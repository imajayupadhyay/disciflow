<template>
  <Head title="Profile Settings - DisciFlow" />

  <div class="min-h-screen bg-white dark:bg-gray-900 transition-colors duration-200">
    <Header />
    <Sidebar />

    <main :class="['pt-16 transition-all duration-300', sidebarCollapsed ? 'md:pl-16' : 'md:pl-64']">
      <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Page Header -->
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Profile Settings</h1>
          <p class="text-gray-600 dark:text-gray-400">Manage your account information and security</p>
        </div>

        <!-- Profile Information Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 shadow-sm mb-6">
          <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Profile Information</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Update your account's profile information and email address.</p>
          </div>
          <div class="p-6">
            <form @submit.prevent="updateProfile">
              <!-- Name -->
              <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Name
                </label>
                <input
                  id="name"
                  v-model="profileForm.name"
                  type="text"
                  class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                  required
                />
                <p v-if="profileErrors.name" class="text-red-500 text-xs mt-1">{{ profileErrors.name }}</p>
              </div>

              <!-- Email -->
              <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Email
                </label>
                <input
                  id="email"
                  v-model="profileForm.email"
                  type="email"
                  class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all"
                  required
                />
                <p v-if="profileErrors.email" class="text-red-500 text-xs mt-1">{{ profileErrors.email }}</p>
              </div>

              <!-- Google ID (read-only if exists) -->
              <div v-if="user?.google_id" class="mb-4">
                <label for="google_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Google Account
                </label>
                <input
                  id="google_id"
                  :value="user.google_id"
                  type="text"
                  disabled
                  class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-zinc-100 dark:bg-zinc-950 text-gray-500 dark:text-gray-400"
                />
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Connected via Google OAuth</p>
              </div>

              <!-- Account Created -->
              <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Account Created
                </label>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                  {{ formatDate(user?.created_at) }}
                </p>
              </div>

              <!-- Success Message -->
              <div v-if="profileSuccess" class="mb-4 p-3 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 rounded-lg">
                <p class="text-sm text-green-700 dark:text-green-400">Profile updated successfully!</p>
              </div>

              <!-- Submit Button -->
              <button
                type="submit"
                :disabled="profileLoading"
                class="px-6 py-2.5 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span v-if="profileLoading">Saving...</span>
                <span v-else>Save Changes</span>
              </button>
            </form>
          </div>
        </div>

        <!-- Change Password Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-700 shadow-sm">
          <div class="p-6 border-b border-zinc-200 dark:border-zinc-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Change Password</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Ensure your account is using a long, random password to stay secure.</p>
          </div>
          <div class="p-6">
            <form @submit.prevent="updatePassword">
              <!-- Current Password -->
              <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Current Password
                </label>
                <div class="relative">
                  <input
                    id="current_password"
                    v-model="passwordForm.current_password"
                    :type="showCurrentPassword ? 'text' : 'password'"
                    class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all pr-10"
                    required
                  />
                  <button
                    type="button"
                    @click="showCurrentPassword = !showCurrentPassword"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                  >
                    <svg v-if="!showCurrentPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                  </button>
                </div>
                <p v-if="passwordErrors.current_password" class="text-red-500 text-xs mt-1">{{ passwordErrors.current_password }}</p>
              </div>

              <!-- New Password -->
              <div class="mb-4">
                <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  New Password
                </label>
                <div class="relative">
                  <input
                    id="new_password"
                    v-model="passwordForm.new_password"
                    :type="showNewPassword ? 'text' : 'password'"
                    class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all pr-10"
                    required
                  />
                  <button
                    type="button"
                    @click="showNewPassword = !showNewPassword"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                  >
                    <svg v-if="!showNewPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                  </button>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Minimum 8 characters</p>
                <p v-if="passwordErrors.new_password" class="text-red-500 text-xs mt-1">{{ passwordErrors.new_password }}</p>
              </div>

              <!-- Confirm New Password -->
              <div class="mb-6">
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Confirm New Password
                </label>
                <div class="relative">
                  <input
                    id="new_password_confirmation"
                    v-model="passwordForm.new_password_confirmation"
                    :type="showConfirmPassword ? 'text' : 'password'"
                    class="w-full px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all pr-10"
                    required
                  />
                  <button
                    type="button"
                    @click="showConfirmPassword = !showConfirmPassword"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                  >
                    <svg v-if="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                    </svg>
                  </button>
                </div>
                <p v-if="passwordErrors.new_password_confirmation" class="text-red-500 text-xs mt-1">{{ passwordErrors.new_password_confirmation }}</p>
              </div>

              <!-- Success Message -->
              <div v-if="passwordSuccess" class="mb-4 p-3 bg-green-100 dark:bg-green-900/30 border border-green-300 dark:border-green-700 rounded-lg">
                <p class="text-sm text-green-700 dark:text-green-400">Password changed successfully!</p>
              </div>

              <!-- Submit Button -->
              <button
                type="submit"
                :disabled="passwordLoading"
                class="px-6 py-2.5 bg-gradient-to-r from-amber-600 to-amber-800 dark:from-amber-500 dark:to-amber-700 text-white font-semibold rounded-lg hover:shadow-lg hover:shadow-amber-500/30 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span v-if="passwordLoading">Updating...</span>
                <span v-else>Update Password</span>
              </button>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import { useAuth } from '@/composables/useAuth';
import { useSidebar } from '@/composables/useSidebar';
import Header from '@/Components/Layout/Header.vue';
import Sidebar from './Components/Sidebar.vue';
import axios from 'axios';

const { user, initAuth } = useAuth();
const { isCollapsed: sidebarCollapsed } = useSidebar();

// Profile Form
const profileForm = ref({
  name: '',
  email: ''
});

const profileErrors = ref({});
const profileLoading = ref(false);
const profileSuccess = ref(false);

// Password Form
const passwordForm = ref({
  current_password: '',
  new_password: '',
  new_password_confirmation: ''
});

const passwordErrors = ref({});
const passwordLoading = ref(false);
const passwordSuccess = ref(false);

// Password visibility toggles
const showCurrentPassword = ref(false);
const showNewPassword = ref(false);
const showConfirmPassword = ref(false);

// Initialize form with user data
onMounted(async () => {
  await initAuth();
  if (user.value) {
    profileForm.value.name = user.value.name;
    profileForm.value.email = user.value.email;
  }
});

// Format date
const formatDate = (date) => {
  if (!date) return 'N/A';
  return new Date(date).toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  });
};

// Update Profile
const updateProfile = async () => {
  profileLoading.value = true;
  profileErrors.value = {};
  profileSuccess.value = false;

  try {
    const response = await axios.put('/profile/update', profileForm.value);

    if (response.data.success) {
      profileSuccess.value = true;
      await initAuth(); // Refresh user data

      setTimeout(() => {
        profileSuccess.value = false;
      }, 3000);
    }
  } catch (error) {
    if (error.response?.data?.errors) {
      profileErrors.value = error.response.data.errors;
    } else {
      profileErrors.value = { general: 'Failed to update profile' };
    }
  } finally {
    profileLoading.value = false;
  }
};

// Update Password
const updatePassword = async () => {
  passwordLoading.value = true;
  passwordErrors.value = {};
  passwordSuccess.value = false;

  try {
    const response = await axios.put('/profile/password', passwordForm.value);

    if (response.data.success) {
      passwordSuccess.value = true;

      // Clear form
      passwordForm.value = {
        current_password: '',
        new_password: '',
        new_password_confirmation: ''
      };

      setTimeout(() => {
        passwordSuccess.value = false;
      }, 3000);
    }
  } catch (error) {
    if (error.response?.data?.errors) {
      passwordErrors.value = error.response.data.errors;
    } else {
      passwordErrors.value = { general: 'Failed to update password' };
    }
  } finally {
    passwordLoading.value = false;
  }
};
</script>
