<template>
    <span :class="[
        'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold',
        variantClasses
    ]">
        <slot />
    </span>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    variant: {
        type: String,
        default: 'default',
        validator: (value) => ['default', 'primary', 'success', 'warning', 'danger', 'info'].includes(value)
    }
});

const variantClasses = computed(() => {
    const variants = {
        default: 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300',
        primary: 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-500',
        success: 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-500',
        warning: 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-500',
        danger: 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-500',
        info: 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-500'
    };

    return variants[props.variant];
});
</script>
