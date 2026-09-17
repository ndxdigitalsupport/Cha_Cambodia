import React, { useState } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, Linking, LayoutAnimation, UIManager, Platform } from 'react-native';

if (Platform.OS === 'android') {
  if (UIManager.setLayoutAnimationEnabledExperimental) {
    UIManager.setLayoutAnimationEnabledExperimental(true);
  }
}
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { Colors, Spacing, BorderRadius, Shadows } from '../../theme/colors';

const faqItems = [
  {
    q: 'What is Haemophilia?',
    a: 'Haemophilia is a rare inherited bleeding disorder where blood does not clot properly due to deficient clotting factor proteins. This can cause joint bleeding and prolonged symptoms after minor injuries.',
  },
  {
    q: 'How do I register for a CHA Membership Card?',
    a: 'You can create an account directly in the app. Once registered as a Patient or Member, your verified digital membership card will be available under the Account tab.',
  },
  {
    q: 'Where are the main treatment centres located?',
    a: 'CHA partners with hospital centers in Phnom Penh (National Pediatric Hospital & Calmette Hospital), Siem Reap, Battambang, and regional referral units across 25 provinces.',
  },
  {
    q: 'What should I do during a bleeding emergency?',
    a: 'Go to the nearest partner hospital immediately. Present your CHA Membership Card so staff can instantly identify your factor deficiency type and initiate factor replacement therapy.',
  },
];

export default function HelpScreen({ navigation }: any) {
  const { t } = useTranslation();
  const [expandedFaq, setExpandedFaq] = useState<number | null>(null);

  const handleToggleFaq = (index: number) => {
    LayoutAnimation.configureNext(LayoutAnimation.Presets.easeInEaseOut);
    setExpandedFaq(expandedFaq === index ? null : index);
  };

  const contactInfo = [
    { icon: 'location' as const, label: 'CHA National Headquarters', value: '#35, St. 121, Sangkat Tuol Tompoung 2, Khan Chamkarmon, Phnom Penh, Cambodia', color: Colors.primary, link: null },
    { icon: 'call' as const, label: 'Emergency Care Hotline', value: '+855 (0) 12 751 728', color: Colors.secondary, link: 'tel:+85512751728' },
    { icon: 'mail' as const, label: 'Official Email Support', value: 'info@chacambodia.org', color: Colors.purple, link: 'mailto:info@chacambodia.org' },
    { icon: 'globe' as const, label: 'Official Web Portal', value: 'https://chacambodia.org', color: Colors.success, link: 'https://chacambodia.org' },
  ];

  return (
    <ScrollView style={styles.container} showsVerticalScrollIndicator={false}>
      {/* Header */}
      <View style={styles.header}>
        <TouchableOpacity style={styles.backBtn} onPress={() => navigation.goBack()} hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}>
          <Ionicons name="arrow-back" size={20} color="#FFFFFF" />
        </TouchableOpacity>
        <View style={styles.headerTitleWrap}>
          <Text style={styles.headerTitle}>{t('help.title', 'Help & Support')}</Text>
          <Text style={styles.headerSub}>{t('settings.contactSupport', 'CHA Assistance & Contact Center')}</Text>
        </View>
      </View>

      {/* Quick Emergency Hotline Banner */}
      <View style={styles.hotlineSection}>
        <View style={styles.hotlineCard}>
          <View style={styles.hotlineIcon}>
            <Ionicons name="call" size={24} color="#FFFFFF" />
          </View>
          <View style={styles.hotlineContent}>
            <Text style={styles.hotlineTitle}>{t('programs.emergency', 'Emergency Support')}</Text>
            <Text style={styles.hotlineSub}>+855 (0) 12 751 728 (24/7 Hotline)</Text>
          </View>
          <TouchableOpacity
            style={styles.hotlineBtn}
            onPress={() => Linking.openURL('tel:+85512751728')}
            activeOpacity={0.85}
          >
            <Text style={styles.hotlineBtnText}>{t('programs.callNow', 'Call Now')}</Text>
          </TouchableOpacity>
        </View>
      </View>

      {/* FAQ Section */}
      <View style={styles.section}>
        <Text style={styles.sectionTitle}>{t('haemophilia.faqTitle', 'Frequently Asked Questions')}</Text>
        {faqItems.map((item, index) => {
          const isOpen = expandedFaq === index;
          return (
            <TouchableOpacity
              key={index}
              style={styles.faqItem}
              onPress={() => handleToggleFaq(index)}
              activeOpacity={0.85}
            >
              <View style={styles.faqHeader}>
                <Text style={styles.faqQuestion}>{item.q}</Text>
                <Ionicons name={isOpen ? 'chevron-up' : 'chevron-down'} size={18} color={Colors.secondary} />
              </View>
              {isOpen && <Text style={styles.faqAnswer}>{item.a}</Text>}
            </TouchableOpacity>
          );
        })}
      </View>

      {/* Contact Direct Section */}
      <View style={styles.section}>
        <Text style={styles.sectionTitle}>{t('contact.title', 'Contact Us')}</Text>
        <View style={styles.contactList}>
          {contactInfo.map((c, i) => (
            <TouchableOpacity
              key={i}
              style={styles.contactCard}
              onPress={() => c.link && Linking.openURL(c.link)}
              activeOpacity={c.link ? 0.85 : 1}
            >
              <View style={[styles.contactIcon, { backgroundColor: c.color + '15' }]}>
                <Ionicons name={c.icon} size={20} color={c.color} />
              </View>
              <View style={styles.contactTextWrap}>
                <Text style={styles.contactLabel}>{c.label}</Text>
                <Text style={styles.contactValue}>{c.value}</Text>
              </View>
              {c.link && <Ionicons name="open-outline" size={16} color={Colors.textMuted} />}
            </TouchableOpacity>
          ))}
        </View>
      </View>

      <View style={{ height: Spacing.xl }} />
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: Colors.surface },
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

  hotlineSection: { paddingHorizontal: Spacing.lg, paddingTop: Spacing.lg },
  hotlineCard: {
    backgroundColor: Colors.primary,
    borderRadius: BorderRadius.lg,
    padding: 16,
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
    ...Shadows.md,
  },
  hotlineIcon: { width: 44, height: 44, borderRadius: 22, backgroundColor: 'rgba(255,255,255,0.2)', alignItems: 'center', justifyContent: 'center' },
  hotlineContent: { flex: 1 },
  hotlineTitle: { fontSize: 15, fontWeight: '800', color: '#FFFFFF', marginBottom: 2, lineHeight: 22, paddingTop: 2 },
  hotlineSub: { fontSize: 12, color: 'rgba(255,255,255,0.9)', paddingTop: 2 },
  hotlineBtn: { backgroundColor: '#FFFFFF', paddingHorizontal: 14, paddingVertical: 8, borderRadius: BorderRadius.sm },
  hotlineBtnText: { fontSize: 12, fontWeight: '800', color: Colors.primary, paddingTop: 2 },

  section: { paddingHorizontal: Spacing.lg, paddingTop: Spacing.lg },
  sectionTitle: { fontSize: 18, fontWeight: '800', color: Colors.secondary, marginBottom: 12, lineHeight: 28, paddingTop: 4 },

  faqItem: {
    backgroundColor: '#FFFFFF',
    borderRadius: BorderRadius.md,
    padding: 14,
    marginBottom: 8,
    borderWidth: 1,
    borderColor: Colors.border,
    ...Shadows.sm,
  },
  faqHeader: { flexDirection: 'row', alignItems: 'center', justifyContent: 'space-between' },
  faqQuestion: { flex: 1, fontSize: 13, fontWeight: '700', color: Colors.text, marginRight: 8, lineHeight: 22, paddingTop: 2 },
  faqAnswer: { fontSize: 12, color: Colors.textSecondary, lineHeight: 20, paddingTop: 4, marginTop: 8, borderTopWidth: 1, borderTopColor: Colors.borderLight },

  contactList: { gap: 8 },
  contactCard: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: '#FFFFFF',
    borderRadius: BorderRadius.md,
    padding: 12,
    borderWidth: 1,
    borderColor: Colors.border,
    ...Shadows.sm,
  },
  contactIcon: { width: 38, height: 38, borderRadius: 19, alignItems: 'center', justifyContent: 'center', marginRight: 12 },
  contactTextWrap: { flex: 1 },
  contactLabel: { fontSize: 11, color: Colors.textSecondary, marginBottom: 2, paddingTop: 2 },
  contactValue: { fontSize: 13, fontWeight: '700', color: Colors.text, lineHeight: 18, paddingTop: 2 },
});
