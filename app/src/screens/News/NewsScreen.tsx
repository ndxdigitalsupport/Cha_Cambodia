import React, { useState, useEffect, useRef, useCallback } from 'react';
import {
  View,
  Text,
  StyleSheet,
  ScrollView,
  TouchableOpacity,
  Image,
  RefreshControl,
  ActivityIndicator,
} from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { Colors, Spacing, Shadows } from '../../theme/colors';
import { newsAPI } from '../../api/client';

type NewsItem = {
  id: number;
  title: string;
  title_km?: string;
  excerpt: string;
  excerpt_km?: string;
  date: string;
  badge: string;
  url: string;
  image?: string;
};

const BADGE_COLORS: Record<string, { bg: string; fg: string }> = {
  Event: { bg: 'rgba(0,0,0,0.55)', fg: '#F8BFC1' },
  Update: { bg: 'rgba(0,0,0,0.55)', fg: '#B3C2E8' },
  Workshop: { bg: 'rgba(0,0,0,0.55)', fg: '#DCC5EA' },
  Announcement: { bg: 'rgba(0,0,0,0.55)', fg: '#B8E6C8' },
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

export default function NewsScreen({ navigation }: any) {
  const { t, i18n } = useTranslation();
  const [items, setItems] = useState<NewsItem[]>([]);
  const [loading, setLoading] = useState(true);
  const [refreshing, setRefreshing] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const isKm = i18n.language === 'km';
  const mounted = useRef(true);

  const load = useCallback(async (showSpinner = false) => {
    if (showSpinner) setLoading(true);
    setError(null);
    try {
      const res: any = await newsAPI.getNews({ page: 1, per_page: 30 });
      if (!mounted.current) return;
      setItems(Array.isArray(res?.items) ? res.items : []);
    } catch (e: any) {
      if (!mounted.current) return;
      setError(e?.message || t('news.error', 'Could not load news. Please try again.'));
    } finally {
      if (mounted.current) setLoading(false);
    }
  }, [t]);

  useEffect(() => {
    mounted.current = true;
    load(true);
    return () => {
      mounted.current = false;
    };
  }, [load]);

  const onRefresh = async () => {
    setRefreshing(true);
    await load(false);
    setRefreshing(false);
  };

  const openArticle = (item: NewsItem) => {
    if (!item.url && !item.id) return;
    navigation.navigate('NewsDetail', {
      id: item.id,
      url: item.url,
      title: titleFor(item),
    });
  };

  const titleFor = (item: NewsItem) =>
    decodeEntities(isKm && item.title_km ? item.title_km : item.title);
  const excerptFor = (item: NewsItem) =>
    decodeEntities(isKm && item.excerpt_km ? item.excerpt_km : item.excerpt);

  return (
    <View style={styles.container}>
      <View style={styles.header}>
        <TouchableOpacity
          style={styles.backBtn}
          onPress={() => navigation.goBack()}
          hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}
        >
          <Ionicons name="arrow-back" size={20} color={Colors.secondary} />
        </TouchableOpacity>
        <View style={styles.headerTextWrap}>
          <Text style={styles.headerTitle}>{t('news.title', 'News & Events')}</Text>
          <Text style={styles.headerLead}>{t('news.lead', 'Stay updated with the latest from the Cambodian Haemophilia Association.')}</Text>
        </View>
      </View>

      <ScrollView
        style={styles.list}
        contentContainerStyle={styles.listContent}
        showsVerticalScrollIndicator={false}
        refreshControl={<RefreshControl refreshing={refreshing} onRefresh={onRefresh} tintColor={Colors.secondary} />}
      >
        {loading ? (
          <View style={styles.centerBox}>
            <ActivityIndicator size="large" color={Colors.secondary} />
          </View>
        ) : error ? (
          <View style={styles.centerBox}>
            <Ionicons name="cloud-offline-outline" size={40} color={Colors.textMuted} />
            <Text style={styles.emptyText}>{error}</Text>
            <TouchableOpacity style={styles.retryBtn} onPress={() => load(true)}>
              <Text style={styles.retryText}>{t('common.retry', 'Retry')}</Text>
            </TouchableOpacity>
          </View>
        ) : items.length === 0 ? (
          <View style={styles.centerBox}>
            <Ionicons name="newspaper-outline" size={40} color={Colors.textMuted} />
            <Text style={styles.emptyText}>{t('news.empty', 'No articles yet. Check back soon!')}</Text>
          </View>
        ) : (
          items.map((item) => {
            const badge = BADGE_COLORS[item.badge] || BADGE_COLORS.Update;
            return (
              <TouchableOpacity
                key={item.id}
                style={styles.card}
                activeOpacity={0.85}
                onPress={() => openArticle(item)}
              >
                <View style={styles.cardMedia}>
                  {item.image ? (
                    <Image source={{ uri: item.image }} style={styles.cardImage} resizeMode="cover" />
                  ) : (
                    <View style={[styles.cardImage, styles.cardImageFallback]}>
                      <Ionicons name="newspaper" size={28} color={Colors.secondary} />
                    </View>
                  )}
                  <View style={styles.cardDateRow}>
                    <Text style={styles.cardDate}>{item.date}</Text>
                    <View style={[styles.badge, { backgroundColor: badge.bg }]}>
                      <Text style={[styles.badgeText, { color: badge.fg }]}>{item.badge}</Text>
                    </View>
                  </View>
                </View>
                <View style={styles.cardBody}>
                  <Text style={styles.cardTitle} numberOfLines={2}>
                    {titleFor(item)}
                  </Text>
                  <Text style={styles.cardExcerpt} numberOfLines={3}>
                    {excerptFor(item)}
                  </Text>
                  <View style={styles.readPill}>
                    <Text style={styles.readText}>{t('news.readMore', 'Read More')}</Text>
                    <Ionicons name="arrow-forward" size={13} color={Colors.primary} />
                  </View>
                </View>
              </TouchableOpacity>
            );
          })
        )}
      </ScrollView>
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8FAFC' },
  header: {
    flexDirection: 'row',
    alignItems: 'flex-start',
    gap: 12,
    paddingHorizontal: Spacing.lg,
    paddingTop: 64,
    paddingBottom: 16,
    backgroundColor: '#FFFFFF',
    borderBottomWidth: 1,
    borderBottomColor: 'rgba(0,0,0,0.05)',
  },
  backBtn: {
    width: 40,
    height: 40,
    borderRadius: 20,
    backgroundColor: Colors.secondaryLight,
    alignItems: 'center',
    justifyContent: 'center',
    marginTop: 2,
  },
  headerTextWrap: { flex: 1 },
  headerTitle: { fontSize: 22, fontWeight: '800', color: Colors.secondary },
  headerLead: { fontSize: 12, color: Colors.textSecondary, lineHeight: 18, marginTop: 4 },
  list: { flex: 1 },
  listContent: { padding: Spacing.lg, paddingBottom: 40 },
  centerBox: { alignItems: 'center', justifyContent: 'center', paddingVertical: 60, gap: 12 },
  emptyText: { fontSize: 14, color: Colors.textSecondary, textAlign: 'center', paddingHorizontal: 24, lineHeight: 22 },
  retryBtn: {
    marginTop: 4,
    backgroundColor: Colors.secondary,
    paddingHorizontal: 22,
    paddingVertical: 10,
    borderRadius: 100,
  },
  retryText: { color: '#FFFFFF', fontWeight: '700', fontSize: 13 },
  card: {
    backgroundColor: '#FFFFFF',
    borderRadius: 20,
    overflow: 'hidden',
    marginBottom: 16,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
    ...Shadows.md,
  },
  cardMedia: { position: 'relative' },
  cardImage: { width: '100%', height: 160 },
  cardImageFallback: {
    backgroundColor: '#EAF0FB',
    alignItems: 'center',
    justifyContent: 'center',
  },
  cardDateRow: {
    position: 'absolute',
    top: 12,
    left: 12,
    right: 12,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  cardDate: {
    fontSize: 11,
    fontWeight: '600',
    color: '#FFFFFF',
    backgroundColor: 'rgba(0,0,0,0.55)',
    paddingHorizontal: 10,
    paddingVertical: 4,
    borderRadius: 100,
    overflow: 'hidden',
  },
  badge: {
    paddingHorizontal: 10,
    paddingVertical: 4,
    borderRadius: 100,
    backgroundColor: 'rgba(0,0,0,0.55)',
  },
  badgeText: {
    fontSize: 10,
    fontWeight: '800',
    textTransform: 'uppercase',
    letterSpacing: 0.4,
  },
  cardBody: { padding: 16 },
  cardTitle: { fontSize: 17, fontWeight: '800', color: Colors.secondary, lineHeight: 24, marginBottom: 6 },
  cardExcerpt: { fontSize: 13, color: Colors.textSecondary, lineHeight: 20, marginBottom: 14 },
  readPill: {
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
  readText: { fontSize: 13, fontWeight: '800', color: Colors.secondary, paddingTop: 1 },
});
