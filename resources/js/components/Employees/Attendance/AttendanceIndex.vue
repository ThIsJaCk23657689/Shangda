<template>
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <a href="/backend/employees" class="btn btn-sm btn-secondary mr-2">返回員工列表</a>
                <strong v-if="employee">{{ employee.name }} 的出勤記錄</strong>
                <strong v-else>出勤記錄</strong>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <button type="button" class="btn btn-sm btn-outline-secondary mr-2" @click="shiftMonth(-1)">&lt;</button>
                    <strong>{{ monthTitle }}</strong>
                    <button type="button" class="btn btn-sm btn-outline-secondary ml-2" @click="shiftMonth(1)">&gt;</button>
                </div>
                <button type="button" class="btn btn-sm btn-primary" @click="openCreate">+ 新增出勤記錄</button>
            </div>
            <div class="card-body">
                <div v-if="loading" class="text-center py-4">資料讀取中...</div>
                <div v-else class="table-responsive">
                    <table class="table table-bordered table-hover mb-3">
                        <thead>
                            <tr>
                                <th>日期</th>
                                <th>類型</th>
                                <th>開始</th>
                                <th>結束</th>
                                <th>時數</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="log in logs" :key="log.id">
                                <td>{{ dateLabel(log.log_date) }}</td>
                                <td>{{ typeLabel(log.type) }}</td>
                                <td>{{ log.start_time }}</td>
                                <td>{{ log.end_time }}</td>
                                <td>{{ hourLabel(log.hours) }}</td>
                                <td>
                                    <div v-if="confirmDeleteId === log.id">
                                        <span class="mr-2 text-danger">確定刪除？</span>
                                        <button type="button" class="btn btn-sm btn-danger mr-1" @click="destroy(log)">確定</button>
                                        <button type="button" class="btn btn-sm btn-secondary" @click="confirmDeleteId = null">取消</button>
                                    </div>
                                    <div v-else>
                                        <button type="button" class="btn btn-sm btn-success mr-1" @click="openEdit(log)">編輯</button>
                                        <button type="button" class="btn btn-sm btn-danger" @click="confirmDeleteId = log.id">刪除</button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="logs.length === 0">
                                <td colspan="8" class="text-center">本月尚無資料</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="border rounded p-3 bg-light">
                        <div class="mb-2">
                            基本月薪：${{ moneyLabel(baseSalary) }}
                            <span class="mx-2">|</span>
                            時薪基準：${{ hourlyRateLabel }}
                        </div>
                        <hr class="my-2">
                        <div class="mb-2">
                            當月加班：{{ hourLabel(overtimeTotalHours) }}
                        </div>
                        <div class="pl-3">
                            <div>├ 1.34 倍率：{{ hourLabel(summary.overtime_hours_134) }}</div>
                            <div>└ 1.67 倍率：{{ hourLabel(summary.overtime_hours_167) }}</div>
                            <div class="mt-1">加班費合計：+${{ moneyLabel(summary.overtime_pay) }}</div>
                        </div>
                        <hr class="my-2">
                        <div class="mb-0">
                            當月請假：{{ hourLabel(summary.leave_hours) }}
                            <span class="ml-2">請假扣薪：-${{ moneyLabel(summary.leave_deduction) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <attendance-form-modal
            :visible="modalVisible"
            :mode="modalMode"
            :value="editingLog"
            :submitting="submitting"
            @close="closeModal"
            @submit="submitForm"
        />
    </div>
</template>

<script>
import AttendanceFormModal from './AttendanceFormModal.vue';
export default {
    name: 'AttendanceIndexPage',
    components: { AttendanceFormModal },
    props: {
        employeeId: { type: Number, required: true },
    },
    data() {
        const now = new Date();
        return {
            employee: null,
            logs: [],
            summary: {
                leave_hours: 0,
                overtime_hours_134: 0,
                overtime_hours_167: 0,
                overtime_pay: 0,
                leave_deduction: 0,
            },
            currentYear: now.getFullYear(),
            currentMonth: now.getMonth() + 1,
            loading: false,
            modalVisible: false,
            modalMode: 'create',
            editingLog: null,
            submitting: false,
            confirmDeleteId: null,
        };
    },
    computed: {
        monthTitle() {
            return `${this.currentYear}年 ${this.currentMonth}月`;
        },
        baseSalary() {
            return Number((this.employee || {}).base_salary || 0);
        },
        hourlyRate() {
            return this.baseSalary / 240;
        },
        hourlyRateLabel() {
            return this.hourlyRate.toLocaleString('en-US', {
                minimumFractionDigits: 4,
                maximumFractionDigits: 4,
            });
        },
        overtimeTotalHours() {
            return Number(this.summary.overtime_hours_134 || 0) + Number(this.summary.overtime_hours_167 || 0);
        },
        overtimeDailyMap() {
            const totals = this.logs.reduce((map, log) => {
                if (Number(log.type) !== 1) return map;
                const date = log.log_date;
                map[date] = Number(map[date] || 0) + Number(log.hours || 0);
                return map;
            }, {});

            return Object.keys(totals).reduce((map, date) => {
                const total = Number(totals[date] || 0);
                if (total <= 2) {
                    map[date] = { h134: total, h167: 0 };
                } else {
                    map[date] = { h134: 2.0, h167: Number((total - 2).toFixed(1)) };
                }
                return map;
            }, {});
        },
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.loading = true;
            this.confirmDeleteId = null;

            axios
                .get(`/backend/employees/${this.employeeId}/attendance`, {
                    params: {
                        year: this.currentYear,
                        month: this.currentMonth,
                    },
                })
                .then((response) => {
                    this.applyResponseData(response.data.data);
                })
                .catch(() => {
                    if (window.$ && $.showErrorModalWithoutError) {
                        $.showErrorModalWithoutError('取得出勤資料失敗');
                    }
                    this.logs = [];
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        applyResponseData(data) {
            this.employee = data.employee || null;
            this.logs = Array.isArray(data.logs) ? data.logs : [];
            this.summary = data.summary || this.summary;
            this.currentYear = Number(data.year || this.currentYear);
            this.currentMonth = Number(data.month || this.currentMonth);
        },
        shiftMonth(delta) {
            const date = new Date(this.currentYear, this.currentMonth - 1, 1);
            date.setMonth(date.getMonth() + delta);
            this.currentYear = date.getFullYear();
            this.currentMonth = date.getMonth() + 1;
            this.fetchData();
        },
        openCreate() {
            this.modalMode = 'create';
            this.editingLog = {
                log_date: this.defaultLogDate(),
                type: 1,
                start_time: '',
                end_time: '',
                note: '',
            };
            this.modalVisible = true;
        },
        openEdit(log) {
            this.modalMode = 'edit';
            this.editingLog = Object.assign({}, log);
            this.modalVisible = true;
            this.confirmDeleteId = null;
        },
        closeModal() {
            this.modalVisible = false;
            this.editingLog = null;
        },
        submitForm(payload) {
            this.submitting = true;
            const request = this.modalMode === 'edit'
                ? axios.put(`/backend/employees/${this.employeeId}/attendance/${this.editingLog.id}`, payload)
                : axios.post(`/backend/employees/${this.employeeId}/attendance`, payload);

            request
                .then((response) => {
                    this.applyResponseData(response.data.data);
                    this.closeModal();

                    if (window.$ && $.showSuccessModal) {
                        $.showSuccessModal(this.modalMode === 'edit' ? '出勤記錄已更新' : '出勤記錄已新增');
                    }
                })
                .catch((error) => {
                    const message = (((error || {}).response || {}).data || {}).message || '送出失敗';
                    if (window.$ && $.showErrorModalWithoutError) {
                        $.showErrorModalWithoutError(message);
                    }
                })
                .finally(() => {
                    this.submitting = false;
                });
        },
        destroy(log) {
            axios
                .delete(`/backend/employees/${this.employeeId}/attendance/${log.id}`, {
                    params: {
                        year: this.currentYear,
                        month: this.currentMonth,
                    },
                })
                .then((response) => {
                    this.applyResponseData(response.data.data);
                    this.confirmDeleteId = null;

                    if (window.$ && $.showSuccessModal) {
                        $.showSuccessModal('出勤記錄已刪除');
                    }
                })
                .catch(() => {
                    if (window.$ && $.showErrorModalWithoutError) {
                        $.showErrorModalWithoutError('刪除失敗');
                    }
                });
        },
        defaultLogDate() {
            const month = String(this.currentMonth).padStart(2, '0');
            return `${this.currentYear}-${month}-01`;
        },
        typeLabel(type) {
            return Number(type) === 1 ? '加班' : '請假';
        },
        dateLabel(date) {
            if (!date) return '';
            const value = String(date);
            return `${value.slice(5, 7)}/${value.slice(8, 10)}`;
        },
        hourLabel(hours) {
            return `${Number(hours || 0).toFixed(1)}h`;
        },
        moneyLabel(amount) {
            return Number(amount || 0).toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2,
            });
        },
    },
};
</script>
