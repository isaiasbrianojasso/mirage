<script setup>
import { ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    carrier: Object,
    zones: Array,
    customerGroups: Array,
    carrierRanges: Array,
    carrierZonePrices: Array,
    carrierCustomerGroups: Array
});

const isEditing = !!props.carrier;

// Preparar Rangos iniciales
const initialRanges = [];
if (isEditing && props.carrierRanges.length > 0) {
    props.carrierRanges.forEach(cr => {
        const prices = {};
        props.carrierZonePrices.filter(czp => czp.carrier_range_id === cr.id).forEach(czp => {
            prices[czp.zone_id] = czp.price;
        });
        initialRanges.push({
            id: cr.id,
            delimiter1: cr.delimiter1,
            delimiter2: cr.delimiter2,
            prices: prices
        });
    });
} else {
    // Rango por defecto si está vacío
    const defaultPrices = {};
    props.zones.forEach(z => { defaultPrices[z.id] = 0; });
    initialRanges.push({ id: Date.now(), delimiter1: 0, delimiter2: 0, prices: defaultPrices });
}

const form = useForm({
    name: props.carrier?.name || '',
    transit_time: props.carrier?.transit_time || '',
    speed_grade: props.carrier?.speed_grade || 0,
    tracking_url: props.carrier?.tracking_url || '',
    is_free: props.carrier?.is_free || false,
    active: props.carrier?.active ?? true,
    logo: null,
    
    // Configuración avanzada
    billing_behavior: props.carrier?.billing_behavior || 'price',
    out_of_range_behavior: props.carrier?.out_of_range_behavior || 'highest_range',
    max_width: props.carrier?.max_width || null,
    max_height: props.carrier?.max_height || null,
    max_depth: props.carrier?.max_depth || null,
    max_weight: props.carrier?.max_weight || null,
    
    // Relaciones serializadas a JSON
    customer_groups: isEditing ? JSON.stringify(props.carrierCustomerGroups) : JSON.stringify(props.customerGroups.map(g => g.id)),
    ranges: JSON.stringify(initialRanges),
});

// UI State
const currentStep = ref(1);
const logoPreview = ref(props.carrier?.logo_path ? '/storage/' + props.carrier.logo_path : null);

// Reactividad temporal para trabajar en el frontend antes de serializar
const selectedCustomerGroups = ref(isEditing ? props.carrierCustomerGroups : props.customerGroups.map(g => g.id));
const ranges = ref(initialRanges);

const handleLogoChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        form.logo = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            logoPreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const addRange = () => {
    const defaultPrices = {};
    props.zones.forEach(z => { defaultPrices[z.id] = 0; });
    
    // Obtener el delimiter2 del último rango como delimiter1 del nuevo
    const lastRange = ranges.value[ranges.value.length - 1];
    const newDelimiter1 = lastRange ? lastRange.delimiter2 : 0;
    
    ranges.value.push({
        id: Date.now(),
        delimiter1: newDelimiter1,
        delimiter2: Number(newDelimiter1) + 10,
        prices: defaultPrices
    });
};

const removeRange = (index) => {
    if (ranges.value.length > 1) {
        ranges.value.splice(index, 1);
    }
};

const nextStep = () => {
    if (currentStep.value < 4) currentStep.value++;
};

const prevStep = () => {
    if (currentStep.value > 1) currentStep.value--;
};

const submit = () => {
    // Sincronizar UI State con form inputs
    form.customer_groups = JSON.stringify(selectedCustomerGroups.value);
    form.ranges = JSON.stringify(ranges.value);

    if (isEditing) {
        form.post(route('carriers.update', props.carrier.id), {
            preserveScroll: true,
            forceFormData: true,
            transform: (data) => ({
                ...data,
                _method: 'put'
            }),
        });
    } else {
        form.post(route('carriers.store'), {
            preserveScroll: true,
            forceFormData: true,
        });
    }
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Transportista' : 'Añadir Transportista'">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ isEditing ? 'Editar Transportista' : 'Añadir Nuevo Transportista' }}
                </h2>
                <Link :href="route('carriers.index')" class="bg-gray-800 text-white hover:bg-gray-700 px-4 py-2 rounded-md shadow-sm text-sm font-medium">
                    Cancelar
                </Link>
            </div>
        </template>

        <div class="py-8 bg-gray-50 min-h-screen">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Wizard Progress Bar -->
                <nav aria-label="Progress" class="mb-8">
                    <ol role="list" class="flex items-center justify-between">
                        <li v-for="step in 4" :key="step" :class="[
                            'relative w-full text-center border-t-4 py-2 font-medium text-sm',
                            currentStep === step ? 'border-blue-600 text-blue-600' : 
                            (currentStep > step ? 'border-blue-300 text-blue-500' : 'border-gray-200 text-gray-400')
                        ]">
                            <span v-if="step === 1">1. Parámetros Generales</span>
                            <span v-if="step === 2">2. Lugares y Costos</span>
                            <span v-if="step === 3">3. Tamaño, Peso y Acceso</span>
                            <span v-if="step === 4">4. Resumen</span>
                        </li>
                    </ol>
                </nav>

                <form @submit.prevent="submit" class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    
                    <!-- PASO 1: GENERAL -->
                    <div v-show="currentStep === 1" class="p-6 space-y-6">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-2">Parámetros Generales</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre del Transportista <span class="text-red-500">*</span></label>
                                    <input type="text" v-model="form.name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Ej: DHL Express">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tiempo de Tránsito</label>
                                    <input type="text" v-model="form.transit_time" placeholder="Ej: 24 a 48 horas" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Se mostrará al cliente al hacer el checkout.</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Grado de Velocidad (0 - 9)</label>
                                    <input type="number" min="0" max="9" v-model="form.speed_grade" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">URL de Rastreo</label>
                                    <input type="url" v-model="form.tracking_url" placeholder="Ej: http://www.fedex.com/Tracking?ascend_header=1&clienttype=dotcom&cntry_code=us&language=english&tracknumbers=@" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Usa '@' donde deba ir el número de guía.</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Logo del Transportista</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md bg-gray-50 hover:bg-gray-100 transition h-48">
                                    <div class="space-y-1 text-center self-center">
                                        <div v-if="logoPreview" class="mb-4">
                                            <img :src="logoPreview" class="mx-auto h-24 object-contain" alt="Logo preview">
                                        </div>
                                        <svg v-else class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2 py-1">
                                                <span>Subir Logo</span>
                                                <input type="file" class="sr-only" accept="image/*" @change="handleLogoChange">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PASO 2: LUGARES Y COSTOS -->
                    <div v-show="currentStep === 2" class="p-6 space-y-6">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-2">Lugares de envío y costos</h3>
                        
                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg flex items-start gap-4">
                            <input type="checkbox" v-model="form.is_free" class="mt-1 h-5 w-5 text-blue-600 focus:ring-blue-500 border-blue-300 rounded">
                            <div>
                                <label class="font-bold text-blue-900">Envío Gratuito</label>
                                <p class="text-sm text-blue-700">Si activas esto, el transportista será completamente gratis y no se cobrarán tarifas por zona ni por rango.</p>
                            </div>
                        </div>

                        <div v-if="!form.is_free" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Facturación</label>
                                    <div class="mt-2 space-y-2">
                                        <label class="flex items-center">
                                            <input type="radio" v-model="form.billing_behavior" value="price" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">De acuerdo al precio total</span>
                                        </label>
                                        <label class="flex items-center">
                                            <input type="radio" v-model="form.billing_behavior" value="weight" class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <span class="ml-2 text-sm text-gray-700">De acuerdo al peso total</span>
                                        </label>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Comportamiento fuera de rango</label>
                                    <select v-model="form.out_of_range_behavior" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                        <option value="highest_range">Aplicar el costo del rango más alto</option>
                                        <option value="disable">Desactivar transportista</option>
                                    </select>
                                </div>
                            </div>

                            <div class="border border-gray-200 rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                                    <h4 class="font-bold text-gray-700">Rangos ({{ form.billing_behavior === 'price' ? '$' : 'kg' }}) y Tarifas por Zona</h4>
                                    <button type="button" @click="addRange" class="text-sm font-medium text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1 rounded border border-blue-200">
                                        + Añadir Nuevo Rango
                                    </button>
                                </div>
                                
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-white">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Zona</th>
                                                <th v-for="(range, index) in ranges" :key="range.id" class="px-4 py-3 text-center bg-gray-50 border-l border-gray-200">
                                                    <div class="flex flex-col gap-1 items-center">
                                                        <div class="flex items-center gap-2">
                                                            <span class="text-xs text-gray-500">>=</span>
                                                            <input type="number" step="0.01" v-model="range.delimiter1" class="w-20 text-xs border-gray-300 rounded py-1">
                                                        </div>
                                                        <div class="flex items-center gap-2">
                                                            <span class="text-xs text-gray-500"><</span>
                                                            <input type="number" step="0.01" v-model="range.delimiter2" class="w-20 text-xs border-gray-300 rounded py-1">
                                                        </div>
                                                        <button v-if="ranges.length > 1" type="button" @click="removeRange(index)" class="mt-2 text-xs text-red-600 hover:text-red-800">
                                                            Eliminar
                                                        </button>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 bg-white">
                                            <tr v-for="zone in zones" :key="zone.id">
                                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ zone.name }}</td>
                                                <td v-for="range in ranges" :key="range.id" class="px-4 py-3 text-center border-l border-gray-200">
                                                    <div class="relative rounded-md shadow-sm">
                                                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 text-xs">$</span>
                                                        </div>
                                                        <input type="number" step="0.01" v-model="range.prices[zone.id]" class="w-24 pl-6 text-sm border-gray-300 rounded py-1">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr v-if="zones.length === 0">
                                                <td :colspan="ranges.length + 1" class="px-4 py-6 text-center text-gray-500 italic">
                                                    No hay zonas creadas. Ve al menú de Zonas primero.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PASO 3: TAMAÑO, PESO Y ACCESO -->
                    <div v-show="currentStep === 3" class="p-6 space-y-6">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-2">Tamaño, Peso y Acceso al Grupo</h3>
                        
                        <div>
                            <h4 class="font-medium text-gray-800 mb-3">Límites Máximos del Paquete</h4>
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-700">Anchura máxima (cm)</label>
                                    <input type="number" step="0.01" v-model="form.max_width" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700">Altura máxima (cm)</label>
                                    <input type="number" step="0.01" v-model="form.max_height" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700">Profundidad máxima (cm)</label>
                                    <input type="number" step="0.01" v-model="form.max_depth" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-700">Peso máximo (kg)</label>
                                    <input type="number" step="0.01" v-model="form.max_weight" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Si dejas el campo vacío o en 0, no habrá límite.</p>
                        </div>

                        <div class="border-t pt-4">
                            <h4 class="font-medium text-gray-800 mb-3">Acceso de Grupos</h4>
                            <p class="text-sm text-gray-600 mb-4">Marca los grupos de clientes a los que quieres dar acceso a este transportista.</p>
                            
                            <div class="space-y-2">
                                <label v-for="group in customerGroups" :key="group.id" class="flex items-center p-3 border rounded-md hover:bg-gray-50 cursor-pointer">
                                    <input type="checkbox" :value="group.id" v-model="selectedCustomerGroups" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-3 font-medium text-gray-900">{{ group.name }}</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- PASO 4: RESUMEN -->
                    <div v-show="currentStep === 4" class="p-6 space-y-6">
                        <h3 class="text-xl font-bold text-gray-900 border-b pb-2">Resumen</h3>
                        
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <p class="text-gray-700 mb-4 text-lg">
                                El transportista <strong>{{ form.name || '[Nombre sin definir]' }}</strong> está 
                                <span v-if="form.active" class="text-green-600 font-bold">Activo</span>
                                <span v-else class="text-red-600 font-bold">Inactivo</span>.
                            </p>
                            
                            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                                <li v-if="form.is_free">Este transportista entregará de forma <strong>gratuita</strong>.</li>
                                <li v-else>
                                    Este transportista calculará el costo de envío dependiendo del 
                                    <strong>{{ form.billing_behavior === 'price' ? 'Precio Total' : 'Peso Total' }}</strong> del pedido.
                                </li>
                                
                                <li v-if="!form.is_free">
                                    Si el pedido está fuera de los rangos definidos, 
                                    <strong>{{ form.out_of_range_behavior === 'highest_range' ? 'se aplicará el costo del rango más alto' : 'se desactivará el transportista' }}</strong>.
                                </li>
                                
                                <li>
                                    Estará disponible para los grupos: 
                                    <strong>{{ customerGroups.filter(g => selectedCustomerGroups.includes(g.id)).map(g => g.name).join(', ') || 'Ninguno' }}</strong>.
                                </li>
                            </ul>
                        </div>
                        
                        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg flex items-center justify-between">
                            <span class="font-medium text-blue-900">¿Todo listo? Haz clic en finalizar para guardar el transportista.</span>
                        </div>
                    </div>
                    
                    <!-- Navegación del Wizard -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-between">
                        <button type="button" @click="prevStep" :disabled="currentStep === 1" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-md shadow-sm text-sm font-medium disabled:opacity-50">
                            Anterior
                        </button>
                        
                        <button v-if="currentStep < 4" type="button" @click="nextStep" class="bg-blue-600 border border-transparent text-white hover:bg-blue-700 px-4 py-2 rounded-md shadow-sm text-sm font-medium">
                            Siguiente
                        </button>
                        
                        <button v-if="currentStep === 4" type="submit" :disabled="form.processing" class="bg-green-600 border border-transparent text-white hover:bg-green-700 px-6 py-2 rounded-md shadow-sm text-sm font-bold disabled:opacity-50 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Finalizar y Guardar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </AppLayout>
</template>
