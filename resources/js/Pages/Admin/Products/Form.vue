<script setup>
import { ref } from 'vue';
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

const activeTab = ref('basic');
const tabs = [
    { id: 'basic', name: 'Básico' },
    { id: 'price_stock', name: 'Precio e Inventario' },
    { id: 'logistics', name: 'Logística' },
    { id: 'seo_options', name: 'SEO y Opciones' },
];

const form = useForm({
    _method: isEditing ? 'put' : 'post',
    // Basic
    name: props.product?.name || '',
    category_id: props.product?.category_id || '',
    description: props.product?.description || '',
    long_description: props.product?.long_description || '',
    specifications: props.product?.specifications || [],
    images: [],
    delete_images: [],
    documents: [],
    existing_documents: props.product?.documents || [],
    delete_documents: [],
    
    // Price & Stock
    sku: props.product?.sku || '',
    price: props.product?.price || '',
    wholesale_price: props.product?.wholesale_price || '',
    discount_price: props.product?.discount_price || '',
    stock: props.product?.stock || 0,
    variants: props.product?.variants || [],
    delete_variants: [],
    
    // Logistics
    weight: props.product?.weight || 0,
    width: props.product?.width || 0,
    height: props.product?.height || 0,
    depth: props.product?.depth || 0,
    additional_shipping_cost: props.product?.additional_shipping_cost || 0,
    
    // SEO & Options
    meta_title: props.product?.meta_title || '',
    meta_description: props.product?.meta_description || '',
    video_url: props.product?.video_url || '',
    is_active: props.product ? !!props.product.is_active : true,
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
    form.variants.push({ 
        id: null, name: '', sku: '', 
        price: form.price || 0, discount_price: '', wholesale_price: form.wholesale_price || 0,
        stock: 0, 
        weight: form.weight || 0, width: form.width || 0, height: form.height || 0, depth: form.depth || 0,
        additional_shipping_cost: form.additional_shipping_cost || 0,
        attributes: [] 
    });
};

const removeVariant = (index) => {
    const variant = form.variants[index];
    if (variant.id) {
        form.delete_variants.push(variant.id);
    }
    form.variants.splice(index, 1);
};

const addVariantAttribute = (variantIndex) => {
    if (!form.variants[variantIndex].attributes) {
        form.variants[variantIndex].attributes = [];
    }
    form.variants[variantIndex].attributes.push({ name: '', unit: '', value: '' });
};

const removeVariantAttribute = (variantIndex, attrIndex) => {
    form.variants[variantIndex].attributes.splice(attrIndex, 1);
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
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ isEditing ? 'Editar Producto' : 'Nuevo Producto' }}
                </h2>
                <Link :href="route('products.index')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                    Volver al Catálogo
                </Link>
            </div>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <form @submit.prevent="submit" enctype="multipart/form-data">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        
                        <!-- Tabs Navigation -->
                        <div class="border-b border-gray-200">
                            <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                                <button 
                                    v-for="tab in tabs" :key="tab.id"
                                    type="button"
                                    @click="activeTab = tab.id"
                                    :class="[
                                        activeTab === tab.id ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300',
                                        'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors'
                                    ]"
                                >
                                    {{ tab.name }}
                                </button>
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div class="p-8">
                            
                            <!-- TAB: BASIC -->
                            <div v-show="activeTab === 'basic'" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel for="name" value="Nombre del Producto *" />
                                        <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus />
                                        <InputError class="mt-2" :message="form.errors.name" />
                                    </div>
                                    <div>
                                        <InputLabel for="category_id" value="Categoría *" />
                                        <select id="category_id" v-model="form.category_id" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" required>
                                            <option value="" disabled>Selecciona una categoría</option>
                                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                                        </select>
                                        <InputError class="mt-2" :message="form.errors.category_id" />
                                    </div>
                                </div>

                                <div>
                                    <InputLabel for="description" value="Resumen (Descripción Corta)" />
                                    <textarea id="description" v-model="form.description" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" rows="3"></textarea>
                                </div>
                                
                                <div>
                                    <InputLabel for="long_description" value="Descripción Larga (Detallada)" />
                                    <textarea id="long_description" v-model="form.long_description" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" rows="6"></textarea>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <InputLabel for="images" value="Galería de Imágenes" />
                                    <input id="images" type="file" multiple @change="handleImagesChange" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    
                                    <div v-if="props.product?.images?.length" class="mt-4">
                                        <div class="grid grid-cols-4 gap-4">
                                            <div v-for="img in props.product.images" :key="img.id" class="relative group">
                                                <div v-if="form.delete_images.includes(img.id)" class="absolute inset-0 bg-red-500 bg-opacity-50 flex items-center justify-center rounded-lg"><span class="text-white text-xs font-bold">Eliminada</span></div>
                                                <img :src="`/storage/${img.image_url}`" class="w-full h-32 object-cover rounded-lg shadow-sm" alt="Producto" />
                                                <button v-if="!form.delete_images.includes(img.id)" @click.prevent="removeExistingImage(img.id)" class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    &times;
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center mb-2">
                                        <InputLabel value="Ficha Técnica (Especificaciones)" />
                                        <button type="button" @click="addSpecification" class="text-sm font-semibold text-blue-600 hover:text-blue-900">+ Agregar Especificación</button>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-3">
                                        Escribe las características principales que quieres destacar. Estas aparecerán como una lista con viñetas (checkmarks verdes) justo debajo de la descripción corta en la tienda, ideal para resaltar los beneficios más importantes.
                                    </p>
                                    <div v-for="(spec, index) in form.specifications" :key="index" class="flex items-center mb-2">
                                        <TextInput v-model="form.specifications[index]" type="text" class="block w-full text-sm" placeholder="Ej. Eficiencia energética superior" />
                                        <button type="button" @click="removeSpecification(index)" class="ml-2 text-red-500 hover:text-red-700 font-bold">&times;</button>
                                    </div>
                                </div>

                                <div class="pt-4 border-t border-gray-200">
                                    <InputLabel for="documents_upload" value="Documentos Técnicos (PDFs)" />
                                    <p class="text-sm text-gray-500 mb-2 mt-1">
                                        Sube aquí archivos como el Manual de Usuario o Folletos en formato PDF. Estos documentos aparecerán organizados en una pestaña especial para que los clientes puedan descargarlos directamente.
                                    </p>
                                    <input id="documents_upload" type="file" multiple @change="handleDocumentsChange" accept=".pdf,.doc,.docx,.zip" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                    
                                    <div v-if="form.documents.length > 0" class="mt-4 space-y-3">
                                        <div v-for="(doc, index) in form.documents" :key="'new-'+index" class="flex items-center gap-3 bg-gray-50 p-3 rounded-md">
                                            <TextInput v-model="doc.title" type="text" class="block w-full text-sm" placeholder="Título" />
                                            <select v-model="doc.type" class="w-32 border-gray-300 rounded-md text-sm"><option value="manual">Manual</option><option value="tech_sheet">Ficha Técnica</option></select>
                                            <button type="button" @click="removeNewDocument(index)" class="text-red-500">&times;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB: PRICE & STOCK -->
                            <div v-show="activeTab === 'price_stock'" class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    <div>
                                        <InputLabel for="sku" value="SKU / Referencia" />
                                        <TextInput id="sku" v-model="form.sku" type="text" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel for="stock" value="Stock Global" />
                                        <TextInput id="stock" v-model="form.stock" type="number" class="mt-1 block w-full" />
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-gray-200">
                                    <div>
                                        <InputLabel for="wholesale_price" value="Precio de Coste ($)" />
                                        <TextInput id="wholesale_price" v-model="form.wholesale_price" type="number" step="0.01" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel for="price" value="Precio Regular ($)" />
                                        <TextInput id="price" v-model="form.price" type="number" step="0.01" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel for="discount_price" value="Precio Oferta ($)" />
                                        <TextInput id="discount_price" v-model="form.discount_price" type="number" step="0.01" class="mt-1 block w-full" />
                                    </div>
                                </div>

                                <!-- Variants Manager -->
                                <div class="mt-8 pt-6 border-t border-gray-200">
                                    <div class="flex justify-between items-center mb-1">
                                        <h3 class="text-lg font-medium text-gray-900">Variantes y Modelos (Opcional)</h3>
                                        <button type="button" @click="addVariant" class="px-4 py-2 bg-gray-800 text-white text-xs font-semibold rounded-md hover:bg-gray-700">+ Agregar Variante</button>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-4">
                                        Usa las variantes si este producto tiene diferentes modelos (ejemplo: 1 Tonelada, 2 Toneladas). Cada variante generará una pestaña nueva en la página del producto para que el cliente vea los detalles técnicos específicos de ese modelo, tal como funciona en la página principal de tu tienda.
                                    </p>
                                    
                                    <div v-if="form.variants.length === 0" class="text-sm text-gray-500 py-4 text-center bg-gray-50 rounded-md border border-dashed border-gray-300">
                                        No has creado modelos diferentes. La tienda mostrará un producto único usando el precio y la información general que llenaste arriba.
                                    </div>

                                    <div v-else class="space-y-4">
                                        <div v-for="(variant, index) in form.variants" :key="'variant-'+index" class="bg-white p-4 rounded-md border border-gray-300 shadow-sm">
                                            <div class="flex justify-between items-center mb-3 border-b pb-2">
                                                <h4 class="font-medium text-gray-700">Variante #{{ index + 1 }}</h4>
                                                <button type="button" @click="removeVariant(index)" class="text-red-500 text-sm font-bold">Eliminar</button>
                                            </div>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                                <div class="col-span-2">
                                                    <InputLabel value="Nombre (Ej. XL, 1 Tonelada)" />
                                                    <TextInput v-model="variant.name" type="text" class="mt-1 block w-full text-sm" required />
                                                </div>
                                                <div>
                                                    <InputLabel value="SKU Variante" />
                                                    <TextInput v-model="variant.sku" type="text" class="mt-1 block w-full text-sm" />
                                                </div>
                                                <div>
                                                    <InputLabel value="Stock" />
                                                    <TextInput v-model="variant.stock" type="number" class="mt-1 block w-full text-sm" required />
                                                </div>
                                            </div>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 bg-gray-50 p-3 rounded">
                                                <div>
                                                    <InputLabel value="Precio Coste ($)" />
                                                    <TextInput v-model="variant.wholesale_price" type="number" step="0.01" class="mt-1 block w-full text-sm" />
                                                </div>
                                                <div>
                                                    <InputLabel value="Precio Regular ($)" />
                                                    <TextInput v-model="variant.price" type="number" step="0.01" class="mt-1 block w-full text-sm" required />
                                                </div>
                                                <div>
                                                    <InputLabel value="Precio Oferta ($)" />
                                                    <TextInput v-model="variant.discount_price" type="number" step="0.01" class="mt-1 block w-full text-sm" />
                                                </div>
                                            </div>
                                            
                                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 bg-blue-50 p-3 rounded">
                                                <div>
                                                    <InputLabel value="Peso Absoluto (kg)" />
                                                    <TextInput v-model="variant.weight" type="number" step="0.01" class="mt-1 block w-full text-sm" />
                                                </div>
                                                <div>
                                                    <InputLabel value="Ancho (cm)" />
                                                    <TextInput v-model="variant.width" type="number" step="0.01" class="mt-1 block w-full text-sm" />
                                                </div>
                                                <div>
                                                    <InputLabel value="Alto (cm)" />
                                                    <TextInput v-model="variant.height" type="number" step="0.01" class="mt-1 block w-full text-sm" />
                                                </div>
                                                <div>
                                                    <InputLabel value="Profundo (cm)" />
                                                    <TextInput v-model="variant.depth" type="number" step="0.01" class="mt-1 block w-full text-sm" />
                                                </div>
                                                <div>
                                                    <InputLabel value="Costo Extra Envío ($)" />
                                                    <TextInput v-model="variant.additional_shipping_cost" type="number" step="0.01" class="mt-1 block w-full text-sm" />
                                                </div>
                                            </div>
                                            
                                            <!-- Variant Attributes Manager -->
                                            <div class="mt-4 border-t border-gray-200 pt-3">
                                                <div class="flex justify-between items-center mb-1">
                                                    <InputLabel value="Tabla de Especificaciones de este Modelo" />
                                                    <button type="button" @click="addVariantAttribute(index)" class="text-xs font-semibold text-blue-600 hover:text-blue-900">+ Agregar Fila a la Tabla</button>
                                                </div>
                                                <p class="text-xs text-gray-500 mb-3">
                                                    Llena esta tabla con los datos técnicos (ej. Capacidad, Voltaje). Estos datos construirán automáticamente la tabla comparativa que el cliente ve al seleccionar esta pestaña (modelo).
                                                </p>
                                                <div v-if="!variant.attributes || variant.attributes.length === 0" class="text-xs text-gray-500 italic mb-2">
                                                    Este modelo no tiene datos técnicos registrados en su tabla.
                                                </div>
                                                <div v-for="(attr, aIndex) in variant.attributes" :key="'attr-'+index+'-'+aIndex" class="flex items-center gap-2 mb-2 bg-gray-50 p-2 rounded border border-gray-200">
                                                    <div class="w-1/3">
                                                        <TextInput v-model="attr.name" type="text" class="block w-full text-xs" placeholder="Nombre (Ej. CAPACIDAD NOMINAL)" required />
                                                    </div>
                                                    <div class="w-1/4">
                                                        <TextInput v-model="attr.unit" type="text" class="block w-full text-xs" placeholder="Unidad (Ej. TON)" />
                                                    </div>
                                                    <div class="w-1/3">
                                                        <TextInput v-model="attr.value" type="text" class="block w-full text-xs" placeholder="Valor (Ej. 10)" required />
                                                    </div>
                                                    <button type="button" @click="removeVariantAttribute(index, aIndex)" class="text-red-500 hover:text-red-700 font-bold ml-2 px-2">&times;</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TAB: LOGISTICS -->
                            <div v-show="activeTab === 'logistics'" class="space-y-6">
                                
                                <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-md">
                                    <p class="text-sm text-yellow-800">
                                        <strong>Nota Logística:</strong> Si este producto tiene variantes con pesos propios, el sistema usará el peso de la variante al momento del checkout. Si la variante tiene peso 0, heredará estos valores del producto base.
                                    </p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                    <div>
                                        <InputLabel for="weight" value="Peso del Paquete (kg)" />
                                        <TextInput id="weight" v-model="form.weight" type="number" step="0.01" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel for="width" value="Ancho (cm)" />
                                        <TextInput id="width" v-model="form.width" type="number" step="0.01" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel for="height" value="Alto (cm)" />
                                        <TextInput id="height" v-model="form.height" type="number" step="0.01" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel for="depth" value="Profundidad (cm)" />
                                        <TextInput id="depth" v-model="form.depth" type="number" step="0.01" class="mt-1 block w-full" />
                                    </div>
                                </div>

                                <div class="pt-6 border-t border-gray-200">
                                    <div class="max-w-md">
                                        <InputLabel for="additional_shipping_cost" value="Costo Adicional de Envío Fijo ($)" />
                                        <div class="mt-1 relative rounded-md shadow-sm">
                                            <TextInput id="additional_shipping_cost" v-model="form.additional_shipping_cost" type="number" step="0.01" class="block w-full" />
                                        </div>
                                        <p class="mt-2 text-xs text-gray-500">Este cobro se sumará al cálculo del Transportista de forma independiente. Útil para productos muy frágiles o manejo especial.</p>
                                    </div>
                                </div>

                            </div>

                            <!-- TAB: SEO & OPTIONS -->
                            <div v-show="activeTab === 'seo_options'" class="space-y-6">
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="space-y-6">
                                        <div>
                                            <InputLabel for="meta_title" value="Título SEO (Meta Title)" />
                                            <TextInput id="meta_title" v-model="form.meta_title" type="text" class="mt-1 block w-full" placeholder="Título para Google..." />
                                            <p class="text-xs text-gray-500 mt-1">Si se deja vacío, se usará el nombre del producto.</p>
                                        </div>
                                        <div>
                                            <InputLabel for="meta_description" value="Descripción SEO (Meta Description)" />
                                            <textarea id="meta_description" v-model="form.meta_description" class="border-gray-300 focus:border-blue-500 focus:ring-blue-500 rounded-md shadow-sm mt-1 block w-full" rows="4"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="space-y-6">
                                        <div>
                                            <InputLabel for="video_url" value="URL del Video (Ej. YouTube)" />
                                            <TextInput id="video_url" v-model="form.video_url" type="url" class="mt-1 block w-full" placeholder="https://..." />
                                        </div>
                                        <div class="pt-4">
                                            <label class="flex items-center">
                                                <Checkbox v-model:checked="form.is_active" name="is_active" />
                                                <span class="ml-2 text-sm text-gray-900 font-medium">Producto Visible y Activo</span>
                                            </label>
                                            <p class="text-xs text-gray-500 ml-6 mt-1">Si lo desmarcas, no aparecerá en el catálogo de la tienda.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        
                        <!-- Form Actions Footer -->
                        <div class="px-8 py-5 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
                            <Link :href="route('products.index')" class="text-sm font-medium text-gray-700 hover:text-gray-900 mr-4">
                                Cancelar
                            </Link>
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                {{ isEditing ? 'Guardar Cambios' : 'Crear Producto' }}
                            </PrimaryButton>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </AppLayout>
</template>
