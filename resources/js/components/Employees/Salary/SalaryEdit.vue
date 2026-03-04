<template>
    <div>
        <div v-if="loading" class="text-center py-5">資料讀取中...</div>
        <div v-else>
            <div class="mb-3">
                <h4 class="mb-0">{{ year }} 年 {{ month }} 月 薪資單</h4>
            </div>

            <div v-if="isConfirmed" class="alert alert-warning d-flex justify-content-between align-items-center">
                <div>
                    ⚠ 此薪資單已確認發薪（{{ confirmedAtLabel }}）
                </div>
                <button type="button" class="btn btn-sm btn-danger" @click="openUnconfirmModal">解除確認</button>
            </div>

            <div class="card mb-3">
                <div class="card-header">員工資訊</div>
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-between mb-3">
                        <div class="mb-2">
                            員工姓名：
                            <a :href="`/backend/employees/${employeeId}`" target="_blank" rel="noopener noreferrer">
                                <strong>{{ employee.name || '-' }}</strong>
                            </a>
                        </div>
                        <div class="mb-2">到職日：<strong>{{ dateLabel(employee.hired_date, '/') }}</strong></div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>基本月薪</label>
                            <input
                                v-model.number="baseSalaryInput"
                                type="number"
                                min="0"
                                step="1"
                                class="form-control"
                                :disabled="isConfirmed || loadingAction"
                                @input="normalizeBaseSalaryInput"
                                @blur="handleBaseSalaryBlur"
                            >
                            <div class="mt-2 d-flex flex-wrap align-items-center">
                                <span :class="{ 'text-warning font-weight-bold': salaryDiffWithEmployee }">
                                    員工目前薪資：{{ moneyIntLabel(employeeBaseSalary) }}
                                </span>
                                <button
                                    v-if="!isConfirmed && salaryRecord"
                                    type="button"
                                    class="btn btn-sm btn-outline-secondary ml-3"
                                    :disabled="loadingAction"
                                    @click="restoreEmployeeSalary"
                                >
                                    恢復為員工薪資
                                </button>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>時薪基準</label>
                            <input :value="hourlyRateDisplay" type="text" class="form-control" disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>健保眷屬數</label>
                            <select
                                v-model.number="healthInsuranceDependentsInput"
                                class="form-control"
                                :disabled="isConfirmed || loadingAction"
                                @change="handleDependentsChange"
                            >
                                <option :value="0">本人</option>
                                <option :value="1">本人+1</option>
                                <option :value="2">本人+2</option>
                                <option :value="3">本人+3</option>
                            </select>
                            <div class="mt-2 d-flex flex-wrap align-items-center">
                                <span :class="{ 'text-warning font-weight-bold': dependentsDiffWithEmployee }">
                                    員工目前設定：{{ dependentsLabel(employeeDependentsValue) }}
                                </span>
                                <button
                                    v-if="!isConfirmed && salaryRecord"
                                    type="button"
                                    class="btn btn-sm btn-outline-secondary ml-3"
                                    :disabled="loadingAction"
                                    @click="restoreEmployeeDependents"
                                >
                                    恢復為員工設定
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>出勤彙總</span>
                    <a :href="`/backend/employees/${employeeId}/attendance`">查看出勤明細</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="border rounded p-3 h-100">
                                <div class="d-flex justify-content-between">
                                    <span>請假</span>
                                    <strong>{{ hoursLabel(leaveHoursValue) }}</strong>
                                </div>
                                <div class="text-danger mt-2">請假扣薪：-{{ moneyLabel(leaveDeductionValue) }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3 h-100">
                                <div class="d-flex justify-content-between">
                                    <span>加班</span>
                                    <strong>{{ hoursLabel(totalOvertimeHours) }}</strong>
                                </div>
                                <div class="mt-2">1.34倍：{{ hoursLabel(overtime134Value) }} / 1.67倍：{{ hoursLabel(overtime167Value) }}</div>
                                <div class="text-success mt-2">加班費：+{{ moneyLabel(overtimePayValue) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded mt-3">
                        <div class="d-flex justify-content-between px-3 py-2 border-bottom">
                            <span>經常性薪資</span>
                            <span>{{ moneyIntLabel(regularWageValue) }}（自動計算，唯讀）</span>
                        </div>
                        <div class="d-flex justify-content-between px-3 py-2 border-bottom">
                            <span>勞保自付額</span>
                            <span>- {{ moneyIntLabel(laborInsuranceAmountValue) }}</span>
                        </div>
                        <div class="d-flex justify-content-between px-3 py-2">
                            <span>健保自付額</span>
                            <span>{{ healthInsuranceDisplay }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>加項</span>
                            <button
                                v-if="!isConfirmed"
                                type="button"
                                class="btn btn-sm btn-primary"
                                :disabled="!salaryRecord || loadingAction"
                                @click="openAdditionCreate"
                            >
                                ＋ 新增加項
                            </button>
                        </div>
                        <div class="card-body">
                            <div v-if="!salaryRecord" class="text-muted">請先儲存草稿後再新增加減項</div>
                            <template v-else>
                                <div v-if="regularWageAdditionsCount > 0" class="alert alert-warning py-2 mb-2">
                                    以下標示「影響勞健保」的加項會納入經常性薪資計算
                                </div>
                                <div v-for="item in additions" :key="`addition-${item.id}`" class="d-flex justify-content-between align-items-center border-bottom py-2">
                                    <div>
                                        <div>
                                            {{ additionItemLabel(item) }}
                                            <span v-if="isRegularWageItem(item)" class="badge badge-warning ml-1">影響勞健保</span>
                                        </div>
                                        <small class="text-muted">{{ item.type }}</small>
                                    </div>
                                    <div class="text-right">
                                        <div>{{ moneyLabel(item.amount) }}</div>
                                        <div v-if="!isConfirmed">
                                            <button type="button" class="btn btn-sm btn-outline-success mr-1" :disabled="loadingAction" @click="openAdditionEdit(item)">編輯</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" :disabled="loadingAction" @click="destroyAddition(item)">刪除</button>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="additions.length === 0" class="text-muted">尚無加項</div>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>減項</span>
                            <button
                                v-if="!isConfirmed"
                                type="button"
                                class="btn btn-sm btn-primary"
                                :disabled="!salaryRecord || loadingAction"
                                @click="openDeductionCreate"
                            >
                                ＋ 新增減項
                            </button>
                        </div>
                        <div class="card-body">
                            <div v-if="!salaryRecord" class="text-muted">請先儲存草稿後再新增加減項</div>
                            <template v-else>
                                <div v-if="regularWageDeductionsCount > 0" class="alert alert-warning py-2 mb-2">
                                    以下標示「影響勞健保」的減項會納入經常性薪資計算
                                </div>
                                <div v-for="item in deductions" :key="`deduction-${item.id}`" class="d-flex justify-content-between align-items-center border-bottom py-2">
                                    <div>
                                        <div>
                                            {{ item.name }}
                                            <span v-if="isRegularWageItem(item)" class="badge badge-warning ml-1">影響勞健保</span>
                                        </div>
                                        <small class="text-muted">{{ item.type }}</small>
                                    </div>
                                    <div class="text-right">
                                        <div>{{ moneyLabel(item.amount) }}</div>
                                        <div v-if="!isConfirmed">
                                            <button type="button" class="btn btn-sm btn-outline-success mr-1" :disabled="loadingAction" @click="openDeductionEdit(item)">編輯</button>
                                            <button type="button" class="btn btn-sm btn-outline-danger" :disabled="loadingAction" @click="destroyDeduction(item)">刪除</button>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="deductions.length === 0" class="text-muted">尚無減項</div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">計算結果</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between py-1">
                        <span>基本月薪</span>
                        <strong>{{ moneyIntLabel(baseSalaryValue) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>請假扣薪</span>
                        <span>- {{ moneyIntLabel(leaveDeductionValue) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>加班費</span>
                        <span>+ {{ moneyIntLabel(overtimePayValue) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>加項合計</span>
                        <span>+ {{ moneyIntLabel(additionTotalValue) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>減項合計</span>
                        <span>- {{ moneyIntLabel(deductionTotalValue) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>勞保自付額</span>
                        <span>- {{ moneyIntLabel(laborInsuranceAmountValue) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-1">
                        <span>健保自付額</span>
                        <span>- {{ moneyIntLabel(healthInsuranceAmountValue) }}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between py-1">
                        <span>實領薪資（精確）</span>
                        <span>{{ moneyLabel(netSalaryValue) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-1 font-weight-bold h5 mb-0">
                        <span>實領薪資（核發）</span>
                        <span>{{ moneyIntLabel(issuedSalaryValue) }}</span>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <label for="salary-note">備註</label>
                    <textarea
                        id="salary-note"
                        v-model.trim="noteInput"
                        class="form-control"
                        rows="3"
                        maxlength="500"
                        :disabled="isConfirmed || loadingAction"
                    ></textarea>
                </div>
            </div>

            <div class="d-flex">
                <button type="button" class="btn btn-primary mr-2" :disabled="isConfirmed || loadingAction" @click="handleSaveDraft">
                    {{ loadingAction ? '處理中...' : '儲存草稿' }}
                </button>
                <button type="button" class="btn btn-success" :disabled="isConfirmed || loadingAction || !salaryRecord" @click="handleConfirmSalary">
                    {{ loadingAction ? '處理中...' : '確認發薪' }}
                </button>
                <div v-if="!salaryRecord" class="text-muted ml-3 align-self-center">請先儲存草稿後再確認</div>
            </div>

            <div class="card mt-3">
                <div class="card-header">列印設定</div>
                <div class="card-body">
                    <div class="form-check mb-2">
                        <input id="print-show-bank" v-model="printShowBank" type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="print-show-bank">列印銀行帳號資訊</label>
                    </div>
                    <div class="form-check mb-3">
                        <input id="print-show-hours" v-model="printShowHours" type="checkbox" class="form-check-input">
                        <label class="form-check-label" for="print-show-hours">列出請假與加班時數</label>
                    </div>
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-outline-primary" :disabled="!canPrintSalaryRecord" @click="openPrintPreview">
                            🖨️ 預覽列印
                        </button>
                        <span v-if="!canPrintSalaryRecord" class="text-muted ml-3">僅已確認的薪資單可列印</span>
                    </div>
                </div>
            </div>
        </div>

        <addition-form-modal
            :visible="additionModal.visible"
            :value="additionModal.item"
            :submitting="additionModal.submitting"
            @close="closeAdditionModal"
            @submit="submitAddition"
        />

        <deduction-form-modal
            :visible="deductionModal.visible"
            :value="deductionModal.item"
            :submitting="deductionModal.submitting"
            @close="closeDeductionModal"
            @submit="submitDeduction"
        />

        <unconfirm-warning-modal
            :visible="unconfirmModalVisible"
            :submitting="unconfirmSubmitting"
            @close="unconfirmModalVisible = false"
            @confirm="handleUnconfirm"
        />
    </div>
</template>

<script>
import AdditionFormModal from './AdditionFormModal.vue';
import DeductionFormModal from './DeductionFormModal.vue';
import UnconfirmWarningModal from './UnconfirmWarningModal.vue';

export default {
    name: 'SalaryEditPage',
    components: {
        AdditionFormModal,
        DeductionFormModal,
        UnconfirmWarningModal,
    },
    props: {
        employeeId: { type: Number, required: true },
    },
    data() {
        const now = new Date();
        return {
            year: now.getFullYear(),
            month: now.getMonth() + 1,
            loading: false,
            loadingAction: false,
            employee: {},
            attendanceSummary: {
                leave_hours: 0,
                overtime_hours_134: 0,
                overtime_hours_167: 0,
                overtime_pay: 0,
                leave_deduction: 0,
                hourly_rate: 0,
            },
            salaryRecord: null,
            baseSalaryInput: 0,
            healthInsuranceDependentsInput: 0,
            printShowBank: true,
            printShowHours: false,
            noteInput: '',
            additionModal: {
                visible: false,
                item: null,
                submitting: false,
            },
            deductionModal: {
                visible: false,
                item: null,
                submitting: false,
            },
            unconfirmModalVisible: false,
            unconfirmSubmitting: false,
        };
    },
    computed: {
        isConfirmed() {
            return this.salaryRecord && Number(this.salaryRecord.status) === 1;
        },
        additions() {
            return Array.isArray((this.salaryRecord || {}).additions) ? this.salaryRecord.additions : [];
        },
        deductions() {
            return Array.isArray((this.salaryRecord || {}).deductions) ? this.salaryRecord.deductions : [];
        },
        employeeBaseSalary() {
            return Number((this.employee || {}).base_salary || 0);
        },
        employeeDependentsValue() {
            return Number((this.employee || {}).health_insurance_dependents || 0);
        },
        salaryDiffWithEmployee() {
            if (!this.salaryRecord) return false;
            return Math.round(Number(this.salaryRecord.base_salary || 0)) !== Math.round(this.employeeBaseSalary);
        },
        dependentsDiffWithEmployee() {
            if (!this.salaryRecord) return false;
            return this.salaryDependentsValue !== this.employeeDependentsValue;
        },
        salaryDependentsValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.health_insurance_dependents || 0);
            return Number(this.healthInsuranceDependentsInput || 0);
        },
        baseSalaryValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.base_salary || 0);
            return Number(this.baseSalaryInput || 0);
        },
        hourlyRateValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.hourly_rate || 0);
            return Number(this.baseSalaryInput || 0) / 240;
        },
        hourlyRateDisplay() {
            return `$${this.hourlyRateValue.toLocaleString('en-US', { minimumFractionDigits: 4, maximumFractionDigits: 4 })}`;
        },
        leaveHoursValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.leave_hours || 0);
            return Number(this.attendanceSummary.leave_hours || 0);
        },
        overtime134Value() {
            if (this.salaryRecord) return Number(this.salaryRecord.overtime_hours_134 || 0);
            return Number(this.attendanceSummary.overtime_hours_134 || 0);
        },
        overtime167Value() {
            if (this.salaryRecord) return Number(this.salaryRecord.overtime_hours_167 || 0);
            return Number(this.attendanceSummary.overtime_hours_167 || 0);
        },
        totalOvertimeHours() {
            return this.overtime134Value + this.overtime167Value;
        },
        overtimePayValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.overtime_pay || 0);
            return Number(this.attendanceSummary.overtime_pay || 0);
        },
        leaveDeductionValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.leave_deduction || 0);
            return Number(this.attendanceSummary.leave_deduction || 0);
        },
        additionTotalValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.addition_total || 0);
            return 0;
        },
        deductionTotalValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.deduction_total || 0);
            return 0;
        },
        regularWageAdditionsCount() {
            return this.additions.filter((item) => this.isRegularWageItem(item)).length;
        },
        regularWageDeductionsCount() {
            return this.deductions.filter((item) => this.isRegularWageItem(item)).length;
        },
        regularWageValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.regular_wage || 0);
            return 0;
        },
        laborInsuranceAmountValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.labor_insurance_amount || 0);
            return 0;
        },
        healthInsuranceAmountValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.health_insurance_amount || 0);
            return 0;
        },
        healthInsuranceMultiplier() {
            return this.salaryDependentsValue + 1;
        },
        healthInsuranceBaseValue() {
            if (this.healthInsuranceMultiplier <= 0) return 0;
            return this.healthInsuranceAmountValue / this.healthInsuranceMultiplier;
        },
        healthInsuranceDisplay() {
            return `- ${this.moneyIntLabel(this.healthInsuranceAmountValue)}（${this.dependentsLabel(this.salaryDependentsValue)}，${this.moneyIntLabel(this.healthInsuranceBaseValue)} × ${this.healthInsuranceMultiplier}）`;
        },
        netSalaryValue() {
            if (this.salaryRecord) return Number(this.salaryRecord.net_salary || 0);
            return this.baseSalaryValue - this.leaveDeductionValue + this.overtimePayValue;
        },
        issuedSalaryValue() {
            return Math.round(this.netSalaryValue);
        },
        confirmedAtLabel() {
            return this.dateTimeLabel((this.salaryRecord || {}).confirmed_at);
        },
        canPrintSalaryRecord() {
            return !!(this.salaryRecord && Number(this.salaryRecord.status) === 1);
        },
    },
    created() {
        this.applyQueryMonth();
        this.fetchPageData();
    },
    methods: {
        applyQueryMonth() {
            const search = new URLSearchParams(window.location.search);
            const year = Number(search.get('year'));
            const month = Number(search.get('month'));
            if (year >= 2000 && year <= 2100) this.year = year;
            if (month >= 1 && month <= 12) this.month = month;
        },
        syncUrlQuery() {
            const url = new URL(window.location.href);
            url.searchParams.set('year', this.year);
            url.searchParams.set('month', this.month);
            window.history.replaceState({}, '', `${url.pathname}?${url.searchParams.toString()}`);
        },
        fetchPageData() {
            this.loading = true;
            axios
                .get(`/backend/salary/${this.employeeId}/edit`, {
                    params: {
                        year: this.year,
                        month: this.month,
                    },
                })
                .then((response) => {
                    const data = response.data.data || {};
                    this.year = Number(data.year || this.year);
                    this.month = Number(data.month || this.month);
                    this.employee = data.employee || {};
                    this.attendanceSummary = data.attendance_summary || this.attendanceSummary;
                    this.salaryRecord = data.salary_record || null;
                    this.baseSalaryInput = Math.round(Number((this.salaryRecord || this.employee).base_salary || 0));
                    this.healthInsuranceDependentsInput = Number(
                        (this.salaryRecord || this.employee).health_insurance_dependents || 0
                    );
                    this.noteInput = this.salaryRecord ? (this.salaryRecord.note || '') : '';
                    this.syncUrlQuery();
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '取得薪資資料失敗'));
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        handleBaseSalaryBlur() {
            this.normalizeBaseSalaryInput();
            if (!this.salaryRecord || this.isConfirmed) return;
            this.updateSalaryRecord();
        },
        handleDependentsChange() {
            this.normalizeDependentsInput();
            if (!this.salaryRecord || this.isConfirmed) return;
            this.updateSalaryRecord();
        },
        handleSaveDraft() {
            if (this.loadingAction || this.isConfirmed) return;
            if (this.salaryRecord) {
                this.updateSalaryRecord(true);
                return;
            }
            this.createSalaryRecord();
        },
        handleConfirmSalary() {
            if (this.loadingAction || this.isConfirmed) return;
            if (!this.salaryRecord) return;
            this.loadingAction = true;
            axios
                .post(`/backend/salary/${this.salaryRecord.id}/confirm`)
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                    this.showSuccess('薪資單已確認');
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '確認發薪失敗'));
                })
                .finally(() => {
                    this.loadingAction = false;
                });
        },
        createSalaryRecord(confirmAfterCreate = false) {
            this.loadingAction = true;
            axios
                .post(`/backend/salary/${this.employeeId}`, {
                    year: this.year,
                    month: this.month,
                    base_salary: this.normalizedBaseSalary(),
                })
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                    if (confirmAfterCreate) {
                        return axios.post(`/backend/salary/${this.salaryRecord.id}/confirm`)
                            .then((confirmResponse) => {
                                this.applySalaryRecord(confirmResponse.data.data);
                                this.showSuccess('薪資單已確認');
                            });
                    }
                    this.showSuccess('草稿已建立');
                    return null;
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, confirmAfterCreate ? '確認發薪失敗' : '建立薪資草稿失敗'));
                })
                .finally(() => {
                    this.loadingAction = false;
                });
        },
        updateSalaryRecord(showSuccess = false) {
            if (!this.salaryRecord) return;
            this.loadingAction = true;
            axios
                .put(`/backend/salary/${this.salaryRecord.id}`, {
                    base_salary: this.normalizedBaseSalary(),
                    health_insurance_dependents: this.normalizedDependents(),
                    note: this.noteInput || null,
                })
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                    if (showSuccess) this.showSuccess('草稿已儲存');
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '更新薪資單失敗'));
                })
                .finally(() => {
                    this.loadingAction = false;
                });
        },
        applySalaryRecord(record) {
            this.salaryRecord = record || null;
            if (this.salaryRecord) {
                this.baseSalaryInput = Math.round(Number(this.salaryRecord.base_salary || 0));
                this.healthInsuranceDependentsInput = Number(this.salaryRecord.health_insurance_dependents || 0);
                this.noteInput = this.salaryRecord.note || '';
            }
        },
        normalizeBaseSalaryInput() {
            const normalized = this.normalizedBaseSalary();
            this.baseSalaryInput = normalized;
            return normalized;
        },
        normalizedBaseSalary() {
            const value = Math.round(Number(this.baseSalaryInput || 0));
            return value < 0 ? 0 : value;
        },
        normalizeDependentsInput() {
            const normalized = this.normalizedDependents();
            this.healthInsuranceDependentsInput = normalized;
            return normalized;
        },
        normalizedDependents() {
            const value = Math.round(Number(this.healthInsuranceDependentsInput || 0));
            if (value < 0) return 0;
            if (value > 3) return 3;
            return value;
        },
        restoreEmployeeSalary() {
            this.baseSalaryInput = Math.round(this.employeeBaseSalary);
            this.handleBaseSalaryBlur();
        },
        restoreEmployeeDependents() {
            this.healthInsuranceDependentsInput = Number(this.employeeDependentsValue || 0);
            this.handleDependentsChange();
        },
        dependentsLabel(value) {
            const dependents = Math.max(0, Math.round(Number(value || 0)));
            if (dependents === 0) return '本人';
            return `本人+${dependents}`;
        },
        openPrintPreview() {
            if (!this.canPrintSalaryRecord) return;
            const url = `/backend/salary/${this.salaryRecord.id}/print`
                + `?show_bank=${this.printShowBank ? 1 : 0}`
                + `&show_hours=${this.printShowHours ? 1 : 0}`;
            window.open(url, '_blank');
        },
        openAdditionCreate() {
            this.additionModal.item = null;
            this.additionModal.visible = true;
        },
        openAdditionEdit(item) {
            this.additionModal.item = Object.assign({}, item);
            this.additionModal.visible = true;
        },
        closeAdditionModal() {
            this.additionModal.visible = false;
            this.additionModal.item = null;
        },
        submitAddition(payload) {
            if (!this.salaryRecord) return;
            this.additionModal.submitting = true;
            const editingItem = this.additionModal.item;
            const request = editingItem
                ? axios.put(`/backend/salary/${this.salaryRecord.id}/additions/${editingItem.id}`, payload)
                : axios.post(`/backend/salary/${this.salaryRecord.id}/additions`, payload);

            request
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                    this.closeAdditionModal();
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '儲存加項失敗'));
                })
                .finally(() => {
                    this.additionModal.submitting = false;
                });
        },
        destroyAddition(item) {
            if (!this.salaryRecord || !window.confirm(`確定刪除加項「${item.name}」？`)) return;
            axios
                .delete(`/backend/salary/${this.salaryRecord.id}/additions/${item.id}`)
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '刪除加項失敗'));
                });
        },
        openDeductionCreate() {
            this.deductionModal.item = null;
            this.deductionModal.visible = true;
        },
        openDeductionEdit(item) {
            this.deductionModal.item = Object.assign({}, item);
            this.deductionModal.visible = true;
        },
        closeDeductionModal() {
            this.deductionModal.visible = false;
            this.deductionModal.item = null;
        },
        submitDeduction(payload) {
            if (!this.salaryRecord) return;
            this.deductionModal.submitting = true;
            const editingItem = this.deductionModal.item;
            const request = editingItem
                ? axios.put(`/backend/salary/${this.salaryRecord.id}/deductions/${editingItem.id}`, payload)
                : axios.post(`/backend/salary/${this.salaryRecord.id}/deductions`, payload);

            request
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                    this.closeDeductionModal();
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '儲存減項失敗'));
                })
                .finally(() => {
                    this.deductionModal.submitting = false;
                });
        },
        destroyDeduction(item) {
            if (!this.salaryRecord || !window.confirm(`確定刪除減項「${item.name}」？`)) return;
            axios
                .delete(`/backend/salary/${this.salaryRecord.id}/deductions/${item.id}`)
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '刪除減項失敗'));
                });
        },
        openUnconfirmModal() {
            this.unconfirmModalVisible = true;
        },
        handleUnconfirm() {
            if (!this.salaryRecord) return;
            this.unconfirmSubmitting = true;
            axios
                .post(`/backend/salary/${this.salaryRecord.id}/unconfirm`)
                .then((response) => {
                    this.applySalaryRecord(response.data.data);
                    this.unconfirmModalVisible = false;
                    this.showSuccess('已解除確認');
                })
                .catch((error) => {
                    this.showError(this.extractErrorMessage(error, '解除確認失敗'));
                })
                .finally(() => {
                    this.unconfirmSubmitting = false;
                });
        },
        additionItemLabel(item) {
            if (item.type !== 'meal') return item.name;
            const quantity = Number(item.quantity || 0);
            const unitPrice = Number(item.unit_price || 0);
            return `${item.name} ${quantity.toFixed(1)}天 x ${this.moneyLabel(unitPrice)}`;
        },
        isRegularWageItem(item) {
            return Number((item || {}).is_regular_wage || 0) === 1;
        },
        moneyLabel(value) {
            return `$${Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
        },
        moneyIntLabel(value) {
            return `$${Math.round(Number(value || 0)).toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 0 })}`;
        },
        hoursLabel(value) {
            return `${Number(value || 0).toFixed(1)}h`;
        },
        dateLabel(value, separator = '-') {
            if (!value) return '-';
            const date = String(value).slice(0, 10);
            return date.replace(/-/g, separator);
        },
        dateTimeLabel(value) {
            if (!value) return '-';
            let source = String(value).trim();
            if (/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}(:\d{2})?$/.test(source)) {
                source = source.replace(' ', 'T');
                if (!/[+-]\d{2}:\d{2}$/.test(source) && !source.endsWith('Z')) {
                    source = `${source}+08:00`;
                }
            }

            const date = new Date(source);
            if (Number.isNaN(date.getTime())) {
                return String(value).slice(0, 16).replace(/-/g, '/');
            }

            const parts = new Intl.DateTimeFormat('zh-TW', {
                timeZone: 'Asia/Taipei',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false,
            }).formatToParts(date).reduce((map, part) => {
                if (part.type !== 'literal') {
                    map[part.type] = part.value;
                }
                return map;
            }, {});

            return `${parts.year}/${parts.month}/${parts.day} ${parts.hour}:${parts.minute}`;
        },
        extractErrorMessage(error, fallback) {
            return (((error || {}).response || {}).data || {}).message || fallback;
        },
        showSuccess(message) {
            if (window.$ && $.showSuccessModal) {
                $.showSuccessModal(message);
                return;
            }
            window.alert(message);
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
