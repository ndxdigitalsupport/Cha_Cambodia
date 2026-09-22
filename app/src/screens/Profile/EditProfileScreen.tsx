import React, { useState, useEffect } from 'react';
import { View, Text, StyleSheet, ScrollView, TouchableOpacity, TextInput, ActivityIndicator, Image, Alert } from 'react-native';
import DateTimePicker from '@react-native-community/datetimepicker';
import * as ImagePicker from 'expo-image-picker';
import { Ionicons } from '@expo/vector-icons';
import { useTranslation } from 'react-i18next';
import { useAuth } from '../../store/AuthContext';
import { profileAPI, authAPI } from '../../api/client';
import { ensureMediaPermission } from '../../utils/mediaPermission';
import { Spacing, BorderRadius } from '../../theme/colors';

const haemophiliaTypes = ['Hemophilia A', 'Hemophilia B', 'Other'];
const bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

function parseDob(value: string): Date | null {
  const m = value?.trim().match(/^(\d{1,2})[\/\-.](\d{1,2})[\/\-.](\d{4})$/);
  if (!m) return null;
  const [_, d, mo, y] = m;
  const date = new Date(Number(y), Number(mo) - 1, Number(d));
  if (date.getFullYear() !== Number(y) || date.getMonth() !== Number(mo) - 1) return null;
  return date;
}

function formatDob(date: Date | null): string {
  if (!date) return '';
  const d = String(date.getDate()).padStart(2, '0');
  const m = String(date.getMonth() + 1).padStart(2, '0');
  return `${d}/${m}/${date.getFullYear()}`;
}

export default function EditProfileScreen({ navigation }: any) {
  const { t } = useTranslation();
  const { user, refreshUser, updatePhoto, logout } = useAuth();
  const isPatient = user?.role === 'Patient';
  const [saving, setSaving] = useState(false);
  const [success, setSuccess] = useState<string | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [uploading, setUploading] = useState(false);
  const [showDobPicker, setShowDobPicker] = useState(false);

  const [form, setForm] = useState({
    name: '',
    nameKhmer: '',
    phone: '',
    address: '',
    bloodType: '',
    condition: '',
    dob: '',
    treatmentCentre: '',
    emergencyContact: '',
  });

  useEffect(() => {
    if (user) {
      setForm({
        name: user.name || '',
        nameKhmer: user.nameKhmer || '',
        phone: user.phone || '',
        address: user.address || '',
        bloodType: user.bloodType || '',
        condition: user.condition || '',
        dob: user.dob || '',
        treatmentCentre: user.treatmentCentre || '',
        emergencyContact: user.emergencyContact || '',
      });
    }
  }, [user]);

  const update = (key: string, value: string) => setForm(prev => ({ ...prev, [key]: value }));

  const pickAndUpload = async () => {
    setError(null);
    setSuccess(null);
    const ok = await ensureMediaPermission();
    if (!ok) return;
    const result = await ImagePicker.launchImageLibraryAsync({
      mediaTypes: ['images'],
      allowsEditing: true,
      aspect: [3, 4],
      quality: 0.8,
    });
    if (result.canceled || !result.assets?.length) return;

    const asset = result.assets[0];
    const fd = new FormData();
    fd.append('photo', {
      uri: asset.uri,
      name: asset.fileName || 'profile-photo.jpg',
      type: asset.mimeType || (asset.uri.endsWith('.png') ? 'image/png' : 'image/jpeg'),
    } as any);

    setUploading(true);
    try {
      const res = await profileAPI.uploadPhoto(fd) as any;
      await updatePhoto(res?.photoUrl || user?.photo || '');
      setSuccess('Photo updated successfully.');
    } catch (e: any) {
      setError(e.message || 'Could not upload the photo. Try a JPG or PNG under 5MB.');
    } finally {
      setUploading(false);
    }
  };

  const removePhoto = async () => {
    setError(null);
    setSuccess(null);
    setUploading(true);
    try {
      await profileAPI.deletePhoto();
      await updatePhoto('');
      setSuccess('Photo removed.');
    } catch (e: any) {
      setError(e.message || 'Could not remove photo.');
    } finally {
      setUploading(false);
    }
  };

  const handleSave = async () => {
    setError(null);
    setSuccess(null);

    if (!form.name.trim()) {
      setError('Full Name is required.');
      return;
    }

    setSaving(true);
    try {
      const payload: any = {
        name: form.name.trim(),
        nameKhmer: form.nameKhmer.trim(),
        phone: form.phone.trim(),
        address: form.address.trim(),
      };
      if (isPatient) {
        payload.bloodType = form.bloodType;
        payload.condition = form.condition;
        payload.dob = form.dob.trim();
        payload.treatmentCentre = form.treatmentCentre.trim();
        payload.emergencyContact = form.emergencyContact.trim();
      }
      await profileAPI.updateProfile(payload);
      await refreshUser();
      setSuccess('Profile updated successfully.');
    } catch (e: any) {
      setError(e.message || 'Failed to update profile.');
    } finally {
      setSaving(false);
    }
  };

  const handleDeleteAccount = () => {
    Alert.alert(
      t('profile.deleteTitle', 'Delete Account'),
      t('profile.deleteConfirm', 'Are you sure you want to permanently delete your CHA account? This action cannot be undone and will erase your digital card records.'),
      [
        { text: t('common.cancel', 'Cancel'), style: 'cancel' },
        {
          text: t('profile.deleteConfirmAction', 'Delete Permanently'),
          style: 'destructive',
          onPress: async () => {
            try {
              await authAPI.deleteAccount();
              await logout();
              navigation.navigate('Main');
              Alert.alert(t('profile.deleteDone', 'Account Deleted'), t('profile.deleteDoneMsg', 'Your CHA account data has been deleted.'));
            } catch (e: any) {
              Alert.alert(t('common.error', 'Error'), e.message || 'Failed to delete account.');
            }
          },
        },
      ]
    );
  };

  return (
    <ScrollView style={styles.container} keyboardShouldPersistTaps="handled">
      {/* Header Bar */}
      <View style={styles.header}>
        <TouchableOpacity style={styles.backBtn} onPress={() => navigation.goBack()} hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}>
          <Ionicons name="arrow-back" size={20} color="#0F172A" />
        </TouchableOpacity>
        <Text style={styles.headerTitle}>{t('profile.editTitle', 'Edit Profile')}</Text>
        <View style={{ width: 38 }} />
      </View>

      <View style={styles.content}>
        {error ? (
          <View style={styles.bannerError}>
            <Ionicons name="alert-circle" size={18} color="#991B1B" />
            <Text style={styles.bannerErrorText}>{error}</Text>
          </View>
        ) : null}
        {success ? (
          <View style={styles.bannerSuccess}>
            <Ionicons name="checkmark-circle" size={18} color="#166534" />
            <Text style={styles.bannerSuccessText}>{success}</Text>
          </View>
        ) : null}

        {/* Photo Upload Section */}
        <View style={styles.photoSection}>
          <View style={styles.avatarWrap}>
            {user?.photo ? (
              <Image source={{ uri: user.photo }} style={styles.avatarImage} />
            ) : (
              <View style={styles.avatarPlaceholder}>
                <Ionicons name="person" size={40} color="#94A3B8" />
              </View>
            )}
            {uploading ? (
              <View style={styles.avatarOverlay}>
                <ActivityIndicator color="#FFFFFF" />
              </View>
            ) : null}
          </View>

          <View style={styles.photoActions}>
            <TouchableOpacity style={styles.photoUploadBtn} onPress={pickAndUpload} disabled={uploading}>
              <Ionicons name="camera-outline" size={16} color="#0B1D6D" />
              <Text style={styles.photoUploadText}>
                {user?.photo ? t('profile.changePhoto', 'Change Photo') : t('profile.uploadPhoto', 'Upload Photo')}
              </Text>
            </TouchableOpacity>

            {user?.photo ? (
              <TouchableOpacity style={styles.photoRemoveBtn} onPress={removePhoto} disabled={uploading}>
                <Ionicons name="trash-outline" size={16} color="#DC2626" />
                <Text style={styles.photoRemoveText}>{t('profile.remove', 'Remove')}</Text>
              </TouchableOpacity>
            ) : null}
          </View>
        </View>

        {/* Form Fields */}
        <View style={styles.field}>
          <Text style={styles.inputLabel}>{t('profile.fullName', 'Full Name')} <Text style={styles.required}>*</Text></Text>
          <View style={styles.inputWrap}>
            <Ionicons name="person-outline" size={18} color="#64748B" style={styles.fieldIcon} />
            <TextInput
              style={styles.textInput}
              value={form.name}
              onChangeText={v => update('name', v)}
              placeholder="e.g. Sokha Chan"
              placeholderTextColor="#94A3B8"
            />
          </View>
        </View>

        <View style={styles.field}>
          <Text style={styles.inputLabel}>{t('profile.nameKhmer', 'Khmer Name')}</Text>
          <View style={styles.inputWrap}>
            <Ionicons name="language-outline" size={18} color="#64748B" style={styles.fieldIcon} />
            <TextInput
              style={styles.textInput}
              value={form.nameKhmer}
              onChangeText={v => update('nameKhmer', v)}
              placeholder="ឧ. សុខា ចាន់"
              placeholderTextColor="#94A3B8"
            />
          </View>
        </View>

        <View style={styles.field}>
          <Text style={styles.inputLabel}>{t('profile.phone', 'Phone Number')}</Text>
          <View style={styles.inputWrap}>
            <Ionicons name="call-outline" size={18} color="#64748B" style={styles.fieldIcon} />
            <TextInput
              style={styles.textInput}
              value={form.phone}
              onChangeText={v => update('phone', v)}
              placeholder="e.g. 012 345 678"
              placeholderTextColor="#94A3B8"
              keyboardType="phone-pad"
            />
          </View>
        </View>

        <View style={styles.field}>
          <Text style={styles.inputLabel}>{t('profile.address', 'Address')}</Text>
          <View style={styles.inputWrap}>
            <Ionicons name="location-outline" size={18} color="#64748B" style={styles.fieldIcon} />
            <TextInput
              style={styles.textInput}
              value={form.address}
              onChangeText={v => update('address', v)}
              placeholder="e.g. Phnom Penh, Cambodia"
              placeholderTextColor="#94A3B8"
            />
          </View>
        </View>

        {isPatient && (
          <>
            <View style={styles.field}>
              <Text style={styles.inputLabel}>{t('profile.dob', 'Date of Birth')}</Text>
              <TouchableOpacity
                style={styles.dobField}
                onPress={() => setShowDobPicker(true)}
                activeOpacity={0.85}
              >
                <Ionicons name="calendar-outline" size={18} color="#64748B" style={styles.fieldIcon} />
                <Text style={[styles.dobFieldText, !form.dob && styles.dobFieldPlaceholder]}>
                  {form.dob || 'DD/MM/YYYY'}
                </Text>
              </TouchableOpacity>
            </View>

            {showDobPicker && (
              <DateTimePicker
                value={parseDob(form.dob) || new Date(2000, 0, 1)}
                mode="date"
                display="default"
                onChange={(_, date) => {
                  setShowDobPicker(false);
                  if (date) update('dob', formatDob(date));
                }}
              />
            )}

            <View style={styles.field}>
              <Text style={styles.inputLabel}>{t('profile.bloodType', 'Blood Type')}</Text>
              <View style={styles.chipsRow}>
                {bloodTypes.map(type => (
                  <TouchableOpacity
                    key={type}
                    style={[styles.chip, form.bloodType === type && styles.chipActive]}
                    onPress={() => update('bloodType', form.bloodType === type ? '' : type)}
                  >
                    <Text style={[styles.chipText, form.bloodType === type && styles.chipTextActive]}>{type}</Text>
                  </TouchableOpacity>
                ))}
              </View>
            </View>

            <View style={styles.field}>
              <Text style={styles.inputLabel}>{t('profile.condition', 'Medical Condition')}</Text>
              <View style={styles.chipsRow}>
                {haemophiliaTypes.map(type => (
                  <TouchableOpacity
                    key={type}
                    style={[styles.chip, form.condition === type && styles.chipActive]}
                    onPress={() => update('condition', form.condition === type ? '' : type)}
                  >
                    <Text style={[styles.chipText, form.condition === type && styles.chipTextActive]}>{type}</Text>
                  </TouchableOpacity>
                ))}
              </View>
            </View>

            <View style={styles.field}>
              <Text style={styles.inputLabel}>{t('profile.hospital', 'Treatment Centre')}</Text>
              <View style={styles.inputWrap}>
                <Ionicons name="medical-outline" size={18} color="#64748B" style={styles.fieldIcon} />
                <TextInput
                  style={styles.textInput}
                  value={form.treatmentCentre}
                  onChangeText={v => update('treatmentCentre', v)}
                  placeholder="e.g. National Pediatric Hospital"
                  placeholderTextColor="#94A3B8"
                />
              </View>
            </View>

            <View style={styles.field}>
              <Text style={styles.inputLabel}>{t('profile.emergencyContact', 'Emergency Contact Phone')}</Text>
              <View style={styles.inputWrap}>
                <Ionicons name="call-outline" size={18} color="#64748B" style={styles.fieldIcon} />
                <TextInput
                  style={styles.textInput}
                  value={form.emergencyContact}
                  onChangeText={v => update('emergencyContact', v)}
                  placeholder="e.g. 012 999 888"
                  placeholderTextColor="#94A3B8"
                  keyboardType="phone-pad"
                />
              </View>
            </View>
          </>
        )}

        {/* Submit Button */}
        <TouchableOpacity style={styles.saveBtn} onPress={handleSave} disabled={saving}>
          {saving ? (
            <ActivityIndicator color="#FFFFFF" />
          ) : (
            <>
              <Ionicons name="checkmark-circle-outline" size={20} color="#FFFFFF" />
              <Text style={styles.saveBtnText}>{t('profile.saveChanges', 'Save Changes')}</Text>
            </>
          )}
        </TouchableOpacity>

        {/* Account Deletion (Apple Guideline 5.1.1(v) Compliance) */}
        <View style={styles.deleteSection}>
          <TouchableOpacity style={styles.deleteBtn} onPress={handleDeleteAccount} activeOpacity={0.85}>
            <Ionicons name="trash-outline" size={16} color="#DC2626" />
            <Text style={styles.deleteBtnText}>{t('profile.deleteAccount', 'Delete Account')}</Text>
          </TouchableOpacity>
        </View>
      </View>
      <View style={{ height: Spacing.xl }} />
    </ScrollView>
  );
}

const styles = StyleSheet.create({
  container: { flex: 1, backgroundColor: '#F8FAFC' },
  header: {
    paddingTop: 56,
    paddingBottom: 16,
    paddingHorizontal: Spacing.lg,
    backgroundColor: '#FFFFFF',
    borderBottomWidth: 1,
    borderBottomColor: '#E2E8F0',
    flexDirection: 'row',
    alignItems: 'center',
    justifyContent: 'space-between',
  },
  backBtn: {
    width: 38,
    height: 38,
    borderRadius: 19,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: '#F1F5F9',
  },
  headerTitle: { fontSize: 18, fontWeight: '800', color: '#0F172A', lineHeight: 28, paddingTop: 4 },
  content: { padding: Spacing.lg },

  bannerError: { flexDirection: 'row', alignItems: 'center', gap: 8, backgroundColor: '#FEE2E2', borderWidth: 1, borderColor: '#FCA5A5', padding: 12, borderRadius: BorderRadius.md, marginBottom: 16 },
  bannerErrorText: { fontSize: 13, color: '#991B1B', flex: 1, lineHeight: 19, paddingTop: 2 },
  bannerSuccess: { flexDirection: 'row', alignItems: 'center', gap: 8, backgroundColor: '#DCFCE7', borderWidth: 1, borderColor: '#86EFAC', padding: 12, borderRadius: BorderRadius.md, marginBottom: 16 },
  bannerSuccessText: { fontSize: 13, color: '#166534', flex: 1, lineHeight: 19, paddingTop: 2 },

  photoSection: { alignItems: 'center', marginBottom: Spacing.xl },
  avatarWrap: { width: 100, height: 100, borderRadius: 50, overflow: 'hidden', backgroundColor: '#E2E8F0', marginBottom: 12 },
  avatarImage: { width: '100%', height: '100%' },
  avatarPlaceholder: { flex: 1, alignItems: 'center', justifyContent: 'center' },
  avatarOverlay: { ...StyleSheet.absoluteFill, backgroundColor: 'rgba(0,0,0,0.5)', alignItems: 'center', justifyContent: 'center' },
  photoActions: { flexDirection: 'row', gap: 12 },
  photoUploadBtn: { flexDirection: 'row', alignItems: 'center', gap: 6, backgroundColor: '#EAF0FB', paddingHorizontal: 14, paddingVertical: 8, borderRadius: BorderRadius.sm },
  photoUploadText: { fontSize: 13, fontWeight: '700', color: '#0B1D6D', paddingTop: 2 },
  photoRemoveBtn: { flexDirection: 'row', alignItems: 'center', gap: 6, backgroundColor: '#FEE2E2', paddingHorizontal: 14, paddingVertical: 8, borderRadius: BorderRadius.sm },
  photoRemoveText: { fontSize: 13, fontWeight: '700', color: '#DC2626', paddingTop: 2 },

  field: { marginBottom: Spacing.lg },
  inputLabel: { fontSize: 13, fontWeight: '700', color: '#334155', marginBottom: 6, lineHeight: 20, paddingTop: 2 },
  required: { color: '#DC2626' },
  inputWrap: { flexDirection: 'row', alignItems: 'center', backgroundColor: '#FFFFFF', borderWidth: 1, borderColor: '#CBD5E1', borderRadius: BorderRadius.md, paddingHorizontal: 12, height: 48 },
  fieldIcon: { marginRight: 8 },
  textInput: { flex: 1, fontSize: 14, color: '#0F172A', paddingVertical: 0 },
  dobField: { flexDirection: 'row', alignItems: 'center', backgroundColor: '#FFFFFF', borderWidth: 1, borderColor: '#CBD5E1', borderRadius: BorderRadius.md, paddingHorizontal: 12, height: 48 },
  dobFieldText: { fontSize: 14, color: '#0F172A', paddingTop: 2 },
  dobFieldPlaceholder: { color: '#94A3B8' },

  chipsRow: { flexDirection: 'row', flexWrap: 'wrap', gap: 8 },
  chip: { paddingHorizontal: 14, paddingVertical: 8, borderRadius: 100, backgroundColor: '#FFFFFF', borderWidth: 1, borderColor: '#CBD5E1' },
  chipActive: { backgroundColor: '#0B1D6D', borderColor: '#0B1D6D' },
  chipText: { fontSize: 12, fontWeight: '600', color: '#475569', paddingTop: 2 },
  chipTextActive: { color: '#FFFFFF' },

  saveBtn: { backgroundColor: '#E31E24', flexDirection: 'row', alignItems: 'center', justifyContent: 'center', gap: 8, height: 50, borderRadius: BorderRadius.md, marginTop: Spacing.md },
  saveBtnText: { color: '#FFFFFF', fontSize: 15, fontWeight: '800', paddingTop: 2 },
  deleteSection: { marginTop: Spacing.lg, alignItems: 'center' },
  deleteBtn: { flexDirection: 'row', alignItems: 'center', justifyContent: 'center', gap: 6, paddingVertical: 10, paddingHorizontal: 16 },
  deleteBtnText: { fontSize: 13, fontWeight: '700', color: '#DC2626', paddingTop: 2 },
});
