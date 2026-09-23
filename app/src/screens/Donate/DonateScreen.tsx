import React, { useState, useRef, useEffect, useCallback } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  Animated,
  ActivityIndicator,
  Alert,
  Image,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { LinearGradient } from 'expo-linear-gradient';
import * as Clipboard from 'expo-clipboard';
import * as MediaLibrary from 'expo-media-library';
import { Asset } from 'expo-asset';
import { File, Paths } from 'expo-file-system';
import { Colors, Spacing, Shadows } from '../../theme/colors';
import { campaignsAPI } from '../../api/client';
import qrImage from '../../../assets/aba-pay-qr.jpeg';
import logoIcon from '../../../assets/logo-icon-cha.png';

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

async function saveQrToLibrary(): Promise<boolean> {
  const perm = await MediaLibrary.requestPermissionsAsync(true);
  if (!perm.granted) return false;

  const [asset] = await Asset.loadAsync(qrImage);
  const sourceUri = asset.localUri || asset.uri;
  if (!sourceUri) throw new Error('QR asset unavailable');

  const dest = new File(Paths.cache, 'CHA-Cambodia-Donation-QR.jpeg');
  if (!dest.exists) {
    const src = new File(sourceUri);
    await src.copy(dest);
  }

  await MediaLibrary.Asset.create(dest.uri);
  return true;
}

export default function DonateScreen({ navigation }: any) {
  const { t, i18n } = useTranslation();
  const [campaigns, setCampaigns] = useState<Campaign[]>([]);
  const [campaignsLoading, setCampaignsLoading] = useState(true);
  const [copied, setCopied] = useState(false);
  const [saving, setSaving] = useState(false);
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

  const handleCopy = async () => {
    try {
      await Clipboard.setStringAsync('000283539');
      setCopied(true);
      setTimeout(() => setCopied(false), 2000);
    } catch {
      Alert.alert(t('common.error', 'Error'), t('donate.copyFailed', 'Could not copy the account number.'));
    }
  };

  const handleSaveQr = async () => {
    if (saving) return;
    setSaving(true);
    try {
      const ok = await saveQrToLibrary();
      if (ok) {
        Alert.alert(
          t('donate.saveQr', 'Save QR Image'),
          t('donate.qrSaved', 'QR code saved to your photos.')
        );
      } else {
        Alert.alert(
          t('donate.saveQr', 'Save QR Image'),
          t('donate.qrSavePermission', 'Photo permission is needed to save the QR code.')
        );
      }
    } catch {
      Alert.alert(t('common.error', 'Error'), t('donate.qrSaveFailed', 'Could not save the QR code.'));
    } finally {
      setSaving(false);
    }
  };

  const steps = [
    {
      num: '1',
      title: t('donate.step1Title', 'Open Banking App'),
      desc: t('donate.step1Desc', 'ABA, Bakong, etc.'),
      bg: 'rgba(11,29,109,0.08)',
      fg: '#0B1D6D',
    },
    {
      num: '2',
      title: t('donate.step2Title', 'Scan KHQR Code'),
      desc: t('donate.step2Desc', 'Point camera at QR'),
      bg: 'rgba(227,30,36,0.08)',
      fg: '#E31E24',
    },
    {
      num: '3',
      title: t('donate.step3Title', 'Enter Amount'),
      desc: t('donate.step3Desc', 'Directly support patients'),
      bg: 'rgba(34,197,94,0.1)',
      fg: '#16A34A',
    },
  ];

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
          {/* Website-style donation card */}
          <View style={styles.donateCard}>
            {/* Header — logo + title, badge on next line like website mobile */}
            <View style={styles.cardHeader}>
              <View style={styles.headerLeft}>
                <View style={styles.logoBox}>
                  <Image source={logoIcon} style={styles.logoImg} resizeMode="contain" />
                </View>
                <View style={styles.headerTitles}>
                  <Text style={styles.cardTitle}>{t('donate.makeDonation', 'Make a Donation')}</Text>
                  <Text style={styles.cardSub}>{t('donate.orgSub', 'Cambodian Haemophilia Association')}</Text>
                </View>
              </View>
              <View style={styles.khqrBadge}>
                <View style={styles.khqrDot} />
                <Text style={styles.khqrBadgeText}>{t('donate.khqrBadge', 'KHQR National Pay')}</Text>
              </View>
            </View>

            {/* QR stand */}
            <View style={styles.qrFrame}>
              <View style={styles.qrImageBox}>
                <Image source={qrImage} style={styles.qrImage} resizeMode="contain" />
              </View>
            </View>

            {/* Scan & Support */}
            <Text style={styles.scanTitle}>{t('donate.scanSupport', 'Scan & Support')}</Text>
            <Text style={styles.scanDesc}>
              {t('donate.scanDesc', 'Directly transfer your donation using ABA Mobile, Bakong, Wing, ACLEDA, Canadia, or banking apps across Cambodia.')}
            </Text>

            {/* Account box */}
            <View style={styles.accountBox}>
              <Text style={styles.accountLabel}>{t('donate.accountName', 'Account Name')}</Text>
              <Text style={styles.accountOrg}>{t('donate.accountOrg', 'CAMBODIA HEMOPHILIA ASSOCIATION')}</Text>
              <View style={styles.accountNumWrap}>
                <View style={styles.abaChip}>
                  <Text style={styles.abaChipText}>ABA</Text>
                </View>
                <Text style={styles.accountNumber}>{t('donate.accountNumber', '000 283 539')}</Text>
              </View>
            </View>

            {/* Actions */}
            <TouchableOpacity style={styles.copyAccountBtn} onPress={handleCopy} activeOpacity={0.7}>
              <Ionicons name="copy-outline" size={14} color="#0B1D6D" />
              <Text style={styles.copyAccountBtnText}>
                {copied
                  ? t('donate.copiedFull', 'Copied to Clipboard!')
                  : t('donate.copyAccount', 'Copy Account Number')}
              </Text>
            </TouchableOpacity>

            <TouchableOpacity
              style={[styles.saveQrBtn, saving && { opacity: 0.7 }]}
              onPress={handleSaveQr}
              activeOpacity={0.85}
              disabled={saving}
            >
              {saving ? (
                <ActivityIndicator size="small" color="#FFFFFF" />
              ) : (
                <Ionicons name="download-outline" size={16} color="#FFFFFF" />
              )}
              <Text style={styles.saveQrBtnText}>{t('donate.saveQr', 'Save QR Image')}</Text>
            </TouchableOpacity>

            {/* Steps strip */}
            <View style={styles.stepsStrip}>
              {steps.map((step, idx) => (
                <View
                  key={step.num}
                  style={[
                    styles.stepItem,
                    idx > 0 && styles.stepItemMid,
                  ]}
                >
                  <View style={[styles.stepNum, { backgroundColor: step.bg }]}>
                    <Text style={[styles.stepNumText, { color: step.fg }]}>{step.num}</Text>
                  </View>
                  <View style={styles.stepTexts}>
                    <Text style={styles.stepTitle}>{step.title}</Text>
                    <Text style={styles.stepDesc}>{step.desc}</Text>
                  </View>
                </View>
              ))}
            </View>

            {/* Trust footer */}
            <View style={styles.trustFooter}>
              <Ionicons name="shield-checkmark" size={15} color="#16A34A" />
              <Text style={styles.trustText}>
                {t('donate.trustNote', 'Instant Direct Settlement · Zero Processing Fee')}
              </Text>
            </View>
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
    width: '100%',
    alignSelf: 'stretch',
    backgroundColor: '#F8FAFC',
    borderTopLeftRadius: 32,
    borderTopRightRadius: 32,
    paddingTop: 28,
    paddingBottom: 80,
    paddingHorizontal: Spacing.lg,
    minHeight: 700,
    ...Shadows.lg,
  },

  // Website-style donation card
  donateCard: {
    width: '100%',
    alignSelf: 'stretch',
    overflow: 'hidden',
    backgroundColor: '#FFFFFF',
    borderRadius: 20,
    borderWidth: 1.5,
    borderColor: '#E2E8F0',
    padding: 20,
    marginBottom: 20,
    ...Shadows.md,
  },
  cardHeader: {
    alignItems: 'flex-start',
    gap: 12,
    paddingBottom: 16,
    marginBottom: 18,
    borderBottomWidth: 1,
    borderBottomColor: '#F1F5F9',
  },
  headerLeft: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
    width: '100%',
  },
  headerTitles: {
    flex: 1,
    minWidth: 0,
  },
  logoBox: {
    width: 44,
    height: 44,
    borderRadius: 12,
    backgroundColor: '#FFFFFF',
    borderWidth: 1.5,
    borderColor: '#E2E8F0',
    alignItems: 'center',
    justifyContent: 'center',
    shadowColor: '#0B1D6D',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.08,
    shadowRadius: 8,
    elevation: 2,
    padding: 4,
    overflow: 'hidden',
    flexShrink: 0,
  },
  logoImg: { width: '100%', height: '100%' },
  cardTitle: {
    fontSize: 21,
    fontWeight: '800',
    color: '#0B1D6D',
    letterSpacing: -0.02,
    lineHeight: 26,
  },
  cardSub: {
    fontSize: 12,
    fontWeight: '600',
    color: '#64748B',
    textTransform: 'uppercase',
    letterSpacing: 0.5,
    marginTop: 2,
  },
  khqrBadge: {
    flexDirection: 'row',
    alignItems: 'center',
    alignSelf: 'flex-start',
    gap: 5,
    backgroundColor: 'rgba(227,30,36,0.08)',
    paddingHorizontal: 12,
    paddingVertical: 5,
    borderRadius: 100,
    borderWidth: 1,
    borderColor: 'rgba(227,30,36,0.18)',
  },
  khqrDot: {
    width: 6,
    height: 6,
    borderRadius: 3,
    backgroundColor: '#E31E24',
  },
  khqrBadgeText: {
    fontSize: 10,
    fontWeight: '800',
    color: '#E31E24',
    textTransform: 'uppercase',
    letterSpacing: 0.4,
  },

  qrFrame: {
    width: '100%',
    alignSelf: 'stretch',
    backgroundColor: '#FFFFFF',
    borderRadius: 22,
    borderWidth: 1.5,
    borderColor: '#E2E8F0',
    padding: 14,
    marginBottom: 18,
    alignItems: 'center',
    justifyContent: 'center',
    overflow: 'hidden',
    shadowColor: '#0B1D6D',
    shadowOffset: { width: 0, height: 10 },
    shadowOpacity: 0.12,
    shadowRadius: 16,
    elevation: 4,
  },
  qrImageBox: {
    width: '100%',
    aspectRatio: 908 / 1280,
    borderRadius: 14,
    overflow: 'hidden',
    backgroundColor: '#FFFFFF',
  },
  qrImage: {
    width: '100%',
    height: '100%',
  },

  scanTitle: {
    fontSize: 20,
    fontWeight: '800',
    color: '#0B1D6D',
    letterSpacing: -0.02,
    marginBottom: 8,
    lineHeight: 26,
  },
  scanDesc: {
    fontSize: 13,
    color: '#64748B',
    lineHeight: 20,
    marginBottom: 14,
  },

  accountBox: {
    backgroundColor: '#F8FAFC',
    borderWidth: 1.5,
    borderColor: '#E2E8F0',
    borderRadius: 16,
    padding: 14,
    marginBottom: 12,
  },
  accountLabel: {
    fontSize: 11,
    fontWeight: '700',
    textTransform: 'uppercase',
    color: '#64748B',
    letterSpacing: 0.6,
    marginBottom: 4,
  },
  accountOrg: {
    fontSize: 14,
    fontWeight: '800',
    color: '#0B1D6D',
    marginBottom: 12,
    lineHeight: 20,
    letterSpacing: 0.2,
  },
  accountNumWrap: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 10,
    backgroundColor: '#FFFFFF',
    borderWidth: 1.5,
    borderColor: '#CBD5E1',
    borderRadius: 12,
    paddingVertical: 10,
    paddingHorizontal: 16,
    width: '100%',
    shadowColor: '#0B1D6D',
    shadowOffset: { width: 0, height: 2 },
    shadowOpacity: 0.04,
    shadowRadius: 6,
    elevation: 1,
  },
  abaChip: {
    backgroundColor: '#0B1D6D',
    paddingHorizontal: 8,
    paddingVertical: 3,
    borderRadius: 6,
  },
  abaChipText: {
    fontSize: 11,
    fontWeight: '900',
    color: '#FFFFFF',
    letterSpacing: 0.5,
  },
  accountNumber: {
    fontSize: 18,
    fontWeight: '800',
    color: '#0B1D6D',
    letterSpacing: 1.2,
    flexShrink: 1,
  },

  copyAccountBtn: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 8,
    width: '100%',
    paddingVertical: 11,
    paddingHorizontal: 16,
    backgroundColor: '#F4F6FC',
    borderWidth: 1.5,
    borderColor: '#CBD5E1',
    borderRadius: 100,
    marginBottom: 8,
  },
  copyAccountBtnText: {
    fontSize: 13,
    fontWeight: '700',
    color: '#0B1D6D',
  },

  saveQrBtn: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 10,
    width: '100%',
    paddingVertical: 13,
    paddingHorizontal: 20,
    backgroundColor: '#0B1D6D',
    borderRadius: 100,
    marginBottom: 16,
    shadowColor: '#0B1D6D',
    shadowOffset: { width: 0, height: 8 },
    shadowOpacity: 0.38,
    shadowRadius: 12,
    elevation: 6,
  },
  saveQrBtnText: {
    fontSize: 14,
    fontWeight: '700',
    color: '#FFFFFF',
  },

  stepsStrip: {
    backgroundColor: '#F8FAFC',
    borderWidth: 1,
    borderColor: '#E2E8F0',
    borderRadius: 16,
    padding: 12,
    marginBottom: 14,
    gap: 10,
  },
  stepItem: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
  },
  stepItemMid: {
    borderTopWidth: 1,
    borderTopColor: '#E2E8F0',
    paddingTop: 10,
  },
  stepNum: {
    width: 28,
    height: 28,
    borderRadius: 14,
    alignItems: 'center',
    justifyContent: 'center',
    flexShrink: 0,
  },
  stepNumText: {
    fontSize: 12,
    fontWeight: '800',
  },
  stepTexts: {
    flex: 1,
    minWidth: 0,
  },
  stepTitle: {
    fontSize: 12,
    fontWeight: '700',
    color: '#0B1D6D',
  },
  stepDesc: {
    fontSize: 11,
    color: '#64748B',
    lineHeight: 15,
    marginTop: 1,
  },

  trustFooter: {
    paddingTop: 14,
    borderTopWidth: 1,
    borderTopColor: '#F1F5F9',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 8,
  },
  trustText: {
    fontSize: 12,
    fontWeight: '600',
    color: '#64748B',
    textAlign: 'center',
  },

  // Campaigns
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
