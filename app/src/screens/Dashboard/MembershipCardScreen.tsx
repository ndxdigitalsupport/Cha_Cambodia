import React, { useState, useEffect } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, Image, Linking } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { useAuth } from '../../store/AuthContext';
import { Colors, Spacing, BorderRadius, Shadows } from '../../theme/colors';
import chaLogo from '../../../assets/cha-logo.png';

const OFFLINE_CARD_KEY = 'cha_offline_card_cache';

export default function MembershipCardScreen({ navigation }: any) {
  const { user } = useAuth();
  const { t } = useTranslation();
  const [cachedUser, setCachedUser] = useState<any>(null);

  // Active display user (live user state or offline fallback)
  const displayUser = user || cachedUser;
  const isPatient = displayUser?.role === 'Patient';

  // Persist current card snapshot locally whenever user is available
  useEffect(() => {
    (async () => {
      if (user) {
        try {
          await AsyncStorage.setItem(OFFLINE_CARD_KEY, JSON.stringify(user));
        } catch (e) {
          // ignore cache write error
        }
      } else {
        try {
          const raw = await AsyncStorage.getItem(OFFLINE_CARD_KEY);
          if (raw) {
            setCachedUser(JSON.parse(raw));
          }
        } catch (e) {
          // ignore cache read error
        }
      }
    })();
  }, [user]);

  const name = displayUser?.name || 'Sok Dara';
  const nameKhmer = displayUser?.nameKhmer || '';
  const bloodType = displayUser?.bloodType || 'A+';
  const condition = displayUser?.condition || 'Haemophilia A';
  const dob = displayUser?.dob || '15 March 1992';
  const phone = displayUser?.phone || '012 345 678';
  const memberId = displayUser?.memberId || 'CHA-2026-0042';
  const treatmentCentre = displayUser?.treatmentCentre || 'National Pediatric Hospital';
  const emergencyContact = displayUser?.emergencyContact || '012 345 678';

  return (
    <ScrollView style={styles.container} showsVerticalScrollIndicator={false}>
      {/* Header */}
      <View style={styles.header}>
        <TouchableOpacity style={styles.backBtn} onPress={() => navigation.goBack()} hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}>
          <Ionicons name="arrow-back" size={20} color="#FFFFFF" />
        </TouchableOpacity>
        <View style={styles.headerTitleWrap}>
          <Text style={styles.headerTitle}>{t('card.title', 'Membership Card')}</Text>
          <Text style={styles.headerSub}>{t('card.officialIdentity', 'CHA Official Identity')}</Text>
        </View>
      </View>

      {/* Main Container */}
      <View style={styles.contentWrap}>
        {/* Official Digital Membership Card */}
        <View style={styles.bossCard}>
          {/* Card Header Row */}
          <View style={styles.cardHeaderRow}>
            <View style={styles.cardBrandWrap}>
              <View style={styles.chaSquareBadge}>
                <Image source={chaLogo} style={styles.chaSquareImg} />
              </View>
              <View>
                <Text style={styles.cardBrandTitle}>Cambodian Haemophilia</Text>
                <Text style={styles.cardBrandSub}>Association</Text>
              </View>
            </View>
            <View style={styles.roleGlassTag}>
              <Text style={styles.roleTagText}>{isPatient ? 'PATIENT' : 'MEMBER'}</Text>
            </View>
          </View>

          {/* Member Name */}
          <Text style={styles.memberName}>{name}</Text>
          {!!nameKhmer && <Text style={styles.memberNameKhmer}>{nameKhmer}</Text>}

          {/* 2x2 Details Grid */}
          <View style={styles.grid2x2}>
            <View style={styles.gridCol}>
              <Text style={styles.gridMutedLabel}>BLOOD TYPE</Text>
              <Text style={styles.gridWhiteVal}>{bloodType}</Text>
            </View>
            <View style={styles.gridCol}>
              <Text style={styles.gridMutedLabel}>CONDITION</Text>
              <Text style={styles.gridWhiteVal}>{condition}</Text>
            </View>

            <View style={styles.gridCol}>
              <Text style={styles.gridMutedLabel}>DATE OF BIRTH</Text>
              <Text style={styles.gridWhiteVal}>{dob}</Text>
            </View>
            <View style={styles.gridCol}>
              <Text style={styles.gridMutedLabel}>PHONE</Text>
              <Text style={styles.gridWhiteVal}>{phone}</Text>
            </View>
          </View>

          {/* Card Footer Divider */}
          <View style={styles.cardDivider} />

          {/* Card Footer Row */}
          <View style={styles.cardFooterRow}>
            <View>
              <Text style={styles.footerMutedLabel}>MEMBER ID</Text>
              <Text style={styles.footerMemberId}>{memberId}</Text>
            </View>
            <View style={styles.floatingBloodBadge}>
              <Text style={styles.bloodBadgeText}>{bloodType}</Text>
            </View>
          </View>
        </View>

        {/* Unified Medical Profile Details Card */}
        <View style={styles.unifiedCard}>
          {/* User Profile Header */}
          <View style={styles.profileHeader}>
            <View style={styles.avatarWrap}>
              {displayUser?.photo ? (
                <Image source={{ uri: displayUser.photo }} style={styles.avatarImg} />
              ) : (
                <Image source={chaLogo} style={styles.avatarImg} />
              )}
            </View>
            <View style={styles.profileInfo}>
              <Text style={styles.profileName}>{name}</Text>
              <Text style={styles.profileEmail}>{displayUser?.email || 'sok.dara@patient.com'}</Text>
            </View>
            <View style={styles.verifiedBadge}>
              <View style={styles.greenDot} />
              <Text style={styles.verifiedText}>{t('card.verified', 'VERIFIED')}</Text>
            </View>
          </View>

          <View style={styles.innerDivider} />

          {/* Detailed Info Grid */}
          <View style={styles.detailGrid}>
            <View style={styles.gridItem}>
              <View style={[styles.itemIcon, { backgroundColor: '#FEE2E2' }]}>
                <Ionicons name="water" size={16} color={Colors.primary} />
              </View>
              <View>
                <Text style={styles.itemLabel}>BLOOD TYPE</Text>
                <Text style={styles.itemVal}>{bloodType}</Text>
              </View>
            </View>

            <View style={styles.gridItem}>
              <View style={[styles.itemIcon, { backgroundColor: '#EAF0FB' }]}>
                <Ionicons name="pulse" size={16} color={Colors.secondary} />
              </View>
              <View>
                <Text style={styles.itemLabel}>CONDITION</Text>
                <Text style={styles.itemVal} numberOfLines={1}>{condition}</Text>
              </View>
            </View>

            <View style={styles.gridItem}>
              <View style={[styles.itemIcon, { backgroundColor: '#F3E8FF' }]}>
                <Ionicons name="calendar-outline" size={16} color={Colors.purple} />
              </View>
              <View>
                <Text style={styles.itemLabel}>DATE OF BIRTH</Text>
                <Text style={styles.itemVal}>{dob}</Text>
              </View>
            </View>

            <View style={styles.gridItem}>
              <View style={[styles.itemIcon, { backgroundColor: '#DCFCE7' }]}>
                <Ionicons name="call-outline" size={16} color={Colors.success} />
              </View>
              <View>
                <Text style={styles.itemLabel}>PHONE</Text>
                <Text style={styles.itemVal}>{phone}</Text>
              </View>
            </View>

            <View style={[styles.gridItem, { width: '100%' }]}>
              <View style={[styles.itemIcon, { backgroundColor: '#EAF0FB' }]}>
                <Ionicons name="business-outline" size={16} color={Colors.secondary} />
              </View>
              <View style={{ flex: 1 }}>
                <Text style={styles.itemLabel}>PRIMARY TREATMENT CENTRE</Text>
                <Text style={styles.itemVal}>{treatmentCentre}</Text>
              </View>
            </View>

            <View style={[styles.gridItem, { width: '100%' }]}>
              <View style={[styles.itemIcon, { backgroundColor: '#FEE2E2' }]}>
                <Ionicons name="shield-checkmark-outline" size={16} color={Colors.primary} />
              </View>
              <View style={{ flex: 1 }}>
                <Text style={styles.itemLabel}>EMERGENCY CONTACT PHONE</Text>
                <Text style={styles.itemVal}>{emergencyContact}</Text>
              </View>
            </View>
          </View>

          {/* Edit Profile Action Link */}
          <TouchableOpacity
            style={styles.editProfileBtn}
            onPress={() => navigation.navigate('EditProfile')}
            activeOpacity={0.85}
          >
            <Ionicons name="create-outline" size={16} color={Colors.secondary} />
            <Text style={styles.editProfileText}>{t('dashboard.editProfile', 'Edit Profile & Photo')}</Text>
            <Ionicons name="chevron-forward" size={14} color={Colors.secondary} />
          </TouchableOpacity>
        </View>

        {/* Treatment Centre Hotlines */}
        <View style={styles.hotlinesCard}>
          <View style={styles.hotlinesHeader}>
            <Ionicons name="call" size={16} color={Colors.primary} />
            <Text style={styles.hotlinesTitle}>{t('card.hotlines', 'Treatment Centre Hotlines')}</Text>
          </View>
          <TouchableOpacity style={styles.hotlineRow} activeOpacity={0.85} onPress={() => Linking.openURL('tel:+85512751728')}>
            <View style={[styles.hotlineIcon, { backgroundColor: '#EAF0FB' }]}>
              <Ionicons name="business-outline" size={16} color={Colors.secondary} />
            </View>
            <View style={{ flex: 1 }}>
              <Text style={styles.hotlineName}>National Pediatric Hospital</Text>
              <Text style={styles.hotlinePhone}>Phnom Penh · 012 751 728</Text>
            </View>
            <Ionicons name="chevron-forward" size={14} color={Colors.textMuted} />
          </TouchableOpacity>
          <TouchableOpacity style={styles.hotlineRow} activeOpacity={0.85} onPress={() => Linking.openURL('tel:+85563963409')}>
            <View style={[styles.hotlineIcon, { backgroundColor: '#F3E8FF' }]}>
              <Ionicons name="business-outline" size={16} color={Colors.purple} />
            </View>
            <View style={{ flex: 1 }}>
              <Text style={styles.hotlineName}>Angkor Hospital for Children</Text>
              <Text style={styles.hotlinePhone}>Siem Reap · 063 963 409</Text>
            </View>
            <Ionicons name="chevron-forward" size={14} color={Colors.textMuted} />
          </TouchableOpacity>
        </View>

        <View style={{ height: Spacing.xl }} />
      </View>
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: Colors.surface },
  header: {
    backgroundColor: Colors.secondary,
    paddingTop: 56,
    paddingBottom: 24,
    paddingHorizontal: Spacing.lg,
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
  },
  backBtn: {
    width: 38,
    height: 38,
    borderRadius: 19,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: 'rgba(255,255,255,0.18)',
  },
  headerTitleWrap: { flex: 1 },
  headerTitle: { fontSize: 24, fontWeight: '800', color: '#FFFFFF', lineHeight: 34, paddingTop: 4 },
  headerSub: { fontSize: 12, color: 'rgba(255,255,255,0.7)', marginTop: 2, lineHeight: 18, paddingTop: 2 },

  offlineBanner: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 8,
    backgroundColor: '#DCFCE7',
    paddingHorizontal: Spacing.lg,
    paddingVertical: 10,
    borderBottomWidth: 1,
    borderBottomColor: '#86EFAC',
  },
  offlineBannerText: { fontSize: 11, fontWeight: '700', color: '#166534', flex: 1, lineHeight: 16, paddingTop: 2 },

  contentWrap: { paddingHorizontal: Spacing.lg, paddingTop: Spacing.lg },

  // Boss's Digital Card
  bossCard: {
    backgroundColor: '#0F1E54',
    borderRadius: 24,
    padding: 20,
    marginBottom: 16,
    ...Shadows.lg,
  },
  cardHeaderRow: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', marginBottom: 16 },
  cardBrandWrap: { flexDirection: 'row', alignItems: 'center', gap: 10 },
  chaSquareBadge: { width: 32, height: 32, borderRadius: 8, backgroundColor: 'rgba(255,255,255,0.2)', alignItems: 'center', justifyContent: 'center', borderWidth: 1, borderColor: 'rgba(255,255,255,0.3)', overflow: 'hidden' },
  chaSquareImg: { width: 28, height: 28, borderRadius: 6 },
  cardBrandTitle: { fontSize: 12, fontWeight: '800', color: '#FFFFFF', lineHeight: 16, paddingTop: 2 },
  cardBrandSub: { fontSize: 10, color: 'rgba(255,255,255,0.7)', lineHeight: 14 },
  roleGlassTag: { backgroundColor: 'rgba(255,255,255,0.18)', borderWidth: 1, borderColor: 'rgba(255,255,255,0.3)', paddingHorizontal: 12, paddingVertical: 4, borderRadius: 100 },
  roleTagText: { fontSize: 10, fontWeight: '800', color: '#FFFFFF', letterSpacing: 0.5 },

  memberName: { fontSize: 26, fontWeight: '900', color: '#FFFFFF', marginBottom: 4, lineHeight: 34, paddingTop: 4 },
  memberNameKhmer: { fontSize: 16, fontWeight: '700', color: 'rgba(255,255,255,0.85)', marginBottom: 16, lineHeight: 24, paddingTop: 2 },

  grid2x2: { flexDirection: 'row', flexWrap: 'wrap', gap: 16, marginBottom: 16 },
  gridCol: { width: '45%' },
  gridMutedLabel: { fontSize: 9, fontWeight: '800', color: 'rgba(255,255,255,0.5)', letterSpacing: 0.5, marginBottom: 2, paddingTop: 2 },
  gridWhiteVal: { fontSize: 13, fontWeight: '700', color: '#FFFFFF', lineHeight: 18, paddingTop: 2 },

  cardDivider: { height: 1, backgroundColor: 'rgba(255,255,255,0.15)', marginBottom: 14 },
  cardFooterRow: { flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center' },
  footerMutedLabel: { fontSize: 9, fontWeight: '800', color: 'rgba(255,255,255,0.5)', letterSpacing: 0.5, marginBottom: 2 },
  footerMemberId: { fontSize: 13, fontWeight: '800', color: '#FFFFFF', letterSpacing: 0.5 },
  floatingBloodBadge: { width: 38, height: 38, borderRadius: 19, backgroundColor: '#E31E24', alignItems: 'center', justifyContent: 'center', ...Shadows.sm },
  bloodBadgeText: { fontSize: 14, fontWeight: '900', color: '#FFFFFF' },

  // Unified Medical Profile Card
  unifiedCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: BorderRadius.lg,
    padding: 16,
    borderWidth: 1,
    borderColor: Colors.border,
    ...Shadows.md,
  },
  profileHeader: { flexDirection: 'row', alignItems: 'center', gap: 12 },
  avatarWrap: { width: 44, height: 44, borderRadius: 22, backgroundColor: Colors.secondary, alignItems: 'center', justifyContent: 'center', overflow: 'hidden' },
  avatarImg: { width: '100%', height: '100%', borderRadius: 22 },
  avatarInitials: { fontSize: 16, fontWeight: '800', color: '#FFFFFF' },
  profileInfo: { flex: 1 },
  profileName: { fontSize: 16, fontWeight: '800', color: Colors.text, lineHeight: 22, paddingTop: 2 },
  profileEmail: { fontSize: 11, color: Colors.textSecondary, paddingTop: 2 },
  verifiedBadge: { flexDirection: 'row', alignItems: 'center', gap: 4, backgroundColor: '#DCFCE7', paddingHorizontal: 10, paddingVertical: 4, borderRadius: 100 },
  greenDot: { width: 6, height: 6, borderRadius: 3, backgroundColor: Colors.success },
  verifiedText: { fontSize: 10, fontWeight: '800', color: Colors.success, letterSpacing: 0.5, paddingTop: 2 },

  innerDivider: { height: 1, backgroundColor: Colors.borderLight, marginVertical: 14 },

  detailGrid: { flexDirection: 'row', flexWrap: 'wrap', gap: 12, marginBottom: 14 },
  gridItem: { width: '47%', flexDirection: 'row', alignItems: 'center', gap: 10, backgroundColor: '#F8FAFC', padding: 10, borderRadius: BorderRadius.md, borderWidth: 1, borderColor: Colors.borderLight },
  itemIcon: { width: 32, height: 32, borderRadius: 16, alignItems: 'center', justifyContent: 'center' },
  itemLabel: { fontSize: 9, fontWeight: '800', color: Colors.textMuted, letterSpacing: 0.5, marginBottom: 2, paddingTop: 2 },
  itemVal: { fontSize: 12, fontWeight: '700', color: Colors.text, paddingTop: 2 },

  editProfileBtn: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 6,
    backgroundColor: '#EAF0FB',
    paddingVertical: 12,
    borderRadius: BorderRadius.md,
    borderWidth: 1,
    borderColor: '#BFDBFE',
  },
  editProfileText: { fontSize: 13, fontWeight: '700', color: Colors.secondary, paddingTop: 2 },

  hotlinesCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: BorderRadius.lg,
    padding: 16,
    borderWidth: 1,
    borderColor: Colors.border,
    marginTop: 16,
    ...Shadows.md,
  },
  hotlinesHeader: { flexDirection: 'row', alignItems: 'center', gap: 8, marginBottom: 12 },
  hotlinesTitle: { fontSize: 14, fontWeight: '800', color: Colors.secondary, paddingTop: 2 },
  hotlineRow: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 10,
    backgroundColor: '#F8FAFC',
    padding: 12,
    borderRadius: BorderRadius.md,
    borderWidth: 1,
    borderColor: Colors.borderLight,
    marginBottom: 8,
  },
  hotlineIcon: { width: 32, height: 32, borderRadius: 16, alignItems: 'center', justifyContent: 'center' },
  hotlineName: { fontSize: 13, fontWeight: '700', color: Colors.text, paddingTop: 2 },
  hotlinePhone: { fontSize: 12, color: Colors.textSecondary, paddingTop: 2 },
});
