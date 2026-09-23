import React, { useRef, useEffect, useState, useCallback } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, Dimensions, ImageBackground, Image, Animated, ActivityIndicator } from 'react-native';
import { useTranslation } from 'react-i18next';
import { LinearGradient } from 'expo-linear-gradient';
import { Ionicons } from '@expo/vector-icons';
import { Colors, Spacing, Shadows, Glassmorphism } from '../../theme/colors';
import { useAuth } from '../../store/AuthContext';
import { newsAPI } from '../../api/client';
import heroImg from '../../../assets/hero.jpg';
import donateImg from '../../../assets/heart-hands.jpg';

const { width } = Dimensions.get('window');

type NewsItem = {
  id: number;
  title: string;
  title_km?: string;
  excerpt?: string;
  excerpt_km?: string;
  date: string;
  badge: string;
  url: string;
  image?: string;
};

const NEWS_BADGE_COLORS: Record<string, string> = {
  Event: '#F8BFC1',
  Update: '#B3C2E8',
  Workshop: '#DCC5EA',
  Announcement: '#B8E6C8',
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

export default function HomeScreen({ navigation }: any) {
  const { user } = useAuth();
  const { t, i18n } = useTranslation();
  const [news, setNews] = useState<NewsItem[]>([]);
  const [newsLoading, setNewsLoading] = useState(true);
  const isKm = i18n.language === 'km';

  const loadNews = useCallback(async () => {
    try {
      const res: any = await newsAPI.getNews({ page: 1, per_page: 3 });
      setNews(Array.isArray(res?.items) ? res.items : []);
    } catch {
      setNews([]);
    } finally {
      setNewsLoading(false);
    }
  }, []);

  useEffect(() => {
    loadNews();
  }, [loadNews]);

  const stats = [
    { value: '25', label: t('home.stats.provinces', 'Provinces'), icon: 'location' as const },
    { value: '500+', label: t('home.stats.patients', 'Patients'), icon: 'people' as const },
    { value: '2', label: t('home.stats.partners', 'Partners'), icon: 'heart' as const },
  ];

  const helpItems = [
    { icon: 'water' as const, label: t('home.quickActions.haemophilia', 'Haemophilia'), desc: t('home.helpDesc.haemophilia', 'Types & symptoms'), screen: 'Haemophilia', color: Colors.primary },
    { icon: 'location' as const, label: t('home.quickActions.locations', 'Locations'), desc: t('home.helpDesc.locations', 'CHA offices & clinics'), screen: 'Locations', color: Colors.secondary },
    { icon: 'card' as const, label: t('home.quickActions.card', 'Membership Card'), desc: t('home.helpDesc.card', 'Your CHA ID card'), screen: 'MembershipCard', color: Colors.purple },
    { icon: 'heart' as const, label: t('home.quickActions.donate', 'Donate'), desc: t('home.helpDesc.donate', 'Support bleeding care'), screen: 'Donate', color: Colors.success },
  ];

  const scrollY = useRef(new Animated.Value(0)).current;
  const scaleZoom = useRef(new Animated.Value(1.1)).current;

  useEffect(() => {
    Animated.timing(scaleZoom, { toValue: 1, duration: 1500, useNativeDriver: true }).start();
  }, []);

  const parallaxTranslateY = scrollY.interpolate({
    inputRange: [-200, 0, 400],
    outputRange: [-100, 0, 150],
  });

  return (
    <Animated.ScrollView
      style={styles.container}
      showsVerticalScrollIndicator={false}
      onScroll={Animated.event([{ nativeEvent: { contentOffset: { y: scrollY } } }], { useNativeDriver: true })}
      scrollEventThrottle={16}
    >
      {/* Hero Section */}
      <Animated.View style={{ transform: [{ translateY: parallaxTranslateY }, { scale: scaleZoom }] }}>
        <ImageBackground source={heroImg} style={styles.hero} resizeMode="cover" imageStyle={{ marginLeft: -300, width: '200%' }}>
        <View style={styles.heroOverlay} />
        <View style={styles.heroContent}>
          <View style={[styles.tagBadge, Glassmorphism.heroBadge]}>
            <Ionicons name="shield-checkmark" size={13} color="#FFFFFF" />
            <Text style={styles.heroTag} numberOfLines={1}>{t('home.heroTag', 'Cambodian Haemophilia Association')}</Text>
          </View>
          <Text style={styles.heroTitleBlue}>{t('home.heroBlue', 'Together We Care.')}</Text>
          <Text style={styles.heroTitleRed}>{t('home.heroRed', 'Together We Change Lives.')}</Text>
          <Text style={styles.heroLead}>
            {t('home.heroLead', 'Supporting and empowering people with bleeding disorders across Cambodia.')}
          </Text>
          <View style={styles.heroButtons}>
            <TouchableOpacity style={styles.btnPrimary} onPress={() => navigation.navigate('Haemophilia')} activeOpacity={0.85}>
              <Text style={styles.btnPrimaryText}>{t('home.getSupport', 'Get Support')}</Text>
              <Ionicons name="arrow-forward" size={16} color="#FFFFFF" />
            </TouchableOpacity>
            <TouchableOpacity
              style={styles.btnOutline}
              onPress={() => navigation.navigate(user ? 'Account' : 'Auth', user ? undefined : { mode: 'register' })}
              activeOpacity={0.85}
            >
              <Text style={styles.btnOutlineText}>{user ? t('home.myDashboard', 'My Dashboard') : t('home.becomeMember', 'Become Member')}</Text>
            </TouchableOpacity>
          </View>
        </View>
        <View style={styles.waveContainer}>
          <View style={styles.waveShape} />
        </View>
        </ImageBackground>
      </Animated.View>

      <View style={{ backgroundColor: Colors.surface, flex: 1 }}>
      {/* Stats Strip */}
      <View style={styles.statsStrip}>
        {stats.map((stat, i) => (
          <React.Fragment key={i}>
            {i > 0 && <View style={styles.statDivider} />}
            <View style={styles.statItem}>
              <View style={styles.statIconWrap}>
                <Ionicons name={stat.icon} size={18} color={Colors.secondary} />
              </View>
              <Text style={styles.statValue}>{stat.value}</Text>
              <Text style={styles.statLabel}>{stat.label}</Text>
            </View>
          </React.Fragment>
        ))}
      </View>

      {/* Quick Access Services */}
      <View style={styles.section}>
        <View style={styles.sectionHeader}>
          <View style={styles.sectionTitleRow}>
            <View style={styles.redBar} />
            <Text style={styles.sectionTitle}>{t('home.howWeHelp', 'How We Help')}</Text>
          </View>
          <Text style={styles.sectionSubtitle}>
            {t('home.howWeHelpSub', 'Four core areas where CHA makes a difference for patients and families across Cambodia.')}
          </Text>
        </View>
        <View style={styles.helpGrid}>
          {helpItems.map((item, index) => (
            <TouchableOpacity
              key={index}
              style={[styles.helpCard, { borderColor: item.color + '20' }]}
              onPress={() => navigation.navigate(item.screen === 'MembershipCard' && !user ? 'Auth' : item.screen)}
              activeOpacity={0.85}
            >
              <View style={[styles.helpIconWrap, { backgroundColor: item.color + '15' }]}>
                <Ionicons name={item.icon} size={24} color={item.color} />
              </View>
              <Text style={styles.helpLabel}>{item.label}</Text>
              <Text style={styles.helpDesc}>{item.desc}</Text>
              <View style={[styles.helpLinkPill, { backgroundColor: item.color + '10' }]}>
                <Text style={[styles.helpLinkText, { color: item.color }]}>{t('home.explore', 'Explore')}</Text>
                <Ionicons name="arrow-forward" size={12} color={item.color} />
              </View>
            </TouchableOpacity>
          ))}
        </View>
      </View>

      {/* Latest News */}
      <View style={styles.section}>
        <View style={styles.sectionHeader}>
          <View style={styles.sectionTitleRow}>
            <View style={styles.redBar} />
            <Text style={styles.sectionTitle}>{t('news.title', 'News & Events')}</Text>
          </View>
          <TouchableOpacity style={styles.viewAllBtn} onPress={() => navigation.navigate('News')}>
            <Text style={styles.viewAllText}>{t('news.viewAll', 'View All')}</Text>
            <Ionicons name="arrow-forward" size={14} color={Colors.primary} />
          </TouchableOpacity>
        </View>
        {newsLoading ? (
          <View style={styles.newsLoadingBox}>
            <ActivityIndicator color={Colors.secondary} />
          </View>
        ) : news.length === 0 ? (
          <View style={styles.newsEmptyBox}>
            <Ionicons name="newspaper-outline" size={28} color={Colors.textMuted} />
            <Text style={styles.newsEmptyText}>{t('news.empty', 'No articles yet. Check back soon!')}</Text>
          </View>
        ) : (
          news.map((item) => {
            const badgeColor = NEWS_BADGE_COLORS[item.badge] || NEWS_BADGE_COLORS.Event;
            const title = decodeEntities(isKm && item.title_km ? item.title_km : item.title);
            const excerpt = decodeEntities(isKm && item.excerpt_km ? item.excerpt_km : item.excerpt);
            return (
              <TouchableOpacity
                key={item.id}
                style={styles.newsCard}
                activeOpacity={0.85}
                onPress={() => {
                  if (item.url) {
                    navigation.navigate('NewsDetail', { id: item.id, url: item.url, title });
                  }
                }}
              >
                <View style={styles.newsMedia}>
                  {item.image ? (
                    <Image source={{ uri: item.image }} style={styles.newsImage} resizeMode="cover" />
                  ) : (
                    <View style={[styles.newsImage, styles.newsImageFallback]}>
                      <Ionicons name="newspaper" size={26} color={Colors.secondary} />
                    </View>
                  )}
                  <View style={styles.newsDateRow}>
                    <Text style={styles.newsDatePill}>{item.date}</Text>
                    <View style={styles.newsBadgePill}>
                      <Text style={[styles.newsBadgePillText, { color: badgeColor }]}>{item.badge}</Text>
                    </View>
                  </View>
                </View>
                <View style={styles.newsBody}>
                  <Text style={styles.newsTitle} numberOfLines={2}>
                    {title}
                  </Text>
                  {!!excerpt && (
                    <Text style={styles.newsExcerpt} numberOfLines={3}>
                      {excerpt}
                    </Text>
                  )}
                  <View style={styles.newsReadPill}>
                    <Text style={styles.newsReadText}>{t('news.readMore', 'Read More')}</Text>
                    <Ionicons name="arrow-forward" size={13} color={Colors.secondary} />
                  </View>
                </View>
              </TouchableOpacity>
            );
          })
        )}
      </View>

      {/* CTA Banner */}
      <View style={styles.ctaWrap}>
        <TouchableOpacity style={styles.ctaBannerWrapper} activeOpacity={0.85} onPress={() => navigation.navigate('Donate')}>
          <ImageBackground source={donateImg} style={styles.ctaBgImage} imageStyle={styles.ctaBgImageStyle}>
            <LinearGradient
              colors={['rgba(227, 30, 36, 0.85)', 'rgba(153, 27, 27, 0.95)']}
              style={styles.ctaGradientOverlay}
            >
              <View style={styles.ctaIconWrap}>
                <Ionicons name="heart" size={32} color="#E31E24" />
              </View>
              <Text style={styles.ctaTitle}>{t('home.donate.title', 'Help Change Lives')}</Text>
              <Text style={styles.ctaText}>
                {t('home.donate.ctaText', 'Your donation helps us provide treatment, education and hope to people with bleeding disorders in Cambodia.')}
              </Text>
              <View style={styles.ctaBtnCentered}>
                <Text style={styles.ctaBtnText}>{t('home.donate.button', 'Donate Now')}</Text>
                <Ionicons name="arrow-forward" size={16} color="#E31E24" />
              </View>
            </LinearGradient>
          </ImageBackground>
        </TouchableOpacity>
      </View>

      <View style={{ height: Spacing.xl }} />
      </View>
    </Animated.ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: Colors.surface },

  hero: { width: '100%', height: 540 },
  heroOverlay: { ...StyleSheet.absoluteFill, backgroundColor: 'rgba(11, 29, 109, 0.78)' },
  heroContent: { flex: 1, justifyContent: 'center', paddingHorizontal: 22, paddingTop: 64, paddingBottom: 48 },
  tagBadge: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 8,
    paddingHorizontal: 14,
    paddingVertical: 7,
    borderRadius: 100,
    alignSelf: 'flex-start',
    marginBottom: 14,
  },
  heroTag: { fontSize: 11, fontWeight: '700', color: '#FFFFFF', letterSpacing: 0.5 },
  heroTitleBlue: { fontSize: 28, fontWeight: '800', color: '#FFFFFF', lineHeight: 44, paddingTop: 4, flexWrap: 'wrap' },
  heroTitleRed: { fontSize: 28, fontWeight: '800', color: '#FF4D4D', lineHeight: 44, paddingTop: 4, marginBottom: 12, flexWrap: 'wrap' },
  heroLead: { fontSize: 13, color: 'rgba(255,255,255,0.92)', lineHeight: 22, paddingTop: 2, marginBottom: 24, maxWidth: 320 },
  heroButtons: { flexDirection: 'row', gap: 12, flexWrap: 'wrap' },
  btnPrimary: {
    backgroundColor: '#E31E24',
    flexDirection: 'row',
    alignItems: 'center',
    paddingHorizontal: 22,
    paddingVertical: 14,
    borderRadius: 100,
    gap: 8,
    shadowColor: '#E31E24',
    shadowOffset: { width: 0, height: 6 },
    shadowOpacity: 0.35,
    shadowRadius: 12,
    elevation: 6,
  },
  btnPrimaryText: { color: '#FFFFFF', fontSize: 14, fontWeight: '800', paddingTop: 2 },
  btnOutline: {
    backgroundColor: 'rgba(255, 255, 255, 0.12)',
    borderWidth: 1,
    borderColor: 'rgba(255, 255, 255, 0.35)',
    paddingHorizontal: 20,
    paddingVertical: 14,
    borderRadius: 100,
  },
  btnOutlineText: { color: '#FFFFFF', fontSize: 14, fontWeight: '700', paddingTop: 2 },
  waveContainer: { position: 'absolute', bottom: 0, left: 0, right: 0, height: 36, overflow: 'hidden' },
  waveShape: { position: 'absolute', bottom: -1, left: -10, right: -10, height: 46, backgroundColor: Colors.surface, borderTopLeftRadius: 36, borderTopRightRadius: 36 },

  statsStrip: {
    flexDirection: 'row',
    backgroundColor: '#FFFFFF',
    marginHorizontal: 20,
    marginTop: -70, 
    borderRadius: 24,
    paddingVertical: 22,
    paddingHorizontal: 12,
    shadowColor: '#000',
    shadowOffset: { width: 0, height: 16 },
    shadowOpacity: 0.12,
    shadowRadius: 24,
    elevation: 10,
    alignItems: 'center',
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
  },
  statItem: { flex: 1, alignItems: 'center' },
  statIconWrap: { width: 48, height: 48, borderRadius: 24, backgroundColor: '#F8FAFC', alignItems: 'center', justifyContent: 'center', marginBottom: 8 },
  statValue: { fontSize: 22, fontWeight: '900', color: Colors.secondary, marginBottom: 2, paddingTop: 2 },
  statLabel: { fontSize: 11, color: Colors.textSecondary, fontWeight: '700', textAlign: 'center', letterSpacing: 0.5, paddingTop: 2 },
  statDivider: { width: 1, height: 50, backgroundColor: 'rgba(0,0,0,0.06)' },

  section: { paddingHorizontal: 20, paddingTop: 24 },
  sectionHeader: { marginBottom: 16 },
  sectionTitleRow: { flexDirection: 'row', alignItems: 'center', gap: 8, marginBottom: 4 },
  redBar: { width: 4, height: 22, borderRadius: 2, backgroundColor: Colors.primary },
  sectionTitle: { fontSize: 20, fontWeight: '800', color: Colors.secondary, lineHeight: 32, paddingTop: 4 },
  sectionSubtitle: { fontSize: 13, color: Colors.textSecondary, lineHeight: 22, marginLeft: 12, paddingTop: 2 },

  helpGrid: { flexDirection: 'row', flexWrap: 'wrap', justifyContent: 'space-between' },
  helpCard: {
    width: (width - 40 - 16) / 2,
    backgroundColor: '#FFFFFF',
    borderRadius: 24,
    padding: 16,
    marginBottom: 16,
    borderWidth: 1.5,
    justifyContent: 'flex-start',
    ...Shadows.md,
  },
  helpIconWrap: { width: 48, height: 48, borderRadius: 24, alignItems: 'center', justifyContent: 'center', marginBottom: 12 },
  helpLabel: { fontSize: 15, fontWeight: '800', color: Colors.text, marginBottom: 4, lineHeight: 22, paddingTop: 2 },
  helpDesc: { fontSize: 12, color: Colors.textSecondary, marginBottom: 16, lineHeight: 19, flex: 1, paddingTop: 2 },
  helpLinkPill: { flexDirection: 'row', alignItems: 'center', gap: 4, paddingHorizontal: 12, paddingVertical: 6, borderRadius: 100, alignSelf: 'flex-start' },
  helpLinkText: { fontSize: 12, fontWeight: '800', paddingTop: 2 },

  viewAllBtn: { flexDirection: 'row', alignItems: 'center', gap: 4 },
  viewAllText: { fontSize: 13, fontWeight: '800', color: Colors.primary },
  newsLoadingBox: { paddingVertical: 24, alignItems: 'center' },
  newsEmptyBox: {
    backgroundColor: '#FFFFFF',
    borderRadius: 20,
    padding: 24,
    alignItems: 'center',
    gap: 8,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
  },
  newsEmptyText: { fontSize: 13, color: Colors.textSecondary, textAlign: 'center' },
  newsCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: 20,
    overflow: 'hidden',
    marginBottom: 16,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
    ...Shadows.md,
  },
  newsMedia: { position: 'relative' },
  newsImage: { width: '100%', aspectRatio: 16 / 9 },
  newsImageFallback: {
    backgroundColor: '#EAF0FB',
    alignItems: 'center',
    justifyContent: 'center',
  },
  newsDateRow: {
    position: 'absolute',
    top: 12,
    left: 12,
    right: 12,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  newsDatePill: {
    fontSize: 11,
    fontWeight: '600',
    color: '#FFFFFF',
    backgroundColor: 'rgba(0,0,0,0.55)',
    paddingHorizontal: 10,
    paddingVertical: 4,
    borderRadius: 100,
    overflow: 'hidden',
  },
  newsBadgePill: {
    backgroundColor: 'rgba(0,0,0,0.55)',
    paddingHorizontal: 10,
    paddingVertical: 4,
    borderRadius: 100,
  },
  newsBadgePillText: {
    fontSize: 10,
    fontWeight: '800',
    textTransform: 'uppercase',
    letterSpacing: 0.4,
  },
  newsBody: { padding: 16 },
  newsTitle: { fontSize: 17, fontWeight: '800', color: Colors.secondary, lineHeight: 24, marginBottom: 6 },
  newsExcerpt: { fontSize: 13, color: Colors.textSecondary, lineHeight: 20, marginBottom: 14 },
  newsReadPill: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 6,
    alignSelf: 'flex-start',
    paddingHorizontal: 18,
    paddingVertical: 8,
    borderRadius: 100,
    backgroundColor: '#FFFFFF',
    borderWidth: 1.5,
    borderColor: '#E2E8F0',
  },
  newsReadText: { fontSize: 13, fontWeight: '800', color: Colors.secondary, paddingTop: 1 },

  ctaWrap: { paddingHorizontal: 20, paddingTop: 24, paddingBottom: 24 },
  ctaBannerWrapper: { borderRadius: 24, overflow: 'hidden', ...Shadows.lg },
  ctaBgImage: { width: '100%', alignItems: 'center' },
  ctaBgImageStyle: { borderRadius: 24 },
  ctaGradientOverlay: { width: '100%', padding: 32, alignItems: 'center', justifyContent: 'center' },
  ctaIconWrap: { width: 64, height: 64, borderRadius: 32, backgroundColor: '#FFFFFF', alignItems: 'center', justifyContent: 'center', marginBottom: 16, shadowColor: '#000', shadowOffset: { width: 0, height: 4 }, shadowOpacity: 0.15, shadowRadius: 8, elevation: 5 },
  ctaTitle: { fontSize: 24, fontWeight: '900', color: '#FFFFFF', marginBottom: 8, textAlign: 'center', paddingTop: 4 },
  ctaText: { fontSize: 13, color: 'rgba(255, 255, 255, 0.95)', lineHeight: 22, textAlign: 'center', marginBottom: 26, paddingHorizontal: 10, paddingTop: 2 },
  ctaBtnCentered: { backgroundColor: '#FFFFFF', flexDirection: 'row', alignItems: 'center', justifyContent: 'center', paddingHorizontal: 24, paddingVertical: 14, borderRadius: 100, gap: 6, shadowColor: '#000', shadowOffset: { width: 0, height: 4 }, shadowOpacity: 0.15, shadowRadius: 8, elevation: 5 },
  ctaBtnText: { fontSize: 16, fontWeight: '900', color: '#E31E24', paddingTop: 2 },
});
