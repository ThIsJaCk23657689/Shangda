<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { AlertTriangle, ArrowDownRight, ArrowUpRight, Boxes, CircleDollarSign, ReceiptText, Users } from '@lucide/vue';
import BackendLayout from '@/Layouts/BackendLayout.vue';
import { formatCurrency, formatNumber, formatPercent } from '@/lib/format';

interface TrendItem { label: string; amount: number }
interface Customer { id: number; name: string; amount: number }
interface LowStockItem { id: number; name: string; stock: number; safe_quantity: number; unit: string; ratio?: number; is_low?: boolean }
interface OverdueItem { consumer_id: number; customer_name: string; overdue_days: number; amount: number }
interface DashboardData {
    generated_at: string;
    year: number;
    settings: { overdue_days: number };
    sales: { current_month: number; year_over_year: number | null; trend: TrendItem[]; top_customers: Customer[] };
    receivables: { balance: number; customer_count: number };
    overdue: { balance: number; customer_count: number; items: OverdueItem[]; remaining_count: number };
    materials: { low_stock_count: number; low_stock_items: LowStockItem[]; remaining_low_stock_count: number; levels: LowStockItem[] };
}

const props = defineProps<{ dashboard: DashboardData }>();
const maxTrend = Math.max(...props.dashboard.sales.trend.map((item) => Number(item.amount)), 1);
</script>

<template>
    <Head title="經營概況" />
    <BackendLayout>
        <div class="mb-7 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="mb-1 text-sm font-semibold text-brand-700">營運中心</p>
                <h1 class="page-title">經營概況</h1>
                <p class="page-description">資料更新時間：{{ dashboard.generated_at }}</p>
            </div>
            <Link href="/backend/reports/sales/analysis" class="rounded-xl border border-stone-300 bg-white px-4 py-2.5 text-sm font-semibold text-stone-700 shadow-sm hover:bg-stone-50">查看銷售分析</Link>
        </div>

        <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="本月關鍵指標">
            <article class="surface p-5">
                <div class="flex items-start justify-between"><span class="text-sm font-medium text-stone-500">本月營收</span><CircleDollarSign class="text-brand-600" :size="22" /></div>
                <div class="mt-3 text-2xl font-bold tabular-nums">{{ formatCurrency(dashboard.sales.current_month) }}</div>
                <div v-if="dashboard.sales.year_over_year !== null" class="mt-2 flex items-center gap-1 text-sm" :class="dashboard.sales.year_over_year >= 0 ? 'text-red-700' : 'text-emerald-700'">
                    <ArrowUpRight v-if="dashboard.sales.year_over_year >= 0" :size="16" /><ArrowDownRight v-else :size="16" />年{{ dashboard.sales.year_over_year >= 0 ? '增' : '減' }} {{ formatPercent(dashboard.sales.year_over_year) }}
                </div>
                <div v-else class="mt-2 text-sm text-stone-400">去年同期無資料</div>
            </article>
            <Link href="/backend/reports/account/receivable" class="surface p-5 transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="flex items-start justify-between"><span class="text-sm font-medium text-stone-500">應收帳款</span><ReceiptText class="text-sky-700" :size="22" /></div>
                <div class="mt-3 text-2xl font-bold tabular-nums">{{ formatCurrency(dashboard.receivables.balance) }}</div>
                <div class="mt-2 text-sm text-stone-500">{{ dashboard.receivables.customer_count }} 位未結清客戶</div>
            </Link>
            <article class="surface border-red-200 p-5">
                <div class="flex items-start justify-between"><span class="text-sm font-medium text-red-700">逾期應收</span><AlertTriangle class="text-red-700" :size="22" /></div>
                <div class="mt-3 text-2xl font-bold tabular-nums text-red-800">{{ formatCurrency(dashboard.overdue.balance) }}</div>
                <div class="mt-2 text-sm text-red-700">{{ dashboard.overdue.customer_count }} 位超過 {{ dashboard.settings.overdue_days }} 天</div>
            </article>
            <Link href="/backend/materials" class="surface p-5 transition hover:-translate-y-0.5 hover:shadow-md">
                <div class="flex items-start justify-between"><span class="text-sm font-medium text-stone-500">原物料低庫存</span><Boxes class="text-wheat-600" :size="22" /></div>
                <div class="mt-3 text-2xl font-bold tabular-nums">{{ dashboard.materials.low_stock_count }} 項</div>
                <div class="mt-2 text-sm text-stone-500">需安排採購或調整安全量</div>
            </Link>
        </section>

        <section class="mt-6 grid gap-6 xl:grid-cols-[1.5fr_1fr]">
            <article class="surface p-5 sm:p-6">
                <div class="mb-6"><h2 class="font-bold text-stone-900">近 12 個月營收趨勢</h2><p class="mt-1 text-sm text-stone-500">未稅淨銷售額，退貨已扣除</p></div>
                <div class="flex h-64 items-end gap-2 border-b border-stone-200 px-1" aria-label="營收長條圖">
                    <div v-for="item in dashboard.sales.trend" :key="item.label" class="group flex h-full min-w-0 flex-1 flex-col justify-end">
                        <div class="relative min-h-1 rounded-t-md bg-brand-600 transition group-hover:bg-brand-700" :style="{ height: `${Math.max(2, Number(item.amount) / maxTrend * 100)}%` }"><span class="pointer-events-none absolute -top-8 left-1/2 hidden -translate-x-1/2 whitespace-nowrap rounded bg-stone-900 px-2 py-1 text-xs text-white group-hover:block">{{ formatCurrency(item.amount) }}</span></div>
                        <div class="mt-2 truncate text-center text-[10px] text-stone-500 sm:text-xs">{{ item.label }}</div>
                    </div>
                </div>
            </article>

            <article class="surface overflow-hidden">
                <div class="border-b border-stone-200 px-5 py-4"><h2 class="font-bold">待辦與警示</h2></div>
                <div class="divide-y divide-stone-100">
                    <Link v-for="item in dashboard.overdue.items" :key="item.consumer_id" :href="`/backend/reports/sales/analysis?tab=drilldown&dimension=customer&entity_id=${item.consumer_id}`" class="flex items-center gap-3 px-5 py-3 hover:bg-stone-50">
                        <span class="grid size-9 place-items-center rounded-full bg-red-50 text-red-700"><AlertTriangle :size="17" /></span>
                        <span class="min-w-0 flex-1"><strong class="block truncate text-sm">{{ item.customer_name }}</strong><small class="text-red-700">逾期 {{ item.overdue_days }} 天</small></span>
                        <strong class="text-sm tabular-nums text-red-800">{{ formatCurrency(item.amount) }}</strong>
                    </Link>
                    <Link v-for="item in dashboard.materials.low_stock_items" :key="item.id" :href="`/backend/materials/${item.id}`" class="flex items-center gap-3 px-5 py-3 hover:bg-stone-50">
                        <span class="grid size-9 place-items-center rounded-full bg-wheat-100 text-wheat-600"><Boxes :size="17" /></span>
                        <span class="min-w-0 flex-1"><strong class="block truncate text-sm">{{ item.name }}</strong><small class="text-stone-500">安全量 {{ formatNumber(item.safe_quantity) }} {{ item.unit }}</small></span>
                        <strong class="text-sm tabular-nums text-red-800">{{ formatNumber(item.stock) }} {{ item.unit }}</strong>
                    </Link>
                    <div v-if="dashboard.overdue.items.length === 0 && dashboard.materials.low_stock_items.length === 0" class="px-5 py-10 text-center text-sm text-stone-500">目前沒有需要處理的警示</div>
                </div>
            </article>
        </section>

        <section class="mt-6 grid gap-6 xl:grid-cols-2">
            <article class="surface overflow-hidden">
                <div class="flex items-center gap-2 border-b border-stone-200 px-5 py-4"><Users class="text-brand-600" :size="19" /><h2 class="font-bold">本月 Top 5 顧客</h2></div>
                <div class="divide-y divide-stone-100">
                    <div v-for="(customer, index) in dashboard.sales.top_customers" :key="customer.id" class="flex items-center gap-3 px-5 py-3.5"><span class="grid size-7 place-items-center rounded-full text-xs font-bold" :class="index === 0 ? 'bg-wheat-300 text-brand-950' : 'bg-stone-100 text-stone-600'">{{ index + 1 }}</span><span class="min-w-0 flex-1 truncate text-sm font-medium">{{ customer.name }}</span><strong class="text-sm tabular-nums">{{ formatCurrency(customer.amount) }}</strong></div>
                    <div v-if="dashboard.sales.top_customers.length === 0" class="px-5 py-8 text-center text-sm text-stone-500">本月尚無銷售資料</div>
                </div>
            </article>
            <article class="surface overflow-hidden">
                <div class="border-b border-stone-200 px-5 py-4"><h2 class="font-bold">原物料庫存水位</h2></div>
                <div class="max-h-96 divide-y divide-stone-100 overflow-y-auto">
                    <Link v-for="item in dashboard.materials.levels" :key="item.id" :href="`/backend/materials/${item.id}`" class="block px-5 py-3.5 hover:bg-stone-50"><div class="mb-2 flex justify-between gap-4 text-sm"><strong class="truncate" :class="item.is_low ? 'text-red-800' : ''">{{ item.name }}</strong><span class="whitespace-nowrap tabular-nums text-stone-500">{{ formatNumber(item.stock) }} / {{ formatNumber(item.safe_quantity) }} {{ item.unit }}</span></div><div class="h-2 overflow-hidden rounded-full bg-stone-100"><div class="h-full rounded-full" :class="item.is_low ? 'bg-red-600' : 'bg-brand-600'" :style="{ width: `${Math.min(100, Math.max(1, Number(item.ratio ?? 0) * 100))}%` }" /></div></Link>
                </div>
            </article>
        </section>
    </BackendLayout>
</template>
