<template>
    <AppLayout title="Configuración de la Tienda">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ⚙️ Configuración de la Tienda
            </h2>
        </template>

        <div class="py-10">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <!-- Success Banner -->
                <div v-if="$page.props.flash?.success" class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ $page.props.flash.success }}</span>
                </div>

                <!-- ===== NOMBRE DEL NEGOCIO ===== -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-5 bg-gradient-to-r from-slate-700 to-slate-800 flex items-center gap-3">
                        <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center text-lg">🏪</div>
                        <div>
                            <h3 class="text-white font-bold text-base">Identidad del Negocio</h3>
                            <p class="text-slate-300 text-xs">Nombre y logo que aparecen en la tienda</p>
                        </div>
                    </div>

                    <form @submit.prevent="submit" class="p-8 space-y-6" enctype="multipart/form-data">
                        
                        <!-- Nombre -->
                        <div>
                            <InputLabel for="name" value="Nombre del Negocio" class="text-sm font-semibold text-gray-700 mb-1.5"/>
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base"
                                placeholder="Ej: Mi Tienda"
                                required
                            />
                            <p class="text-xs text-gray-400 mt-1.5">Este nombre aparece en el SEO y en el `alt` del logo.</p>
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <!-- Logo -->
                        <div>
                            <InputLabel for="logo" value="Logotipo de la Tienda" class="text-sm font-semibold text-gray-700 mb-1.5"/>

                            <!-- Current logo -->
                            <div class="mb-4 p-4 bg-gray-50 rounded-xl border border-gray-100 flex items-center gap-4">
                                <div class="w-20 h-20 bg-white rounded-xl border border-gray-200 flex items-center justify-center overflow-hidden shadow-sm flex-shrink-0">
                                    <img
                                        v-if="previewUrl || setting.logo_path"
                                        :src="previewUrl || setting.logo_path"
                                        alt="Logo"
                                        class="w-full h-full object-contain p-1"
                                        @error="e => e.target.parentElement.innerHTML = '<span class=\'text-gray-300 text-3xl\'>🏪</span>'"
                                    />
                                    <span v-else class="text-gray-300 text-3xl">🏪</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-700">{{ previewUrl ? 'Nueva imagen seleccionada' : (setting.logo_path ? 'Logo actual' : 'Sin logo configurado') }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ previewUrl ? 'Guarda los cambios para aplicar.' : 'Sube una imagen para reemplazar.' }}</p>
                                    <button v-if="previewUrl" type="button" @click="removePreview" class="text-xs text-red-500 hover:text-red-700 mt-1 transition">
                                        ✕ Quitar nueva imagen
                                    </button>
                                </div>
                            </div>

                            <!-- Drop zone -->
                            <label
                                for="logo"
                                class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-indigo-50 hover:border-indigo-400 transition-all group"
                            >
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-7 h-7 text-gray-400 group-hover:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 group-hover:text-indigo-600 transition font-medium">Subir nuevo logo</p>
                                    <p class="text-xs text-gray-400">PNG, JPG, SVG — recomendado: fondo transparente</p>
                                </div>
                                <input id="logo" type="file" class="hidden" accept="image/*" @change="handleLogoChange" />
                            </label>
                            <InputError :message="form.errors.logo" class="mt-2" />
                        </div>

                        <!-- Email de contacto -->
                        <div>
                            <InputLabel for="email" value="Email de Contacto" class="text-sm font-semibold text-gray-700 mb-1.5"/>
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base"
                                placeholder="Ej: contacto@midominio.com"
                            />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>

                        <!-- Teléfono de contacto -->
                        <div>
                            <InputLabel for="phone" value="Teléfono" class="text-sm font-semibold text-gray-700 mb-1.5"/>
                            <TextInput
                                id="phone"
                                v-model="form.phone"
                                type="text"
                                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base"
                                placeholder="Ej: +52 123 456 7890"
                            />
                            <InputError :message="form.errors.phone" class="mt-2" />
                        </div>

                        <!-- Slogan -->
                        <div>
                            <InputLabel for="slogan" value="Slogan (Lema)" class="text-sm font-semibold text-gray-700 mb-1.5"/>
                            <TextInput
                                id="slogan"
                                v-model="form.slogan"
                                type="text"
                                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500 text-base"
                                placeholder="Ej: Innovación en tu hogar"
                            />
                            <InputError :message="form.errors.slogan" class="mt-2" />
                        </div>

                        <!-- Save button -->
                        <div class="flex items-center justify-end gap-4 pt-2 border-t border-gray-100">
                            <ActionMessage :on="form.recentlySuccessful" class="text-sm text-green-600 font-medium">
                                ✅ Cambios guardados correctamente.
                            </ActionMessage>
                            <PrimaryButton
                                :class="['px-6 py-2.5 rounded-xl font-semibold text-sm', { 'opacity-50 cursor-not-allowed': form.processing }]"
                                :disabled="form.processing"
                            >
                                <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                💾 Guardar Configuración
                            </PrimaryButton>
                        </div>
                    </form>
                </div>

                <!-- ===== INFO ADICIONAL ===== -->
                <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6">
                    <h4 class="font-semibold text-indigo-800 mb-3 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        ¿Dónde se usan estos datos?
                    </h4>
                    <ul class="text-sm text-indigo-700 space-y-2">
                        <li class="flex items-start gap-2"><span class="text-indigo-400 mt-0.5">•</span> El <strong>logo</strong> aparece en el encabezado de todas las páginas de la tienda.</li>
                        <li class="flex items-start gap-2"><span class="text-indigo-400 mt-0.5">•</span> El <strong>nombre</strong> se muestra en el atributo `alt` del logo y en los metadatos de SEO.</li>
                        <li class="flex items-start gap-2"><span class="text-indigo-400 mt-0.5">•</span> Los cambios se aplican <strong>inmediatamente</strong> en toda la tienda al guardar.</li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ActionMessage from '@/Components/ActionMessage.vue';

const props = defineProps({
    setting: Object,
});

const previewUrl = ref(null);

const form = useForm({
    name: props.setting?.name || 'Mi Tienda',
    logo: null,
    email: props.setting?.email || '',
    phone: props.setting?.phone || '',
    slogan: props.setting?.slogan || '',
});

function handleLogoChange(e) {
    const file = e.target.files[0];
    if (!file) return;
    form.logo = file;
    previewUrl.value = URL.createObjectURL(file);
}

function removePreview() {
    previewUrl.value = null;
    form.logo = null;
}

const submit = () => {
    form.post(route('settings.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('logo');
            previewUrl.value = null;
        },
    });
};
</script>
