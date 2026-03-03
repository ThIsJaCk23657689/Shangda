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
    { value: 'labor_insurance', label: '勞保' },
    { value: 'health_insurance', label: '健保' },
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
                type: 'labor_insurance',
                name: '勞保',
                amount: null,
            };
        },
        resetForm() {
            this.touchedName = false;
            if (!this.value) {
                this.form = this.defaultForm();
                return;
            }

            this.form = {
                type: this.value.type || 'labor_insurance',
                name: this.value.name || '',
                amount: this.value.amount,
            };
        },
        submit() {
            this.$emit('submit', {
                type: this.form.type,
                name: this.form.name,
                amount: Number(this.form.amount || 0),
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
