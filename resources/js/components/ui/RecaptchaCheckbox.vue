<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref } from 'vue';

declare global {
    interface Window {
        grecaptcha?: {
            render: (element: HTMLElement, options: Record<string, unknown>) => number;
            reset: (widgetId?: number) => void;
        };
    }
}

const props = defineProps<{ siteKey: string }>();
const emit = defineEmits<{ verified: [token: string]; expired: [] }>();
const container = ref<HTMLElement | null>(null);
let widgetId: number | undefined;

function render(): void {
    if (! container.value || ! window.grecaptcha || widgetId !== undefined) return;
    widgetId = window.grecaptcha.render(container.value, {
        sitekey: props.siteKey,
        callback: (token: string) => emit('verified', token),
        'expired-callback': () => emit('expired'),
        'error-callback': () => emit('expired'),
    });
}

onMounted(() => {
    if (window.grecaptcha) {
        render();
        return;
    }

    const existing = document.querySelector<HTMLScriptElement>('script[data-shangda-recaptcha]');
    if (existing) {
        existing.addEventListener('load', render, { once: true });
        return;
    }

    const script = document.createElement('script');
    script.src = 'https://www.google.com/recaptcha/api.js?render=explicit';
    script.async = true;
    script.defer = true;
    script.dataset.shangdaRecaptcha = 'true';
    script.addEventListener('load', render, { once: true });
    document.head.appendChild(script);
});

onBeforeUnmount(() => {
    if (widgetId !== undefined) window.grecaptcha?.reset(widgetId);
});
</script>

<template>
    <div ref="container" aria-label="reCAPTCHA 驗證"></div>
</template>
