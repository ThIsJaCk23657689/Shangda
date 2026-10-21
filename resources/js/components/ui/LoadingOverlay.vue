<script setup lang="ts">
withDefaults(defineProps<{ show: boolean; label?: string }>(), { label: '處理中…' });
</script>

<template>
    <div v-if="show" class="absolute inset-0 z-20 grid place-items-center rounded-[inherit] bg-white/80 backdrop-blur-sm" aria-live="polite" aria-busy="true">
        <div class="flex items-center gap-3 text-sm font-medium text-brand-800">
            <span class="size-5 animate-spin rounded-full border-2 border-brand-200 border-t-brand-700" />
            {{ label }}
        </div>
    </div>
</template>
