import React, { useState } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, Switch, Linking, Modal, Alert } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import Constants from 'expo-constants';
import { useTranslation } from 'react-i18next';
import { Colors, Spacing, BorderRadius, Shadows } from '../../theme/colors';
import { changeLanguage } from '../../i18n';
import { useAuth } from '../../store/AuthContext';
import { useAppTheme } from '../../store/ThemeContext';

function appVersion(): string {
  const v = Constants.expoConfig?.version || '';
  const build = Constants.nativeBuildVersion || '';
  return v ? (build && build !== '1' ? `${v} (${build})` : v) : '1.0.1';
}

interface SettingItem {
  icon: keyof typeof Ionicons.glyphMap;
  label: string;
  color: string;
  value?: string;
  action?: string;
  isSwitch?: boolean;
  switchValue?: boolean;
  onToggle?: (v: boolean) => void;
}

export default function SettingsScreen({ navigation }: any) {
  const { user } = useAuth();
  const { t, i18n } = useTranslation();
  const { isDarkMode, theme, toggleDarkMode } = useAppTheme();

  const [notifications, setNotifications] = useState(true);
  const [showLangPicker, setShowLangPicker] = useState(false);

  const currentLang = (i18n.language || 'en').startsWith('km') ? 'km' : 'en';

  const handleLanguageSelect = async (code: string) => {
    setShowLangPicker(false);
    await changeLanguage(code);
  };

  const handleContactSupport = () => {
    Alert.alert(
      t('settings.contactSupport', 'Contact Support'),
      t('settings.contactChoice', 'Choose how you would like to contact CHA Support:'),
      [
        {
          text: t('programs.callClinic', 'Call 24/7 Hotline'),
          onPress: () => Linking.openURL('tel:+85512751728'),
        },
        {
          text: t('profile.email', 'Send Email'),
          onPress: () => Linking.openURL('mailto:info@chacambodia.org'),
        },
        {
          text: t('common.cancel', 'Cancel'),
          style: 'cancel',
        },
      ]
    );
  };

  const handleRowPress = (action: string) => {
    if (action === 'lang') {
      setShowLangPicker(true);
    } else if (action === 'EditProfile') {
      navigation.navigate(user ? 'EditProfile' : 'Auth');
    } else if (action === 'ChangePassword') {
      navigation.navigate(user ? 'ChangePassword' : 'Auth');
    } else if (action === 'MembershipCard') {
      navigation.navigate(user ? 'MembershipCard' : 'Auth');
    } else if (action === 'Help') {
      navigation.navigate('Help');
    } else if (action === 'ContactSupport') {
      handleContactSupport();
    } else if (action.startsWith('http')) {
      Linking.openURL(action);
    }
  };

  const sections: { title: string; items: SettingItem[] }[] = [
    {
      title: t('settings.preferences', 'App Preferences'),
      items: [
        {
          icon: 'globe-outline' as const,
          label: t('settings.language', 'Language'),
          value: currentLang === 'km' ? 'ខ្មែរ (Khmer)' : 'English',
          color: Colors.secondary,
          action: 'lang',
        },
        {
          icon: 'notifications-outline' as const,
          label: t('settings.notifications', 'Push Notifications'),
          color: Colors.primary,
          isSwitch: true,
          switchValue: notifications,
          onToggle: setNotifications,
        },
      ],
    },
    {
      title: t('settings.helpCenter', 'Support & Legal'),
      items: [
        { icon: 'help-circle-outline' as const, label: t('settings.helpCenter', 'Help Center'), color: Colors.secondary, action: 'Help' },
        { icon: 'chatbubble-ellipses-outline' as const, label: t('settings.contactSupport', 'Contact Support'), color: Colors.success, action: 'ContactSupport' },
        { icon: 'document-text-outline' as const, label: t('settings.privacy', 'Privacy Policy'), color: Colors.textSecondary, action: 'https://chacambodia.org/privacy' },
        { icon: 'document-outline' as const, label: t('settings.terms', 'Terms of Use'), color: Colors.textSecondary, action: 'https://chacambodia.org/terms' },
      ],
    },
  ];

  return (
    <ScrollView style={[styles.container, { backgroundColor: theme.background }]} showsVerticalScrollIndicator={false}>
      {/* Header */}
      <View style={styles.header}>
        <TouchableOpacity style={styles.backBtn} onPress={() => navigation.goBack()} hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}>
          <Ionicons name="arrow-back" size={20} color="#FFFFFF" />
        </TouchableOpacity>
        <View style={styles.headerTitleWrap}>
          <Text style={styles.headerTitle}>{t('settings.title', 'Settings')}</Text>
          <Text style={styles.headerSub}>{t('settings.sub', 'Preferences & Security')}</Text>
        </View>
      </View>

      {/* Settings Sections */}
      {sections.map((section, sIndex) => (
        <View key={sIndex} style={styles.section}>
          <Text style={[styles.sectionTitle, { color: theme.textSecondary }]}>{section.title}</Text>
          <View style={[styles.sectionCard, { backgroundColor: theme.card, borderColor: theme.border }]}>
            {section.items.map((item, iIndex) => (
              <TouchableOpacity
                key={iIndex}
                style={[styles.menuItem, { borderBottomColor: theme.border }, iIndex === section.items.length - 1 && styles.noBorder]}
                onPress={() => item.action && handleRowPress(item.action)}
                activeOpacity={0.85}
              >
                <View style={[styles.menuIcon, { backgroundColor: item.color + '15' }]}>
                  <Ionicons name={item.icon} size={18} color={item.color} />
                </View>
                <Text style={[styles.menuLabel, { color: theme.text }]}>{item.label}</Text>
                {item.isSwitch ? (
                  <Switch
                    value={item.switchValue}
                    onValueChange={item.onToggle}
                    trackColor={{ false: '#E2E8F0', true: Colors.primaryLight }}
                    thumbColor={item.switchValue ? Colors.primary : Colors.textMuted}
                  />
                ) : (
                  <View style={styles.menuRight}>
                    {item.value && <Text style={[styles.menuValue, { color: theme.textSecondary }]}>{item.value}</Text>}
                    <Ionicons name="chevron-forward" size={16} color={theme.textSecondary} />
                  </View>
                )}
              </TouchableOpacity>
            ))}
          </View>
        </View>
      ))}

      {/* App Version Footer */}
      <View style={styles.versionSection}>
        <Text style={[styles.versionText, { color: theme.textSecondary }]}>{t('home.heroTag', 'Cambodian Haemophilia Association')}</Text>
        <Text style={[styles.versionSub, { color: theme.textMuted }]}>{t('settings.version', 'Version')} {appVersion()}</Text>
      </View>

      <View style={{ height: Spacing.xl }} />

      {/* Language Modal */}
      <Modal visible={showLangPicker} transparent animationType="fade" onRequestClose={() => setShowLangPicker(false)}>
        <TouchableOpacity style={styles.modalBackdrop} activeOpacity={1} onPress={() => setShowLangPicker(false)}>
          <View style={[styles.modalCard, { backgroundColor: theme.card }]} onStartShouldSetResponder={() => true}>
            <Text style={[styles.modalTitle, { color: theme.text }]}>{t('settings.selectLanguage', 'Select Language')}</Text>
            {[
              { code: 'en', label: 'English' },
              { code: 'km', label: 'ខ្មែរ (Khmer)' },
            ].map((l) => (
              <TouchableOpacity
                key={l.code}
                style={[styles.modalOption, { backgroundColor: theme.background, borderColor: theme.border }, currentLang === l.code && styles.modalOptionActive]}
                onPress={() => handleLanguageSelect(l.code)}
                activeOpacity={0.85}
              >
                <Text style={[styles.modalOptionText, { color: theme.text }, currentLang === l.code && styles.modalOptionTextActive]}>{l.label}</Text>
                {currentLang === l.code && <Ionicons name="checkmark-circle" size={20} color={Colors.primary} />}
              </TouchableOpacity>
            ))}
          </View>
        </TouchableOpacity>
      </Modal>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1 },
  header: {
    backgroundColor: Colors.secondary,
    paddingTop: 56,
    paddingBottom: 24,
    paddingHorizontal: Spacing.lg,
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
  },
  backBtn: {
    width: 38,
    height: 38,
    borderRadius: 19,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: 'rgba(255,255,255,0.18)',
  },
  headerTitleWrap: { flex: 1 },
  headerTitle: { fontSize: 24, fontWeight: '800', color: '#FFFFFF', lineHeight: 34, paddingTop: 4 },
  headerSub: { fontSize: 12, color: 'rgba(255,255,255,0.7)', marginTop: 2, lineHeight: 18, paddingTop: 2 },

  section: { paddingHorizontal: Spacing.lg, paddingTop: Spacing.lg },
  sectionTitle: { fontSize: 13, fontWeight: '800', textTransform: 'uppercase', letterSpacing: 0.5, marginBottom: 8, lineHeight: 20, paddingTop: 2 },
  sectionCard: { borderRadius: BorderRadius.lg, borderWidth: 1, overflow: 'hidden', ...Shadows.sm },

  menuItem: { flexDirection: 'row', alignItems: 'center', padding: 14, borderBottomWidth: 1 },
  noBorder: { borderBottomWidth: 0 },
  menuIcon: { width: 34, height: 34, borderRadius: 17, alignItems: 'center', justifyContent: 'center', marginRight: 12 },
  menuLabel: { flex: 1, fontSize: 14, fontWeight: '600', lineHeight: 22, paddingTop: 2 },
  menuRight: { flexDirection: 'row', alignItems: 'center', gap: 6 },
  menuValue: { fontSize: 13, paddingTop: 2 },

  versionSection: { alignItems: 'center', paddingTop: Spacing.xl },
  versionText: { fontSize: 13, fontWeight: '700', marginBottom: 2, lineHeight: 20, paddingTop: 2 },
  versionSub: { fontSize: 11 },

  modalBackdrop: { flex: 1, backgroundColor: 'rgba(0,0,0,0.5)', justifyContent: 'center', alignItems: 'center', padding: 24 },
  modalCard: { width: '100%', borderRadius: BorderRadius.lg, padding: 20, ...Shadows.lg },
  modalTitle: { fontSize: 18, fontWeight: '800', marginBottom: 16, textAlign: 'center', lineHeight: 26, paddingTop: 4 },
  modalOption: { flexDirection: 'row', alignItems: 'center', justifyContent: 'space-between', paddingVertical: 14, paddingHorizontal: 16, borderRadius: BorderRadius.md, marginBottom: 8, borderWidth: 1 },
  modalOptionActive: { backgroundColor: '#FEE2E2', borderColor: Colors.primary },
  modalOptionText: { fontSize: 15, fontWeight: '600', paddingTop: 2 },
  modalOptionTextActive: { color: Colors.primary, fontWeight: '700' },
});
