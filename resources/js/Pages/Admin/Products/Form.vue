<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
    product: {
        type: Object,
        default: null
    },
    categories: Array,
});

const isEditing = !!props.product;

const form = useForm({
    _method: isEditing ? 'put' : 'post',
    name: props.product?.name || '',
    category_id: props.product?.category_id || '',
    description: props.product?.description || '',
    price: props.product?.price || '',
    discount_price: props.product?.discount_price || '',
    sku: props.product?.sku || '',
    stock: props.product?.stock || 0,
    is_active: props.product ? !!props.product.is_active : true,
    images: [],
    delete_images: [],
});

const submit = () => {
    if (isEditing) {
        form.post(route('products.update', props.product.id), {
            preserveScroll: true,
        });
    } else {
        form.post(route('products.store'), {
            preserveScroll: true,
        });
    }
};

const handleImagesChange = (e) => {
    form.images = Array.from(e.target.files);
};

const removeExistingImage = (imageId) => {
    form.delete_images.push(imageId);
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Producto' : 'Nuevo Producto'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditing ? 'Editar Producto' : 'Nuevo Producto' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <InputLabel for="name" value="Nombre del Producto" />
                                    <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus />
                                    <InputError class="mt-2" :message="form.errors.name" />
                                </div>

                                <div>
                                    <InputLabel for="category_id" value="Categoría" />
                                    <select id="category_id" v-model="form.category_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                        <option value="" disabled>Selecciona una categoría</option>
                                        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                            {{ cat.name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.category_id" />
                                </div>

                                <div>
                                    <InputLabel for="description" value="Descripción" />
                                    <textarea id="description" v-model="form.description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="5"></textarea>
                                    <InputError class="mt-2" :message="form.errors.description" />
                                </div>
                                
                                <div>
                                    <InputLabel for="images" value="Galería de Imágenes" />
                                    <input id="images" type="file" multiple @change="handleImagesChange" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                    <InputError class="mt-2" :message="form.errors.images" />
                                    
                                    <div v-if="props.product?.images?.length" class="mt-4">
                                        <p class="text-sm text-gray-500 mb-2">Imágenes Actuales:</p>
                                        <div class="grid grid-cols-3 gap-2">
                                            <div v-for="img in props.product.images" :key="img.id" class="relative group">
                                                <div v-if="form.delete_images.includes(img.id)" class="absolute inset-0 bg-red-500 bg-opacity-50 flex items-center justify-center rounded-lg">
                                                    <span class="text-white text-xs font-bold">Eliminada</span>
                                                </div>
                                                <img :src="`/storage/${img.image_url}`" class="w-full h-24 object-cover rounded-lg shadow-sm" alt="Producto" />
                                                <button v-if="!form.delete_images.includes(img.id)" @click.prevent="removeExistingImage(img.id)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <InputLabel for="price" value="Precio Regular ($)" />
                                        <TextInput id="price" v-model="form.price" type="number" step="0.01" class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.price" />
                                    </div>
                                    <div>
                                        <InputLabel for="discount_price" value="Precio Oferta ($)" />
                                        <TextInput id="discount_price" v-model="form.discount_price" type="number" step="0.01" class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.discount_price" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <InputLabel for="sku" value="SKU / Código" />
                                        <TextInput id="sku" v-model="form.sku" type="text" class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.sku" />
                                    </div>
                                    <div>
                                        <InputLabel for="stock" value="Stock" />
                                        <TextInput id="stock" v-model="form.stock" type="number" class="mt-1 block w-full" />
                                        <InputError class="mt-2" :message="form.errors.stock" />
                                    </div>
                                </div>

                                <div class="block pt-4">
                                    <label class="flex items-center">
                                        <Checkbox v-model:checked="form.is_active" name="is_active" />
                                        <span class="ml-2 text-sm text-gray-600">Producto Activo (Visible en la tienda)</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-8 border-t pt-4 border-gray-200">
                            <Link :href="route('products.index')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                                Cancelar
                            </Link>

                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ isEditing ? 'Actualizar' : 'Guardar' }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
