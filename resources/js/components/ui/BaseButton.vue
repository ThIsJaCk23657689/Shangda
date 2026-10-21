<script setup lang="ts">
import { computed } from 'vue';

const props = withDefaults(
    defineProps<{
        type?: 'button' | 'submit' | 'reset';
        variant?: 'primary' | 'secondary' | 'danger' | 'ghost';
        disabled?: boolean;
    }>(),
    {
        type: 'button',
        variant: 'primary',
        disabled: false,
    },
);

const classes = computed(() => ({
    'bg-brand-700 text-white hover:bg-brand-800': props.variant === 'primary',
    'border border-stone-300 bg-white text-stone-700 hover:bg-stone-50': props.variant === 'secondary',
    'bg-red-700 text-white hover:bg-red-800': props.variant === 'danger',
    'text-stone-600 hover:bg-stone-100': props.variant === 'ghost',
}));
</script>

<template>
    <button
        :type="type"
        :disabled="disabled"
        class="inline-flex min-h-10 items-center justify-center gap-2 rounded-xl px-4 py-2 text-sm font-semibold transition disabled:cursor-not-allowed disabled:opacity-50"
        :class="classes"
    >
        <slot />
    </button>
</template>
