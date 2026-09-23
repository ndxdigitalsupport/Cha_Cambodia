import React, { useCallback, useEffect, useState } from 'react';
import {
  View,
  Text,
  StyleSheet,
  TouchableOpacity,
  ActivityIndicator,
  Linking,
} from 'react-native';
import { WebView } from 'react-native-webview';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { Colors, Spacing } from '../../theme/colors';
import { newsAPI } from '../../api/client';

type Props = {
  navigation: any;
  route: { params?: { url?: string; title?: string; id?: number } };
};

type Article = {
  title: string;
  title_km?: string;
  date: string;
  badge: string;
  url: string;
  image?: string;
  content: string;
  content_km?: string;
};

const BADGE_HEX: Record<string, string> = {
  Event: '#E31E24',
  Update: '#0B1D6D',
  Workshop: '#6A2C91',
  Announcement: '#16A34A',
};

function escapeHtml(value: string): string {
  return value
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

function buildArticleHtml(article: Article, isKm: boolean): string {
  const title = isKm && article.title_km ? article.title_km : article.title;
  const content =
    isKm && article.content_km ? article.content_km : article.content;
  const badge = article.badge || 'Event';
  const badgeColor = BADGE_HEX[badge] || BADGE_HEX.Event;
  const imageHtml = article.image
    ? `<img src="${escapeHtml(article.image)}" alt="" class="hero">`
    : '';

  return `<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<style>
  * { box-sizing: border-box; }
  body {
    margin: 0;
    padding: 20px 18px 48px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Noto Sans Khmer", sans-serif;
    background: #F8FAFC;
    color: #0F172A;
    line-height: 1.75;
  }
  .card {
    background: #FFFFFF;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 8px 24px rgba(0,0,0,0.06);
  }
  .hero { width: 100%; aspect-ratio: 16/9; object-fit: cover; display: block; background: #E2E8F0; }
  .body { padding: 22px 18px 28px; }
  .meta { display: flex; align-items: center; gap: 10px; margin-bottom: 14px; flex-wrap: wrap; }
  .badge {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 999px;
    background: ${badgeColor}15;
    color: ${badgeColor};
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.04em;
    text-transform: uppercase;
  }
  .date { color: #64748B; font-size: 13px; font-weight: 600; }
  h1 {
    margin: 0 0 18px;
    font-size: 24px;
    line-height: 1.3;
    font-weight: 800;
    color: #0B1D6D;
  }
  .content { font-size: 16px; color: #1E293B; }
  .content p { margin: 0 0 14px; }
  .content img, .content figure img { max-width: 100%; height: auto; border-radius: 12px; }
  .content h2, .content h3 { color: #0B1D6D; line-height: 1.35; }
  .content a { color: #E31E24; }
  .content ul, .content ol { padding-left: 1.25em; }
  .content blockquote {
    margin: 16px 0;
    padding: 12px 16px;
    border-left: 4px solid #E31E24;
    background: #F8FAFC;
    border-radius: 0 12px 12px 0;
    color: #334155;
  }
</style>
</head>
<body>
  <article class="card">
    ${imageHtml}
    <div class="body">
      <div class="meta">
        <span class="badge">${escapeHtml(badge)}</span>
        <span class="date">${escapeHtml(article.date || '')}</span>
      </div>
      <h1>${escapeHtml(title || '')}</h1>
      <div class="content">${content || ''}</div>
    </div>
  </article>
</body>
</html>`;
}

export default function NewsDetailScreen({ navigation, route }: Props) {
  const { t, i18n } = useTranslation();
  const isKm = i18n.language === 'km';
  const articleId = Number(route?.params?.id) || 0;
  const fallbackUrl = route?.params?.url || '';
  const fallbackTitle = route?.params?.title || '';
  const [html, setHtml] = useState<string | null>(null);
  const [articleUrl, setArticleUrl] = useState(fallbackUrl);
  const [loading, setLoading] = useState(true);
  const [failed, setFailed] = useState(false);
  const [useWebFallback, setUseWebFallback] = useState(false);
  const [attempt, setAttempt] = useState(0);
  const [headerTitle, setHeaderTitle] = useState(fallbackTitle);

  const openExternally = () => {
    const target = articleUrl || fallbackUrl;
    if (!target) return;
    Linking.openURL(target).catch(() => {});
  };

  const loadArticle = useCallback(async () => {
    if (!articleId) {
      if (fallbackUrl) {
        setUseWebFallback(true);
        setLoading(false);
        setFailed(false);
        return;
      }
      setFailed(true);
      setLoading(false);
      return;
    }
    setLoading(true);
    setFailed(false);
    setHtml(null);
    setUseWebFallback(false);
    try {
      const res: any = await newsAPI.getNewsItem(articleId);
      if (!res?.success || !res?.content) throw new Error('no content');
      setArticleUrl(res.url || fallbackUrl);
      setHeaderTitle(
        (isKm && res.title_km ? res.title_km : res.title) || fallbackTitle
      );
      setHtml(buildArticleHtml(res, isKm));
      setLoading(false);
    } catch {
      if (fallbackUrl) {
        setArticleUrl(fallbackUrl);
        setUseWebFallback(true);
        setLoading(false);
        setFailed(false);
      } else {
        setFailed(true);
        setLoading(false);
      }
    }
  }, [articleId, fallbackTitle, fallbackUrl, isKm]);

  useEffect(() => {
    loadArticle();
  }, [loadArticle, attempt]);

  if (!articleId && !fallbackUrl) {
    return (
      <View style={styles.container}>
        <Header navigation={navigation} title={t('news.title', 'News & Events')} />
        <View style={styles.centerBox}>
          <Ionicons name="alert-circle-outline" size={40} color={Colors.textMuted} />
          <Text style={styles.errorText}>{t('news.error', 'Could not load news. Please try again.')}</Text>
        </View>
      </View>
    );
  }

  return (
    <View style={styles.container}>
      <Header navigation={navigation} title={headerTitle || t('news.title', 'News & Events')} />
      {failed ? (
        <View style={styles.centerBox}>
          <Ionicons name="cloud-offline-outline" size={40} color={Colors.textMuted} />
          <Text style={styles.errorText}>{t('news.error', 'Could not load news. Please try again.')}</Text>
          <TouchableOpacity style={styles.retryBtn} onPress={() => setAttempt((a) => a + 1)}>
            <Text style={styles.retryText}>{t('common.retry', 'Retry')}</Text>
          </TouchableOpacity>
          {!!(articleUrl || fallbackUrl) && (
            <TouchableOpacity style={styles.externalBtn} onPress={openExternally}>
              <Ionicons name="open-outline" size={15} color={Colors.secondary} />
              <Text style={styles.externalText}>{t('news.openArticle', 'Open article on website')}</Text>
            </TouchableOpacity>
          )}
        </View>
      ) : html ? (
        <WebView
          originWhitelist={['*']}
          source={{ html, baseUrl: 'https://chacambodia.org' }}
          style={styles.webview}
          allowsBackForwardNavigationGestures
          allowsInlineMediaPlayback
          decelerationRate="normal"
        />
      ) : useWebFallback && articleUrl ? (
        <WebView
          originWhitelist={['*']}
          source={{ uri: articleUrl }}
          userAgent={
            'Mozilla/5.0 (Linux; Android 14) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36'
          }
          style={styles.webview}
          allowsBackForwardNavigationGestures
          allowsInlineMediaPlayback
          decelerationRate="normal"
        />
      ) : (
        <View style={styles.centerBox}>
          <ActivityIndicator size="large" color={Colors.secondary} />
          <Text style={styles.loadingLabel}>{t('news.loading', 'Loading article…')}</Text>
        </View>
      )}
    </View>
  );
}

function Header({ navigation, title }: { navigation: any; title: string }) {
  return (
    <View style={styles.header}>
      <TouchableOpacity
        style={styles.backBtn}
        onPress={() => navigation.goBack()}
        hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}
      >
        <Ionicons name="arrow-back" size={20} color={Colors.secondary} />
      </TouchableOpacity>
      <Text style={styles.headerTitle} numberOfLines={1}>
        {title}
      </Text>
      <View style={styles.headerSpacer} />
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8FAFC' },
  header: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
    paddingHorizontal: Spacing.lg,
    paddingTop: 64,
    paddingBottom: 14,
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
  },
  headerTitle: {
    flex: 1,
    fontSize: 16,
    fontWeight: '800',
    color: Colors.secondary,
    textAlign: 'center',
  },
  headerSpacer: { width: 40 },
  webview: { flex: 1, backgroundColor: '#F8FAFC' },
  centerBox: { flex: 1, alignItems: 'center', justifyContent: 'center', padding: 24, gap: 12 },
  loadingLabel: { fontSize: 13, color: Colors.textSecondary, fontWeight: '600' },
  errorText: { fontSize: 14, color: Colors.textSecondary, textAlign: 'center', lineHeight: 22 },
  retryBtn: {
    marginTop: 4,
    backgroundColor: Colors.secondary,
    paddingHorizontal: 22,
    paddingVertical: 10,
    borderRadius: 100,
  },
  retryText: { color: '#FFFFFF', fontWeight: '700', fontSize: 13 },
  externalBtn: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 6,
    paddingHorizontal: 18,
    paddingVertical: 10,
    borderRadius: 100,
    borderWidth: 1.5,
    borderColor: '#E2E8F0',
    backgroundColor: '#FFFFFF',
  },
  externalText: { fontSize: 13, fontWeight: '800', color: Colors.secondary, paddingTop: 1 },
});
