import React, { useState } from 'react';
import { View, Text, StyleSheet, TouchableOpacity, ActivityIndicator, Platform } from 'react-native';
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
  const [loading, setLoading] = useState(true);
  const [failed, setFailed] = useState(false);

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
          <TouchableOpacity style={styles.retryBtn} onPress={() => { setFailed(false); setLoading(true); }}>
            <Text style={styles.retryText}>{t('common.retry', 'Retry')}</Text>
          </TouchableOpacity>
        </View>
      ) : (
        <>
          <WebView
            source={{ uri: url }}
            style={styles.webview}
            originWhitelist={['*']}
            startInLoadingState
            onLoadStart={() => { setLoading(true); setFailed(false); }}
            onLoadEnd={() => setLoading(false)}
            onError={() => { setFailed(true); setLoading(false); }}
            onHttpError={() => { setFailed(true); setLoading(false); }}
            allowsInlineMediaPlayback
            mediaPlaybackRequiresUserAction={false}
            decelerationRate="normal"
            androidLayerType={Platform.OS === 'android' ? 'hardware' : undefined}
          />
          {loading && (
            <View style={styles.loadingOverlay} pointerEvents="none">
              <ActivityIndicator size="large" color={Colors.secondary} />
            </View>
          )}
        </>
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
  loadingOverlay: {
    ...StyleSheet.absoluteFill,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: 'rgba(255,255,255,0.65)',
  },
  centerBox: { flex: 1, alignItems: 'center', justifyContent: 'center', padding: 24, gap: 12 },
  errorText: { fontSize: 14, color: Colors.textSecondary, textAlign: 'center', lineHeight: 22 },
  retryBtn: {
    marginTop: 4,
    backgroundColor: Colors.secondary,
    paddingHorizontal: 22,
    paddingVertical: 10,
    borderRadius: 100,
  },
  retryText: { color: '#FFFFFF', fontWeight: '700', fontSize: 13 },
});
