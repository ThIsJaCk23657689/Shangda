<template>
    <div v-if="visible" class="salary-modal-wrap">
        <div class="salary-modal-backdrop" @click="$emit('close')"></div>
        <div class="salary-modal card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>{{ isEdit ? '編輯加項' : '新增加項' }}</strong>
                <button type="button" class="close" @click="$emit('close')"><span>&times;</span></button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>類型</label>
                    <select v-model="form.type" class="form-control">
                        <option v-for="item in additionTypes" :key="item.value" :value="item.value">{{ item.label }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>項目名稱</label>
                    <input v-model.trim="form.name" type="text" class="form-control" maxlength="50" @input="touchedName = true">
                </div>

                <div v-if="isMealType" class="form-row">
                    <div class="form-group col-md-6">
                        <label>天數</label>
                        <input v-model.number="form.quantity" type="number" min="0" step="0.1" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>單價</label>
                        <input v-model.number="form.unit_price" type="number" min="0" step="0.01" class="form-control">
                    </div>
                    <div class="col-12">
                        <div class="alert alert-light border mb-0">
                            小計：{{ moneyLabel(mealSubtotal) }}
                        </div>
                    </div>
                </div>

                <div v-else class="form-group mb-0">
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
    { value: 'seniority', label: '年資獎金' },
    { value: 'position', label: '職務津貼' },
    { value: 'production', label: '生產獎金' },
    { value: 'holiday', label: '節慶獎金' },
    { value: 'year_end', label: '年終獎金' },
    { value: 'meal', label: '餐費津貼' },
];

export default {
    name: 'AdditionFormModal',
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
        additionTypes() {
            return TYPE_OPTIONS;
        },
        isEdit() {
            return !!(this.value && this.value.id);
        },
        isMealType() {
            return this.form.type === 'meal';
        },
        mealSubtotal() {
            return Number(this.form.unit_price || 0) * Number(this.form.quantity || 0);
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
            if (newVal) {
                this.resetForm();
            }
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
            if (newType === 'meal' && !this.form.unit_price) {
                this.form.unit_price = 80;
            }
        },
    },
    methods: {
        defaultForm() {
            return {
                type: 'seniority',
                name: '年資獎金',
                unit_price: null,
                quantity: null,
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
                type: this.value.type || 'seniority',
                name: this.value.name || '',
                unit_price: this.value.unit_price,
                quantity: this.value.quantity,
                amount: this.value.amount,
            };
        },
        submit() {
            const payload = {
                type: this.form.type,
                name: this.form.name,
            };
            if (this.isMealType) {
                payload.unit_price = Number(this.form.unit_price || 0);
                payload.quantity = Number(this.form.quantity || 0);
            } else {
                payload.amount = Number(this.form.amount || 0);
            }
            this.$emit('submit', payload);
        },
        moneyLabel(value) {
            return `$${Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}`;
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
