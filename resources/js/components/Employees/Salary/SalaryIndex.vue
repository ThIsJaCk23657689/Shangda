<template>
    <div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">薪資管理</h5>
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary" @click="shiftMonth(-1)">&lt;</button>
                    <strong class="mx-3">{{ monthTitle }}</strong>
                    <button type="button" class="btn btn-sm btn-outline-secondary" @click="shiftMonth(1)">&gt;</button>
                </div>
            </div>
            <div class="card-body">
                <div v-if="loading" class="text-center py-4">資料讀取中...</div>
                <div v-else class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>員工</th>
                                <th>基本月薪</th>
                                <th>實領薪資</th>
                                <th>狀態</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in employees" :key="item.id">
                                <td>{{ item.name }}</td>
                                <td>{{ moneyLabel(item.base_salary) }}</td>
                                <td>{{ netSalaryLabel(item.salary_record) }}</td>
                                <td>
                                    <span class="badge" :class="statusClass(item.salary_record)">
                                        {{ statusLabel(item.salary_record) }}
                                    </span>
                                </td>
                                <td>
                                    <a :href="editUrl(item.id)" class="btn btn-sm btn-primary">
                                        {{ actionLabel(item.salary_record) }}
                                    </a>
                                </td>
                            </tr>
                            <tr v-if="employees.length === 0">
                                <td colspan="5" class="text-center">本月份無在職員工資料</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SalaryIndexPage',
    data() {
        const now = new Date();
        return {
            year: now.getFullYear(),
            month: now.getMonth() + 1,
            employees: [],
            loading: false,
        };
    },
    computed: {
        monthTitle() {
            return `${this.year}年 ${this.month}月`;
        },
    },
    created() {
        this.applyQueryMonth();
        this.fetchData();
    },
    methods: {
        applyQueryMonth() {
            const search = new URLSearchParams(window.location.search);
            const year = Number(search.get('year'));
            const month = Number(search.get('month'));
            if (year >= 2000 && year <= 2100) {
                this.year = year;
            }
            if (month >= 1 && month <= 12) {
                this.month = month;
            }
        },
        syncUrl() {
            const url = new URL(window.location.href);
            url.searchParams.set('year', this.year);
            url.searchParams.set('month', this.month);
            window.history.replaceState({}, '', `${url.pathname}?${url.searchParams.toString()}`);
        },
        fetchData() {
            this.loading = true;

            axios
                .get('/backend/salary', {
                    params: {
                        year: this.year,
                        month: this.month,
                    },
                })
                .then((response) => {
                    const payload = response.data.data || {};
                    this.year = Number(payload.year || this.year);
                    this.month = Number(payload.month || this.month);
                    this.employees = Array.isArray(payload.employees) ? payload.employees : [];
                    this.syncUrl();
                })
                .catch((error) => {
                    this.employees = [];
                    this.showError(this.extractErrorMessage(error, '取得薪資列表失敗'));
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        shiftMonth(delta) {
            const date = new Date(this.year, this.month - 1, 1);
            date.setMonth(date.getMonth() + delta);
            this.year = date.getFullYear();
            this.month = date.getMonth() + 1;
            this.fetchData();
        },
        editUrl(employeeId) {
            return `/backend/salary/${employeeId}/edit?year=${this.year}&month=${this.month}`;
        },
        statusLabel(record) {
            if (!record) return '未建立';
            return Number(record.status) === 1 ? '已確認' : '草稿';
        },
        statusClass(record) {
            if (!record) return 'badge-secondary';
            return Number(record.status) === 1 ? 'badge-success' : 'badge-warning';
        },
        actionLabel(record) {
            if (!record) return '建立薪資單';
            return Number(record.status) === 1 ? '查看' : '編輯';
        },
        netSalaryLabel(record) {
            if (!record) return '-';
            return this.moneyLabel(record.net_salary);
        },
        moneyLabel(value) {
            return `$${Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        },
        extractErrorMessage(error, fallback) {
            return (((error || {}).response || {}).data || {}).message || fallback;
        },
        showError(message) {
            if (window.$ && $.showErrorModalWithoutError) {
                $.showErrorModalWithoutError(message);
                return;
            }
            window.alert(message);
        },
    },
};
</script>
