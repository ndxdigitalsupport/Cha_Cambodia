import React, { useState } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, TextInput, ScrollView, KeyboardAvoidingView, Platform, ActivityIndicator, Alert } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import DateTimePicker from '@react-native-community/datetimepicker';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { useAuth, RegisterPayload } from '../../store/AuthContext';

const haemophiliaTypes = ['Hemophilia A', 'Hemophilia B', 'Other'];
const bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

function parseDob(value: string): Date | null {
  const m = value?.trim().match(/^(\d{1,2})[\/\-.](\d{1,2})[\/\-.](\d{4})$/);
  if (!m) return null;
  const [_, d, mo, y] = m;
  const date = new Date(Number(y), Number(mo) - 1, Number(d));
  if (date.getFullYear() !== Number(y) || date.getMonth() !== Number(mo) - 1) return null;
  return date;
}

function formatDob(date: Date | null): string {
  if (!date) return '';
  const d = String(date.getDate()).padStart(2, '0');
  const m = String(date.getMonth() + 1).padStart(2, '0');
  return `${d}/${m}/${date.getFullYear()}`;
}

const Field = ({
  label, required, optional, children,
}: any) => (
  <View style={styles.inputGroup}>
    <Text style={styles.inputLabel}>
      {label} {required ? <Text style={styles.required}>*</Text> : optional ? <Text style={styles.optional}>(optional)</Text> : null}
    </Text>
    {children}
  </View>
);

export default function AuthScreen({ navigation, route }: any) {
  const { t } = useTranslation();
  const initialMode = route?.params?.mode === 'register' ? false : true;
  const { login, register, resendVerification, isLoading } = useAuth();

  const [isLogin, setIsLogin] = useState(initialMode);
  const [role, setRole] = useState<'member' | 'patient'>('patient');
  const [showPassword, setShowPassword] = useState(false);
  const [agreeTerms, setAgreeTerms] = useState(false);
  const [showDobPicker, setShowDobPicker] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState<string | null>(null);

  const [form, setForm] = useState({
    fullName: '', email: '', password: '', phone: '', address: '',
    dob: '', haemophiliaType: '', bloodType: '',
  });

  const update = (key: string, value: string) => setForm(prev => ({ ...prev, [key]: value }));

  const handleSubmit = async () => {
    setError(null);
    setSuccess(null);

    if (isLogin) {
      if (!form.email.trim() || !form.password) {
        setError('Please enter your email and password.');
        return;
      }
      try {
        await login(form.email.trim(), form.password);
        navigation.navigate('Main', { screen: 'Account' });
      } catch (err: any) {
        if (err.code === 'not_verified') {
          Alert.alert(
            'Email not verified yet',
            'Please check your inbox for the verification link. Want us to send it again?',
            [
              { text: 'Cancel', style: 'cancel' },
              {
                text: 'Resend email',
                onPress: async () => {
                  try {
                    await resendVerification(form.email.trim());
                    setSuccess('Verification email sent. Please check your inbox.');
                  } catch (e: any) {
                    setError(e.message || 'Failed to send email.');
                  }
                },
              },
            ]
          );
        } else {
          setError(err.message || 'Invalid email or password.');
        }
      }
      return;
    }

    // Register
    if (!form.fullName.trim() || !form.email.trim() || !form.password) {
      setError('Please fill in all required fields.');
      return;
    }
    if (!agreeTerms) {
      setError('Please agree to the Terms & Conditions.');
      return;
    }
    const payload: RegisterPayload = {
      name: form.fullName.trim(),
      email: form.email.trim(),
      password: form.password,
      phone: form.phone.trim(),
      address: form.address.trim(),
      role: role === 'patient' ? 'Patient' : 'Member',
    };
    if (role === 'patient') {
      if (form.dob.trim()) payload.dob = form.dob.trim();
      if (form.haemophiliaType) payload.condition = form.haemophiliaType;
      if (form.bloodType) payload.bloodType = form.bloodType;
    }
    try {
      const res = await register(payload);
      setSuccess(res.message || 'Account created. Please verify your email to continue.');
      setIsLogin(true);
      setForm(prev => ({ ...prev, password: '' }));
    } catch (err: any) {
      setError(err.message || 'Registration failed. Please try again.');
    }
  };

  const handleResendFromBanner = async () => {
    setError(null);
    try {
      await resendVerification(form.email.trim());
      setSuccess('Verification email sent. Please check your inbox.');
    } catch (e: any) {
      setError(e.message || 'Failed to send email.');
    }
  };

  const submitBtn = (
    <TouchableOpacity style={styles.submitBtn} activeOpacity={0.85} onPress={handleSubmit} disabled={isLoading}>
      {isLoading ? (
        <ActivityIndicator color="#FFFFFF" />
      ) : (
        <>
          <Text style={styles.submitBtnText}>{isLogin ? t('auth.signInTitle', 'Sign In') : t('auth.createAccount', 'Register')}</Text>
          <Ionicons name="arrow-forward" size={16} color="#FFFFFF" />
        </>
      )}
    </TouchableOpacity>
  );

  return (
    <KeyboardAvoidingView style={styles.flex} behavior={Platform.OS === 'ios' ? 'padding' : undefined}>
      <SafeAreaView style={styles.flex} edges={['top']}>
        <ScrollView style={styles.container} contentContainerStyle={styles.scrollContent} keyboardShouldPersistTaps="handled">
          {/* Branded Header */}
          <View style={styles.header}>
            <TouchableOpacity style={styles.backBtn} onPress={() => navigation.goBack()} hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}>
              <Ionicons name="arrow-back" size={20} color="#0B1D6D" />
            </TouchableOpacity>
            <View style={styles.headerBrand}>
              <View style={styles.headerLogo}>
                <Ionicons name="water" size={15} color="#E31E24" />
              </View>
              <Text style={styles.headerBrandText}>CHA Cambodia</Text>
            </View>
            <View style={{ width: 40 }} />
          </View>

          {/* Title */}
          <View style={styles.titleBlock}>
            <Text style={styles.greeting}>{isLogin ? t('auth.welcomeBack', 'Welcome back') : t('auth.joinCommunity', 'Join the community')}</Text>
            <Text style={styles.title}>{isLogin ? t('auth.signInTitle', 'Sign In') : t('auth.createAccountTitle', 'Create your account')}</Text>
            <Text style={styles.subtitle}>
              {isLogin
                ? t('auth.signInSub', 'Access your membership, treatment info and updates.')
                : t('auth.createAccountSub', 'Register to access support, treatments and our latest news.')}
            </Text>
          </View>

          {!isLogin && (
            <View style={styles.roleSection}>
              <Text style={styles.roleHeading}>{t('auth.iAmA', 'I am a')} <Text style={styles.required}>*</Text></Text>
              <View style={styles.roleRow}>
                <TouchableOpacity
                  style={[styles.roleCard, role === 'member' && styles.roleCardActive]}
                  onPress={() => setRole('member')}
                  activeOpacity={0.85}
                >
                  <View style={[styles.roleIcon, role === 'member' && styles.roleIconActiveMember]}>
                    <Ionicons name="people" size={20} color={role === 'member' ? '#FFFFFF' : '#0B1D6D'} />
                  </View>
                  <View style={styles.roleTextWrap}>
                    <Text style={styles.roleTitle}>{t('auth.member', 'Member')}</Text>
                    <Text style={styles.roleSubtitle}>{t('auth.supporterFamily', 'Member')}</Text>
                  </View>
                </TouchableOpacity>
                <TouchableOpacity
                  style={[styles.roleCard, role === 'patient' && styles.roleCardActive]}
                  onPress={() => setRole('patient')}
                  activeOpacity={0.85}
                >
                  <View style={[styles.roleIcon, role === 'patient' && styles.roleIconActivePatient]}>
                    <Ionicons name="medkit" size={20} color={role === 'patient' ? '#FFFFFF' : '#E31E24'} />
                  </View>
                  <View style={styles.roleTextWrap}>
                    <Text style={styles.roleTitle}>{t('auth.patient', 'Patient')}</Text>
                    <Text style={styles.roleSubtitle}>{t('auth.hasCondition', 'I have a bleeding disorder')}</Text>
                  </View>
                </TouchableOpacity>
              </View>
            </View>
          )}

          {/* Form Card Container */}
          <View style={styles.formCard}>
            {/* Status banners */}
            {error && (
              <View style={[styles.banner, styles.bannerError]}>
                <Ionicons name="alert-circle" size={16} color="#B91C1C" />
                <Text style={styles.bannerErrorText}>{error}</Text>
              </View>
            )}
            {success && (
              <View style={[styles.banner, styles.bannerSuccess]}>
                <Ionicons name="checkmark-circle" size={16} color="#166534" />
                <Text style={styles.bannerSuccessText}>{success}</Text>
                {!isLogin && form.email.trim() && (
                  <TouchableOpacity onPress={handleResendFromBanner}>
                    <Text style={styles.bannerLink}>Resend</Text>
                  </TouchableOpacity>
                )}
              </View>
            )}

            {/* Login Form */}
            {isLogin && (
              <View style={styles.form}>
                <Field label={t('auth.email', 'Email')} required>
                  <View style={styles.iconInputRow}>
                    <Ionicons name="mail" size={16} color="#B6BCC6" style={styles.inputIcon} />
                    <TextInput
                      style={styles.fieldInputInRow}
                      placeholder="name@example.com"
                      placeholderTextColor="#B6BCC6"
                      keyboardType="email-address"
                      autoCapitalize="none"
                      autoCorrect={false}
                      value={form.email}
                      onChangeText={(v) => update('email', v)}
                    />
                  </View>
                </Field>
                <Field label={t('auth.password', 'Password')} required>
                  <View style={styles.iconInputRow}>
                    <Ionicons name="lock-closed" size={16} color="#B6BCC6" style={styles.inputIcon} />
                    <TextInput
                      style={styles.fieldInputInRow}
                      placeholder="••••••••"
                      placeholderTextColor="#B6BCC6"
                      secureTextEntry={!showPassword}
                      value={form.password}
                      onChangeText={(v) => update('password', v)}
                    />
                    <TouchableOpacity style={styles.eyeBtn} onPress={() => setShowPassword(!showPassword)} hitSlop={{ top: 8, bottom: 8, left: 8, right: 8 }}>
                      <Ionicons name={showPassword ? 'eye-off' : 'eye'} size={18} color="#9CA3AF" />
                    </TouchableOpacity>
                  </View>
                </Field>
                <TouchableOpacity style={styles.forgotBtn} onPress={() => navigation.navigate('ForgotPassword')}>
                  <Text style={styles.forgotText}>{t('auth.forgotPassword', 'Forgot password?')}</Text>
                </TouchableOpacity>
                {submitBtn}
                <View style={styles.switchRow}>
                  <Text style={styles.switchLabel}>{t('auth.newToCha', 'New to CHA?')}</Text>
                  <TouchableOpacity onPress={() => { setError(null); setSuccess(null); setIsLogin(false); }}>
                    <Text style={styles.switchLink}>{t('auth.createAccount', 'Create an account')}</Text>
                  </TouchableOpacity>
                </View>
              </View>
            )}

            {/* Register Form */}
            {!isLogin && (
              <View style={styles.form}>
                <Field label={t('auth.fullName', 'Full name')} required>
                  <View style={styles.iconInputRow}>
                    <Ionicons name="person" size={16} color="#B6BCC6" style={styles.inputIcon} />
                    <TextInput
                      style={styles.fieldInputInRow}
                      placeholder="Your full name"
                      placeholderTextColor="#B6BCC6"
                      value={form.fullName}
                      onChangeText={(v) => update('fullName', v)}
                    />
                  </View>
                </Field>
                <Field label={t('auth.email', 'Email address')} required>
                  <View style={styles.iconInputRow}>
                    <Ionicons name="mail" size={16} color="#B6BCC6" style={styles.inputIcon} />
                    <TextInput
                      style={styles.fieldInputInRow}
                      placeholder="name@example.com"
                      placeholderTextColor="#B6BCC6"
                      keyboardType="email-address"
                      autoCapitalize="none"
                      autoCorrect={false}
                      value={form.email}
                      onChangeText={(v) => update('email', v)}
                    />
                  </View>
                </Field>
                <Field label={t('auth.password', 'Password')} required>
                  <View style={styles.iconInputRow}>
                    <Ionicons name="lock-closed" size={16} color="#B6BCC6" style={styles.inputIcon} />
                    <TextInput
                      style={styles.fieldInputInRow}
                      placeholder="Min 6 characters"
                      placeholderTextColor="#B6BCC6"
                      secureTextEntry={!showPassword}
                      value={form.password}
                      onChangeText={(v) => update('password', v)}
                    />
                    <TouchableOpacity style={styles.eyeBtn} onPress={() => setShowPassword(!showPassword)} hitSlop={{ top: 8, bottom: 8, left: 8, right: 8 }}>
                      <Ionicons name={showPassword ? 'eye-off' : 'eye'} size={18} color="#9CA3AF" />
                    </TouchableOpacity>
                  </View>
                </Field>
                <Field label={t('profile.phone', 'Phone number')} optional>
                  <View style={styles.iconInputRow}>
                    <Ionicons name="call" size={16} color="#B6BCC6" style={styles.inputIcon} />
                    <TextInput
                      style={styles.fieldInputInRow}
                      placeholder="012345678"
                      placeholderTextColor="#B6BCC6"
                      keyboardType="phone-pad"
                      value={form.phone}
                      onChangeText={(v) => update('phone', v)}
                    />
                  </View>
                </Field>
                <Field label={t('profile.address', 'Address / Province')} optional>
                  <View style={styles.iconInputRow}>
                    <Ionicons name="location" size={16} color="#B6BCC6" style={styles.inputIcon} />
                    <TextInput
                      style={styles.fieldInputInRow}
                      placeholder="e.g. Phnom Penh"
                      placeholderTextColor="#B6BCC6"
                      value={form.address}
                      onChangeText={(v) => update('address', v)}
                    />
                  </View>
                </Field>

                {role === 'patient' && (
                  <>
                    <Field label={t('profile.dob', 'Date of birth')} optional>
                      <TouchableOpacity style={styles.iconInputRow} onPress={() => setShowDobPicker(true)} activeOpacity={0.85}>
                        <Ionicons name="calendar" size={16} color="#B6BCC6" style={styles.inputIcon} />
                        <Text style={[styles.fieldInputInRowText, !form.dob && styles.placeholderText]}>
                          {form.dob || 'DD/MM/YYYY'}
                        </Text>
                      </TouchableOpacity>
                    </Field>
                    {showDobPicker && (
                      <DateTimePicker
                        value={parseDob(form.dob) || new Date(2000, 0, 1)}
                        mode="date"
                        display="default"
                        onChange={(_, date) => {
                          setShowDobPicker(false);
                          if (date) update('dob', formatDob(date));
                        }}
                      />
                    )}
                    <Field label={t('profile.condition', 'Bleeding disorder type')} optional>
                      <View style={styles.chipsRow}>
                        {haemophiliaTypes.map(type => (
                          <TouchableOpacity
                            key={type}
                            style={[styles.chip, form.haemophiliaType === type && styles.chipActive]}
                            onPress={() => update('haemophiliaType', form.haemophiliaType === type ? '' : type)}
                          >
                            <Text style={[styles.chipText, form.haemophiliaType === type && styles.chipTextActive]}>{type}</Text>
                          </TouchableOpacity>
                        ))}
                      </View>
                    </Field>
                    <Field label={t('profile.bloodType', 'Blood type')} optional>
                      <View style={styles.chipsRow}>
                        {bloodTypes.map(type => (
                          <TouchableOpacity
                            key={type}
                            style={[styles.chip, form.bloodType === type && styles.chipActive]}
                            onPress={() => update('bloodType', form.bloodType === type ? '' : type)}
                          >
                            <Text style={[styles.chipText, form.bloodType === type && styles.chipTextActive]}>{type}</Text>
                          </TouchableOpacity>
                        ))}
                      </View>
                    </Field>
                  </>
                )}

                <TouchableOpacity style={styles.checkboxRow} onPress={() => setAgreeTerms(!agreeTerms)} activeOpacity={0.85}>
                  <View style={[styles.checkbox, agreeTerms && styles.checkboxChecked]}>
                    {agreeTerms && <Ionicons name="checkmark" size={12} color="#FFFFFF" />}
                  </View>
                  <Text style={styles.checkboxLabel}>I agree to the Terms of Service & Privacy Policy</Text>
                </TouchableOpacity>

                <View style={styles.healthNotice}>
                  <Ionicons name="shield-checkmark" size={14} color="#64748B" />
                  <Text style={styles.healthNoticeText}>
                    {t('auth.healthNotice', 'By registering you agree to store your profile details (including any bleeding-disorder type, blood type and emergency contact you provide) securely, used only for your membership card and emergency support.')}
                  </Text>
                </View>

                {submitBtn}

                <View style={styles.switchRow}>
                  <Text style={styles.switchLabel}>{t('auth.alreadyHaveAccount', 'Already have an account?')}</Text>
                  <TouchableOpacity onPress={() => { setError(null); setSuccess(null); setIsLogin(true); }}>
                    <Text style={styles.switchLink}>{t('auth.signInLink', 'Sign in')}</Text>
                  </TouchableOpacity>
                </View>
              </View>
            )}
          </View>
        </ScrollView>
      </SafeAreaView>
    </KeyboardAvoidingView>
  );
}

const styles = StyleSheet.create({
  flex: { flex: 1, backgroundColor: '#F8FAFC' },
  container: { flex: 1 },
  scrollContent: { paddingHorizontal: 20, paddingBottom: 40 },

  header: { flexDirection: 'row', alignItems: 'center', justifyContent: 'space-between', paddingTop: 12, paddingBottom: 20 },
  backBtn: { width: 38, height: 38, borderRadius: 19, backgroundColor: '#FFFFFF', alignItems: 'center', justifyContent: 'center', borderWidth: 1, borderColor: '#E2E8F0' },
  headerBrand: { flexDirection: 'row', alignItems: 'center', gap: 6 },
  headerLogo: { width: 24, height: 24, borderRadius: 12, backgroundColor: '#FEE2E2', alignItems: 'center', justifyContent: 'center' },
  headerBrandText: { fontSize: 13, fontWeight: '800', color: '#0B1D6D', letterSpacing: 0.5, paddingTop: 2 },

  titleBlock: { marginBottom: 20 },
  greeting: { fontSize: 13, fontWeight: '700', color: '#E31E24', textTransform: 'uppercase', letterSpacing: 0.5, marginBottom: 4, lineHeight: 18, paddingTop: 2 },
  title: { fontSize: 26, fontWeight: '800', color: '#0B1D6D', marginBottom: 6, lineHeight: 36, paddingTop: 4 },
  subtitle: { fontSize: 13, color: '#64748B', lineHeight: 20, paddingTop: 2 },

  roleSection: { marginBottom: 20 },
  roleHeading: { fontSize: 13, fontWeight: '700', color: '#334155', marginBottom: 10, lineHeight: 20, paddingTop: 2 },
  required: { color: '#E31E24' },
  roleRow: { flexDirection: 'row', gap: 10 },
  roleCard: { flex: 1, flexDirection: 'row', alignItems: 'center', gap: 10, backgroundColor: '#FFFFFF', padding: 12, borderRadius: 12, borderWidth: 1.5, borderColor: '#E2E8F0' },
  roleCardActive: { borderColor: '#0B1D6D', backgroundColor: '#F0F4FF' },
  roleIcon: { width: 36, height: 36, borderRadius: 18, backgroundColor: '#F1F5F9', alignItems: 'center', justifyContent: 'center' },
  roleIconActiveMember: { backgroundColor: '#0B1D6D' },
  roleIconActivePatient: { backgroundColor: '#E31E24' },
  roleTextWrap: { flex: 1 },
  roleTitle: { fontSize: 13, fontWeight: '700', color: '#0F172A', lineHeight: 18, paddingTop: 2 },
  roleSubtitle: { fontSize: 10, color: '#64748B', lineHeight: 14, paddingTop: 2 },

  formCard: { backgroundColor: '#FFFFFF', borderRadius: 16, padding: 20, borderWidth: 1, borderColor: '#E2E8F0' },

  banner: { flexDirection: 'row', alignItems: 'center', gap: 8, padding: 12, borderRadius: 8, marginBottom: 16 },
  bannerError: { backgroundColor: '#FEE2E2', borderWidth: 1, borderColor: '#FCA5A5' },
  bannerErrorText: { fontSize: 12, color: '#991B1B', flex: 1, lineHeight: 18, paddingTop: 2 },
  bannerSuccess: { backgroundColor: '#DCFCE7', borderWidth: 1, borderColor: '#86EFAC' },
  bannerSuccessText: { fontSize: 12, color: '#166534', flex: 1, lineHeight: 18, paddingTop: 2 },
  bannerLink: { fontSize: 12, fontWeight: '700', color: '#166534', textDecorationLine: 'underline', paddingTop: 2 },

  form: { gap: 14 },
  inputGroup: { gap: 4 },
  inputLabel: { fontSize: 12, fontWeight: '700', color: '#334155', lineHeight: 18, paddingTop: 2 },
  optional: { color: '#94A3B8', fontWeight: '400' },
  iconInputRow: { flexDirection: 'row', alignItems: 'center', backgroundColor: '#F8FAFC', borderWidth: 1, borderColor: '#CBD5E1', borderRadius: 10, paddingHorizontal: 12, height: 46 },
  inputIcon: { marginRight: 8 },
  fieldInputInRow: { flex: 1, fontSize: 14, color: '#0F172A', paddingVertical: 0 },
  fieldInputInRowText: { flex: 1, fontSize: 14, color: '#0F172A', paddingTop: 2 },
  placeholderText: { color: '#B6BCC6' },
  eyeBtn: { padding: 4 },

  forgotBtn: { alignSelf: 'flex-end', marginTop: -4 },
  forgotText: { fontSize: 12, fontWeight: '600', color: '#0B1D6D', paddingTop: 2 },

  submitBtn: { backgroundColor: '#E31E24', flexDirection: 'row', alignItems: 'center', justifyContent: 'center', gap: 8, height: 48, borderRadius: 10, marginTop: 6 },
  submitBtnText: { color: '#FFFFFF', fontSize: 14, fontWeight: '700', paddingTop: 2 },

  switchRow: { flexDirection: 'row', alignItems: 'center', justifyContent: 'center', gap: 6, marginTop: 10 },
  switchLabel: { fontSize: 13, color: '#64748B', paddingTop: 2 },
  switchLink: { fontSize: 13, fontWeight: '700', color: '#0B1D6D', paddingTop: 2 },

  chipsRow: { flexDirection: 'row', flexWrap: 'wrap', gap: 6 },
  chip: { paddingHorizontal: 12, paddingVertical: 6, borderRadius: 100, backgroundColor: '#F1F5F9', borderWidth: 1, borderColor: '#CBD5E1' },
  chipActive: { backgroundColor: '#0B1D6D', borderColor: '#0B1D6D' },
  chipText: { fontSize: 11, fontWeight: '600', color: '#475569', paddingTop: 2 },
  chipTextActive: { color: '#FFFFFF' },

  checkboxRow: { flexDirection: 'row', alignItems: 'center', gap: 8, marginVertical: 4 },
  checkbox: { width: 18, height: 18, borderRadius: 4, borderWidth: 1.5, borderColor: '#CBD5E1', alignItems: 'center', justifyContent: 'center' },
  checkboxChecked: { backgroundColor: '#0B1D6D', borderColor: '#0B1D6D' },
  checkboxLabel: { fontSize: 12, color: '#475569', flex: 1, lineHeight: 18, paddingTop: 2 },
  healthNotice: { flexDirection: 'row', alignItems: 'flex-start', gap: 8, backgroundColor: '#F8FAFC', borderWidth: 1, borderColor: '#E2E8F0', borderRadius: 10, padding: 12, marginTop: 4 },
  healthNoticeText: { fontSize: 11, color: '#64748B', flex: 1, lineHeight: 16, paddingTop: 2 },
});
