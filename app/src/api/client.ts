import axios from 'axios';
import { getAuthToken } from '../store/tokenStore';

const API_BASE_URL = 'https://chacambodia.org/wp-json/cha/v1';

const apiClient = axios.create({
  baseURL: API_BASE_URL,
  timeout: 15000,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Request interceptor - attach auth token if available
apiClient.interceptors.request.use(
  (config) => {
    const token = getAuthToken();
    if (token) {
      config.headers['X-CHA-Token'] = token;
    }
    return config;
  },
  (error) => {
    return Promise.reject(error);
  }
);

// Response interceptor - unwrap data, preserve error code
apiClient.interceptors.response.use(
  (response) => response.data,
  (error) => {
    const data = error.response?.data;
    let message = data?.message;
    if (!message) {
      const status = error.response?.status;
      const contentType = error.response?.headers?.['content-type'] || '';
      if (status) {
        message = contentType.includes('application/json')
          ? `Request failed (${status}).`
          : `Server error (${status}). Response was not JSON.`;
      } else if (error.code === 'ECONNABORTED') {
        message = 'Request timed out. Check your connection and try again.';
      } else if (error.message?.includes('Network Error')) {
        message = 'Could not reach the server. Check your internet connection.';
      } else {
        message = `Network error: ${error.message || 'unknown'}`;
      }
    }
    const err = new Error(message) as any;
    err.code = data?.code || error.code || undefined;
    err.status = error.response?.status;
    return Promise.reject(err);
  }
);

// Auth API
export const authAPI = {
  login: (email: string, password: string) =>
    apiClient.post('/login', { email, password }),

  register: (data: any) =>
    apiClient.post('/register', data),

  verifyEmail: (token: string) =>
    apiClient.get(`/verify?token=${token}`),

  resendVerification: (email: string) =>
    apiClient.post('/resend-verification', { email }),

  forgotPassword: (email: string) =>
    apiClient.post('/forgot-password', { email }),

  logout: () =>
    apiClient.post('/member/logout'),

  changePassword: (current_password: string, new_password: string) =>
    apiClient.post('/member/change-password', { current_password, new_password }),

  deleteAccount: () =>
    apiClient.post('/member/delete'),
};

// Profile API
export const profileAPI = {
  getProfile: (email: string) =>
    apiClient.get('/member/profile', { params: { email, _ts: Date.now() } }),

  updateProfile: (data: any) =>
    apiClient.put('/member/profile', data),

  uploadPhoto: (formData: FormData) =>
    apiClient.post('/member/photo', formData, {
      headers: { 'Content-Type': 'multipart/form-data' },
    }),

  deletePhoto: () =>
    apiClient.post('/member/photo/delete'),
};

// News API
export const newsAPI = {
  getNews: (params?: { page?: number; per_page?: number; category?: string }) =>
    apiClient.get('/news', { params }),
};

// Campaigns API
export const campaignsAPI = {
  getCampaigns: () => apiClient.get('/campaigns'),
};

// PayWay API
export const paywayAPI = {
  purchase: (data: { amount: number; currency?: string; firstname?: string; email?: string; phone?: string }) =>
    apiClient.post('/payway/purchase', { currency: 'USD', ...data }),

  check: (tran_id: string) => apiClient.post('/payway/check', { tran_id }),
};

export default apiClient;
