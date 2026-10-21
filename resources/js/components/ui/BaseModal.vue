<script setup lang="ts">
import { X } from '@lucide/vue';
import { onBeforeUnmount, watch } from 'vue';

const props = defineProps<{
    open: boolean;
    title: string;
}>();

const emit = defineEmits<{
    close: [];
}>();

const onKeydown = (event: KeyboardEvent) => {
    if (event.key === 'Escape') emit('close');
};

watch(
    () => props.open,
    (open) => {
        document.body.classList.toggle('overflow-hidden', open);
        if (open) window.addEventListener('keydown', onKeydown);
        else window.removeEventListener('keydown', onKeydown);
    },
);

onBeforeUnmount(() => {
    document.body.classList.remove('overflow-hidden');
    window.removeEventListener('keydown', onKeydown);
});
</script>

<template>
    <Teleport to="body">
        <div v-if="open" class="fixed inset-0 z-50 grid place-items-center p-4" role="dialog" aria-modal="true" :aria-label="title">
            <button class="absolute inset-0 bg-stone-950/50 backdrop-blur-sm" aria-label="關閉視窗" @click="emit('close')" />
            <section class="surface relative z-10 max-h-[90vh] w-full max-w-2xl overflow-auto p-6">
                <header class="mb-5 flex items-center justify-between gap-4">
                    <h2 class="text-xl font-bold text-stone-900">{{ title }}</h2>
                    <button class="rounded-lg p-2 text-stone-500 hover:bg-stone-100" aria-label="關閉" @click="emit('close')">
                        <X :size="20" />
                    </button>
                </header>
                <slot />
            </section>
        </div>
    </Teleport>
</template>
