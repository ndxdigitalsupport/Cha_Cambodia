import React, { useEffect, useState } from 'react';
import { View, ActivityIndicator } from 'react-native';
import { GestureHandlerRootView } from 'react-native-gesture-handler';
import { NavigationContainer, DefaultTheme, DarkTheme } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { StatusBar } from 'expo-status-bar';
import initI18n from './src/i18n';
import { AuthProvider } from './src/store/AuthContext';
import { ThemeProvider, useAppTheme } from './src/store/ThemeContext';
import BottomTabs from './src/navigation/BottomTabs';
import AuthScreen from './src/screens/Auth/AuthScreen';
import ForgotPasswordScreen from './src/screens/Auth/ForgotPasswordScreen';
import MembershipCardScreen from './src/screens/Dashboard/MembershipCardScreen';
import EditProfileScreen from './src/screens/Profile/EditProfileScreen';
import ChangePasswordScreen from './src/screens/Profile/ChangePasswordScreen';
import HelpScreen from './src/screens/Help/HelpScreen';
import DonateScreen from './src/screens/Donate/DonateScreen';
import SettingsScreen from './src/screens/Settings/SettingsScreen';
import NewsScreen from './src/screens/News/NewsScreen';

const Stack = createNativeStackNavigator();

function AppNavigator() {
  const { isDarkMode, theme } = useAppTheme();

  const customNavTheme = isDarkMode
    ? {
        ...DarkTheme,
        colors: {
          ...DarkTheme.colors,
          background: theme.background,
          card: theme.card,
          text: theme.text,
          border: theme.border,
        },
      }
    : {
        ...DefaultTheme,
        colors: {
          ...DefaultTheme.colors,
          background: theme.background,
          card: theme.card,
          text: theme.text,
          border: theme.border,
        },
      };

  return (
    <NavigationContainer theme={customNavTheme}>
      <StatusBar style={isDarkMode ? 'light' : 'light'} />
      <Stack.Navigator screenOptions={{ headerShown: false }}>
        <Stack.Screen name="Main" component={BottomTabs} />
        <Stack.Screen name="Auth" component={AuthScreen} />
        <Stack.Screen name="ForgotPassword" component={ForgotPasswordScreen} />
        <Stack.Screen name="MembershipCard" component={MembershipCardScreen} />
        <Stack.Screen name="EditProfile" component={EditProfileScreen} />
        <Stack.Screen name="ChangePassword" component={ChangePasswordScreen} />
        <Stack.Screen name="Help" component={HelpScreen} />
        <Stack.Screen name="Donate" component={DonateScreen} />
        <Stack.Screen name="Settings" component={SettingsScreen} />
        <Stack.Screen name="News" component={NewsScreen} />
      </Stack.Navigator>
    </NavigationContainer>
  );
}

export default function App() {
  const [i18nReady, setI18nReady] = useState(false);

  useEffect(() => {
    initI18n().then(() => setI18nReady(true));
  }, []);

  if (!i18nReady) {
    return (
      <View style={{ flex: 1, alignItems: 'center', justifyContent: 'center', backgroundColor: '#0B1D6D' }}>
        <ActivityIndicator color="#FFFFFF" size="large" />
      </View>
    );
  }

  return (
    <GestureHandlerRootView style={{ flex: 1 }}>
      <ThemeProvider>
        <AuthProvider>
          <AppNavigator />
        </AuthProvider>
      </ThemeProvider>
    </GestureHandlerRootView>
  );
}
