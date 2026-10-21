<script setup lang="ts">
defineProps<{
    id: string;
    label: string;
    modelValue: string | number | null;
    type?: string;
    error?: string;
    required?: boolean;
    autocomplete?: string;
}>();

defineEmits<{
    'update:modelValue': [value: string];
}>();
</script>

<template>
    <label :for="id" class="block">
        <span class="mb-1.5 block text-sm font-medium text-stone-700">
            {{ label }}
            <span v-if="required" class="text-red-600" aria-hidden="true">*</span>
        </span>
        <input
            :id="id"
            :type="type ?? 'text'"
            :value="modelValue ?? ''"
            :required="required"
            :autocomplete="autocomplete"
            class="min-h-11 w-full rounded-xl border bg-white px-3 py-2 text-stone-900 shadow-sm transition placeholder:text-stone-400"
            :class="error ? 'border-red-500' : 'border-stone-300 focus:border-brand-600'"
            :aria-invalid="Boolean(error)"
            :aria-describedby="error ? `${id}-error` : undefined"
            @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
        />
        <span v-if="error" :id="`${id}-error`" class="mt-1 block text-sm text-red-700">
            {{ error }}
        </span>
    </label>
</template>
