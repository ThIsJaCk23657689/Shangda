<template>
    <div>
        <div class="row mb-3">
            <div class="col-md-6">
                <input
                    v-model="keyword"
                    type="text"
                    class="form-control"
                    placeholder="搜尋姓名或證件號碼"
                >
            </div>
            <div class="col-md-6 text-right">
                <a href="/backend/employees/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    新增員工
                </a>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-users"></i>
                在職員工列表
            </div>
            <div class="card-body">
                <div v-if="loading" class="text-center py-4">資料讀取中...</div>
                <div v-else class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>姓名</th>
                                <th>性別</th>
                                <th>國籍</th>
                                <th>證件號碼</th>
                                <th>手機</th>
                                <th>基本月薪</th>
                                <th>到職日</th>
                                <th>狀態</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="employee in employees" :key="employee.id">
                                <td>{{ employee.name }}</td>
                                <td>{{ genderLabel(employee.gender) }}</td>
                                <td>{{ employee.nationality }}</td>
                                <td>{{ employee.id_number }}</td>
                                <td>{{ employee.phone }}</td>
                                <td>{{ salaryLabel(employee.base_salary) }}</td>
                                <td>{{ dateLabel(employee.hired_date) }}</td>
                                <td>{{ statusLabel(employee.status) }}</td>
                                <td>
                                    <a :href="`/backend/employees/${employee.id}`" class="btn btn-sm btn-info mr-1">查看</a>
                                    <a :href="`/backend/employees/${employee.id}/edit`" class="btn btn-sm btn-success mr-1">編輯</a>
                                    <button type="button" class="btn btn-sm btn-danger" @click="destroy(employee)">刪除</button>
                                </td>
                            </tr>
                            <tr v-if="employees.length === 0">
                                <td colspan="9" class="text-center">查無資料</td>
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
    name: 'EmployeeIndexPage',
    data() {
        return {
            employees: [],
            keyword: '',
            loading: false,
            keywordTimer: null,
        };
    },
    watch: {
        keyword() {
            clearTimeout(this.keywordTimer);
            this.keywordTimer = setTimeout(() => {
                this.fetchEmployees();
            }, 300);
        },
    },
    created() {
        this.fetchEmployees();
    },
    beforeDestroy() {
        clearTimeout(this.keywordTimer);
    },
    methods: {
        fetchEmployees() {
            this.loading = true;
            axios
                .get('/backend/employees', { params: { keyword: this.keyword } })
                .then((response) => {
                    this.employees = response.data.data || [];
                })
                .catch(() => {
                    this.employees = [];
                    if (window.$ && $.showErrorModalWithoutError) {
                        $.showErrorModalWithoutError('取得員工資料失敗');
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        destroy(employee) {
            const executeDelete = () => {
                axios
                    .delete(`/backend/employees/${employee.id}`)
                    .then((response) => {
                        if (response.data.success) {
                            this.fetchEmployees();
                            if (window.$ && $.showSuccessModal) {
                                $.showSuccessModal('員工資料已刪除');
                            }
                        }
                    })
                    .catch(() => {
                        if (window.$ && $.showErrorModalWithoutError) {
                            $.showErrorModalWithoutError('刪除失敗');
                        }
                    });
            };

            if (window.Swal) {
                Swal.fire({
                    title: '確認刪除',
                    text: `確定要刪除 ${employee.name} 嗎？`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '確認',
                    cancelButtonText: '取消',
                }).then((result) => {
                    if (result.value) {
                        executeDelete();
                    }
                });
                return;
            }

            if (window.confirm(`確定要刪除 ${employee.name} 嗎？`)) {
                executeDelete();
            }
        },
        genderLabel(gender) {
            return Number(gender) === 1 ? '男' : '女';
        },
        statusLabel(status) {
            return Number(status) === 1 ? '在職' : '離職';
        },
        salaryLabel(value) {
            const amount = Number(value || 0);
            return amount.toLocaleString('zh-TW', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
        },
        dateLabel(date) {
            return date ? String(date).slice(0, 10) : '';
        },
    },
};
</script>
