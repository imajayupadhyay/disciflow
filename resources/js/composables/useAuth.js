import { ref } from 'vue';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const user = ref(null);
const isAuthenticated = ref(false);

export function useAuth() {
    const register = async (formData) => {
        try {
            const response = await axios.post('/auth/register', formData);

            if (response.data.success) {
                user.value = response.data.user;
                isAuthenticated.value = true;
                localStorage.setItem('user', JSON.stringify(response.data.user));

                // Redirect to dashboard after successful registration
                router.visit('/dashboard');

                return { success: true };
            }
        } catch (error) {
            console.error('Registration error:', error);
            return {
                success: false,
                errors: error.response?.data?.errors || { general: 'Registration failed' }
            };
        }
    };

    const login = async (credentials) => {
        try {
            const response = await axios.post('/auth/login', credentials);

            if (response.data.success) {
                user.value = response.data.user;
                isAuthenticated.value = true;
                localStorage.setItem('user', JSON.stringify(response.data.user));

                // Redirect to dashboard after successful login
                router.visit('/dashboard');

                return { success: true };
            }
        } catch (error) {
            console.error('Login error:', error);
            return {
                success: false,
                errors: error.response?.data?.errors || { general: 'Login failed' }
            };
        }
    };

    const logout = async () => {
        try {
            await axios.post('/auth/logout');
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            user.value = null;
            isAuthenticated.value = false;
            localStorage.removeItem('user');

            // Redirect to home page after logout
            router.visit('/');
        }
    };

    const initAuth = async () => {
        try {
            const response = await axios.get('/auth/user');

            if (response.data.user) {
                user.value = response.data.user;
                isAuthenticated.value = true;
                localStorage.setItem('user', JSON.stringify(response.data.user));
            } else {
                localStorage.removeItem('user');
            }
        } catch (error) {
            console.error('Auth init error:', error);
            localStorage.removeItem('user');
        }
    };

    return {
        user,
        isAuthenticated,
        register,
        login,
        logout,
        initAuth
    };
}
