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

function decodeEntities(value?: string) {
  if (!value) return '';
  return value
    .replace(/&amp;/g, '&')
    .replace(/&lt;/g, '<')
    .replace(/&gt;/g, '>')
    .replace(/&quot;/g, '"')
    .replace(/&#0?39;/g, "'")
    .replace(/&nbsp;/g, ' ');
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
<style>body{margin:0;font-family:system-ui,sans-serif;background:#fff}</style>
</head>
<body>
<form id="pw-form" method="POST" action="${escapeHtml(checkoutUrl)}">
${inputs}
<p style="padding:24px;color:#0B1D6D;font-weight:600">Opening secure ABA checkout…</p>
<button type="submit" style="padding:12px 20px;font-size:16px">Open payment page</button>
<noscript>JavaScript is required for checkout. Tap the button above.</noscript>
</form>
<script>
(function () {
  function submitForm() {
    var f = document.getElementById('pw-form');
    if (f && !f.dataset.submitted) {
      f.dataset.submitted = '1';
      f.submit();
    }
  }
  if (document.readyState === 'complete') {
    setTimeout(submitForm, 50);
  } else {
    window.addEventListener('load', function () { setTimeout(submitForm, 50); });
  }
})();
</script>
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
  const [campaigns, setCampaigns] = useState<Campaign[]>([]);
  const [campaignsLoading, setCampaignsLoading] = useState(true);
  const [amountText, setAmountText] = useState('10');
  const [checkoutHtml, setCheckoutHtml] = useState<string | null>(null);
  const [webviewKey, setWebviewKey] = useState(0);
  const [paying, setPaying] = useState(false);
  const [checking, setChecking] = useState(false);
  const tranIdRef = useRef<string | null>(null);
  const pollRef = useRef<ReturnType<typeof setInterval> | null>(null);
  const loadedRef = useRef(false);
  const errorShownRef = useRef(false);
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
      loadedRef.current = false;
      errorShownRef.current = false;
      setWebviewKey((k) => k + 1);
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

  const closeCheckout = (options?: { poll?: boolean }) => {
    const tranId = tranIdRef.current;
    setCheckoutHtml(null);
    loadedRef.current = false;
    errorShownRef.current = false;
    if (options?.poll === false || !tranId) {
      setChecking(false);
      stopPolling();
      return;
    }
    startStatusPoll(tranId);
  };

  const handleWebViewError = (e: any) => {
    const desc = String(e?.nativeEvent?.description || '');
    const benign =
      desc.includes('ERR_ABORTED') ||
      desc.includes('ERR_UNKNOWN_URL_SCHEME') ||
      desc.includes('about:blank') ||
      desc.includes('ERR_CACHE_MISS') ||
      desc === '';
    if (benign) return;
    if (errorShownRef.current) return;
    errorShownRef.current = true;
    Alert.alert(
      t('donate.payWay', 'Pay with PayWay (ABA)'),
      t('donate.webviewError', 'Could not load the payment page. Please try again.'),
      [
        {
          text: t('common.retry', 'Retry'),
          onPress: () => {
            errorShownRef.current = false;
            startCheckout();
          },
        },
        {
          text: t('common.cancel', 'Cancel'),
          onPress: () => closeCheckout({ poll: false }),
          style: 'cancel',
        },
      ]
    );
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

          <View style={styles.securityNote}>
            <Ionicons name="lock-closed" size={14} color={Colors.textMuted} />
            <Text style={styles.securityText}>{t('donate.securityNote', 'Payments are processed securely via ABA Bank KHQR.')}</Text>
          </View>

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
                        {decodeEntities(isKm && c.title_km ? c.title_km : c.title)}
                      </Text>
                      <View style={[styles.pctPill, { backgroundColor: barColor + '15' }]}>
                        <Text style={[styles.pctPillText, { color: barColor }]}>{pct}%</Text>
                      </View>
                    </View>
                    <Text style={styles.campaignDesc} numberOfLines={3}>
                      {decodeEntities(isKm && c.excerpt_km ? c.excerpt_km : c.excerpt)}
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
        </View>
      </Animated.ScrollView>

      <Modal visible={!!checkoutHtml} animationType="slide" onRequestClose={() => closeCheckout()}>
        <View style={styles.modalHeader}>
          <TouchableOpacity style={styles.modalClose} onPress={() => closeCheckout()}>
            <Ionicons name="close" size={22} color={Colors.secondary} />
          </TouchableOpacity>
          <Text style={styles.modalTitle}>{t('donate.payWay', 'Pay with PayWay (ABA)')}</Text>
          <View style={{ width: 40 }} />
        </View>
        {checkoutHtml ? (
          <WebView
            key={webviewKey}
            originWhitelist={['*']}
            source={{ html: checkoutHtml, baseUrl: 'https://chacambodia.org' }}
            javaScriptEnabled
            domStorageEnabled
            thirdPartyCookiesEnabled
            sharedCookiesEnabled
            setSupportMultipleWindows={false}
            allowsBackForwardNavigationGestures
            startInLoadingState
            onLoadStart={() => {
              loadedRef.current = false;
            }}
            onLoadEnd={() => {
              loadedRef.current = true;
            }}
            onNavigationStateChange={(nav) => {
              if (nav.url && isReturnUrl(nav.url)) closeCheckout();
            }}
            onError={handleWebViewError}
            onHttpError={(e) => {
              const code = e?.nativeEvent?.statusCode ?? 0;
              if (code >= 400 && code < 600 && !errorShownRef.current) {
                handleWebViewError(e);
              }
            }}
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

  securityNote: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 6,
    paddingBottom: 8,
  },
  securityText: { fontSize: 11, fontWeight: '600', color: Colors.textMuted },
});
