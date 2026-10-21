<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
import { Boxes, ChevronLeft, ClipboardList, Factory, LayoutDashboard, LogOut, Menu, Package, ShoppingCart, Users, X } from '@lucide/vue';
import { computed, ref } from 'vue';
import type { SharedPageProps } from '@/types';

const page = usePage<SharedPageProps>();
const open = ref(false);

const staff = computed(() => page.props.auth.staff);
const nav = [
    { label: '經營概況', href: '/backend', icon: LayoutDashboard },
    { label: '顧客管理', href: '/backend/consumers', icon: Users },
    { label: '商品管理', href: '/backend/products', icon: Package },
    { label: '原物料', href: '/backend/materials', icon: Boxes },
    { label: '製作庫存', href: '/backend/produces', icon: Factory },
    { label: '進貨單', href: '/backend/orders/purchase', icon: ClipboardList },
    { label: '銷貨單', href: '/backend/orders/sales', icon: ShoppingCart },
];

const active = (href: string) => href === '/backend' ? page.url === href : page.url.startsWith(href);
const logout = () => router.post('/logout');
</script>

<template>
    <div class="min-h-screen bg-stone-100 lg:grid lg:grid-cols-[17rem_1fr]">
        <div v-if="open" class="fixed inset-0 z-30 bg-stone-950/50 lg:hidden" @click="open = false" />
        <aside class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col bg-brand-900 text-white transition-transform lg:sticky lg:top-0 lg:h-screen lg:w-auto" :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
            <div class="flex h-20 items-center justify-between border-b border-white/10 px-5">
                <Link href="/backend" class="flex items-center gap-3" @click="open = false">
                    <img src="/images/ShangDa_text_logo.png" alt="上大食品" class="h-9 max-w-36 object-contain brightness-0 invert" />
                </Link>
                <button class="rounded-lg p-2 hover:bg-white/10 lg:hidden" aria-label="關閉選單" @click="open = false"><X :size="20" /></button>
            </div>
            <nav class="flex-1 space-y-1 overflow-y-auto p-3">
                <Link v-for="item in nav" :key="item.href" :href="item.href" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition" :class="active(item.href) ? 'bg-wheat-300 text-brand-950 shadow-sm' : 'text-brand-100 hover:bg-white/10 hover:text-white'" @click="open = false">
                    <component :is="item.icon" :size="19" />
                    {{ item.label }}
                </Link>
            </nav>
            <div class="border-t border-white/10 p-4">
                <div class="mb-3 min-w-0">
                    <div class="truncate text-sm font-semibold">{{ staff?.name }}</div>
                    <div class="truncate text-xs text-brand-200">{{ staff?.jobTitle ?? '內部人員' }}</div>
                </div>
                <button class="flex w-full items-center gap-2 rounded-lg px-2 py-2 text-sm text-brand-100 hover:bg-white/10 hover:text-white" @click="logout">
                    <LogOut :size="17" /> 登出
                </button>
            </div>
        </aside>

        <div class="min-w-0">
            <header class="sticky top-0 z-20 flex h-16 items-center border-b border-stone-200 bg-white/90 px-4 backdrop-blur lg:px-8">
                <button class="rounded-lg p-2 text-stone-600 hover:bg-stone-100 lg:hidden" aria-label="開啟選單" @click="open = true"><Menu :size="22" /></button>
                <div class="ml-auto text-sm text-stone-500">上大食品管理系統</div>
            </header>
            <main class="mx-auto w-full max-w-[100rem] p-4 sm:p-6 lg:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>
