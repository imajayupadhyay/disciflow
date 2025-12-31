import { ref } from 'vue';

const isCollapsed = ref(false);

export function useSidebar() {
    const toggleSidebar = () => {
        isCollapsed.value = !isCollapsed.value;
    };

    return {
        isCollapsed,
        toggleSidebar
    };
}
