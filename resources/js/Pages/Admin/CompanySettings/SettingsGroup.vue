<template>
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <!-- Header -->
        <div class="px-8 py-6 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center" v-html="icon"></div>
                <div>
                    <h3 class="text-lg font-bold text-gray-900">{{ title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">{{ description }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form @submit.prevent="submit" class="p-8">
            <div class="space-y-6 sm:space-y-5">
                <template v-for="(field, index) in fields" :key="field.key">
                    <div v-if="!field.showIf || field.showIf(form.settings)" 
                         class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-gray-100"
                         :class="{ 'sm:border-t sm:pt-5': index > 0 }">
                        
                        <label :for="field.key" class="block text-sm font-semibold text-gray-700 sm:mt-px sm:pt-2 mb-1.5 sm:mb-0">
                            {{ field.label }}
                        </label>

                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <textarea
                                v-if="field.type === 'textarea'"
                                :id="field.key"
                                v-model="form.settings[field.key]"
                                rows="3"
                                :placeholder="field.placeholder || ''"
                                class="block w-full max-w-2xl rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm resize-y"
                            ></textarea>

                            <select
                                v-else-if="field.type === 'select'"
                                :id="field.key"
                                v-model="form.settings[field.key]"
                                class="block w-full max-w-md rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            >
                                <option v-for="opt in field.options" :key="opt.value" :value="opt.value">
                                    {{ opt.label }}
                                </option>
                            </select>

                            <div v-else-if="field.type === 'image'" class="space-y-3">
                                <div v-if="getPreview(field)" class="relative inline-block border border-gray-200 rounded-xl overflow-hidden bg-gray-50 group">
                                    <img 
                                        :src="getPreview(field)" 
                                        class="h-32 object-contain" 
                                        alt="Preview" 
                                    />
                                    <button 
                                        v-if="typeof form.settings[field.key] !== 'string' || form.settings[field.key]"
                                        type="button" 
                                        @click="clearImage(field.key)" 
                                        class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none shadow-sm opacity-0 group-hover:opacity-100 transition-opacity"
                                        title="Remover imagen"
                                    >
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                                <input
                                    :id="field.key"
                                    type="file"
                                    accept="image/*"
                                    @input="handleFileChange($event, field.key)"
                                    class="block w-full text-sm text-slate-500
                                        file:mr-4 file:py-2.5 file:px-4
                                        file:rounded-xl file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-indigo-50 file:text-indigo-700
                                        hover:file:bg-indigo-100 transition"
                                />
                            </div>

                            <div v-else-if="field.type === 'color'" class="flex items-center gap-3">
                                <div class="relative overflow-hidden rounded-lg w-10 h-10 border border-gray-200 shadow-sm flex-shrink-0">
                                    <input
                                        :id="field.key + '_color'"
                                        type="color"
                                        v-model="form.settings[field.key]"
                                        class="absolute -top-2 -left-2 w-16 h-16 cursor-pointer"
                                    />
                                </div>
                                <input
                                    :id="field.key"
                                    type="text"
                                    v-model="form.settings[field.key]"
                                    :placeholder="field.placeholder || '#000000'"
                                    class="block w-full max-w-[140px] rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm font-mono uppercase"
                                />
                            </div>

                            <input
                                v-else
                                :id="field.key"
                                v-model="form.settings[field.key]"
                                :type="field.type || 'text'"
                                :placeholder="field.placeholder || ''"
                                class="block w-full max-w-2xl rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                            />

                            <p v-if="form.errors[`settings.${field.key}`]" class="text-xs text-red-500 mt-1.5 font-medium">
                                {{ form.errors[`settings.${field.key}`] }}
                            </p>
                        </div>
                    </div>
                </template>
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
import { ref } from 'vue';
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

const imagePreviews = ref({});

// Build initial form values from current settings
const initialSettings = {};
props.fields.forEach(field => {
    initialSettings[field.key] = props.settings[field.key]?.value ?? '';
});

const form = useForm({
    group: props.group,
    settings: initialSettings,
});

function getPreview(field) {
    if (imagePreviews.value[field.key]) {
        return imagePreviews.value[field.key];
    }
    const val = form.settings[field.key];
    if (typeof val === 'string' && val.trim() !== '') {
        return val;
    }
    if (field.placeholder && (field.placeholder.startsWith('http') || field.placeholder.startsWith('/'))) {
        return field.placeholder;
    }
    return null;
}

function handleFileChange(event, key) {
    const file = event.target.files[0];
    if (file) {
        form.settings[key] = file;
        imagePreviews.value[key] = URL.createObjectURL(file);
    }
}

function clearImage(key) {
    form.settings[key] = '';
    imagePreviews.value[key] = null;
    const input = document.getElementById(key);
    if (input) input.value = '';
}

function submit() {
    form.post(route('company-settings.update'), {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            emit('saved');
            imagePreviews.value = {};
            props.fields.forEach(field => {
                form.settings[field.key] = props.settings[field.key]?.value ?? '';
            });
        },
    });
}
</script>
