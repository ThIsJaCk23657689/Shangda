<template>
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-user"></i>
            員工詳細資料
        </div>
        <div class="card-body" v-if="employee">
            <h5 class="mb-3">基本資料</h5>
            <div class="row">
                <div class="col-md-4 mb-2"><strong>姓名：</strong>{{ employee.name }}</div>
                <div class="col-md-4 mb-2"><strong>性別：</strong>{{ genderLabel(employee.gender) }}</div>
                <div class="col-md-4 mb-2"><strong>狀態：</strong>{{ statusLabel(employee.status) }}</div>
                <div class="col-md-4 mb-2"><strong>國籍：</strong>{{ employee.nationality || '-' }}</div>
                <div class="col-md-4 mb-2"><strong>證件類型：</strong>{{ idTypeLabel(employee.id_type) }}</div>
                <div class="col-md-4 mb-2"><strong>證件號碼：</strong>{{ employee.id_number || '-' }}</div>
                <div class="col-md-6 mb-2"><strong>出生年月日：</strong>{{ dateLabel(employee.birth_date) || '-' }}</div>
                <div class="col-md-6 mb-2"><strong>手機：</strong>{{ employee.phone || '-' }}</div>
                <div class="col-md-6 mb-2"><strong>基本月薪：</strong>{{ salaryLabel(employee.base_salary) }}</div>
                <div class="col-md-6 mb-2"><strong>健保眷屬數：</strong>{{ dependentsLabel(employee.health_insurance_dependents) }}</div>
                <div class="col-md-6 mb-2"><strong>到職日：</strong>{{ dateLabel(employee.hired_date) || '-' }}</div>
                <div class="col-md-6 mb-2"><strong>離職日：</strong>{{ dateLabel(employee.resigned_date) || '-' }}</div>
                <div class="col-md-12 mb-2"><strong>住址：</strong>{{ addressLabel(employee) }}</div>
            </div>

            <hr>

            <h5 class="mb-3">銀行帳號</h5>
            <div v-if="!employee.bank_accounts || !employee.bank_accounts.length" class="text-muted">無資料</div>
            <div v-else class="table-responsive mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>銀行代碼</th>
                            <th>銀行名稱</th>
                            <th>帳號</th>
                            <th>主要帳號</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="bank in employee.bank_accounts" :key="bank.id">
                            <td>{{ bank.bank_code }}</td>
                            <td>{{ bank.bank_name }}</td>
                            <td>{{ bank.account_number }}</td>
                            <td><span v-if="Number(bank.is_primary) === 1" class="badge badge-success">主要</span><span v-else>-</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h5 class="mb-3">緊急聯絡人</h5>
            <div v-if="!employee.emergency_contacts || !employee.emergency_contacts.length" class="text-muted">無資料</div>
            <div v-else class="table-responsive mb-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>關係</th>
                            <th>姓名</th>
                            <th>電話</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="contact in employee.emergency_contacts" :key="contact.id">
                            <td>{{ contact.relationship }}</td>
                            <td>{{ contact.name }}</td>
                            <td>{{ contact.phone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <a href="/backend/employees" class="btn btn-secondary mr-2">返回列表</a>
            <a :href="`/backend/employees/${employee.id}/edit`" class="btn btn-primary">前往編輯</a>
        </div>
        <div v-else class="card-body text-center py-4">資料讀取中...</div>
    </div>
</template>

<script>
export default {
    name: 'EmployeeShowPage',
    props: { employeeId: { type: Number, required: true } },
    data() {
        return { employee: null };
    },
    created() {
        this.fetchEmployee();
    },
    methods: {
        fetchEmployee() {
            axios.get(`/backend/employees/${this.employeeId}`).then((response) => {
                this.employee = response.data.data;
            }).catch(() => {
                if (window.$ && $.showErrorModalWithoutError) {
                    $.showErrorModalWithoutError('讀取員工資料失敗');
                }
            });
        },
        genderLabel(gender) {
            if (gender === null || gender === undefined || gender === '') return '-';
            return Number(gender) === 1 ? '男' : '女';
        },
        statusLabel(status) {
            return Number(status) === 1 ? '在職' : '離職';
        },
        idTypeLabel(idType) {
            const map = { 1: '身分證', 2: '護照', 3: '居留證' };
            return map[Number(idType)] || '-';
        },
        salaryLabel(value) {
            const amount = Number(value || 0);
            return amount.toLocaleString('zh-TW', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
        },
        dependentsLabel(value) {
            if (value === null || value === undefined || value === '') return '-';
            const dependents = Math.max(0, Number(value) || 0);
            if (dependents === 0) return '本人';
            return `本人+${dependents}`;
        },
        dateLabel(date) {
            return date ? String(date).slice(0, 10) : '';
        },
        addressLabel(employee) {
            const composed = [employee.address_zipcode, employee.address_county, employee.address_district, employee.address_others].filter(Boolean).join('');
            return composed || employee.address || '-';
        },
    },
};
</script>
