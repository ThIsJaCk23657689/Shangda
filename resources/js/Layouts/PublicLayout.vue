<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Menu, ShoppingBag, X } from '@lucide/vue';
import { ref } from 'vue';
import type { SharedPageProps } from '@/types';

const page = usePage<SharedPageProps>();
const open = ref(false);
const links = [
    { label: '首頁', href: '/' },
    { label: '關於上大', href: '/about' },
    { label: '商品', href: '/products' },
    { label: '最新消息', href: '/announcements' },
    { label: '聯絡我們', href: '/contact' },
];
</script>

<template>
    <div class="min-h-screen bg-wheat-50">
        <header class="sticky top-0 z-30 border-b border-brand-900/10 bg-wheat-50/90 backdrop-blur">
            <div class="mx-auto flex h-20 max-w-7xl items-center px-4 sm:px-6 lg:px-8">
                <Link href="/" class="mr-8"><img src="/images/ShangDa_text_logo.png" alt="上大食品" class="h-10 w-auto" /></Link>
                <nav class="hidden items-center gap-1 lg:flex">
                    <Link v-for="link in links" :key="link.href" :href="link.href" class="rounded-lg px-3 py-2 text-sm font-medium text-brand-900 hover:bg-brand-100">{{ link.label }}</Link>
                </nav>
                <div class="ml-auto hidden items-center gap-2 lg:flex">
                    <Link v-if="page.props.auth.consumer" :href="`/consumers/${page.props.auth.consumer.id}/cart`" class="rounded-xl p-2.5 text-brand-900 hover:bg-brand-100" aria-label="購物車"><ShoppingBag :size="20" /></Link>
                    <Link :href="page.props.auth.consumer ? `/consumers/${page.props.auth.consumer.id}/profile` : '/consumers/login'" class="rounded-xl bg-brand-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-900">{{ page.props.auth.consumer ? page.props.auth.consumer.name : '顧客登入' }}</Link>
                </div>
                <button class="ml-auto rounded-lg p-2 text-brand-900 lg:hidden" aria-label="開啟選單" @click="open = !open"><X v-if="open" /><Menu v-else /></button>
            </div>
            <nav v-if="open" class="border-t border-brand-900/10 px-4 py-3 lg:hidden">
                <Link v-for="link in links" :key="link.href" :href="link.href" class="block rounded-lg px-3 py-2.5 font-medium text-brand-900 hover:bg-brand-100" @click="open = false">{{ link.label }}</Link>
            </nav>
        </header>
        <main><slot /></main>
        <footer class="mt-20 bg-brand-950 py-10 text-brand-100">
            <div class="mx-auto max-w-7xl px-4 text-sm sm:px-6 lg:px-8">© {{ new Date().getFullYear() }} 上大食品股份有限公司</div>
        </footer>
    </div>
</template>
