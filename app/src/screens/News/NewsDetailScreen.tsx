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

type Props = {
  navigation: any;
  route: { params?: { url?: string; title?: string } };
};

export default function NewsDetailScreen({ navigation, route }: Props) {
  const { t } = useTranslation();
  const url = route?.params?.url || '';
  const title = route?.params?.title || '';
  const [html, setHtml] = useState<string | null>(null);
  const [loading, setLoading] = useState(true);
  const [failed, setFailed] = useState(false);
  const [attempt, setAttempt] = useState(0);

  const openExternally = () => {
    if (!url) return;
    Linking.openURL(url).catch(() => {});
  };

  const loadArticle = useCallback(async () => {
    if (!url) return;
    setLoading(true);
    setFailed(false);
    setHtml(null);
    try {
      const res = await fetch(url, {
        headers: {
          Accept: 'text/html,application/xhtml+xml',
          'User-Agent':
            'Mozilla/5.0 (Linux; Android 14) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36',
        },
      });
      if (!res.ok) throw new Error(`HTTP ${res.status}`);
      const body = await res.text();
      if (!body || body.length < 100) throw new Error('empty');
      setHtml(body);
      setLoading(false);
    } catch {
      setFailed(true);
      setLoading(false);
    }
  }, [url]);

  useEffect(() => {
    loadArticle();
  }, [loadArticle, attempt]);

  if (!url) {
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
      <Header navigation={navigation} title={title || t('news.title', 'News & Events')} />
      {failed ? (
        <View style={styles.centerBox}>
          <Ionicons name="cloud-offline-outline" size={40} color={Colors.textMuted} />
          <Text style={styles.errorText}>{t('news.error', 'Could not load news. Please try again.')}</Text>
          <TouchableOpacity style={styles.retryBtn} onPress={() => setAttempt((a) => a + 1)}>
            <Text style={styles.retryText}>{t('common.retry', 'Retry')}</Text>
          </TouchableOpacity>
          <TouchableOpacity style={styles.externalBtn} onPress={openExternally}>
            <Ionicons name="open-outline" size={15} color={Colors.secondary} />
            <Text style={styles.externalText}>{t('news.openArticle', 'Open article on website')}</Text>
          </TouchableOpacity>
        </View>
      ) : html ? (
        <WebView
          originWhitelist={['*']}
          source={{ html, baseUrl: url }}
          style={styles.webview}
          allowsBackForwardNavigationGestures
          allowsInlineMediaPlayback
          mediaPlaybackRequiresUserAction={false}
          decelerationRate="normal"
          startInLoadingState
          renderLoading={() => (
            <View style={styles.webLoading} pointerEvents="none">
              <ActivityIndicator size="large" color={Colors.secondary} />
            </View>
          )}
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
  const { t } = useTranslation();
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
        {title || t('news.title', 'News & Events')}
      </Text>
      <View style={styles.headerSpacer} />
    </View>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#FFFFFF' },
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
  webview: { flex: 1, backgroundColor: '#FFFFFF' },
  webLoading: {
    ...StyleSheet.absoluteFill,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#FFFFFF',
  },
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
