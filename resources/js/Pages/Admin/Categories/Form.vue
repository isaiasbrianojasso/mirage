<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
    category: {
        type: Object,
        default: null
    },
    parentCategories: {
        type: Array,
        default: () => []
    }
});

const isEditing = !!props.category;

const form = useForm({
    _method: isEditing ? 'put' : 'post',
    name: props.category?.name || '',
    description: props.category?.description || '',
    parent_id: props.category?.parent_id || '',
    is_active: props.category ? !!props.category.is_active : true,
    image: null,
});

const submit = () => {
    if (isEditing) {
        form.post(route('categories.update', props.category.id), {
            preserveScroll: true,
        });
    } else {
        form.post(route('categories.store'), {
            preserveScroll: true,
        });
    }
};

const handleImageChange = (e) => {
    form.image = e.target.files[0];
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Categoría' : 'Nueva Categoría'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditing ? 'Editar Categoría' : 'Nueva Categoría' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <InputLabel for="name" value="Nombre de la Categoría o Subcategoría" />
                                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" placeholder="Ej. Refrigerador, Mini Bar, etc." required autofocus autocomplete="name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div>
                                <InputLabel for="parent_id" value="¿Pertenece a otra categoría? (Opcional)" />
                                <select id="parent_id" v-model="form.parent_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    <option value="">-- Ninguna (Es una categoría principal) --</option>
                                    <option v-for="parent in parentCategories" :key="parent.id" :value="parent.id">
                                        {{ parent.name }}
                                    </option>
                                </select>
                                <p class="mt-2 text-sm text-gray-500">
                                    Si dejas esto en "Ninguna", crearás una categoría grande (Ejemplo: <b>Refrigerador</b>).<br>
                                    Si seleccionas otra de la lista, crearás una subcategoría. (Ejemplo: para crear <b>Mini Bar</b>, escribe ese nombre arriba y aquí selecciona <b>Refrigerador</b>).
                                </p>
                                <InputError class="mt-2" :message="form.errors.parent_id" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Descripción" />
                                <textarea id="description" v-model="form.description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="4"></textarea>
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div>
                                <InputLabel for="image" value="Imagen de la Categoría" />
                                <input id="image" type="file" @change="handleImageChange" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                <InputError class="mt-2" :message="form.errors.image" />
                                <div v-if="props.category?.image_url && !form.image" class="mt-4">
                                    <p class="text-sm text-gray-500 mb-2">Imagen Actual:</p>
                                    <img :src="`/storage/${props.category.image_url}`" class="w-32 h-32 object-cover rounded-lg shadow-sm" alt="Categoría" />
                                </div>
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox v-model:checked="form.is_active" name="is_active" />
                                    <span class="ml-2 text-sm text-gray-600">Categoría Activa (Visible en la tienda)</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4 border-t border-gray-200 pt-4">
                                <Link :href="route('categories.index')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                                    Cancelar
                                </Link>

                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    {{ isEditing ? 'Actualizar' : 'Guardar' }}
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
