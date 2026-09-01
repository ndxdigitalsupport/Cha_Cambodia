import React, { useState, useRef } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, Animated, Platform, Alert, Share } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { LinearGradient } from 'expo-linear-gradient';
import { Colors, Spacing, BorderRadius, Shadows } from '../../theme/colors';
import qrImage from '../../../assets/aba-pay-qr.jpeg';

const STEPS = [
  { icon: 'phone-portrait-outline' as const, color: Colors.secondary },
  { icon: 'scan-outline' as const, color: Colors.primary },
  { icon: 'checkmark-circle-outline' as const, color: Colors.success },
];

export default function DonateScreen({ navigation }: any) {
  const { t } = useTranslation();
  const [done, setDone] = useState(false);
  const scrollY = useRef(new Animated.Value(0)).current;

  const parallaxTranslateY = scrollY.interpolate({
    inputRange: [-200, 0, 400],
    outputRange: [-100, 0, 150],
    extrapolate: 'clamp',
  });

  const scaleZoom = scrollY.interpolate({
    inputRange: [-200, 0],
    outputRange: [1.5, 1],
    extrapolateRight: 'clamp',
  });

  const handleDone = () => {
    Alert.alert(
      t('donate.thankYou', 'Thank You!'),
      t('donate.thankYouMsg', 'Your support helps CHA provide treatment and care for haemophilia patients across Cambodia.'),
      [{ text: 'OK' }]
    );
    setDone(true);
  };

  return (
    <View style={styles.container}>
      {/* Hero */}
      <Animated.View style={[styles.heroContainer, { transform: [{ translateY: parallaxTranslateY }, { scale: scaleZoom }] }]}>
        <LinearGradient
          colors={['#DC2626', '#991B1B']}
          start={{ x: 0, y: 0 }}
          end={{ x: 1, y: 1 }}
          style={styles.heroGradient}
        >
          <View style={styles.heroContent}>
            <View style={styles.heroIconWrap}>
              <View style={styles.heroIconGlass}>
                <Ionicons name="heart" size={42} color="#FFFFFF" />
              </View>
            </View>
            <Text style={styles.heroTitle}>{t('donate.title', 'Help Change Lives')}</Text>
            <Text style={styles.heroLead}>
              {t('donate.subtitle', 'Your generosity directly funds vital treatment and support for bleeding disorder patients across Cambodia.')}
            </Text>
          </View>
        </LinearGradient>
      </Animated.View>

      {/* Floating Back */}
      <TouchableOpacity style={styles.floatingBackBtn} onPress={() => navigation.goBack()} hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}>
        <Ionicons name="arrow-back" size={20} color="#FFFFFF" />
      </TouchableOpacity>

      <Animated.ScrollView
        style={styles.scrollView}
        contentContainerStyle={styles.scrollContent}
        showsVerticalScrollIndicator={false}
        onScroll={Animated.event([{ nativeEvent: { contentOffset: { y: scrollY } } }], { useNativeDriver: true })}
        scrollEventThrottle={16}
      >
        <View style={styles.contentWrapper}>

          {/* QR Code Card */}
          <View style={styles.qrCard}>
            <View style={styles.qrBadge}>
              <Ionicons name="shield-checkmark" size={14} color={Colors.success} />
              <Text style={styles.qrBadgeText}>{t('donate.securePayment', 'Secure Payment')}</Text>
            </View>

            <View style={styles.qrImageWrap}>
              <View style={styles.qrFrame}>
                <Animated.Image source={qrImage} style={styles.qrImage} resizeMode="contain" />
              </View>
            </View>

            {/* Account Info */}
            <View style={styles.accountInfo}>
              <Text style={styles.accountLabel}>{t('donate.scanToPay', 'Scan to Pay')}</Text>
              <Text style={styles.accountName}>CHA</Text>
              <Text style={styles.accountOrg}>{t('donate.accountOrg', 'CAMBODIA HEMOPHILIA ASSOCIATION')}</Text>
              <View style={styles.accountNumberWrap}>
                <Text style={styles.accountNumber}>{t('donate.accountNumber', '000 283 539')}</Text>
              </View>
            </View>
          </View>

          {/* Scan Steps */}
          <View style={styles.stepsCard}>
            <Text style={styles.stepsTitle}>{t('donate.howToPay', 'How to Pay')}</Text>
            {[
              t('donate.step1', 'Open your ABA Mobile, Bakong, or any KHQR-supported banking app'),
              t('donate.step2', 'Scan the QR code above and enter the amount'),
              t('donate.step3', 'Confirm the payment in your banking app'),
            ].map((step, i) => (
              <View key={i} style={styles.stepRow}>
                <View style={[styles.stepIcon, { backgroundColor: STEPS[i].color + '15' }]}>
                  <Ionicons name={STEPS[i].icon} size={20} color={STEPS[i].color} />
                </View>
                <View style={styles.stepContent}>
                  <Text style={styles.stepNumber}>{t('donate.step', 'Step')} {i + 1}</Text>
                  <Text style={styles.stepText}>{step}</Text>
                </View>
              </View>
            ))}
          </View>

          {/* Done Button */}
          <TouchableOpacity
            style={[styles.doneBtn, done && styles.doneBtnCompleted]}
            onPress={handleDone}
            activeOpacity={0.85}
            disabled={done}
          >
            <LinearGradient
              colors={done ? ['#16A34A', '#15803D'] : ['#DC2626', '#B91C1C']}
              start={{ x: 0, y: 0 }}
              end={{ x: 1, y: 1 }}
              style={styles.doneBtnGradient}
            >
              <Ionicons name={done ? 'checkmark-circle' : 'checkmark'} size={20} color="#FFFFFF" />
              <Text style={styles.doneBtnText}>
                {done
                  ? t('donate.paymentCompleted', 'Payment Completed')
                  : t('donate.markAsPaid', "I've Completed Payment")}
              </Text>
            </LinearGradient>
          </TouchableOpacity>

          {/* Security Note */}
          <View style={styles.securityNote}>
            <Ionicons name="lock-closed" size={14} color={Colors.textMuted} />
            <Text style={styles.securityText}>{t('donate.securityNote', 'Payments are processed securely via ABA Bank KHQR.')}</Text>
          </View>

        </View>
      </Animated.ScrollView>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8FAFC' },

  heroContainer: {
    position: 'absolute',
    top: 0,
    left: 0,
    right: 0,
    height: 300,
    zIndex: 1,
  },
  heroGradient: {
    flex: 1,
    paddingTop: 60,
    paddingHorizontal: Spacing.lg,
  },
  heroContent: {
    alignItems: 'center',
    zIndex: 2,
  },
  floatingBackBtn: {
    position: 'absolute',
    top: 60,
    left: Spacing.lg,
    width: 40,
    height: 40,
    borderRadius: 20,
    backgroundColor: 'rgba(255,255,255,0.25)',
    alignItems: 'center',
    justifyContent: 'center',
    zIndex: 10,
    ...Shadows.sm,
  },
  heroIconWrap: {
    marginBottom: Spacing.md,
    marginTop: 10,
  },
  heroIconGlass: {
    width: 80,
    height: 80,
    borderRadius: 40,
    backgroundColor: 'rgba(255,255,255,0.15)',
    alignItems: 'center',
    justifyContent: 'center',
    borderWidth: 1,
    borderColor: 'rgba(255,255,255,0.3)',
    ...Shadows.md,
  },
  heroTitle: { fontSize: 26, fontWeight: '800', color: '#FFFFFF', marginBottom: 6, textAlign: 'center' },
  heroLead: { fontSize: 13, color: 'rgba(255,255,255,0.9)', lineHeight: 20, textAlign: 'center', maxWidth: 300 },

  scrollView: { flex: 1, zIndex: 2 },
  scrollContent: { paddingTop: 260 },
  contentWrapper: {
    backgroundColor: '#F8FAFC',
    borderTopLeftRadius: 32,
    borderTopRightRadius: 32,
    paddingTop: 28,
    paddingBottom: 80,
    paddingHorizontal: Spacing.lg,
    minHeight: 700,
    ...Shadows.lg,
  },

  // QR Card
  qrCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 24,
    padding: 24,
    alignItems: 'center',
    marginBottom: 20,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
    ...Shadows.md,
  },
  qrBadge: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 6,
    backgroundColor: Colors.successLight,
    paddingHorizontal: 14,
    paddingVertical: 6,
    borderRadius: 100,
    marginBottom: 20,
  },
  qrBadgeText: { fontSize: 12, fontWeight: '700', color: Colors.success },
  qrImageWrap: {
    width: 260,
    height: 260,
    marginBottom: 20,
  },
  qrFrame: {
    width: '100%',
    height: '100%',
    borderRadius: 20,
    backgroundColor: '#FFFFFF',
    borderWidth: 2,
    borderColor: Colors.border,
    overflow: 'hidden',
    alignItems: 'center',
    justifyContent: 'center',
    ...Shadows.sm,
  },
  qrImage: {
    width: '100%',
    height: '100%',
  },

  // Account Info
  accountInfo: {
    alignItems: 'center',
    paddingTop: 16,
    borderTopWidth: 1,
    borderTopColor: Colors.borderLight,
    width: '100%',
  },
  accountLabel: { fontSize: 12, fontWeight: '700', color: Colors.textSecondary, textTransform: 'uppercase', letterSpacing: 1, marginBottom: 8 },
  accountName: { fontSize: 22, fontWeight: '900', color: Colors.secondary, marginBottom: 4 },
  accountOrg: { fontSize: 12, fontWeight: '700', color: Colors.textSecondary, textTransform: 'uppercase', letterSpacing: 1, marginBottom: 12 },
  accountNumberWrap: {
    backgroundColor: Colors.secondaryLight,
    paddingHorizontal: 20,
    paddingVertical: 10,
    borderRadius: 12,
  },
  accountNumber: { fontSize: 20, fontWeight: '900', color: Colors.secondary, letterSpacing: 3 },

  // Steps
  stepsCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 24,
    padding: 24,
    marginBottom: 20,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
    ...Shadows.sm,
  },
  stepsTitle: { fontSize: 18, fontWeight: '800', color: Colors.secondary, marginBottom: 16 },
  stepRow: {
    flexDirection: 'row',
    alignItems: 'flex-start',
    gap: 14,
    marginBottom: 16,
  },
  stepIcon: {
    width: 44,
    height: 44,
    borderRadius: 22,
    alignItems: 'center',
    justifyContent: 'center',
  },
  stepContent: { flex: 1 },
  stepNumber: { fontSize: 11, fontWeight: '700', color: Colors.textSecondary, textTransform: 'uppercase', letterSpacing: 0.5, marginBottom: 2 },
  stepText: { fontSize: 13, color: Colors.text, lineHeight: 20 },

  // Done Button
  doneBtn: { borderRadius: 16, overflow: 'hidden', marginBottom: 16, ...Shadows.md },
  doneBtnCompleted: { opacity: 0.85 },
  doneBtnGradient: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 10,
    paddingVertical: 18,
  },
  doneBtnText: { fontSize: 16, fontWeight: '800', color: '#FFFFFF' },

  // Security
  securityNote: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 6,
    paddingBottom: 8,
  },
  securityText: { fontSize: 11, fontWeight: '600', color: Colors.textMuted },
});
