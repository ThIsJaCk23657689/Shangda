<template>
    <div v-if="visible" class="attendance-modal-wrap">
        <div class="attendance-modal-backdrop" @click="$emit('close')"></div>
        <div class="attendance-modal card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>{{ isEdit ? '編輯出勤記錄' : '新增出勤記錄' }}</span>
                <button type="button" class="close" @click="$emit('close')">
                    <span>&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>日期</label>
                    <input v-model="form.log_date" type="date" class="form-control">
                </div>

                <div class="form-group">
                    <label>類型</label>
                    <select v-model="form.type" class="form-control">
                        <option value="1">加班</option>
                        <option value="0">請假</option>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>開始時間</label>
                        <input v-model="form.start_time" type="time" step="1800" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>結束時間</label>
                        <input v-model="form.end_time" type="time" step="1800" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>備註</label>
                    <textarea v-model="form.note" rows="3" maxlength="200" class="form-control"></textarea>
                </div>

                <div class="alert alert-light border mb-0">
                    時數預覽：<strong>{{ hoursPreviewLabel }}</strong>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary mr-2" :disabled="submitting" @click="$emit('close')">取消</button>
                <button type="button" class="btn btn-primary" :disabled="submitting" @click="submit">
                    {{ submitting ? '處理中...' : (isEdit ? '儲存變更' : '新增') }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AttendanceFormModal',
    props: {
        visible: { type: Boolean, default: false },
        submitting: { type: Boolean, default: false },
        mode: { type: String, default: 'create' },
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
        };
    },
    computed: {
        isEdit() {
            return this.mode === 'edit';
        },
        previewHours() {
            if (!this.form.start_time || !this.form.end_time) return 0;
            if (this.form.end_time <= this.form.start_time) return 0;

            const start = this.toMinutes(this.form.start_time);
            const end = this.toMinutes(this.form.end_time);
            const minutes = Math.max(0, end - start);
            return Math.floor(minutes / 30) * 0.5;
        },
        hoursPreviewLabel() {
            return `${this.previewHours.toFixed(1)}h`;
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
                if (this.visible) {
                    this.resetForm();
                }
            },
        },
    },
    methods: {
        defaultForm() {
            return {
                log_date: '',
                type: '1',
                start_time: '',
                end_time: '',
                note: '',
            };
        },
        resetForm() {
            if (!this.value) {
                this.form = this.defaultForm();
                return;
            }

            this.form = {
                log_date: this.value.log_date || '',
                type: String(this.value.type),
                start_time: this.value.start_time || '',
                end_time: this.value.end_time || '',
                note: this.value.note || '',
            };
        },
        toMinutes(time) {
            const parts = String(time).split(':');
            if (parts.length < 2) return 0;
            return (Number(parts[0]) * 60) + Number(parts[1]);
        },
        submit() {
            this.$emit('submit', {
                log_date: this.form.log_date,
                type: this.form.type,
                start_time: this.form.start_time,
                end_time: this.form.end_time,
                note: this.form.note ? String(this.form.note).trim() : null,
            });
        },
    },
};
</script>

<style scoped>
.attendance-modal-wrap {
    position: fixed;
    inset: 0;
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
}

.attendance-modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.4);
}

.attendance-modal {
    position: relative;
    width: 100%;
    max-width: 520px;
    z-index: 1;
}
</style>
