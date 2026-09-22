import React, { useState, useRef, useEffect } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, Linking, TextInput, Dimensions, ImageBackground, Animated } from 'react-native';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { LinearGradient } from 'expo-linear-gradient';
import { Colors, Spacing, BorderRadius, Shadows, Glassmorphism } from '../../theme/colors';
import heroImg from '../../../assets/programs-hero.jpg';

const { width } = Dimensions.get('window');

export default function LocationsScreen({ navigation }: any) {
  const { t } = useTranslation();
  const [selectedProvinceKey, setSelectedProvinceKey] = useState('all');
  const [searchQuery, setSearchQuery] = useState('');

  const PROVINCE_KEYS = [
    { key: 'all', label: t('programs.provinces.all', 'All') },
    { key: 'phnomPenh', label: t('programs.provinces.phnomPenh', 'Phnom Penh') },
    { key: 'siemReap', label: t('programs.provinces.siemReap', 'Siem Reap') },
  ];

  const CENTRES = [
    {
      id: 1,
      provinceKey: 'phnomPenh',
      name: t('programs.hospitals.nph.name', 'National Pediatric Hospital'),
      type: t('programs.hospitals.nph.type', 'National Care Centre'),
      address: t('programs.hospitals.nph.address', '100 Russian Blvd, Phnom Penh'),
      phone: '+855 12 751 728',
      hasLab: true,
      emergency: '24/7',
    },
    {
      id: 2,
      provinceKey: 'siemReap',
      name: t('programs.hospitals.ahc.name', 'Angkor Hospital for Children (AHC)'),
      type: t('programs.hospitals.ahc.type', 'Haemophilia Unit'),
      address: t('programs.hospitals.ahc.address', 'Tep Vong St, Siem Reap'),
      phone: '+855 12 794 685',
      hasLab: true,
      emergency: 'Mon – Sun: 24h Inpatient',
    },
  ];

  const offices = [
    {
      key: 'phnomPenh',
      icon: 'business' as const,
      name: t('locations.offices.phnomPenh.name', 'CHA National Headquarters'),
      sub: t('locations.offices.phnomPenh.sub', 'Phnom Penh'),
      address: t('locations.offices.phnomPenh.address', '#35, St. 121, Sangkat Tuol Tompoung 2, Khan Chamkarmon, Phnom Penh, Cambodia'),
      phone: '+855 (0) 12 751 728',
      email: 'info@chacambodia.org',
      mapQuery: 'CHA Cambodia, St 121, Phnom Penh',
      color: Colors.secondary,
    },
    {
      key: 'siemReap',
      icon: 'business' as const,
      name: t('locations.offices.siemReap.name', 'CHA Siem Reap Chapter'),
      sub: t('locations.offices.siemReap.sub', 'Siem Reap'),
      address: t('locations.offices.siemReap.address', 'Angkor Hospital for Children, Tep Vong St, Siem Reap, Cambodia'),
      phone: '+855 (0) 12 794 685',
      email: 'info@chacambodia.org',
      mapQuery: 'Angkor Hospital for Children, Siem Reap',
      color: Colors.primary,
    },
  ];

  const filteredCentres = CENTRES.filter(c => {
    const matchesProvince = selectedProvinceKey === 'all' || c.provinceKey === selectedProvinceKey;
    const matchesSearch = c.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          c.address.toLowerCase().includes(searchQuery.toLowerCase()) ||
                          c.type.toLowerCase().includes(searchQuery.toLowerCase());
    return matchesProvince && matchesSearch;
  });

  const handleCall = (phone: string) => {
    Linking.openURL(`tel:${phone.replace(/\s+/g, '')}`);
  };

  const openMaps = (query: string) => {
    Linking.openURL(`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(query)}`);
  };

  const scrollY = useRef(new Animated.Value(0)).current;
  const scaleZoom = useRef(new Animated.Value(1.1)).current;
  const listAnimValues = useRef([...Array(50)].map(() => new Animated.Value(0))).current;

  useEffect(() => {
    Animated.timing(scaleZoom, { toValue: 1, duration: 1500, useNativeDriver: true }).start();
  }, []);

  useEffect(() => {
    listAnimValues.forEach(v => v.setValue(0));
    const anims = filteredCentres.map((_, i) =>
      Animated.spring(listAnimValues[i], { toValue: 1, friction: 6, useNativeDriver: true })
    );
    Animated.stagger(100, anims).start();
  }, [selectedProvinceKey, searchQuery]);

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
      {/* Hero Header */}
      <Animated.View style={{ transform: [{ translateY: parallaxTranslateY }, { scale: scaleZoom }] }}>
        <ImageBackground source={heroImg} style={styles.heroBg} resizeMode="cover">
        <LinearGradient
          colors={['rgba(15,30,84,0.7)', 'rgba(15,30,84,0.95)']}
          style={styles.heroGradient}
        >
          <View style={[styles.heroIconWrap, Glassmorphism.heroBadge]}>
            <Ionicons name="location" size={32} color="#FFFFFF" />
          </View>
          <Text style={styles.heroTitle}>{t('locations.title', 'CHA Locations')}</Text>
          <Text style={styles.heroLead}>
            {t('locations.lead', 'Find CHA offices and partner treatment centres in Phnom Penh and Siem Reap.')}
          </Text>
        </LinearGradient>
        </ImageBackground>
      </Animated.View>

      <View style={{ backgroundColor: Colors.surface, flex: 1 }}>
      {/* CHA Offices */}
      <View style={styles.officeSection}>
        <View style={styles.sectionTitleRow}>
          <View style={styles.redBar} />
          <Text style={styles.sectionTitle}>{t('locations.officesTitle', 'CHA Offices')}</Text>
        </View>

        {offices.map((office) => (
          <View key={office.key} style={styles.officeCard}>
            <View style={styles.officeTop}>
              <View style={[styles.officeIcon, { backgroundColor: office.color + '15' }]}>
                <Ionicons name={office.icon} size={22} color={office.color} />
              </View>
              <View style={styles.officeInfo}>
                <Text style={styles.officeName}>{office.name}</Text>
                <Text style={styles.officeSub}>{office.sub}</Text>
              </View>
            </View>

            <View style={styles.officeDetails}>
              <View style={styles.detailRow}>
                <Ionicons name="location" size={14} color={Colors.primary} />
                <Text style={styles.detailText}>{office.address}</Text>
              </View>
              <View style={styles.detailRow}>
                <Ionicons name="call" size={14} color={Colors.secondary} />
                <Text style={styles.detailText}>{office.phone}</Text>
              </View>
              <View style={styles.detailRow}>
                <Ionicons name="mail" size={14} color={Colors.purple} />
                <Text style={styles.detailText}>{office.email}</Text>
              </View>
            </View>

            <View style={styles.officeActions}>
              <TouchableOpacity style={styles.actionBtn} onPress={() => handleCall(office.phone)} activeOpacity={0.85}>
                <Ionicons name="call" size={14} color="#FFFFFF" />
                <Text style={styles.actionBtnText}>{t('programs.callNow', 'Call Now')}</Text>
              </TouchableOpacity>
              <TouchableOpacity style={[styles.actionBtn, styles.actionBtnOutline]} onPress={() => openMaps(office.mapQuery)} activeOpacity={0.85}>
                <Ionicons name="map-outline" size={14} color={Colors.secondary} />
                <Text style={[styles.actionBtnText, styles.actionBtnTextOutline]}>{t('locations.openInMaps', 'Open in Maps')}</Text>
              </TouchableOpacity>
            </View>
          </View>
        ))}
      </View>

      {/* Partner Treatment Centres */}
      <View style={styles.partnerSection}>
        <View style={styles.sectionTitleRow}>
          <View style={styles.redBar} />
          <Text style={styles.sectionTitle}>{t('locations.partnersTitle', 'Partner Treatment Centres')}</Text>
        </View>
        <Text style={styles.partnerSub}>
          {t('locations.partnersSub', 'Hospitals and specialized haematology units across Cambodia.')}
        </Text>
      </View>

      {/* Search Input */}
      <View style={styles.searchSection}>
        <View style={styles.searchBar}>
          <Ionicons name="search" size={18} color={Colors.secondary} />
          <TextInput
            style={styles.searchInput}
            placeholder={t('programs.searchPlaceholder', 'Search hospital or province...')}
            placeholderTextColor={Colors.textMuted}
            value={searchQuery}
            onChangeText={setSearchQuery}
          />
          {searchQuery ? (
            <TouchableOpacity onPress={() => setSearchQuery('')}>
              <Ionicons name="close-circle" size={18} color={Colors.textMuted} />
            </TouchableOpacity>
          ) : null}
        </View>
      </View>

      {/* Horizontal Province Scroll */}
      <ScrollView horizontal showsHorizontalScrollIndicator={false} contentContainerStyle={styles.provinceScroll}>
        {PROVINCE_KEYS.map((prov) => (
          <TouchableOpacity
            key={prov.key}
            style={[styles.provinceChip, selectedProvinceKey === prov.key && styles.provinceChipActive]}
            onPress={() => setSelectedProvinceKey(prov.key)}
            activeOpacity={0.85}
          >
            <Text style={[styles.provinceText, selectedProvinceKey === prov.key && styles.provinceTextActive]}>
              {prov.label}
            </Text>
          </TouchableOpacity>
        ))}
      </ScrollView>

      {/* Results Header */}
      <View style={styles.listSection}>
        <View style={styles.resultHeader}>
          <Text style={styles.resultCount}>{filteredCentres.length} {t('programs.centresFound', 'Partner Centres Available')}</Text>
        </View>

        {filteredCentres.length === 0 ? (
          <View style={styles.emptyState}>
            <Ionicons name="medkit-outline" size={48} color={Colors.textMuted} />
            <Text style={styles.emptyTitle}>No Treatment Centres Found</Text>
            <Text style={styles.emptySub}>Try adjusting your province filter or search query.</Text>
          </View>
        ) : (
          filteredCentres.map((centre, index) => {
            const opacity = listAnimValues[index] || 1;
            const translateY = (listAnimValues[index] || new Animated.Value(1)).interpolate({ inputRange: [0, 1], outputRange: [50, 0] });
            return (
            <Animated.View key={centre.id} style={[styles.centreCard, { opacity, transform: [{ translateY }] }]}>
              <View style={styles.cardTop}>
                <View style={styles.centreIcon}>
                  <Ionicons name="business" size={22} color={Colors.secondary} />
                </View>
                <View style={styles.centreInfo}>
                  <Text style={styles.centreName}>{centre.name}</Text>
                  <Text style={styles.centreType}>{centre.type}</Text>
                </View>
                {centre.hasLab && (
                  <View style={styles.labBadge}>
                    <Ionicons name="flask" size={10} color={Colors.success} />
                    <Text style={styles.labBadgeText}>{t('programs.labOnsite', 'Lab Onsite')}</Text>
                  </View>
                )}
              </View>

              <View style={styles.cardDetails}>
                <View style={styles.detailRow}>
                  <Ionicons name="location" size={14} color={Colors.primary} />
                  <Text style={styles.detailText}>{centre.address}</Text>
                </View>
                <View style={styles.detailRow}>
                  <Ionicons name="time-outline" size={14} color={Colors.secondary} />
                  <Text style={styles.detailText}>{t('programs.careAccess', 'Care Access')}: {centre.emergency}</Text>
                </View>
              </View>

              <TouchableOpacity
                style={styles.callBtn}
                onPress={() => handleCall(centre.phone)}
                activeOpacity={0.85}
              >
                <Ionicons name="call" size={15} color="#FFFFFF" />
                <Text style={styles.callBtnText}>{t('programs.callClinic', 'Call Clinic')}: {centre.phone}</Text>
              </TouchableOpacity>
            </Animated.View>
            );
          })
        )}
      </View>

      <View style={{ height: Spacing.xl }} />
      </View>
    </Animated.ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: Colors.surface },

  heroBg: { width: '100%' },
  heroGradient: {
    paddingTop: 64,
    paddingBottom: 64,
    paddingHorizontal: Spacing.lg,
    alignItems: 'center',
    justifyContent: 'center',
  },
  heroIconWrap: {
    width: 64,
    height: 64,
    borderRadius: 32,
    alignItems: 'center',
    justifyContent: 'center',
    marginBottom: Spacing.md,
    borderWidth: 1,
    borderColor: 'rgba(255,255,255,0.3)',
  },
  heroTitle: { fontSize: 26, fontWeight: '900', color: '#FFFFFF', textAlign: 'center', lineHeight: 38, paddingTop: 4, marginBottom: 8 },
  heroLead: { fontSize: 14, color: 'rgba(255,255,255,0.9)', lineHeight: 24, paddingTop: 2, textAlign: 'center', maxWidth: '95%' },

  officeSection: { paddingHorizontal: Spacing.lg, paddingTop: 24 },
  partnerSection: { paddingHorizontal: Spacing.lg, paddingTop: 24 },
  sectionTitleRow: { flexDirection: 'row', alignItems: 'center', gap: 8, marginBottom: 12 },
  redBar: { width: 4, height: 22, borderRadius: 2, backgroundColor: Colors.primary },
  sectionTitle: { fontSize: 20, fontWeight: '800', color: Colors.secondary, lineHeight: 32, paddingTop: 4 },
  partnerSub: { fontSize: 13, color: Colors.textSecondary, lineHeight: 22, marginLeft: 12, paddingTop: 2, marginBottom: 16 },

  officeCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: BorderRadius.lg,
    borderWidth: 1,
    borderColor: Colors.border,
    padding: Spacing.md,
    marginBottom: 12,
    ...Shadows.md,
  },
  officeTop: { flexDirection: 'row', alignItems: 'center', marginBottom: 12, gap: 12 },
  officeIcon: { width: 44, height: 44, borderRadius: 22, alignItems: 'center', justifyContent: 'center' },
  officeInfo: { flex: 1 },
  officeName: { fontSize: 15, fontWeight: '800', color: Colors.text, lineHeight: 22, paddingTop: 2 },
  officeSub: { fontSize: 12, color: Colors.textSecondary, lineHeight: 18, paddingTop: 2 },
  officeDetails: { gap: 6, marginBottom: 14, paddingTop: 10, borderTopWidth: 1, borderTopColor: Colors.borderLight },
  detailRow: { flexDirection: 'row', alignItems: 'center', gap: 6 },
  detailText: { fontSize: 12, color: Colors.textSecondary, fontWeight: '500', lineHeight: 19, paddingTop: 2, flex: 1 },
  officeActions: { flexDirection: 'row', gap: 10 },
  actionBtn: {
    flex: 1,
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 6,
    backgroundColor: Colors.secondary,
    paddingVertical: 12,
    borderRadius: BorderRadius.md,
  },
  actionBtnOutline: { backgroundColor: 'transparent', borderWidth: 1.5, borderColor: Colors.secondary },
  actionBtnText: { fontSize: 13, fontWeight: '700', color: '#FFFFFF', paddingTop: 2 },
  actionBtnTextOutline: { color: Colors.secondary },

  searchSection: { paddingHorizontal: Spacing.lg, paddingTop: 8 },
  searchBar: {
    flexDirection: 'row',
    alignItems: 'center',
    gap: 12,
    backgroundColor: '#FFFFFF',
    borderRadius: 24,
    paddingHorizontal: 20,
    paddingVertical: 16,
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.04)',
    ...Shadows.lg,
  },
  searchInput: { flex: 1, fontSize: 15, color: Colors.text, padding: 0, fontWeight: '500' },

  provinceScroll: { paddingHorizontal: Spacing.lg, paddingVertical: 20, gap: 10 },
  provinceChip: {
    paddingHorizontal: 20,
    paddingVertical: 10,
    borderRadius: 100,
    backgroundColor: '#FFFFFF',
    borderWidth: 1,
    borderColor: 'rgba(0,0,0,0.06)',
    ...Shadows.sm,
  },
  provinceChipActive: { backgroundColor: Colors.secondary, borderColor: Colors.secondary, ...Shadows.md },
  provinceText: { fontSize: 14, fontWeight: '700', color: Colors.textSecondary, paddingTop: 2 },
  provinceTextActive: { color: '#FFFFFF' },

  listSection: { paddingHorizontal: Spacing.lg, paddingTop: 8 },
  resultHeader: { marginBottom: 16 },
  resultCount: { fontSize: 14, fontWeight: '800', color: Colors.secondary, lineHeight: 22, paddingTop: 2 },

  emptyState: { alignItems: 'center', justifyContent: 'center', paddingVertical: 48 },
  emptyTitle: { fontSize: 17, fontWeight: '800', color: Colors.text, marginTop: 16 },
  emptySub: { fontSize: 14, color: Colors.textSecondary, marginTop: 6 },

  centreCard: {
    backgroundColor: '#FFFFFF',
    borderRadius: BorderRadius.lg,
    borderWidth: 1,
    borderColor: Colors.border,
    padding: Spacing.md,
    marginBottom: 12,
    ...Shadows.lg,
  },
  cardTop: { flexDirection: 'row', alignItems: 'center', marginBottom: 12, gap: 12 },
  centreIcon: { width: 44, height: 44, borderRadius: 22, backgroundColor: '#EAF0FB', alignItems: 'center', justifyContent: 'center' },
  centreInfo: { flex: 1 },
  centreName: { fontSize: 15, fontWeight: '700', color: Colors.text, lineHeight: 22, paddingTop: 2 },
  centreType: { fontSize: 12, color: Colors.textSecondary, lineHeight: 18, paddingTop: 2 },
  labBadge: { flexDirection: 'row', alignItems: 'center', gap: 4, backgroundColor: '#DCFCE7', paddingHorizontal: 10, paddingVertical: 4, borderRadius: 100 },
  labBadgeText: { fontSize: 10, fontWeight: '700', color: Colors.success, paddingTop: 2 },

  cardDetails: { gap: 6, marginBottom: 14, paddingTop: 10, borderTopWidth: 1, borderTopColor: Colors.borderLight },
  callBtn: {
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'center',
    gap: 8,
    backgroundColor: Colors.secondary,
    paddingVertical: 12,
    borderRadius: BorderRadius.md,
    ...Shadows.sm,
  },
  callBtnText: { fontSize: 13, fontWeight: '700', color: '#FFFFFF', paddingTop: 2 },
});
