<script setup>
import { ref, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';

const props = defineProps({
    order: Object,
});

const page = usePage();

// Form para actualizar el estado general
const statusForm = useForm({
    status: props.order.status,
});

// Form para añadir pago
const paymentForm = useForm({
    payment_method: '',
    amount: '',
    transaction_id: '',
});

// Form para añadir mensaje
const messageForm = useForm({
    message: '',
    is_private: false,
});

// Form para reembolsos
const refundMode = ref(false);
const refundForm = useForm({
    items: props.order.items.map(item => ({
        id: item.id,
        refund_quantity: 0
    })),
    refund_shipping: false,
    restock: true,
});

const toggleRefundMode = () => {
    refundMode.value = !refundMode.value;
    if (!refundMode.value) {
        refundForm.reset();
    }
};

const updateStatus = () => {
    statusForm.put(route('orders.update', props.order.id), {
        preserveScroll: true,
    });
};

const submitPayment = () => {
    paymentForm.post(route('orders.payment', props.order.id), {
        preserveScroll: true,
        onSuccess: () => paymentForm.reset(),
    });
};

const submitMessage = () => {
    messageForm.post(route('orders.message', props.order.id), {
        preserveScroll: true,
        onSuccess: () => messageForm.reset(),
    });
};

const submitRefund = () => {
    if(confirm('¿Estás seguro de procesar este reembolso? Esta acción no se puede deshacer.')) {
        refundForm.post(route('orders.refund', props.order.id), {
            preserveScroll: true,
            onSuccess: () => {
                refundMode.value = false;
                refundForm.reset();
            }
        });
    }
};

// Utils
const statusColors = {
    pending: 'bg-yellow-100 text-yellow-800 border-yellow-200',
    processing: 'bg-blue-100 text-blue-800 border-blue-200',
    shipped: 'bg-indigo-100 text-indigo-800 border-indigo-200',
    delivered: 'bg-green-100 text-green-800 border-green-200',
    cancelled: 'bg-red-100 text-red-800 border-red-200',
    'Reembolso Parcial': 'bg-purple-100 text-purple-800 border-purple-200',
};

const statusLabels = {
    pending: 'Pendiente',
    processing: 'Procesando',
    shipped: 'Enviado',
    delivered: 'Entregado',
    cancelled: 'Cancelado',
    'Reembolso Parcial': 'Reembolso Parcial',
};

const formatDate = (dateString) => {
    if (!dateString) return '';
    return new Date(dateString).toLocaleString('es-MX', {
        year: 'numeric', month: 'short', day: 'numeric',
        hour: '2-digit', minute: '2-digit'
    });
};

const totalPaid = computed(() => {
    if (!props.order.payments) return 0;
    return props.order.payments.reduce((sum, p) => sum + Number(p.amount), 0);
});

const balance = computed(() => {
    return Number(props.order.total_amount) - totalPaid.value - Number(props.order.total_refunded || 0);
});

const printInvoice = () => {
    window.open(route('orders.invoice', props.order.id), '_blank');
};

</script>

<template>
    <AppLayout title="Detalle de Pedido">
        <template #header>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                        Pedido <span class="text-blue-600 font-mono">#{{ String(order.id).padStart(6, '0') }}</span>
                    </h2>
                    <span :class="['px-3 py-1 text-sm font-semibold rounded-full border', statusColors[order.status]]">
                        {{ statusLabels[order.status] || order.status }}
                    </span>
                </div>
                <div class="flex gap-2">
                    <button @click="printInvoice" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-md shadow-sm text-sm font-medium flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Imprimir Factura
                    </button>
                    <Link :href="route('orders.index')" class="bg-gray-800 text-white hover:bg-gray-700 px-4 py-2 rounded-md shadow-sm text-sm font-medium">
                        Volver a Pedidos
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-8 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Resumen Superior -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-center items-center text-center">
                        <span class="text-gray-500 text-sm font-medium">Fecha</span>
                        <span class="text-gray-900 font-bold mt-1">{{ formatDate(order.created_at) }}</span>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-center items-center text-center">
                        <span class="text-gray-500 text-sm font-medium">Total del Pedido</span>
                        <span class="text-gray-900 font-bold text-xl mt-1">${{ Number(order.total_amount).toFixed(2) }}</span>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-center items-center text-center">
                        <span class="text-gray-500 text-sm font-medium">Total Pagado</span>
                        <span class="text-green-600 font-bold text-xl mt-1">${{ totalPaid.toFixed(2) }}</span>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-center items-center text-center">
                        <span class="text-gray-500 text-sm font-medium">Reembolsado</span>
                        <span class="text-purple-600 font-bold text-xl mt-1">${{ Number(order.total_refunded || 0).toFixed(2) }}</span>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200 flex flex-col justify-center items-center text-center">
                        <span class="text-gray-500 text-sm font-medium">Balance</span>
                        <span :class="['font-bold text-xl mt-1', balance > 0 ? 'text-red-600' : 'text-gray-900']">
                            ${{ balance.toFixed(2) }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <!-- COLUMNA IZQUIERDA (Principal) -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- 1. BLOQUE DE ESTADO (Status History) -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-4 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
                                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Estado del Pedido
                                </h3>
                            </div>
                            <div class="p-4">
                                <form @submit.prevent="updateStatus" class="flex gap-4 items-end mb-6">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Actualizar Estado</label>
                                        <select v-model="statusForm.status" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                            <option value="pending">Pendiente</option>
                                            <option value="processing">Procesando</option>
                                            <option value="shipped">Enviado</option>
                                            <option value="delivered">Entregado</option>
                                            <option value="cancelled">Cancelado</option>
                                        </select>
                                    </div>
                                    <button type="submit" :disabled="statusForm.processing" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-sm text-sm font-medium hover:bg-blue-700 disabled:opacity-50">
                                        Actualizar
                                    </button>
                                </form>

                                <!-- Historial -->
                                <div v-if="order.histories && order.histories.length > 0">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Historial de Cambios</h4>
                                    <div class="flow-root">
                                        <ul role="list" class="-mb-8">
                                            <li v-for="(history, hIdx) in order.histories" :key="history.id">
                                                <div class="relative pb-8">
                                                    <span v-if="hIdx !== order.histories.length - 1" class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                                    <div class="relative flex space-x-3">
                                                        <div>
                                                            <span class="h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center ring-8 ring-white">
                                                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                            </span>
                                                        </div>
                                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                            <div>
                                                                <p class="text-sm text-gray-500">
                                                                    Estado cambiado a <span class="font-medium text-gray-900">{{ statusLabels[history.status] || history.status }}</span> 
                                                                    <span v-if="history.user">por {{ history.user.name }}</span>
                                                                </p>
                                                            </div>
                                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                                <time :datetime="history.created_at">{{ formatDate(history.created_at) }}</time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div v-else class="text-sm text-gray-500 italic">No hay historial registrado.</div>
                            </div>
                        </div>

                        <!-- 2. BLOQUE DE PRODUCTOS (Products) -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                            <div class="px-4 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    Productos ({{ order.items.length }})
                                </h3>
                                
                                <button @click="toggleRefundMode" class="text-sm font-medium text-purple-600 hover:text-purple-800 flex items-center gap-1 border border-purple-200 px-3 py-1 rounded bg-purple-50">
                                    <svg v-if="!refundMode" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                    <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    {{ refundMode ? 'Cancelar Reembolso' : 'Reembolso Parcial' }}
                                </button>
                            </div>
                            
                            <!-- Tabla de Productos -->
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-white">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                                            <th v-if="refundMode" scope="col" class="px-6 py-3 text-center text-xs font-bold text-purple-600 uppercase tracking-wider bg-purple-50">Reembolsar</th>
                                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="(item, index) in order.items" :key="item.id" :class="{'hover:bg-gray-50': true, 'bg-red-50': item.quantity_refunded > 0 && !refundMode}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-10 w-10 flex-shrink-0 bg-gray-100 rounded border border-gray-200 flex items-center justify-center overflow-hidden">
                                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ item.product_name }}</div>
                                                        <div class="text-xs text-gray-500">Ref: {{ item.product ? item.product.sku : 'N/A' }}</div>
                                                        <div v-if="item.quantity_refunded > 0" class="text-xs text-red-500 font-medium mt-1">
                                                            - {{ item.quantity_refunded }} Reembolsados
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                ${{ Number(item.price).toFixed(2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold text-center">
                                                x{{ item.quantity }}
                                            </td>
                                            
                                            <!-- Columna extra para Reembolso -->
                                            <td v-if="refundMode" class="px-6 py-4 whitespace-nowrap text-center bg-purple-50">
                                                <input 
                                                    type="number" 
                                                    min="0" 
                                                    :max="item.quantity - item.quantity_refunded" 
                                                    v-model="refundForm.items[index].refund_quantity" 
                                                    class="block w-20 mx-auto border-gray-300 rounded shadow-sm focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                                                    :disabled="item.quantity - item.quantity_refunded <= 0"
                                                >
                                            </td>
                                            
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">
                                                ${{ (item.price * item.quantity).toFixed(2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Panel de Opciones de Reembolso -->
                            <div v-if="refundMode" class="bg-purple-100 px-6 py-4 border-t border-purple-200 flex flex-col items-end gap-3">
                                <div class="w-full lg:w-1/2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" v-model="refundForm.restock" class="rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                                            <span class="text-sm font-medium text-gray-700">Re-abastecer inventario de productos</span>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between mb-4">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" v-model="refundForm.refund_shipping" :disabled="order.total_refunded > 0" class="rounded text-purple-600 focus:ring-purple-500 border-gray-300">
                                            <span class="text-sm font-medium text-gray-700">Reembolsar costo de envío</span>
                                        </label>
                                    </div>
                                    <button 
                                        @click="submitRefund" 
                                        :disabled="refundForm.processing"
                                        class="w-full bg-purple-600 text-white py-2 px-4 rounded font-bold hover:bg-purple-700 focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 disabled:opacity-50"
                                    >
                                        Procesar Reembolso
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Totals Footer (Solo visible si no es modo reembolso) -->
                            <div v-else class="bg-gray-50 px-6 py-4 flex flex-col items-end gap-2 border-t border-gray-200">
                                <div class="flex justify-between w-64 text-sm text-gray-600">
                                    <span>Subtotal:</span>
                                    <span>${{ (order.total_amount - (order.shipping_cost || 0)).toFixed(2) }}</span>
                                </div>
                                <div class="flex justify-between w-64 text-sm text-gray-600">
                                    <span>Costo de Envío:</span>
                                    <span>${{ Number(order.shipping_cost || 0).toFixed(2) }}</span>
                                </div>
                                <div v-if="order.total_refunded > 0" class="flex justify-between w-64 text-sm text-red-600 font-medium">
                                    <span>Total Reembolsado:</span>
                                    <span>-${{ Number(order.total_refunded).toFixed(2) }}</span>
                                </div>
                                <div class="flex justify-between w-64 text-lg font-bold text-gray-900 mt-2 pt-2 border-t border-gray-200">
                                    <span>Total:</span>
                                    <span>${{ Number(order.total_amount).toFixed(2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- 3. BLOQUE DE MENSAJES (Messages) -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-4 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
                                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                                    Mensajes ({{ order.messages ? order.messages.length : 0 }})
                                </h3>
                            </div>
                            <div class="p-4">
                                <div v-if="order.messages && order.messages.length > 0" class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                                    <div v-for="msg in order.messages" :key="msg.id" :class="['p-3 rounded-lg text-sm', msg.is_private ? 'bg-yellow-50 border border-yellow-200' : 'bg-blue-50 border border-blue-200']">
                                        <div class="flex justify-between items-start mb-1">
                                            <span class="font-bold text-gray-900">{{ msg.user ? msg.user.name : 'Sistema/Cliente' }}</span>
                                            <span class="text-xs text-gray-500">{{ formatDate(msg.created_at) }}</span>
                                        </div>
                                        <p class="text-gray-800 whitespace-pre-wrap">{{ msg.message }}</p>
                                        <span v-if="msg.is_private" class="inline-block mt-2 text-xs font-semibold text-yellow-800 bg-yellow-200 px-2 py-0.5 rounded">Nota Privada</span>
                                    </div>
                                </div>

                                <form @submit.prevent="submitMessage" class="bg-gray-50 p-4 rounded-md border border-gray-200">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Añadir Mensaje</label>
                                    <textarea v-model="messageForm.message" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm mb-3" placeholder="Escribe un mensaje aquí..."></textarea>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="is_private" v-model="messageForm.is_private" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="is_private" class="ml-2 block text-sm text-gray-900">Mensaje privado (sólo empleados)</label>
                                        </div>
                                        <button type="submit" :disabled="messageForm.processing || !messageForm.message" class="bg-gray-800 text-white px-4 py-2 rounded-md shadow-sm text-sm font-medium hover:bg-gray-700 disabled:opacity-50">
                                            Enviar Mensaje
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!-- COLUMNA DERECHA (Secundaria) -->
                    <div class="space-y-6">
                        
                        <!-- 4. BLOQUE DEL CLIENTE (Customer) -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-4 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
                                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Cliente
                                </h3>
                            </div>
                            <div class="p-4">
                                <div class="font-bold text-lg text-gray-900 mb-1">{{ order.customer_name }}</div>
                                <a :href="'mailto:'+order.customer_email" class="text-blue-600 text-sm hover:underline flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    {{ order.customer_email }}
                                </a>
                                <div v-if="order.customer_phone" class="text-gray-600 text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    {{ order.customer_phone }}
                                </div>
                                <hr class="my-4 border-gray-100">
                                <div class="text-sm">
                                    <span class="font-semibold text-gray-700 block mb-1">Dirección de Envío / Facturación</span>
                                    <p class="text-gray-600">
                                        {{ order.shipping_address || 'Dirección no proporcionada.' }}<br>
                                        <span v-if="order.shipping_city">{{ order.shipping_city }}, </span>
                                        <span v-if="order.shipping_state">{{ order.shipping_state }}</span>
                                        <span v-if="order.shipping_zip"> CP: {{ order.shipping_zip }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- 5. BLOQUE DE PAGOS (Payments) -->
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                            <div class="px-4 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
                                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                    Pagos
                                </h3>
                            </div>
                            <div class="p-4">
                                <div v-if="order.payments && order.payments.length > 0" class="mb-4">
                                    <table class="min-w-full text-sm divide-y divide-gray-200">
                                        <thead>
                                            <tr>
                                                <th class="text-left py-2 font-medium text-gray-500">Fecha</th>
                                                <th class="text-left py-2 font-medium text-gray-500">Método</th>
                                                <th class="text-right py-2 font-medium text-gray-500">Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            <tr v-for="pay in order.payments" :key="pay.id">
                                                <td class="py-2 text-gray-600">{{ new Date(pay.created_at).toLocaleDateString() }}</td>
                                                <td class="py-2 text-gray-900">{{ pay.payment_method }}</td>
                                                <td :class="['py-2 text-right font-semibold', pay.amount < 0 ? 'text-red-600' : 'text-gray-900']">
                                                    ${{ Number(pay.amount).toFixed(2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div v-else class="text-sm text-gray-500 mb-4 italic">No hay pagos registrados.</div>

                                <!-- Añadir Pago -->
                                <div v-if="balance > 0" class="bg-gray-50 p-3 rounded border border-gray-200">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Añadir Pago</h4>
                                    <form @submit.prevent="submitPayment" class="space-y-3">
                                        <div>
                                            <select v-model="paymentForm.payment_method" class="block w-full text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" required>
                                                <option value="" disabled>Método...</option>
                                                <option>Transferencia Bancaria</option>
                                                <option>Tarjeta de Crédito/Débito</option>
                                                <option>Efectivo</option>
                                                <option>Cheque</option>
                                            </select>
                                        </div>
                                        <div class="flex gap-2">
                                            <input type="number" step="0.01" v-model="paymentForm.amount" class="block w-full text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" placeholder="Monto" required>
                                            <button type="submit" :disabled="paymentForm.processing" class="bg-blue-600 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-blue-700 disabled:opacity-50">
                                                Añadir
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div v-else-if="balance === 0" class="bg-green-50 p-3 rounded border border-green-200 text-green-800 text-sm font-semibold flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Pedido Pagado en su Totalidad
                                </div>
                                <div v-else class="bg-red-50 p-3 rounded border border-red-200 text-red-800 text-sm font-semibold flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Saldo a favor del cliente: ${{ Math.abs(balance).toFixed(2) }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
