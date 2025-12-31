import { ref, watch, onMounted } from 'vue';

const isDark = ref(true); // Default to dark mode

export function useDarkMode() {
    const toggleDarkMode = () => {
        isDark.value = !isDark.value;
        updateTheme();
    };

    const updateTheme = () => {
        if (isDark.value) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    };

    const initTheme = () => {
        const savedTheme = localStorage.getItem('theme');

        // Default to dark if no saved preference
        if (savedTheme) {
            isDark.value = savedTheme === 'dark';
        } else {
            isDark.value = true; // Default to dark
        }

        updateTheme();
    };

    return {
        isDark,
        toggleDarkMode,
        initTheme
    };
}
