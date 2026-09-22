import React, { useState, useRef, useEffect, useCallback } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  Animated,
  ActivityIndicator,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { LinearGradient } from 'expo-linear-gradient';
import { Colors, Spacing, Shadows } from '../../theme/colors';
import { campaignsAPI } from '../../api/client';
import qrImage from '../../../assets/aba-pay-qr.jpeg';

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
  }, [loadCampaigns]);

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

      {/* Floating Back Button */}
      <TouchableOpacity
        style={styles.floatingBackBtn}
        onPress={() => navigation.goBack()}
        hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}
      >
        <Ionicons name="arrow-back" size={20} color="#FFFFFF" />
      </TouchableOpacity>

      {/* Scrollable Content */}
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

          {/* Security Note */}
          <View style={styles.securityNote}>
            <Ionicons name="lock-closed" size={14} color={Colors.textMuted} />
            <Text style={styles.securityText}>{t('donate.securityNote', 'Pay directly with ABA Mobile, Bakong, or any KHQR-supported banking app.')}</Text>
          </View>

          {/* Current Campaigns */}
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

  // Security
  securityNote: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 6,
    paddingBottom: 8,
    marginBottom: 16,
  },
  securityText: { fontSize: 11, fontWeight: '600', color: Colors.textMuted },

  // Section / Campaigns
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
});
