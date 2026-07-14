<template>
    <AppLayout :title="isEditing ? 'Editar Banner' : 'Nuevo Banner'">
        <template #header>
            <div class="flex items-center gap-3">
                <Link :href="route('banners.index')" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </Link>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ isEditing ? 'Editar Banner' : 'Nuevo Banner' }}
                </h2>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    
                    <!-- Form Header -->
                    <div class="px-8 py-6 bg-gradient-to-r from-indigo-600 to-purple-600">
                        <p class="text-indigo-100 text-sm">
                            Los banners son las imágenes grandes que aparecen en la página principal (carrusel) y van pasando automáticamente. Puedes usarlos para mostrar promociones, nuevos productos o anuncios importantes.
                        </p>
                    </div>

                    <form @submit.prevent="submit" class="p-8 space-y-6" enctype="multipart/form-data">

                        <!-- Título -->
                        <div>
                            <InputLabel for="title" value="Nombre o Título del Banner" class="text-sm font-semibold text-gray-700 mb-1.5" />
                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                class="mt-1 block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Ej: Promoción Buen Fin, Lanzamiento Mini Split, etc."
                                required
                            />
                            <p class="text-xs text-gray-500 mt-1">
                                Este título es solo para que tú lo identifiques en la lista, no se mostrará en la imagen de la tienda.
                            </p>
                            <InputError :message="form.errors.title" class="mt-2" />
                        </div>

                        <!-- URL de Enlace -->
                        <div>
                            <InputLabel for="link_url" value="¿A dónde quieres que lleve el banner al darle clic? (Opcional)" class="text-sm font-semibold text-gray-700 mb-1.5" />
                            <div class="relative">
                                <TextInput
                                    id="link_url"
                                    v-model="form.link_url"
                                    type="text"
                                    class="mt-1 block w-full rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Ej: https://tiendamirage.mx/promociones"
                                />
                            </div>
                            <p class="text-xs text-gray-500 mt-1">
                                Si quieres que los clientes vayan a una página de un producto en específico al tocar la imagen, pega aquí ese enlace. Si lo dejas vacío, la imagen será solo visual y no hará nada al darle clic.
                            </p>
                            <InputError :message="form.errors.link_url" class="mt-2" />
                        </div>

                        <!-- Orden -->
                        <div>
                            <InputLabel for="order" value="Lugar de aparición" class="text-sm font-semibold text-gray-700 mb-1.5" />
                            <TextInput
                                id="order"
                                v-model="form.order"
                                type="number"
                                min="0"
                                class="mt-1 block w-32 rounded-xl border-gray-200 focus:border-indigo-500 focus:ring-indigo-500"
                            />
                            <p class="text-xs text-gray-500 mt-1">
                                Indica qué número de imagen será en el carrusel (Ej: Si pones 1, será la primera imagen en salir. Si pones 2, saldrá después de la primera).
                            </p>
                            <InputError :message="form.errors.order" class="mt-2" />
                        </div>

                        <!-- Imagen -->
                        <div>
                            <InputLabel for="image" value="Imagen del Banner" class="text-sm font-semibold text-gray-700 mb-1.5" />
                            
                            <!-- Current image preview -->
                            <div v-if="isEditing && banner.image_url && !previewUrl" class="mb-4 rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                                <div class="relative aspect-video bg-gray-50">
                                    <img :src="banner.image_url" :alt="banner.title" class="w-full h-full object-cover" />
                                    <div class="absolute bottom-2 left-2 bg-black/60 text-white text-xs font-medium px-2 py-1 rounded">Imagen actual</div>
                                </div>
                            </div>

                            <!-- New image preview -->
                            <div v-if="previewUrl" class="mb-4 rounded-xl overflow-hidden border-2 border-indigo-200 shadow-sm">
                                <div class="relative aspect-video bg-gray-50">
                                    <img :src="previewUrl" alt="Vista previa" class="w-full h-full object-cover" />
                                    <div class="absolute bottom-2 left-2 bg-indigo-600/80 text-white text-xs font-medium px-2 py-1 rounded">Nueva imagen</div>
                                    <button type="button" @click="removePreview" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Drop zone -->
                            <label
                                for="image"
                                class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-indigo-50 hover:border-indigo-400 transition-all group"
                            >
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-8 h-8 text-gray-400 group-hover:text-indigo-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-sm text-gray-500 group-hover:text-indigo-600 transition">
                                        <span class="font-semibold">Haz click</span> o arrastra la imagen aquí
                                    </p>
                                    <p class="text-xs text-gray-400">PNG, JPG, WEBP hasta 2MB</p>
                                </div>
                                <input id="image" type="file" class="hidden" accept="image/*" :required="!isEditing" @change="handleImageChange" />
                            </label>
                            <InputError :message="form.errors.image" class="mt-2" />
                        </div>

                        <!-- Estado Activo -->
                        <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                            <button
                                type="button"
                                @click="form.is_active = !form.is_active"
                                :class="form.is_active ? 'bg-indigo-600' : 'bg-gray-300'"
                                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none"
                            >
                                <span :class="form.is_active ? 'translate-x-6' : 'translate-x-1'" class="inline-block h-4 w-4 rounded-full bg-white shadow transition-transform"/>
                            </button>
                            <label class="text-sm font-medium text-gray-700 cursor-pointer select-none" @click="form.is_active = !form.is_active">
                                <span v-if="form.is_active" class="text-indigo-600">Banner Visible en Tienda</span>
                                <span v-else class="text-gray-400">Banner Apagado (Oculto)</span>
                            </label>
                        </div>
                        <p class="text-xs text-gray-500 -mt-2">
                            Puedes apagar el banner en lugar de borrarlo, por si quieres volver a encenderlo en el futuro (ej. en el próximo Buen Fin).
                        </p>

                        <!-- Buttons -->
                        <div class="flex items-center gap-4 pt-2">
                            <Link :href="route('banners.index')" class="flex-1 text-center py-3 border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition text-sm">
                                Cancelar
                            </Link>
                            <PrimaryButton
                                :class="['flex-1 justify-center py-3 rounded-xl font-semibold text-sm', { 'opacity-50 cursor-not-allowed': form.processing }]"
                                :disabled="form.processing"
                            >
                                <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ isEditing ? 'Guardar Cambios' : 'Crear Banner' }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    banner: {
        type: Object,
        default: () => ({}),
    },
});

const isEditing = computed(() => !!props.banner?.id);
const previewUrl = ref(null);

const form = useForm({
    _method: isEditing.value ? 'PUT' : 'POST',
    title: props.banner?.title || '',
    link_url: props.banner?.link_url || '',
    order: props.banner?.order ?? 0,
    is_active: props.banner?.is_active ?? true,
    image: null,
});

function handleImageChange(e) {
    const file = e.target.files[0];
    if (!file) return;
    form.image = file;
    previewUrl.value = URL.createObjectURL(file);
}

function removePreview() {
    previewUrl.value = null;
    form.image = null;
}

const submit = () => {
    if (isEditing.value) {
        form.post(route('banners.update', props.banner.id));
    } else {
        form.post(route('banners.store'));
    }
};
</script>
