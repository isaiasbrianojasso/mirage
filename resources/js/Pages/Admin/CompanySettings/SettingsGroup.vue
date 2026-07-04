<template>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="px-8 py-5 bg-gradient-to-r from-slate-700 to-slate-800 flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center text-white" v-html="icon"></div>
            <div>
                <h3 class="text-white font-bold text-base">{{ title }}</h3>
                <p class="text-slate-300 text-xs">{{ description }}</p>
            </div>
        </div>

        <!-- Form -->
        <form @submit.prevent="submit" class="p-8 space-y-5">
            <div v-for="field in fields" :key="field.key">
                <label :for="field.key" class="block text-sm font-semibold text-gray-700 mb-1.5">
                    {{ field.label }}
                </label>

                <textarea
                    v-if="field.type === 'textarea'"
                    :id="field.key"
                    v-model="form.settings[field.key]"
                    rows="3"
                    :placeholder="field.placeholder || ''"
                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm resize-y"
                ></textarea>

                <input
                    v-else
                    :id="field.key"
                    v-model="form.settings[field.key]"
                    type="text"
                    :placeholder="field.placeholder || ''"
                    class="block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                />

                <p v-if="form.errors[`settings.${field.key}`]" class="text-xs text-red-500 mt-1">
                    {{ form.errors[`settings.${field.key}`] }}
                </p>
            </div>

            <!-- Save -->
            <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                <span v-if="form.recentlySuccessful" class="text-sm text-green-600 font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Guardado.
                </span>
                <button
                    type="submit"
                    :disabled="form.processing"
                    :class="[
                        'flex items-center gap-2 px-6 py-2.5 rounded-xl font-semibold text-sm bg-slate-800 text-white hover:bg-slate-700 transition',
                        { 'opacity-50 cursor-not-allowed': form.processing }
                    ]"
                >
                    <svg v-if="form.processing" class="animate-spin -ml-1 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg v-else class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    Guardar
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    title: String,
    icon: String,
    description: String,
    group: String,
    fields: Array,
    settings: Object,
});

const emit = defineEmits(['saved']);

// Build initial form values from current settings
const initialSettings = {};
props.fields.forEach(field => {
    initialSettings[field.key] = props.settings[field.key]?.value ?? '';
});

const form = useForm({
    group: props.group,
    settings: initialSettings,
});

function submit() {
    form.post(route('company-settings.update'), {
        preserveScroll: true,
        onSuccess: () => emit('saved'),
    });
}
</script>
