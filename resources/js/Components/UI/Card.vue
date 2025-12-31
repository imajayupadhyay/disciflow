<template>
    <div :class="[
        'bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl transition-all duration-300',
        hover && 'hover:shadow-xl hover:shadow-amber-900/10 dark:hover:shadow-amber-600/10 hover:-translate-y-1 cursor-pointer',
        paddingClasses
    ]">
        <slot />
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    hover: {
        type: Boolean,
        default: false
    },
    padding: {
        type: String,
        default: 'default',
        validator: (value) => ['none', 'sm', 'default', 'lg'].includes(value)
    }
});

const paddingClasses = computed(() => {
    const paddings = {
        none: '',
        sm: 'p-4',
        default: 'p-6',
        lg: 'p-8'
    };

    return paddings[props.padding];
});
</script>
