<template>
    <div v-if="visible" class="salary-modal-wrap">
        <div class="salary-modal-backdrop" @click="$emit('close')"></div>
        <div class="salary-modal card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>{{ isEdit ? '編輯減項' : '新增減項' }}</strong>
                <button type="button" class="close" @click="$emit('close')"><span>&times;</span></button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>類型</label>
                    <select v-model="form.type" class="form-control">
                        <option v-for="item in deductionTypes" :key="item.value" :value="item.value">{{ item.label }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>項目名稱</label>
                    <input v-model.trim="form.name" type="text" class="form-control" maxlength="50" @input="touchedName = true">
                </div>

                <div class="form-group mb-0">
                    <label>金額</label>
                    <input v-model.number="form.amount" type="number" min="0" step="0.01" class="form-control">
                </div>

                <div class="form-group mt-3 mb-0">
                    <div class="form-check">
                        <input
                            id="deduction-is-regular-wage"
                            v-model="isRegularWageChecked"
                            type="checkbox"
                            class="form-check-input"
                        >
                        <label class="form-check-label" for="deduction-is-regular-wage">
                            納入經常性薪資
                        </label>
                    </div>
                    <small class="text-muted d-block mt-1">勾選後將納入勞健保級距計算</small>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary mr-2" :disabled="submitting" @click="$emit('close')">取消</button>
                <button type="button" class="btn btn-primary" :disabled="submitting" @click="submit">
                    {{ submitting ? '處理中...' : (isEdit ? '儲存' : '新增') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
const TYPE_OPTIONS = [
    { value: 'service_fee', label: '代辦費' },
    { value: 'water', label: '水費' },
    { value: 'electricity', label: '電費' },
    { value: 'housing', label: '住宿費' },
    { value: 'advance', label: '預支款' },
    { value: 'other', label: '其他' },
];

export default {
    name: 'DeductionFormModal',
    props: {
        visible: { type: Boolean, default: false },
        submitting: { type: Boolean, default: false },
        value: {
            type: Object,
            default() {
                return null;
            },
        },
    },
    data() {
        return {
            form: this.defaultForm(),
            touchedName: false,
        };
    },
    computed: {
        deductionTypes() {
            return TYPE_OPTIONS;
        },
        isEdit() {
            return !!(this.value && this.value.id);
        },
        typeLabelMap() {
            return TYPE_OPTIONS.reduce((map, item) => {
                map[item.value] = item.label;
                return map;
            }, {});
        },
        isRegularWageChecked: {
            get() {
                return Number(this.form.is_regular_wage) === 1;
            },
            set(checked) {
                this.form.is_regular_wage = checked ? 1 : 0;
            },
        },
    },
    watch: {
        visible(newVal) {
            if (newVal) this.resetForm();
        },
        value: {
            deep: true,
            handler() {
                if (this.visible) this.resetForm();
            },
        },
        'form.type'(newType, oldType) {
            if (newType !== oldType && !this.touchedName) {
                this.form.name = this.typeLabelMap[newType] || '';
            }
        },
    },
    methods: {
        defaultForm() {
            return {
                type: 'service_fee',
                name: '代辦費',
                amount: null,
                is_regular_wage: 0,
            };
        },
        resetForm() {
            this.touchedName = false;
            if (!this.value) {
                this.form = this.defaultForm();
                return;
            }

            this.form = {
                type: this.value.type || 'service_fee',
                name: this.value.name || '',
                amount: this.value.amount,
                is_regular_wage: Number(this.value.is_regular_wage || 0),
            };
        },
        submit() {
            this.$emit('submit', {
                type: this.form.type,
                name: this.form.name,
                amount: Number(this.form.amount || 0),
                is_regular_wage: Number(this.form.is_regular_wage || 0),
            });
        },
    },
};
</script>

<style scoped>
.salary-modal-wrap {
    position: fixed;
    inset: 0;
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.salary-modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
}

.salary-modal {
    position: relative;
    width: 100%;
    max-width: 540px;
    z-index: 1;
}
</style>
