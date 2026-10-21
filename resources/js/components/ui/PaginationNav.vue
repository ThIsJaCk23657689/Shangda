<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import type { PaginationLink } from '@/types';

defineProps<{ links: PaginationLink[] }>();
</script>

<template>
    <nav v-if="links.length > 3" class="flex flex-wrap justify-center gap-1" aria-label="分頁">
        <template v-for="link in links" :key="link.label">
            <Link
                v-if="link.url"
                :href="link.url"
                preserve-scroll
                class="grid min-h-10 min-w-10 place-items-center rounded-lg px-3 text-sm"
                :class="link.active ? 'bg-brand-700 font-semibold text-white' : 'border border-stone-200 bg-white text-stone-600 hover:bg-stone-50'"
                v-html="link.label"
            />
            <span v-else class="grid min-h-10 min-w-10 place-items-center rounded-lg px-3 text-sm text-stone-400" v-html="link.label" />
        </template>
    </nav>
</template>
