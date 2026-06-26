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
    long_description: props.product?.long_description || '',
    specifications: props.product?.specifications || [],
    price: props.product?.price || '',
    discount_price: props.product?.discount_price || '',
    sku: props.product?.sku || '',
    stock: props.product?.stock || 0,
    is_active: props.product ? !!props.product.is_active : true,
    images: [],
    delete_images: [],
    variants: props.product?.variants || [],
    delete_variants: [],
    documents: [],
    existing_documents: props.product?.documents || [],
    delete_documents: [],
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

const addSpecification = () => {
    form.specifications.push('');
};

const removeSpecification = (index) => {
    form.specifications.splice(index, 1);
};

const addVariant = () => {
    form.variants.push({ id: null, name: '', sku: '', price: form.price || 0, discount_price: '', stock: 0, attributes: [] });
};

const removeVariant = (index) => {
    const variant = form.variants[index];
    if (variant.id) {
        form.delete_variants.push(variant.id);
    }
    form.variants.splice(index, 1);
};

const handleDocumentsChange = (e) => {
    Array.from(e.target.files).forEach(file => {
        form.documents.push({
            title: file.name.split('.').slice(0, -1).join('.'),
            type: 'manual',
            file: file,
        });
    });
    e.target.value = '';
};

const removeNewDocument = (index) => {
    form.documents.splice(index, 1);
};

const removeExistingDocument = (docId) => {
    form.delete_documents.push(docId);
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
                                    <InputLabel for="long_description" value="Descripción Larga (Detallada)" />
                                    <textarea id="long_description" v-model="form.long_description" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6"></textarea>
                                    <InputError class="mt-2" :message="form.errors.long_description" />
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

                                <div class="pt-4 border-t border-gray-200">
                                    <InputLabel for="documents_upload" value="Documentos Técnicos (PDFs)" />
                                    <input id="documents_upload" type="file" multiple @change="handleDocumentsChange" accept=".pdf,.doc,.docx,.zip" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    
                                    <div v-if="form.documents.length > 0" class="mt-4 space-y-3">
                                        <p class="text-sm font-medium text-gray-700">Nuevos Documentos:</p>
                                        <div v-for="(doc, index) in form.documents" :key="'new-'+index" class="flex items-center gap-3 bg-gray-50 p-3 rounded-md">
                                            <div class="flex-1">
                                                <TextInput v-model="doc.title" type="text" class="block w-full text-sm" placeholder="Título (Ej. Ficha Técnica)" />
                                            </div>
                                            <div class="w-32">
                                                <select v-model="doc.type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full text-sm">
                                                    <option value="manual">Manual</option>
                                                    <option value="tech_sheet">Ficha Técnica</option>
                                                    <option value="warranty">Garantía</option>
                                                </select>
                                            </div>
                                            <button type="button" @click="removeNewDocument(index)" class="text-red-500 hover:text-red-700">&times;</button>
                                        </div>
                                    </div>

                                    <div v-if="form.existing_documents.length > 0" class="mt-4 space-y-2">
                                        <p class="text-sm font-medium text-gray-700">Documentos Actuales:</p>
                                        <div v-for="doc in form.existing_documents" :key="doc.id" class="flex items-center justify-between bg-white border p-2 rounded-md" :class="{'opacity-50 line-through': form.delete_documents.includes(doc.id)}">
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm font-medium text-gray-700">{{ doc.title }}</span>
                                                <span class="text-xs px-2 py-1 bg-gray-100 rounded-full text-gray-600">{{ doc.type }}</span>
                                            </div>
                                            <button v-if="!form.delete_documents.includes(doc.id)" type="button" @click="removeExistingDocument(doc.id)" class="text-red-500 hover:text-red-700 text-sm">Eliminar</button>
                                            <span v-else class="text-red-500 text-xs font-bold">A eliminar</span>
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

                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center mb-2">
                                        <InputLabel value="Ficha Técnica (Especificaciones)" />
                                        <button type="button" @click="addSpecification" class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">+ Agregar Especificación</button>
                                    </div>
                                    <div v-for="(spec, index) in form.specifications" :key="index" class="flex items-center mb-2">
                                        <TextInput v-model="form.specifications[index]" type="text" class="block w-full text-sm" placeholder="Ej. Eficiencia energética superior" />
                                        <button type="button" @click="removeSpecification(index)" class="ml-2 px-2 py-1 bg-red-100 text-red-600 hover:bg-red-200 rounded-md font-bold" title="Eliminar">&times;</button>
                                    </div>
                                    <InputError class="mt-2" :message="form.errors.specifications" />
                                </div>

                                <div class="block pt-4 border-t border-gray-200">
                                    <label class="flex items-center">
                                        <Checkbox v-model:checked="form.is_active" name="is_active" />
                                        <span class="ml-2 text-sm text-gray-600">Producto Activo (Visible en la tienda)</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Full Width Section for Variants -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-medium text-gray-900">Variantes del Producto (Capacidades, Voltajes)</h3>
                                <button type="button" @click="addVariant" class="px-4 py-2 bg-gray-800 text-white text-xs font-semibold rounded-md hover:bg-gray-700">+ Agregar Variante</button>
                            </div>
                            
                            <div v-if="form.variants.length === 0" class="text-sm text-gray-500 py-4 text-center bg-gray-50 rounded-md border border-dashed border-gray-300">
                                No hay variantes registradas. Este producto se venderá como único usando su precio base.
                            </div>

                            <div v-else class="space-y-4">
                                <div v-for="(variant, index) in form.variants" :key="'variant-'+index" class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <div class="flex justify-between items-center mb-3">
                                        <h4 class="font-medium text-gray-700">Variante #{{ index + 1 }}</h4>
                                        <button type="button" @click="removeVariant(index)" class="text-red-500 hover:text-red-700 text-sm font-bold">Eliminar Variante</button>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div class="col-span-2">
                                            <InputLabel value="Nombre de Variante (Ej. 1 Tonelada 110V)" />
                                            <TextInput v-model="variant.name" type="text" class="mt-1 block w-full" required />
                                        </div>
                                        <div>
                                            <InputLabel value="SKU Variante" />
                                            <TextInput v-model="variant.sku" type="text" class="mt-1 block w-full" />
                                        </div>
                                        <div>
                                            <InputLabel value="Stock" />
                                            <TextInput v-model="variant.stock" type="number" class="mt-1 block w-full" required />
                                        </div>
                                        <div>
                                            <InputLabel value="Precio Regular ($)" />
                                            <TextInput v-model="variant.price" type="number" step="0.01" class="mt-1 block w-full" required />
                                        </div>
                                        <div>
                                            <InputLabel value="Precio Oferta ($)" />
                                            <TextInput v-model="variant.discount_price" type="number" step="0.01" class="mt-1 block w-full" />
                                        </div>
                                    </div>
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
