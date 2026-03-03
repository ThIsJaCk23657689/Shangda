<template>
    <div v-if="visible" class="salary-modal-wrap">
        <div class="salary-modal-backdrop" @click="$emit('close')"></div>
        <div class="salary-modal card">
            <div class="card-header">
                <strong>⚠ 警告</strong>
            </div>
            <div class="card-body">
                <p class="mb-2">此操作將解除已確認的薪資單，薪資資料將可被修改。</p>
                <p class="mb-0">請確認您了解此操作的風險，並有充分的理由進行修改。</p>
            </div>
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary mr-2" :disabled="submitting" @click="$emit('close')">取消</button>
                <button type="button" class="btn btn-danger" :disabled="submitting" @click="$emit('confirm')">
                    {{ submitting ? '處理中...' : '確認解除' }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UnconfirmWarningModal',
    props: {
        visible: { type: Boolean, default: false },
        submitting: { type: Boolean, default: false },
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
    max-width: 520px;
    z-index: 1;
}
</style>
