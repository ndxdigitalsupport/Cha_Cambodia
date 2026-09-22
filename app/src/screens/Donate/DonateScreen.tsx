import React, { useState, useRef, useEffect, useCallback } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  Animated,
  Alert,
  TextInput,
  Modal,
  Linking,
  ActivityIndicator,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { LinearGradient } from 'expo-linear-gradient';
import { WebView } from 'react-native-webview';
import { Colors, Spacing, Shadows } from '../../theme/colors';
import { campaignsAPI, paywayAPI } from '../../api/client';
import qrImage from '../../../assets/aba-pay-qr.jpeg';

const STEPS = [
  { icon: 'phone-portrait-outline' as const, color: Colors.secondary },
  { icon: 'scan-outline' as const, color: Colors.primary },
  { icon: 'checkmark-circle-outline' as const, color: Colors.success },
];

const PRESETS = [5, 10, 25, 50];

type Campaign = {
  id: number;
  title: string;
  title_km?: string;
  excerpt: string;
  excerpt_km?: string;
  raised: number;
  goal: number;
  pct: number;
  color: string;
};

function escapeHtml(value: string) {
  return value
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function buildCheckoutHtml(checkoutUrl: string, fields: Record<string, string>) {
  const inputs = Object.keys(fields)
    .map(
      (key) =>
        `<input type="hidden" name="${escapeHtml(key)}" value="${escapeHtml(String(fields[key] ?? ''))}">`
    )
    .join('\n');
  return `<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PayWay Checkout</title>
</head>
<body onload="document.getElementById('pw-form').submit()">
<form id="pw-form" method="POST" action="${escapeHtml(checkoutUrl)}">
${inputs}
<noscript>JavaScript is required for checkout.</noscript>
</form>
</body>
</html>`;
}

const colorHex: Record<string, string> = {
  red: '#E31E24',
  blue: '#0B1D6D',
  purple: '#6A2C91',
  green: '#16A34A',
};

export default function DonateScreen({ navigation }: any) {
  const { t, i18n } = useTranslation();
  const [done, setDone] = useState(false);
  const [campaigns, setCampaigns] = useState<Campaign[]>([]);
  const [campaignsLoading, setCampaignsLoading] = useState(true);
  const [amountText, setAmountText] = useState('10');
  const [checkoutHtml, setCheckoutHtml] = useState<string | null>(null);
  const [paying, setPaying] = useState(false);
  const [checking, setChecking] = useState(false);
  const tranIdRef = useRef<string | null>(null);
  const pollRef = useRef<ReturnType<typeof setInterval> | null>(null);
  const scrollY = useRef(new Animated.Value(0)).current;
  const isKm = i18n.language === 'km';

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

  const loadCampaigns = useCallback(async () => {
    try {
      const res: any = await campaignsAPI.getCampaigns();
      setCampaigns(Array.isArray(res?.items) ? res.items : []);
    } catch {
      setCampaigns([]);
    } finally {
      setCampaignsLoading(false);
    }
  }, []);

  useEffect(() => {
    loadCampaigns();
    return () => {
      if (pollRef.current) clearInterval(pollRef.current);
    };
  }, [loadCampaigns]);

  const stopPolling = () => {
    if (pollRef.current) {
      clearInterval(pollRef.current);
      pollRef.current = null;
    }
  };

  const startStatusPoll = (tranId: string) => {
    stopPolling();
    setChecking(true);
    let attempts = 0;
    pollRef.current = setInterval(async () => {
      attempts += 1;
      try {
        const res: any = await paywayAPI.check(tranId);
        const local = res?.local_status;
        const code = res?.data?.payment_status_code;
        if (local === 'completed' || code === 0) {
          stopPolling();
          setChecking(false);
          setDone(true);
          Alert.alert(
            t('donate.thankYou', 'Thank You!'),
            t('donate.paymentSuccess', 'Thank you! Your payment was received.'),
            [{ text: 'OK' }]
          );
          return;
        }
        if (local === 'failed' || local === 'cancelled' || code === 3 || code === 7) {
          stopPolling();
          setChecking(false);
          Alert.alert(
            t('donate.paymentFailed', 'Payment not completed'),
            t('donate.paymentFailed', 'Payment not completed. Please try again.'),
            [{ text: 'OK' }]
          );
          return;
        }
      } catch {
        // keep polling
      }
      if (attempts >= 20) {
        stopPolling();
        setChecking(false);
        Alert.alert(
          t('donate.paymentStatus', 'Checking payment status…'),
          t('donate.paymentFailed', 'Payment not completed. Please try again.'),
          [{ text: 'OK' }]
        );
      }
    }, 3000);
  };

  const startCheckout = async () => {
    const amount = parseFloat(amountText);
    if (!amount || amount <= 0 || Number.isNaN(amount)) {
      Alert.alert(
        t('donate.invalidAmount', 'Invalid amount'),
        t('donate.invalidAmount', 'Please select or enter a valid donation amount.')
      );
      return;
    }

    setPaying(true);
    try {
      const res: any = await paywayAPI.purchase({
        amount,
        currency: 'USD',
        firstname: 'Friend',
      });
      if (!res?.success || !res?.checkout_url || !res?.fields) {
        throw new Error(res?.message || 'Could not start payment.');
      }
      tranIdRef.current = res.tran_id;
      setCheckoutHtml(buildCheckoutHtml(res.checkout_url, res.fields));
    } catch (e: any) {
      Alert.alert(
        t('donate.payWay', 'Pay with PayWay (ABA)'),
        e?.message || 'Could not start payment. Please try again.'
      );
    } finally {
      setPaying(false);
    }
  };

  const isReturnUrl = (url: string) =>
    !!url &&
    (url.includes('donation-thank-you') ||
      url.includes('donation-cancelled') ||
      url.includes('/wp-json/cha/v1/payway/callback') ||
      url.includes('payway.com.kh/api/payment-gateway/v1/payments/return'));

  const closeCheckout = () => {
    const tranId = tranIdRef.current;
    setCheckoutHtml(null);
    if (tranId) startStatusPoll(tranId);
    else setChecking(false);
  };

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
          {/* Campaigns */}
          <View style={styles.sectionCard}>
            <Text style={styles.sectionTitle}>{t('donate.campaignsHeading', 'Current Campaigns')}</Text>
            {campaignsLoading ? (
              <ActivityIndicator color={Colors.secondary} style={{ marginVertical: 16 }} />
            ) : campaigns.length === 0 ? (
              <Text style={styles.campaignEmpty}>
                {t('donate.campaignEmpty', 'No active campaigns right now. Your donation still helps!')}
              </Text>
            ) : (
              campaigns.map((c) => {
                const pct = typeof c.pct === 'number' ? c.pct : 0;
                const barColor = colorHex[c.color] || colorHex.red;
                return (
                  <View key={c.id} style={styles.campaignCard}>
                    <View style={styles.campaignTitleRow}>
                      <Text style={styles.campaignTitle} numberOfLines={2}>
                        {isKm && c.title_km ? c.title_km : c.title}
                      </Text>
                      <View style={[styles.pctPill, { backgroundColor: barColor + '15' }]}>
                        <Text style={[styles.pctPillText, { color: barColor }]}>{pct}%</Text>
                      </View>
                    </View>
                    <Text style={styles.campaignDesc} numberOfLines={3}>
                      {isKm && c.excerpt_km ? c.excerpt_km : c.excerpt}
                    </Text>
                    <View style={styles.progressTrack}>
                      <View style={[styles.progressFill, { width: `${pct}%`, backgroundColor: barColor }]} />
                    </View>
                    <View style={styles.campaignMetaRow}>
                      <Text style={styles.campaignMeta}>
                        {t('donate.campaignRaised', 'Raised')}: <Text style={styles.campaignMetaStrong}>${Number(c.raised || 0).toLocaleString()}</Text>
                      </Text>
                      <Text style={styles.campaignMeta}>
                        {t('donate.campaignGoal', 'Goal')}: <Text style={styles.campaignMetaStrong}>${Number(c.goal || 0).toLocaleString()}</Text>
                      </Text>
                    </View>
                  </View>
                );
              })
            )}
          </View>

          {/* PayWay amount */}
          <View style={styles.sectionCard}>
            <View style={styles.payWayHeader}>
              <View style={styles.payWayIcon}>
                <Ionicons name="card" size={20} color={Colors.secondary} />
              </View>
              <View style={{ flex: 1 }}>
                <Text style={styles.sectionTitle}>{t('donate.payWay', 'Pay with PayWay (ABA)')}</Text>
                <Text style={styles.payWayHint}>
                  {t('donate.payWayHint', 'Enter an amount and continue to secure ABA checkout.')}
                </Text>
              </View>
            </View>

            <Text style={styles.amountLabel}>{t('donate.amount', 'Donation amount (USD)')}</Text>
            <View style={styles.presetRow}>
              {PRESETS.map((p) => {
                const selected = amountText === String(p);
                return (
                  <TouchableOpacity
                    key={p}
                    style={[styles.presetBtn, selected && styles.presetBtnActive]}
                    onPress={() => setAmountText(String(p))}
                    activeOpacity={0.8}
                  >
                    <Text style={[styles.presetText, selected && styles.presetTextActive]}>${p}</Text>
                  </TouchableOpacity>
                );
              })}
            </View>
            <TextInput
              style={styles.amountInput}
              keyboardType="numeric"
              value={amountText}
              onChangeText={setAmountText}
              placeholder="10"
              placeholderTextColor={Colors.textMuted}
            />

            <TouchableOpacity
              style={[styles.checkoutBtn, (paying || checking) && styles.checkoutBtnDisabled]}
              onPress={startCheckout}
              disabled={paying || checking}
              activeOpacity={0.85}
            >
              <LinearGradient
                colors={['#DC2626', '#B91C1C']}
                start={{ x: 0, y: 0 }}
                end={{ x: 1, y: 1 }}
                style={styles.checkoutGradient}
              >
                {paying || checking ? (
                  <ActivityIndicator color="#FFFFFF" />
                ) : (
                  <Ionicons name="lock-closed" size={18} color="#FFFFFF" />
                )}
                <Text style={styles.checkoutText}>
                  {paying
                    ? t('donate.processing', 'Processing payment…')
                    : checking
                      ? t('donate.paymentStatus', 'Checking payment status…')
                      : t('donate.openCheckout', 'Continue to Payment')}
                </Text>
              </LinearGradient>
            </TouchableOpacity>
            <Text style={styles.checkoutHint}>{t('donate.checkoutHint', 'Complete payment in the secure window, then return.')}</Text>
          </View>

          {/* QR fallback */}
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

          <View style={styles.securityNote}>
            <Ionicons name="lock-closed" size={14} color={Colors.textMuted} />
            <Text style={styles.securityText}>{t('donate.securityNote', 'Payments are processed securely via ABA Bank KHQR.')}</Text>
          </View>
        </View>
      </Animated.ScrollView>

      <Modal visible={!!checkoutHtml} animationType="slide" onRequestClose={closeCheckout}>
        <View style={styles.modalHeader}>
          <TouchableOpacity style={styles.modalClose} onPress={closeCheckout}>
            <Ionicons name="close" size={22} color={Colors.secondary} />
          </TouchableOpacity>
          <Text style={styles.modalTitle}>{t('donate.payWay', 'Pay with PayWay (ABA)')}</Text>
          <View style={{ width: 40 }} />
        </View>
        {checkoutHtml ? (
          <WebView
            originWhitelist={['*']}
            source={{ html: checkoutHtml }}
            javaScriptEnabled
            domStorageEnabled
            startInLoadingState
            onNavigationStateChange={(nav) => {
              if (nav.url && isReturnUrl(nav.url)) closeCheckout();
            }}
            onError={closeCheckout}
            renderLoading={() => (
              <View style={styles.webviewLoading}>
                <ActivityIndicator size="large" color={Colors.secondary} />
                <Text style={styles.webviewLoadingText}>{t('donate.processing', 'Processing payment…')}</Text>
              </View>
            )}
            style={{ flex: 1 }}
          />
        ) : null}
      </Modal>
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

  sectionCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 24,
    padding: 20,
    marginBottom: 16,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
    ...Shadows.sm,
  },
  sectionTitle: { fontSize: 17, fontWeight: '800', color: Colors.secondary, marginBottom: 12 },
  campaignEmpty: { fontSize: 13, color: Colors.textSecondary, lineHeight: 20 },
  campaignCard: {
    backgroundColor: '#F8FAFC',
    borderRadius: 16,
    padding: 14,
    marginBottom: 12,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
  },
  campaignTitleRow: { flexDirection: 'row', alignItems: 'center', gap: 8, marginBottom: 6 },
  campaignTitle: { flex: 1, fontSize: 15, fontWeight: '800', color: Colors.secondary, lineHeight: 20 },
  pctPill: { paddingHorizontal: 8, paddingVertical: 3, borderRadius: 100 },
  pctPillText: { fontSize: 11, fontWeight: '800' },
  campaignDesc: { fontSize: 12, color: Colors.textSecondary, lineHeight: 18, marginBottom: 10 },
  progressTrack: {
    height: 8,
    borderRadius: 4,
    backgroundColor: 'rgba(0,0,0,0.06)',
    overflow: 'hidden',
    marginBottom: 8,
  },
  progressFill: { height: '100%', borderRadius: 4 },
  campaignMetaRow: { flexDirection: 'row', justifyContent: 'space-between' },
  campaignMeta: { fontSize: 12, color: Colors.textSecondary },
  campaignMetaStrong: { fontWeight: '800', color: Colors.text },

  payWayHeader: { flexDirection: 'row', alignItems: 'flex-start', gap: 12, marginBottom: 16 },
  payWayIcon: {
    width: 40,
    height: 40,
    borderRadius: 20,
    backgroundColor: Colors.secondaryLight,
    alignItems: 'center',
    justifyContent: 'center',
  },
  payWayHint: { fontSize: 12, color: Colors.textSecondary, lineHeight: 18, marginTop: 2 },
  amountLabel: { fontSize: 12, fontWeight: '700', color: Colors.textSecondary, marginBottom: 8 },
  presetRow: { flexDirection: 'row', gap: 8, marginBottom: 12 },
  presetBtn: {
    flex: 1,
    paddingVertical: 10,
    borderRadius: 12,
    borderWidth: 1.5,
    borderColor: Colors.border,
    alignItems: 'center',
    backgroundColor: '#FFFFFF',
  },
  presetBtnActive: { borderColor: Colors.primary, backgroundColor: Colors.primary + '10' },
  presetText: { fontSize: 14, fontWeight: '700', color: Colors.textSecondary },
  presetTextActive: { color: Colors.primary },
  amountInput: {
    borderWidth: 1.5,
    borderColor: Colors.border,
    borderRadius: 14,
    paddingHorizontal: 16,
    paddingVertical: 12,
    fontSize: 18,
    fontWeight: '800',
    color: Colors.secondary,
    backgroundColor: '#FFFFFF',
    marginBottom: 14,
  },
  checkoutBtn: { borderRadius: 16, overflow: 'hidden', ...Shadows.md },
  checkoutBtnDisabled: { opacity: 0.85 },
  checkoutGradient: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 10,
    paddingVertical: 16,
  },
  checkoutText: { fontSize: 15, fontWeight: '800', color: '#FFFFFF' },
  checkoutHint: { fontSize: 11, color: Colors.textMuted, textAlign: 'center', marginTop: 10, lineHeight: 16 },

  modalHeader: {
    flexDirection: 'row',
    alignItems: 'center',
    paddingTop: 56,
    paddingBottom: 12,
    paddingHorizontal: 16,
    backgroundColor: '#FFFFFF',
    borderBottomWidth: 1,
    borderBottomColor: 'rgba(0,0,0,0.06)',
  },
  modalClose: {
    width: 40,
    height: 40,
    borderRadius: 20,
    backgroundColor: Colors.secondaryLight,
    alignItems: 'center',
    justifyContent: 'center',
  },
  modalTitle: { flex: 1, textAlign: 'center', fontSize: 16, fontWeight: '800', color: Colors.secondary },
  webviewLoading: {
    position: 'absolute',
    top: 0,
    left: 0,
    right: 0,
    bottom: 0,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#FFFFFF',
    gap: 12,
  },
  webviewLoadingText: { fontSize: 13, color: Colors.textSecondary },

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

  securityNote: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 6,
    paddingBottom: 8,
  },
  securityText: { fontSize: 11, fontWeight: '600', color: Colors.textMuted },
});
