<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>員工薪資計算</h4>
                    </div>
                    <div class="card-body">
                        <!-- 基本輸入欄位 -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="baseSalary">
                                        <span class="text-danger mr-2">*</span>基本月薪
                                    </label>
                                    <input
                                        id="baseSalary"
                                        v-model.number="baseSalary"
                                        type="number"
                                        class="form-control"
                                        min="0"
                                        step="1"
                                        placeholder="例如：29500"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="leaveDays">請假天數</label>
                                    <input
                                        id="leaveDays"
                                        v-model.number="leaveDays"
                                        type="number"
                                        class="form-control"
                                        min="0"
                                        step="1"
                                        placeholder="0"
                                    />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="leaveHours">請假小時數</label>
                                    <input
                                        id="leaveHours"
                                        v-model.number="leaveHours"
                                        type="number"
                                        class="form-control"
                                        min="0"
                                        step="0.5"
                                        placeholder="0"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- 加班列表 -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>加班列表</h5>
                                    <button
                                        type="button"
                                        class="btn btn-primary btn-sm"
                                        @click="addOvertimeRow"
                                    >
                                        <i class="fas fa-plus"></i> 新增加班
                                    </button>
                                </div>
                                <div v-if="overtimeList.length === 0" class="alert alert-info">
                                    尚未新增任何加班記錄
                                </div>
                                <div v-else class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="40%">加班時數</th>
                                                <th width="40%">對應天數</th>
                                                <th width="20%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in overtimeList" :key="index">
                                                <td>
                                                    <input
                                                        v-model.number="item.hours"
                                                        type="number"
                                                        class="form-control"
                                                        min="0"
                                                        step="0.5"
                                                        placeholder="例如：1, 2, 3.5, 4"
                                                    />
                                                </td>
                                                <td>
                                                    <input
                                                        v-model.number="item.days"
                                                        type="number"
                                                        class="form-control"
                                                        min="0"
                                                        step="1"
                                                        placeholder="天數"
                                                    />
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm"
                                                        @click="removeOvertimeRow(index)"
                                                    >
                                                        <i class="fas fa-trash"></i> 刪除
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- 動態收入項目 -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-success">
                                        <i class="fas fa-plus-circle"></i> 加項（收入）
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <select
                                            v-model="selectedEarningType"
                                            class="form-control form-control-sm mr-2"
                                            style="width: auto; min-width: 180px;"
                                        >
                                            <option value="">選擇收入項目...</option>
                                            <option value="seniority">年資獎金</option>
                                            <option value="position">職務津貼</option>
                                            <option value="meal">餐費津貼</option>
                                            <option value="production">生產獎金</option>
                                            <option value="festival">節慶獎金</option>
                                            <option value="year_end">年終獎金</option>
                                        </select>
                                        <button
                                            type="button"
                                            class="btn btn-success btn-sm"
                                            @click="addEarning"
                                            :disabled="!selectedEarningType"
                                        >
                                            <i class="fas fa-plus"></i> 新增
                                        </button>
                                    </div>
                                </div>
                                <div v-if="earnings.length === 0" class="alert alert-info">
                                    尚未新增任何收入項目
                                </div>
                                <div v-else class="table-responsive">
                                    <table class="table table-bordered table-hover earning-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="30%">項目名稱</th>
                                                <th width="25%">金額/天數</th>
                                                <th width="25%">小計</th>
                                                <th width="20%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(item, index) in earnings"
                                                :key="index"
                                                class="earning-row"
                                            >
                                                <td>
                                                    <strong>{{ getEarningTypeName(item.type) }}</strong>
                                                    <span
                                                        v-if="item.type === 'position'"
                                                        class="badge badge-info ml-2"
                                                    >
                                                        {{ item.positionType === 'leader' ? '組長' : '主管' }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <!-- 職務津貼：下拉選單 -->
                                                    <select
                                                        v-if="item.type === 'position'"
                                                        v-model="item.positionType"
                                                        class="form-control form-control-sm"
                                                        @change="updatePositionAllowance(item)"
                                                    >
                                                        <option value="leader">組長 ($2,000)</option>
                                                        <option value="supervisor">主管 ($1,000)</option>
                                                    </select>
                                                    <!-- 餐費津貼：天數輸入 -->
                                                    <input
                                                        v-else-if="item.type === 'meal'"
                                                        v-model.number="item.days"
                                                        type="number"
                                                        class="form-control form-control-sm"
                                                        min="0"
                                                        step="1"
                                                        placeholder="天數"
                                                    />
                                                    <!-- 其他：金額輸入 -->
                                                    <input
                                                        v-else
                                                        v-model.number="item.amount"
                                                        type="number"
                                                        class="form-control form-control-sm"
                                                        min="0"
                                                        step="1"
                                                        placeholder="金額"
                                                    />
                                                </td>
                                                <td>
                                                    <span class="text-success font-weight-bold">
                                                        ${{ getEarningAmount(item).toLocaleString('zh-TW') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm"
                                                        @click="removeEarning(index)"
                                                    >
                                                        <i class="fas fa-trash"></i> 刪除
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot v-if="earnings.length > 0">
                                            <tr class="table-success">
                                                <th colspan="2" class="text-right">收入小計：</th>
                                                <th class="text-success">
                                                    ${{ totalEarningsFormatted }}
                                                </th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- 動態扣除項目 -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-danger">
                                        <i class="fas fa-minus-circle"></i> 減項（扣除）
                                    </h5>
                                    <div class="d-flex align-items-center">
                                        <select
                                            v-model="selectedDeductionType"
                                            class="form-control form-control-sm mr-2"
                                            style="width: auto; min-width: 180px;"
                                        >
                                            <option value="">選擇扣除項目...</option>
                                            <option value="labor_insurance">勞保</option>
                                            <option value="health_insurance">健保</option>
                                            <option value="agency_fee">代辦費</option>
                                            <option value="water_bill">水費</option>
                                            <option value="electricity_bill">電費</option>
                                            <option value="accommodation">住宿費</option>
                                            <option value="advance_payment">預支款</option>
                                            <option value="others">其他</option>
                                        </select>
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
                                            @click="addDeduction"
                                            :disabled="!selectedDeductionType"
                                        >
                                            <i class="fas fa-plus"></i> 新增
                                        </button>
                                    </div>
                                </div>
                                <div v-if="deductions.length === 0" class="alert alert-info">
                                    尚未新增任何扣除項目
                                </div>
                                <div v-else class="table-responsive">
                                    <table class="table table-bordered table-hover deduction-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th width="40%">項目名稱</th>
                                                <th width="40%">金額</th>
                                                <th width="20%">操作</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(item, index) in deductions"
                                                :key="index"
                                                class="deduction-row"
                                            >
                                                <td>
                                                    <strong>{{ getDeductionTypeName(item.type) }}</strong>
                                                </td>
                                                <td>
                                                    <input
                                                        v-model.number="item.amount"
                                                        type="number"
                                                        class="form-control form-control-sm"
                                                        min="0"
                                                        step="1"
                                                        placeholder="金額"
                                                    />
                                                </td>
                                                <td>
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger btn-sm"
                                                        @click="removeDeduction(index)"
                                                    >
                                                        <i class="fas fa-trash"></i> 刪除
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot v-if="deductions.length > 0">
                                            <tr class="table-danger">
                                                <th class="text-right">扣除小計：</th>
                                                <th class="text-danger">
                                                    ${{ totalDeductionsFormatted }}
                                                </th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- 詳細薪資明細 -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h5 class="mb-0">薪資明細</h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- 基本項目 -->
                                        <div class="salary-breakdown">
                                            <div class="breakdown-row">
                                                <div class="breakdown-label">基本月薪</div>
                                                <div class="breakdown-value">
                                                    ${{ baseSalaryFormatted }}
                                                </div>
                                            </div>
                                            <div class="breakdown-row">
                                                <div class="breakdown-label">加班費</div>
                                                <div class="breakdown-value text-success">
                                                    + ${{ monthlyOvertimePayFormatted }}
                                                </div>
                                            </div>
                                            <div class="breakdown-row">
                                                <div class="breakdown-label">請假扣款</div>
                                                <div class="breakdown-value text-danger">
                                                    - ${{ leaveDeductionFormatted }}
                                                </div>
                                            </div>
                                            <div class="breakdown-subtotal">
                                                <div class="breakdown-label">
                                                    <strong>小計（基本薪資）</strong>
                                                </div>
                                                <div class="breakdown-value">
                                                    <strong>${{ baseSalaryTotalFormatted }}</strong>
                                                </div>
                                            </div>

                                            <hr />

                                            <!-- 收入項目 -->
                                            <template v-if="earnings.length > 0">
                                                <div
                                                    v-for="(item, index) in earnings"
                                                    :key="'earning-' + index"
                                                    class="breakdown-row earning-item"
                                                >
                                                    <div class="breakdown-label">
                                                        {{ getEarningTypeName(item.type) }}
                                                    </div>
                                                    <div class="breakdown-value text-success">
                                                        + ${{ getEarningAmount(item).toLocaleString('zh-TW') }}
                                                    </div>
                                                </div>
                                                <div class="breakdown-subtotal">
                                                    <div class="breakdown-label text-success">
                                                        <strong>收入小計</strong>
                                                    </div>
                                                    <div class="breakdown-value text-success">
                                                        <strong>+ ${{ totalEarningsFormatted }}</strong>
                                                    </div>
                                                </div>
                                                <hr />
                                            </template>

                                            <!-- 扣除項目 -->
                                            <template v-if="deductions.length > 0">
                                                <div
                                                    v-for="(item, index) in deductions"
                                                    :key="'deduction-' + index"
                                                    class="breakdown-row deduction-item"
                                                >
                                                    <div class="breakdown-label">
                                                        {{ getDeductionTypeName(item.type) }}
                                                    </div>
                                                    <div class="breakdown-value text-danger">
                                                        - ${{ (item.amount || 0).toLocaleString('zh-TW') }}
                                                    </div>
                                                </div>
                                                <div class="breakdown-subtotal">
                                                    <div class="breakdown-label text-danger">
                                                        <strong>扣除小計</strong>
                                                    </div>
                                                    <div class="breakdown-value text-danger">
                                                        <strong>- ${{ totalDeductionsFormatted }}</strong>
                                                    </div>
                                                </div>
                                                <hr />
                                            </template>

                                            <!-- 最終實領薪資 -->
                                            <div class="breakdown-total">
                                                <div class="breakdown-label">
                                                    <h4 class="mb-0">實領薪資</h4>
                                                </div>
                                                <div class="breakdown-value">
                                                    <h4 class="mb-0 text-primary font-weight-bold">
                                                        ${{ netSalaryFormatted }}
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'SalaryCalculator',
    data() {
        return {
            baseSalary: 29500,
            leaveDays: 0,
            leaveHours: 0,
            overtimeList: [],
            // 收入項目
            earnings: [],
            selectedEarningType: '',
            // 扣除項目
            deductions: [],
            selectedDeductionType: ''
        };
    },
    computed: {
        // 時薪基準
        hourlyBase() {
            if (!this.baseSalary || this.baseSalary <= 0) {
                return 0;
            }
            return this.baseSalary / 30 / 8;
        },
        hourlyBaseFormatted() {
            return Math.round(this.hourlyBase).toLocaleString('zh-TW');
        },

        // 當月加班費
        monthlyOvertimePay() {
            if (!this.overtimeList || this.overtimeList.length === 0) {
                return 0;
            }
            let total = 0;
            this.overtimeList.forEach(item => {
                const hours = item.hours || 0;
                const days = item.days || 0;
                if (hours > 0 && days > 0) {
                    const dailyPay = this.calculateDailyOvertimePay(hours);
                    total += dailyPay * days;
                }
            });
            return total;
        },
        monthlyOvertimePayFormatted() {
            return Math.round(this.monthlyOvertimePay).toLocaleString('zh-TW');
        },

        // 請假扣款
        leaveDeduction() {
            if (this.hourlyBase <= 0) {
                return 0;
            }
            const leaveDays = this.leaveDays || 0;
            const leaveHours = this.leaveHours || 0;
            return (leaveDays * 8 + leaveHours) * this.hourlyBase;
        },
        leaveDeductionFormatted() {
            return Math.round(this.leaveDeduction).toLocaleString('zh-TW');
        },

        // 基本月薪格式化
        baseSalaryFormatted() {
            return (this.baseSalary || 0).toLocaleString('zh-TW');
        },

        // 基本薪資小計（基本月薪 + 加班費 - 請假扣款）
        baseSalaryTotal() {
            const base = this.baseSalary || 0;
            const overtime = this.monthlyOvertimePay;
            const deduction = this.leaveDeduction;
            return base + overtime - deduction;
        },
        baseSalaryTotalFormatted() {
            return Math.round(this.baseSalaryTotal).toLocaleString('zh-TW');
        },

        // 收入總計
        totalEarnings() {
            let total = 0;
            this.earnings.forEach(item => {
                total += this.getEarningAmount(item);
            });
            return total;
        },
        totalEarningsFormatted() {
            return Math.round(this.totalEarnings).toLocaleString('zh-TW');
        },

        // 扣除總計
        totalDeductions() {
            let total = 0;
            this.deductions.forEach(item => {
                total += item.amount || 0;
            });
            return total;
        },
        totalDeductionsFormatted() {
            return Math.round(this.totalDeductions).toLocaleString('zh-TW');
        },

        // 實領薪資（最終結果）
        netSalary() {
            return this.baseSalaryTotal + this.totalEarnings - this.totalDeductions;
        },
        netSalaryFormatted() {
            return Math.round(this.netSalary).toLocaleString('zh-TW');
        }
    },
    methods: {
        // 單日加班費計算
        calculateDailyOvertimePay(hours) {
            if (!hours || hours <= 0 || this.hourlyBase <= 0) {
                return 0;
            }
            const base = this.hourlyBase;
            if (hours <= 2) {
                return hours * base * 1.34;
            } else {
                return (2 * base * 1.34) + ((hours - 2) * base * 1.67);
            }
        },
        // 新增加班列
        addOvertimeRow() {
            this.overtimeList.push({
                hours: 0,
                days: 0
            });
        },
        // 刪除加班列
        removeOvertimeRow(index) {
            this.overtimeList.splice(index, 1);
        },

        // 取得收入項目名稱
        getEarningTypeName(type) {
            const names = {
                seniority: '年資獎金',
                position: '職務津貼',
                meal: '餐費津貼',
                production: '生產獎金',
                festival: '節慶獎金',
                year_end: '年終獎金'
            };
            return names[type] || '';
        },

        // 取得收入項目金額
        getEarningAmount(item) {
            switch (item.type) {
                case 'position':
                    return item.positionType === 'leader' ? 2000 : 1000;
                case 'meal':
                    return (item.days || 0) * 80;
                default:
                    return item.amount || 0;
            }
        },

        // 新增收入項目
        addEarning() {
            if (!this.selectedEarningType) return;

            const newEarning = {
                type: this.selectedEarningType,
                amount: 0,
                days: 0,
                positionType: 'leader'
            };

            // 如果是職務津貼，預設為組長
            if (this.selectedEarningType === 'position') {
                newEarning.positionType = 'leader';
            }

            this.earnings.push(newEarning);
            this.selectedEarningType = ''; // 清空選擇
        },

        // 刪除收入項目
        removeEarning(index) {
            this.earnings.splice(index, 1);
        },

        // 更新職務津貼
        updatePositionAllowance(item) {
            // 此方法主要用於觸發重新計算
            // Vue 的響應式系統會自動處理
        },

        // 取得扣除項目名稱
        getDeductionTypeName(type) {
            const names = {
                labor_insurance: '勞保',
                health_insurance: '健保',
                agency_fee: '代辦費',
                water_bill: '水費',
                electricity_bill: '電費',
                accommodation: '住宿費',
                advance_payment: '預支款',
                others: '其他'
            };
            return names[type] || '';
        },

        // 新增扣除項目
        addDeduction() {
            if (!this.selectedDeductionType) return;

            this.deductions.push({
                type: this.selectedDeductionType,
                amount: 0
            });

            this.selectedDeductionType = ''; // 清空選擇
        },

        // 刪除扣除項目
        removeDeduction(index) {
            this.deductions.splice(index, 1);
        }
    }
};
</script>

<style scoped>
.card-header h4,
.card-header h5 {
    margin: 0;
}

.table th {
    text-align: center;
}

.form-group label {
    font-weight: 500;
}

.text-danger {
    color: #dc3545 !important;
}

.text-success {
    color: #28a745 !important;
}

.text-primary {
    color: #007bff !important;
}

/* 收入表格樣式 */
.earning-table {
    border: 2px solid #28a745;
}

.earning-row {
    background-color: #f8fff9;
}

.earning-row:hover {
    background-color: #e8f5e9;
}

/* 扣除表格樣式 */
.deduction-table {
    border: 2px solid #dc3545;
}

.deduction-row {
    background-color: #fff8f8;
}

.deduction-row:hover {
    background-color: #ffe8e8;
}

/* 薪資明細樣式 */
.salary-breakdown {
    font-size: 1rem;
}

.breakdown-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e0e0e0;
}

.breakdown-row:last-child {
    border-bottom: none;
}

.breakdown-label {
    flex: 1;
    font-weight: 500;
}

.breakdown-value {
    flex: 0 0 auto;
    text-align: right;
    font-weight: 500;
    min-width: 120px;
}

.breakdown-subtotal {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    margin-top: 0.5rem;
    border-top: 2px solid #ccc;
}

.breakdown-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    margin-top: 1rem;
    border-top: 3px solid #007bff;
    background-color: #f0f8ff;
    border-radius: 5px;
}

.earning-item .breakdown-label {
    color: #28a745;
}

.deduction-item .breakdown-label {
    color: #dc3545;
}

h5.text-success,
h5.text-danger {
    margin-bottom: 0;
}

.badge {
    font-size: 0.75rem;
}
</style>