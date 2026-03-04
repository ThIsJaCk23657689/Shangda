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
                                <th style="width: 52px;" class="text-center">
                                    <input
                                        type="checkbox"
                                        :checked="isAllSelectableChecked"
                                        :disabled="selectableRecordIds.length === 0"
                                        @change="toggleSelectAll($event.target.checked)"
                                    >
                                </th>
                                <th>員工</th>
                                <th>基本月薪</th>
                                <th>實領薪資</th>
                                <th>狀態</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in employees" :key="item.id">
                                <td class="text-center align-middle">
                                    <input
                                        type="checkbox"
                                        :checked="isSelected(item.salary_record)"
                                        :disabled="!canSelectForPrint(item.salary_record)"
                                        :title="canSelectForPrint(item.salary_record) ? '' : '僅已確認的薪資單可列印'"
                                        @change="toggleSelectRecord(item.salary_record, $event.target.checked)"
                                    >
                                </td>
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
                                <td colspan="6" class="text-center">本月份無在職員工資料</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card mt-3">
                    <div class="card-header">列印設定</div>
                    <div class="card-body">
                        <div class="mb-2">已選取 {{ selectedIds.length }} 位員工</div>
                        <div class="form-check mb-2">
                            <input id="batch-print-show-bank" v-model="printShowBank" type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="batch-print-show-bank">列印銀行帳號資訊</label>
                        </div>
                        <div class="form-check mb-3">
                            <input id="batch-print-show-hours" v-model="printShowHours" type="checkbox" class="form-check-input">
                            <label class="form-check-label" for="batch-print-show-hours">列出請假與加班時數</label>
                        </div>
                        <button type="button" class="btn btn-outline-primary" :disabled="selectedIds.length === 0" @click="openBatchPrintPreview">
                            🖨️ 預覽列印
                        </button>
                    </div>
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
            selectedIds: [],
            printShowBank: true,
            printShowHours: false,
            loading: false,
        };
    },
    computed: {
        monthTitle() {
            return `${this.year}年 ${this.month}月`;
        },
        selectableRecordIds() {
            return this.employees
                .map((item) => item.salary_record)
                .filter((record) => this.canSelectForPrint(record))
                .map((record) => Number(record.id));
        },
        isAllSelectableChecked() {
            if (this.selectableRecordIds.length === 0) return false;
            return this.selectableRecordIds.every((id) => this.selectedIds.includes(id));
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
                    this.selectedIds = [];
                    this.syncUrl();
                })
                .catch((error) => {
                    this.employees = [];
                    this.selectedIds = [];
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
            this.selectedIds = [];
            this.fetchData();
        },
        canSelectForPrint(record) {
            return !!(record && Number(record.status) === 1);
        },
        isSelected(record) {
            if (!record) return false;
            return this.selectedIds.includes(Number(record.id));
        },
        toggleSelectRecord(record, checked) {
            if (!this.canSelectForPrint(record)) return;
            const id = Number(record.id);
            if (checked) {
                if (!this.selectedIds.includes(id)) {
                    this.selectedIds.push(id);
                }
                return;
            }
            this.selectedIds = this.selectedIds.filter((item) => item !== id);
        },
        toggleSelectAll(checked) {
            if (!checked) {
                this.selectedIds = [];
                return;
            }
            this.selectedIds = [...this.selectableRecordIds];
        },
        openBatchPrintPreview() {
            if (this.selectedIds.length === 0) return;
            const ids = this.selectedIds.join(',');
            const url = `/backend/salary/print`
                + `?ids=${ids}`
                + `&show_bank=${this.printShowBank ? 1 : 0}`
                + `&show_hours=${this.printShowHours ? 1 : 0}`;
            window.open(url, '_blank');
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
            return `$${Math.round(Number(value || 0)).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`;
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
