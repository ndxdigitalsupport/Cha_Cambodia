import React, { useState } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, Image, Modal } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { LinearGradient } from 'expo-linear-gradient';
import { useAuth } from '../../store/AuthContext';
import { Colors, Spacing, BorderRadius, Shadows } from '../../theme/colors';
import { changeLanguage } from '../../i18n';
import chaLogo from '../../../assets/cha-logo.png';

function initialsOf(name: string) {
  return (name || '?')
    .split(' ')
    .map((w) => w[0])
    .join('')
    .substring(0, 2)
    .toUpperCase();
}

const LANG_OPTIONS = [
  { code: 'en', label: 'English' },
  { code: 'km', label: 'ខ្មែរ' },
];

export default function DashboardScreen({ navigation }: any) {
  const { user, logout } = useAuth();
  const { t, i18n } = useTranslation();
  const [showLangPicker, setShowLangPicker] = useState(false);
  const [showLogoutConfirm, setShowLogoutConfirm] = useState(false);

  const currentLang = (i18n.language || 'en').startsWith('km') ? 'km' : 'en';

  const handleLanguageChange = async (code: string) => {
    setShowLangPicker(false);
    await changeLanguage(code);
  };

  const handleLogout = async () => {
    setShowLogoutConfirm(true);
  };

  const confirmLogout = async () => {
    setShowLogoutConfirm(false);
    await logout();
  };

  const handleSignIn = () => {
    navigation.navigate('Auth');
  };

  // Logged-out state
  if (!user) {
    return (
      <View style={styles.container}>
        <View style={styles.header}>
          <Text style={styles.headerTitle}>{t('dashboard.title', 'Account')}</Text>
          <View style={styles.headerRight}>
            <TouchableOpacity style={styles.langBtn} onPress={() => setShowLangPicker(true)} activeOpacity={0.85}>
              <Ionicons name="globe-outline" size={16} color="#FFFFFF" />
              <Text style={styles.langBtnText}>{currentLang === 'km' ? 'ខ្មែរ' : 'EN'}</Text>
            </TouchableOpacity>
          </View>
        </View>
        <View style={styles.emptyState}>
          <View style={styles.emptyIcon}>
            <Ionicons name="person-outline" size={48} color="#D1D5DB" />
          </View>
          <Text style={styles.emptyTitle}>{t('dashboard.welcome', 'Welcome to CHA')}</Text>
          <Text style={styles.emptySubtitle}>
            {t('dashboard.welcomeSub', 'Sign in to access your digital membership card, emergency treatment info, and medical updates.')}
          </Text>
          <TouchableOpacity style={styles.signInBtn} onPress={handleSignIn} activeOpacity={0.85}>
            <Ionicons name="log-in" size={18} color="#FFFFFF" />
            <Text style={styles.signInBtnText}>{t('dashboard.signInRegister', 'Sign In')}</Text>
          </TouchableOpacity>
        </View>

        <LanguagePicker visible={showLangPicker} current={currentLang} onSelect={handleLanguageChange} onClose={() => setShowLangPicker(false)} />
      </View>
    );
  }

  const menuItems = [
    { icon: 'person' as const, label: t('dashboard.editProfile', 'My Profile'), color: '#0B1D6D', screen: 'EditProfile' },
    { icon: 'card' as const, label: t('dashboard.idCard', 'Membership Card'), color: '#E31E24', screen: 'MembershipCard' },
    { icon: 'settings' as const, label: t('settings.title', 'Settings'), color: '#6B7280', screen: 'Settings' },
    { icon: 'help-circle' as const, label: t('settings.helpCenter', 'Help & Support'), color: '#0B1D6D', screen: 'Help' },
  ];

  // Logged-in state
  return (
    <ScrollView style={styles.container} showsVerticalScrollIndicator={false}>
      {/* Top Header Row */}
      <View style={styles.topBar}>
        <Text style={styles.topBarTitle}>{t('dashboard.title', 'Account')}</Text>
        <TouchableOpacity style={styles.langBtnDark} onPress={() => setShowLangPicker(true)} activeOpacity={0.85}>
          <Ionicons name="globe-outline" size={16} color={Colors.primary} />
          <Text style={styles.langBtnTextDark}>{currentLang === 'km' ? 'ខ្មែរ' : 'EN'}</Text>
        </TouchableOpacity>
      </View>

      {/* VIP Membership Card */}
      <View style={styles.cardSection}>
        <TouchableOpacity activeOpacity={0.9} onPress={() => navigation.navigate('MembershipCard')}>
          <LinearGradient
            colors={['#0B1D6D', '#142C8E']}
            start={{ x: 0, y: 0 }}
            end={{ x: 1, y: 1 }}
            style={styles.vipCard}
          >
            <View style={styles.vipCardTop}>
              <View style={styles.vipLogoWrap}>
                <Image source={chaLogo} style={styles.vipLogoImg} />
              </View>
              <View style={styles.vipOrgInfo}>
                <Text style={styles.vipOrgName}>CHA Cambodia</Text>
                <Text style={styles.vipOrgSub}>Verified Patient ID</Text>
              </View>
              <View style={styles.vipAvatarWrap}>
                {user?.photo ? (
                  <Image source={{ uri: user.photo }} style={styles.vipAvatarImg} />
                ) : (
                  <Image source={chaLogo} style={styles.vipAvatarImg} />
                )}
              </View>
            </View>

            <View style={styles.vipCardMiddle}>
              <Text style={styles.vipMemberName}>{(user?.name || '').toUpperCase()}</Text>
              <Text style={styles.vipMemberId}>ID: {user?.memberId || '—'}</Text>
            </View>

            <View style={styles.vipCardBottom}>
              <View style={styles.vipDataBlock}>
                <Text style={styles.vipDataLabel}>Role</Text>
                <Text style={styles.vipDataValue}>{t('dashboard.member', 'Member')}</Text>
              </View>
              <View style={styles.vipDataBlock}>
                <Text style={styles.vipDataLabel}>Joined</Text>
                <Text style={styles.vipDataValue}>{user?.memberSince || '—'}</Text>
              </View>
              <View style={styles.vipDataBlockRight}>
                <Text style={styles.vipDataLabel}>Status</Text>
                <View style={styles.vipStatusPill}>
                  <Text style={styles.vipStatusText}>{user?.status === 'active' ? 'Active' : 'Pending'}</Text>
                </View>
              </View>
            </View>
          </LinearGradient>
        </TouchableOpacity>
      </View>

      {/* Menu Options (Frameless rows) */}
      <View style={styles.menuList}>
        {menuItems.map((item, index) => (
          <TouchableOpacity
            key={index}
            style={[styles.menuRow, index === menuItems.length - 1 && styles.menuRowLast]}
            onPress={() => item.screen && navigation.navigate(item.screen)}
            activeOpacity={0.7}
          >
            <View style={[styles.menuRowIcon, { backgroundColor: item.color + '15' }]}>
              <Ionicons name={item.icon} size={20} color={item.color} />
            </View>
            <Text style={styles.menuRowLabel}>{item.label}</Text>
            <Ionicons name="chevron-forward" size={18} color="#9CA3AF" />
          </TouchableOpacity>
        ))}
      </View>

      {/* Sign Out Action */}
      <View style={styles.logoutSection}>
        <TouchableOpacity style={styles.logoutBtn} onPress={handleLogout} activeOpacity={0.7}>
          <Ionicons name="log-out" size={18} color="#DC2626" />
          <Text style={styles.logoutText}>{t('dashboard.signOut', 'Sign Out')}</Text>
        </TouchableOpacity>
      </View>

      <View style={{ height: Spacing.xxl }} />

      <LanguagePicker visible={showLangPicker} current={currentLang} onSelect={handleLanguageChange} onClose={() => setShowLangPicker(false)} />

      {/* Sign Out Confirmation Modal */}
      <Modal visible={showLogoutConfirm} transparent animationType="fade" onRequestClose={() => setShowLogoutConfirm(false)}>
        <View style={styles.confirmBackdrop}>
          <View style={styles.confirmCard}>
            <View style={styles.confirmIconWrap}>
              <Ionicons name="log-out" size={28} color="#DC2626" />
            </View>
            <Text style={styles.confirmTitle}>{t('dashboard.signOut', 'Sign Out')}</Text>
            <Text style={styles.confirmMsg}>{t('dashboard.signOutConfirm', 'Are you sure you want to sign out of your CHA account?')}</Text>
            <View style={styles.confirmActions}>
              <TouchableOpacity style={styles.confirmCancelBtn} onPress={() => setShowLogoutConfirm(false)} activeOpacity={0.8}>
                <Text style={styles.confirmCancelText}>{t('common.cancel', 'Cancel')}</Text>
              </TouchableOpacity>
              <TouchableOpacity style={styles.confirmLogoutBtn} onPress={confirmLogout} activeOpacity={0.8}>
                <Text style={styles.confirmLogoutText}>{t('dashboard.signOut', 'Sign Out')}</Text>
              </TouchableOpacity>
            </View>
          </View>
        </View>
      </Modal>
    </ScrollView>
  );
}

function LanguagePicker({
  visible, current, onSelect, onClose,
}: {
  visible: boolean;
  current: string;
  onSelect: (code: string) => void;
  onClose: () => void;
}) {
  const { t } = useTranslation();
  return (
    <Modal visible={visible} transparent animationType="fade" onRequestClose={onClose}>
      <TouchableOpacity style={styles.modalBackdrop} activeOpacity={1} onPress={onClose}>
        <View style={styles.modalCard} onStartShouldSetResponder={() => true}>
          <Text style={styles.modalTitle}>{t('settings.selectLanguage', 'Language')}</Text>
          {LANG_OPTIONS.map((l) => (
            <TouchableOpacity
              key={l.code}
              style={[styles.langOption, current === l.code && styles.langOptionActive]}
              onPress={() => onSelect(l.code)}
              activeOpacity={0.85}
            >
              <Text style={[styles.langOptionText, current === l.code && styles.langOptionTextActive]}>{l.label}</Text>
              {current === l.code && <Ionicons name="checkmark" size={18} color="#0B1D6D" />}
            </TouchableOpacity>
          ))}
        </View>
      </TouchableOpacity>
    </Modal>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8FAFC' },
  
  // Headers
  header: {
    backgroundColor: '#0B1D6D',
    paddingTop: 56,
    paddingBottom: 20,
    paddingHorizontal: Spacing.lg,
    flexDirection: 'row',
    alignItems: 'center',
  },
  headerTitle: { fontSize: 28, fontWeight: '700', color: '#FFFFFF', flex: 1, lineHeight: 42, paddingTop: 6, paddingBottom: 2 },
  headerRight: { flexDirection: 'row', alignItems: 'center' },
  langBtn: { flexDirection: 'row', alignItems: 'center', gap: 6, backgroundColor: 'rgba(255,255,255,0.15)', borderRadius: 100, paddingHorizontal: 14, paddingVertical: 8 },
  langBtnText: { fontSize: 13, fontWeight: '700', color: '#FFFFFF', paddingTop: 4, lineHeight: 18 },

  topBar: {
    paddingTop: 64,
    paddingBottom: 20,
    paddingHorizontal: Spacing.lg,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  topBarTitle: { fontSize: 32, fontWeight: '900', color: Colors.secondary, paddingTop: 4 },
  langBtnDark: { flexDirection: 'row', alignItems: 'center', gap: 6, backgroundColor: '#FFFFFF', borderRadius: 100, paddingHorizontal: 14, paddingVertical: 8, borderWidth: 1, borderColor: 'rgba(0,0,0,0.05)', ...Shadows.sm },
  langBtnTextDark: { fontSize: 13, fontWeight: '800', color: Colors.primary, paddingTop: 2 },

  // Empty state
  emptyState: { flex: 1, alignItems: 'center', justifyContent: 'center', paddingHorizontal: Spacing.xl, paddingTop: 60 },
  emptyIcon: { width: 96, height: 96, borderRadius: 48, backgroundColor: '#F3F4F6', alignItems: 'center', justifyContent: 'center', marginBottom: Spacing.lg },
  emptyTitle: { fontSize: 22, fontWeight: '700', color: '#1A1A1A', marginBottom: 8, textAlign: 'center', lineHeight: 34, paddingTop: 6 },
  emptySubtitle: { fontSize: 14, color: '#6B7280', textAlign: 'center', lineHeight: 22, paddingTop: 2, marginBottom: Spacing.xl },
  signInBtn: { flexDirection: 'row', alignItems: 'center', gap: 8, backgroundColor: '#0B1D6D', paddingHorizontal: 32, paddingVertical: 14, borderRadius: 12, shadowColor: '#0B1D6D', shadowOffset: { width: 0, height: 4 }, shadowOpacity: 0.2, shadowRadius: 8, elevation: 4 },
  signInBtnText: { fontSize: 15, fontWeight: '700', color: '#FFFFFF', paddingTop: 4, lineHeight: 20 },

  // VIP Card
  cardSection: { paddingHorizontal: Spacing.lg, marginBottom: 32 },
  vipCard: {
    borderRadius: 24,
    padding: 24,
    ...Shadows.lg,
    shadowColor: Colors.secondary,
    shadowOpacity: 0.3,
    shadowRadius: 16,
  },
  vipCardTop: { flexDirection: 'row', alignItems: 'center', marginBottom: 32 },
  vipLogoWrap: { width: 44, height: 44, borderRadius: 22, backgroundColor: '#FFFFFF', alignItems: 'center', justifyContent: 'center', marginRight: 16, overflow: 'hidden' },
  vipLogoImg: { width: 36, height: 36, borderRadius: 18 },
  vipOrgInfo: { flex: 1 },
  vipOrgName: { fontSize: 17, fontWeight: '900', color: '#FFFFFF', letterSpacing: 0.5, paddingTop: 2 },
  vipOrgSub: { fontSize: 12, color: 'rgba(255,255,255,0.7)', fontWeight: '600', paddingTop: 2 },
  vipAvatarWrap: { width: 48, height: 48, borderRadius: 24, backgroundColor: 'rgba(255,255,255,0.2)', alignItems: 'center', justifyContent: 'center', overflow: 'hidden', borderWidth: 2, borderColor: '#FFFFFF' },
  vipAvatarImg: { width: '100%', height: '100%' },
  vipAvatarText: { fontSize: 18, fontWeight: '800', color: '#FFFFFF' },

  vipCardMiddle: { marginBottom: 32 },
  vipMemberName: { fontSize: 26, fontWeight: '900', color: '#FFFFFF', letterSpacing: 1, paddingTop: 2, marginBottom: 4 },
  vipMemberId: { fontSize: 15, color: 'rgba(255,255,255,0.85)', fontWeight: '600', letterSpacing: 2, paddingTop: 2 },

  vipCardBottom: { flexDirection: 'row', borderTopWidth: 1, borderTopColor: 'rgba(255,255,255,0.15)', paddingTop: 20 },
  vipDataBlock: { flex: 1 },
  vipDataBlockRight: { flex: 1, alignItems: 'flex-end' },
  vipDataLabel: { fontSize: 11, color: 'rgba(255,255,255,0.6)', fontWeight: '700', textTransform: 'uppercase', letterSpacing: 1, marginBottom: 6, paddingTop: 2 },
  vipDataValue: { fontSize: 15, fontWeight: '800', color: '#FFFFFF', paddingTop: 2 },
  vipStatusPill: { backgroundColor: '#10B981', paddingHorizontal: 12, paddingVertical: 4, borderRadius: 100 },
  vipStatusText: { fontSize: 11, fontWeight: '800', color: '#FFFFFF', paddingTop: 2 },

  // Menu List (Frameless)
  menuList: { backgroundColor: '#FFFFFF', borderRadius: 24, marginHorizontal: Spacing.lg, paddingVertical: 8, ...Shadows.sm, borderWidth: 1, borderColor: 'rgba(0,0,0,0.03)' },
  menuRow: { flexDirection: 'row', alignItems: 'center', paddingVertical: 16, paddingHorizontal: 20, borderBottomWidth: StyleSheet.hairlineWidth, borderBottomColor: 'rgba(0,0,0,0.06)' },
  menuRowLast: { borderBottomWidth: 0 },
  menuRowIcon: { width: 36, height: 36, borderRadius: 18, alignItems: 'center', justifyContent: 'center', marginRight: 16 },
  menuRowLabel: { flex: 1, fontSize: 16, fontWeight: '700', color: Colors.text, paddingTop: 2 },

  // Logout
  logoutSection: { paddingHorizontal: Spacing.lg, marginTop: 32, marginBottom: 20 },
  logoutBtn: { flexDirection: 'row', alignItems: 'center', justifyContent: 'center', gap: 8, backgroundColor: '#FEF2F2', paddingVertical: 16, borderRadius: 16, borderWidth: 1, borderColor: '#FEE2E2' },
  logoutText: { fontSize: 15, fontWeight: '700', color: '#DC2626', letterSpacing: 0.5, paddingTop: 2 },

  // Modal
  modalBackdrop: { flex: 1, backgroundColor: 'rgba(0,0,0,0.4)', alignItems: 'center', justifyContent: 'center', paddingHorizontal: Spacing.xl },
  modalCard: { backgroundColor: '#FFFFFF', borderRadius: BorderRadius.lg, padding: Spacing.lg, width: '100%', maxWidth: 360 },
  modalTitle: { fontSize: 18, fontWeight: '700', color: '#0B1D6D', marginBottom: Spacing.md, lineHeight: 26, paddingTop: 4 },
  langOption: { flexDirection: 'row', alignItems: 'center', justifyContent: 'space-between', paddingVertical: Spacing.md, paddingHorizontal: Spacing.md, borderRadius: BorderRadius.md, marginBottom: Spacing.sm, backgroundColor: '#F8F9FB' },
  langOptionActive: { backgroundColor: '#EAF0FB' },
  langOptionText: { fontSize: 15, color: '#1A1A1A', paddingTop: 4, lineHeight: 22 },
  langOptionTextActive: { color: '#0B1D6D', fontWeight: '600' },

  // Logout Confirmation Modal
  confirmBackdrop: { flex: 1, backgroundColor: 'rgba(15,30,84,0.5)', alignItems: 'center', justifyContent: 'center', paddingHorizontal: 28 },
  confirmCard: { backgroundColor: '#FFFFFF', borderRadius: 24, padding: 28, width: '100%', maxWidth: 340, alignItems: 'center' },
  confirmIconWrap: { width: 60, height: 60, borderRadius: 30, backgroundColor: '#FEF2F2', alignItems: 'center', justifyContent: 'center', marginBottom: 16 },
  confirmTitle: { fontSize: 18, fontWeight: '800', color: '#0F172A', marginBottom: 6, textAlign: 'center' },
  confirmMsg: { fontSize: 14, color: '#64748B', textAlign: 'center', lineHeight: 21, marginBottom: 24 },
  confirmActions: { flexDirection: 'row', gap: 12, width: '100%' },
  confirmCancelBtn: { flex: 1, paddingVertical: 14, borderRadius: 14, backgroundColor: '#F1F5F9', alignItems: 'center' },
  confirmCancelText: { fontSize: 15, fontWeight: '700', color: '#475569' },
  confirmLogoutBtn: { flex: 1, paddingVertical: 14, borderRadius: 14, backgroundColor: '#DC2626', alignItems: 'center' },
  confirmLogoutText: { fontSize: 15, fontWeight: '700', color: '#FFFFFF' },
});
