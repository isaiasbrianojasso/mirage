<script setup>
import { ref, computed, watch } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const props = defineProps({
    customers: Array,
    products: Array,
    zones: Array,
});

const form = useForm({
    user_id: '',
    payment_method: 'Transferencia Bancaria',
    status: 'pending',
    shipping_cost: 0,
    items: [],
    
    // Logística
    delivery_address_id: '',
    invoice_address_id: '',
    carrier_id: '',
    total_weight: 0,
});

// UI State
const searchQuery = ref('');
const selectedCustomer = ref(null);
const customerAddresses = ref([]);
const availableCarriers = ref([]);
const isLoadingCarriers = ref(false);

// Address Modal State
const showAddressModal = ref(false);
const addressForm = ref({
    alias: 'Casa',
    first_name: '',
    last_name: '',
    address1: '',
    address2: '',
    city: '',
    zip_code: '',
    phone: '',
    zone_id: props.zones && props.zones.length > 0 ? props.zones[0].id : ''
});

const filteredProducts = computed(() => {
    if (searchQuery.value === '') return [];
    return props.products.filter(p => 
        p.name.toLowerCase().includes(searchQuery.value.toLowerCase()) || 
        (p.sku && p.sku.toLowerCase().includes(searchQuery.value.toLowerCase()))
    );
});

const selectCustomer = async (event) => {
    const customerId = event.target.value;
    selectedCustomer.value = props.customers.find(c => c.id == customerId);
    form.user_id = customerId;
    
    // Auto-fill address names if creating new
    if (selectedCustomer.value) {
        addressForm.value.first_name = selectedCustomer.value.first_name;
        addressForm.value.last_name = selectedCustomer.value.last_name;
    }
    
    await fetchAddresses(customerId);
};

const fetchAddresses = async (customerId) => {
    try {
        const response = await axios.get(route('api.customers.addresses', customerId));
        customerAddresses.value = response.data;
        if (customerAddresses.value.length > 0) {
            form.delivery_address_id = customerAddresses.value[0].id;
            form.invoice_address_id = customerAddresses.value[0].id;
        } else {
            form.delivery_address_id = '';
            form.invoice_address_id = '';
        }
    } catch (error) {
        console.error("Error fetching addresses:", error);
    }
};

const saveAddress = async () => {
    // Para simplificar en este demo, enviaremos la solicitud de creación de dirección
    // pero como no hicimos la ruta POST para direcciones, simularemos que se crea
    // añadiéndola a la lista local (en producción haríamos un post real a AddressController)
    
    alert('Esta función requiere un AddressController. Por ahora simularemos la creación.');
    const newAddress = {
        id: Date.now(),
        user_id: form.user_id,
        ...addressForm.value
    };
    customerAddresses.value.push(newAddress);
    form.delivery_address_id = newAddress.id;
    form.invoice_address_id = newAddress.id;
    showAddressModal.value = false;
};

const getCustomerDiscount = () => {
    if (selectedCustomer.value && selectedCustomer.value.customer_group) {
        return selectedCustomer.value.customer_group.discount_percentage || 0;
    }
    return 0;
};

const addProduct = (product) => {
    const existing = form.items.find(i => i.product_id === product.id);
    if (existing) {
        existing.quantity += 1;
    } else {
        const discount = getCustomerDiscount();
        const priceWithDiscount = product.price * (1 - (discount / 100));
        
        form.items.push({
            product_id: product.id,
            name: product.name,
            original_price: product.price,
            price: priceWithDiscount,
            manual_price: priceWithDiscount,
            quantity: 1,
            stock: product.stock,
            weight: 1 // default mockup weight
        });
    }
    searchQuery.value = ''; // Reset search
    updateLogistics();
};

const removeItem = (index) => {
    form.items.splice(index, 1);
    updateLogistics();
};

// Calculate Totals
const subtotal = computed(() => {
    return form.items.reduce((total, item) => total + (item.manual_price * item.quantity), 0);
});

const totalWeight = computed(() => {
    return form.items.reduce((total, item) => total + ((item.weight || 1) * item.quantity), 0);
});

const calculateTotal = computed(() => {
    return subtotal.value + Number(form.shipping_cost);
});

// Update Logistics (Fetch Carriers based on Address Zone & Cart)
const updateLogistics = async () => {
    form.total_weight = totalWeight.value;
    
    if (!form.delivery_address_id) {
        availableCarriers.value = [];
        return;
    }
    
    const address = customerAddresses.value.find(a => a.id === form.delivery_address_id);
    if (!address || !address.zone_id) return;
    
    isLoadingCarriers.value = true;
    try {
        const response = await axios.get(route('api.zones.carriers', address.zone_id), {
            params: {
                weight: totalWeight.value,
                price: subtotal.value,
                customer_group_id: selectedCustomer.value?.customer_group_id
            }
        });
        
        availableCarriers.value = response.data;
        
        // Auto-select first carrier if current not in list
        if (availableCarriers.value.length > 0) {
            const exists = availableCarriers.value.find(c => c.id === form.carrier_id);
            if (!exists) {
                selectCarrier(availableCarriers.value[0]);
            } else {
                // update price
                selectCarrier(exists);
            }
        } else {
            form.carrier_id = '';
            form.shipping_cost = 0;
        }
    } catch (error) {
        console.error("Error fetching carriers:", error);
    } finally {
        isLoadingCarriers.value = false;
    }
};

const selectCarrier = (carrier) => {
    form.carrier_id = carrier.id;
    form.shipping_cost = carrier.calculated_price;
};

watch(() => form.delivery_address_id, () => {
    updateLogistics();
});
watch(() => form.items, () => {
    updateLogistics();
}, { deep: true });


const submit = () => {
    form.post(route('orders.store'));
};
</script>

<template>
    <AppLayout title="Añadir Nuevo Pedido">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Añadir Nuevo Pedido Avanzado
                </h2>
                <Link :href="route('orders.index')" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded">
                    Volver a Pedidos
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- Left Column: Customer, Addresses, Products -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- 1. Customer Selection -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">1. Seleccionar Cliente</h3>
                            <select 
                                v-model="form.user_id" 
                                @change="selectCustomer"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md"
                            >
                                <option value="" disabled>Busca un cliente por nombre o email...</option>
                                <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                    {{ customer.first_name }} {{ customer.last_name }} ({{ customer.email }})
                                </option>
                            </select>
                            
                            <div v-if="selectedCustomer" class="mt-4 p-4 bg-gray-50 rounded-md border border-gray-200 flex justify-between items-center">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ selectedCustomer.first_name }} {{ selectedCustomer.last_name }}</p>
                                    <p class="text-sm text-gray-500">{{ selectedCustomer.email }}</p>
                                </div>
                                <div v-if="getCustomerDiscount() > 0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Descuento VIP: {{ getCustomerDiscount() }}%
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Addresses -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" :class="{ 'opacity-50 pointer-events-none': !form.user_id }">
                            <div class="flex justify-between items-center mb-4 border-b pb-2">
                                <h3 class="text-lg font-medium text-gray-900">2. Direcciones</h3>
                                <button type="button" @click="showAddressModal = true" class="text-sm text-blue-600 hover:text-blue-800 font-medium bg-blue-50 px-3 py-1 rounded">
                                    + Añadir Dirección
                                </button>
                            </div>
                            
                            <div v-if="customerAddresses.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Dirección de Entrega</label>
                                    <select v-model="form.delivery_address_id" class="mt-1 block w-full border-gray-300 rounded-md sm:text-sm">
                                        <option v-for="addr in customerAddresses" :key="addr.id" :value="addr.id">
                                            {{ addr.alias }} - {{ addr.address1 }}, {{ addr.city }}
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Dirección de Facturación</label>
                                    <select v-model="form.invoice_address_id" class="mt-1 block w-full border-gray-300 rounded-md sm:text-sm">
                                        <option v-for="addr in customerAddresses" :key="addr.id" :value="addr.id">
                                            {{ addr.alias }} - {{ addr.address1 }}, {{ addr.city }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div v-else class="text-center py-4 text-sm text-gray-500 italic bg-yellow-50 rounded border border-yellow-200">
                                Este cliente no tiene direcciones guardadas. Crea una para continuar.
                            </div>
                        </div>

                        <!-- 3. Product Search & Cart -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" :class="{ 'opacity-50 pointer-events-none': !form.user_id }">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">3. Carrito y Productos</h3>
                            
                            <!-- Search -->
                            <div class="relative rounded-md shadow-sm mb-4">
                                <input type="text" v-model="searchQuery" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md p-2 border" placeholder="Buscar producto por nombre...">
                                <div v-if="filteredProducts.length > 0" class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-60 rounded-md py-1 overflow-auto text-sm">
                                    <ul role="listbox">
                                        <li v-for="product in filteredProducts" :key="product.id" @click="addProduct(product)" class="cursor-pointer py-2 px-3 hover:bg-blue-600 hover:text-white flex justify-between">
                                            <span>{{ product.name }}</span>
                                            <span>${{ product.price }} (Stock: {{ product.stock }})</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Cart Table -->
                            <div class="mt-4 border rounded-md overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase">
                                        <tr>
                                            <th class="px-4 py-2 text-left">Producto</th>
                                            <th class="px-4 py-2 text-left">Precio</th>
                                            <th class="px-4 py-2 text-left">Cant.</th>
                                            <th class="px-4 py-2 text-left">Total</th>
                                            <th class="px-4 py-2"></th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr v-if="form.items.length === 0">
                                            <td colspan="5" class="px-4 py-6 text-center text-gray-500 text-sm">Carrito vacío.</td>
                                        </tr>
                                        <tr v-for="(item, index) in form.items" :key="index">
                                            <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ item.name }}</td>
                                            <td class="px-4 py-3 text-sm">
                                                <input type="number" step="0.01" v-model="item.manual_price" class="w-20 sm:text-sm border-gray-300 rounded-md p-1 border">
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                <input type="number" min="1" v-model="item.quantity" class="w-16 sm:text-sm border-gray-300 rounded-md p-1 border">
                                            </td>
                                            <td class="px-4 py-3 text-sm font-semibold">${{ (item.manual_price * item.quantity).toFixed(2) }}</td>
                                            <td class="px-4 py-3 text-right"><button @click.prevent="removeItem(index)" class="text-red-600 hover:text-red-900 text-xs">Eliminar</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Shipping, Summary & Payment -->
                    <div class="space-y-6">
                        
                        <!-- 4. Shipping -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6" :class="{ 'opacity-50 pointer-events-none': !form.delivery_address_id }">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">4. Envío</h3>
                            
                            <div v-if="isLoadingCarriers" class="text-center py-4 text-sm text-gray-500">Calculando transportistas...</div>
                            <div v-else>
                                <div v-if="availableCarriers.length > 0" class="space-y-3">
                                    <label v-for="carrier in availableCarriers" :key="carrier.id" class="flex items-center justify-between p-3 border rounded-md cursor-pointer hover:bg-gray-50" :class="{'border-blue-500 bg-blue-50': form.carrier_id === carrier.id}">
                                        <div class="flex items-center">
                                            <input type="radio" :value="carrier.id" v-model="form.carrier_id" @change="selectCarrier(carrier)" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                            <div class="ml-3">
                                                <span class="block text-sm font-medium text-gray-900">{{ carrier.name }}</span>
                                                <span class="block text-xs text-gray-500">{{ carrier.transit_time || 'Estándar' }}</span>
                                            </div>
                                        </div>
                                        <span class="text-sm font-bold text-gray-900">{{ carrier.calculated_price == 0 ? '¡Gratis!' : '$' + carrier.calculated_price }}</span>
                                    </label>
                                </div>
                                <div v-else-if="form.delivery_address_id && form.items.length > 0" class="text-red-600 text-sm bg-red-50 p-3 rounded border border-red-200">
                                    No hay transportistas disponibles para esta dirección o rango de pesos.
                                </div>
                                <div v-else class="text-gray-500 text-sm italic">
                                    Agrega productos y selecciona una dirección para ver transportistas.
                                </div>
                            </div>
                        </div>

                        <!-- 5. Summary & Payment -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 sticky top-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">5. Resumen y Pago</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Método de Pago</label>
                                    <select v-model="form.payment_method" class="mt-1 block w-full border-gray-300 rounded-md sm:text-sm">
                                        <option>Transferencia Bancaria</option>
                                        <option>Efectivo (Contra Reembolso)</option>
                                        <option>Tarjeta de Crédito (Manual)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Estado del Pedido</label>
                                    <select v-model="form.status" class="mt-1 block w-full border-gray-300 rounded-md sm:text-sm">
                                        <option value="pending">Pendiente</option>
                                        <option value="processing">Procesando</option>
                                        <option value="paid">Pagado</option>
                                    </select>
                                </div>

                                <hr class="my-4 border-gray-200">

                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Subtotal ({{ form.items.reduce((s,i)=>s+i.quantity, 0) }} art)</span>
                                    <span class="text-gray-900 font-medium">${{ subtotal.toFixed(2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm mt-2">
                                    <span class="text-gray-500">Envío (Peso: {{ totalWeight }}kg)</span>
                                    <span class="text-gray-900 font-medium">${{ Number(form.shipping_cost).toFixed(2) }}</span>
                                </div>
                                <div class="flex justify-between items-center text-lg font-bold mt-4">
                                    <span class="text-gray-900">Total</span>
                                    <span class="text-blue-600">${{ calculateTotal.toFixed(2) }}</span>
                                </div>

                                <button @click="submit" :disabled="form.processing || form.items.length === 0 || !form.user_id" class="w-full mt-6 bg-blue-600 text-white py-3 px-4 rounded-md font-medium hover:bg-blue-700 disabled:opacity-50 transition">
                                    {{ form.processing ? 'Procesando...' : 'Crear Pedido' }}
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Address Modal (Mockup for simplicity) -->
        <div v-if="showAddressModal" class="fixed z-50 inset-0 overflow-y-auto bg-gray-500 bg-opacity-75 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <h3 class="text-lg font-bold mb-4">Añadir Dirección Rápida</h3>
                <div class="space-y-4">
                    <input type="text" v-model="addressForm.alias" placeholder="Alias (Ej. Casa)" class="w-full border-gray-300 rounded text-sm">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" v-model="addressForm.first_name" placeholder="Nombre" class="w-full border-gray-300 rounded text-sm">
                        <input type="text" v-model="addressForm.last_name" placeholder="Apellido" class="w-full border-gray-300 rounded text-sm">
                    </div>
                    <input type="text" v-model="addressForm.address1" placeholder="Dirección 1" class="w-full border-gray-300 rounded text-sm">
                    <input type="text" v-model="addressForm.city" placeholder="Ciudad" class="w-full border-gray-300 rounded text-sm">
                    <div class="grid grid-cols-2 gap-2">
                        <input type="text" v-model="addressForm.zip_code" placeholder="C.P." class="w-full border-gray-300 rounded text-sm">
                        <select v-model="addressForm.zone_id" class="w-full border-gray-300 rounded text-sm">
                            <option v-for="z in zones" :key="z.id" :value="z.id">{{ z.name }}</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button @click="showAddressModal = false" class="px-4 py-2 border rounded text-sm font-medium">Cancelar</button>
                    <button @click="saveAddress" class="px-4 py-2 bg-blue-600 text-white rounded text-sm font-medium">Guardar y Asignar</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
