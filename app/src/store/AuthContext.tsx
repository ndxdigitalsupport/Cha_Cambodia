import React, { createContext, useContext, useState, useCallback, useEffect, ReactNode } from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { authAPI, profileAPI } from '../api/client';
import { setAuthToken } from './tokenStore';

export interface ChaUser {
  memberId: string;
  name: string;
  nameKhmer?: string;
  email: string;
  province: string;
  role: string;
  memberSince: string;
  status: string;
  registered: string;
  bloodType: string;
  condition: string;
  dob: string;
  treatmentCentre: string;
  phone: string;
  emergencyContact: string;
  linkedPatient: string;
  relationship: string;
  affiliation: string;
  specialty: string;
  licenseNumber: string;
  photo: string;
  address: string;
  token?: string;
}

export interface RegisterPayload {
  name: string;
  nameKhmer?: string;
  email: string;
  password: string;
  phone: string;
  address: string;
  role: string;
  dob?: string;
  condition?: string;
  bloodType?: string;
}

interface AuthContextValue {
  user: ChaUser | null;
  isLoading: boolean;
  isHydrated: boolean;
  login: (email: string, password: string) => Promise<void>;
  register: (payload: RegisterPayload) => Promise<{ message: string }>;
  resendVerification: (email: string) => Promise<void>;
  logout: () => Promise<void>;
  refreshUser: () => Promise<void>;
  updatePhoto: (photoUrl: string) => Promise<void>;
}

const AuthContext = createContext<AuthContextValue | undefined>(undefined);

const STORAGE_KEY = 'cha_current_user';

function extractUser(data: any): ChaUser | null {
  if (!data || !data.memberId) return null;
  const token = data.token || undefined;
  const { token: _t, ...rest } = data;
  return { ...rest, token } as ChaUser;
}

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<ChaUser | null>(null);
  const [isLoading, setIsLoading] = useState(false);
  const [isHydrated, setIsHydrated] = useState(false);

  // Hydrate session from AsyncStorage on mount
  useEffect(() => {
    (async () => {
      try {
        const raw = await AsyncStorage.getItem(STORAGE_KEY);
        if (raw) {
          const parsed = JSON.parse(raw);
          const u = extractUser(parsed);
          setUser(u);
          if (u?.token) setAuthToken(u.token);
        }
      } catch (e) {
        // ignore hydration errors
      } finally {
        setIsHydrated(true);
      }
    })();
  }, []);

  const persist = useCallback(async (u: ChaUser | null) => {
    if (u) {
      await AsyncStorage.setItem(STORAGE_KEY, JSON.stringify(u));
    } else {
      await AsyncStorage.removeItem(STORAGE_KEY);
    }
  }, []);

  const login = useCallback(async (email: string, password: string) => {
    setIsLoading(true);
    try {
      const data = await authAPI.login(email, password) as any;
      const u = extractUser(data);
      if (!u) throw new Error('Could not read account details.');
      if (u.token) setAuthToken(u.token);
      setUser(u);
      await persist(u);
    } finally {
      setIsLoading(false);
    }
  }, [persist]);

  const register = useCallback(async (payload: RegisterPayload) => {
    setIsLoading(true);
    try {
      const data = await authAPI.register(payload) as any;
      return { message: data?.message || 'Account created. Please verify your email.' };
    } finally {
      setIsLoading(false);
    }
  }, []);

  const resendVerification = useCallback(async (email: string) => {
    await authAPI.resendVerification(email);
  }, []);

  const logout = useCallback(async () => {
    try {
      await authAPI.logout();
    } catch (e) {
      // backend revoke is best-effort; always clear local session
    }
    setUser(null);
    setAuthToken(null);
    await AsyncStorage.removeItem(STORAGE_KEY);
  }, []);

  const refreshUser = useCallback(async () => {
    if (!user?.email) return;
    try {
      const data = await profileAPI.getProfile(user.email) as any;
      if (data?.memberId) {
        const u = extractUser({ ...data, token: user.token });
        setUser(u);
        await persist(u);
      }
    } catch (e) {
      // ignore refresh failures
    }
  }, [user, persist]);

  const updatePhoto = useCallback(async (photoUrl: string) => {
    if (!user) return;
    const u = { ...user, photo: photoUrl };
    setUser(u);
    await persist(u);
  }, [user, persist]);

  return (
    <AuthContext.Provider
      value={{
        user,
        isLoading,
        isHydrated,
        login,
        register,
        resendVerification,
        logout,
        refreshUser,
        updatePhoto,
      }}
    >
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth(): AuthContextValue {
  const ctx = useContext(AuthContext);
  if (!ctx) throw new Error('useAuth must be used within an AuthProvider');
  return ctx;
}