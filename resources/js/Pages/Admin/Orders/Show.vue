<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    order: Object,
});

const form = useForm({
    status: props.order.status,
    payment_status: props.order.payment_status || 'pending',
});

const updateStatus = () => {
    form.put(route('orders.update', props.order.id), {
        preserveScroll: true,
    });
};

const statusColors = {
    pending: 'bg-yellow-100 text-yellow-800',
    processing: 'bg-blue-100 text-blue-800',
    shipped: 'bg-indigo-100 text-indigo-800',
    delivered: 'bg-green-100 text-green-800',
    cancelled: 'bg-red-100 text-red-800',
};

const statusLabels = {
    pending: 'Pendiente',
    processing: 'Procesando',
    shipped: 'Enviado',
    delivered: 'Entregado',
    cancelled: 'Cancelado',
};

const paymentMethodLabels = {
    card: 'Tarjeta Crédito/Débito',
    transfer: 'Transferencia Bancaria',
    cash: 'Efectivo',
};

const shippingMethodLabels = {
    local_pickup: 'Recoger en Sucursal',
    home_delivery: 'Envío a Domicilio',
};

const paymentStatusColors = {
    pending: 'bg-yellow-100 text-yellow-800',
    paid: 'bg-green-100 text-green-800',
    failed: 'bg-red-100 text-red-800',
    refunded: 'bg-gray-100 text-gray-800',
};

const paymentStatusLabels = {
    pending: 'Pendiente',
    paid: 'Pagado',
    failed: 'Fallido',
    refunded: 'Reembolsado',
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('es-MX', {
        year: 'numeric', month: 'long', day: 'numeric',
        hour: '2-digit', minute: '2-digit'
    });
};
</script>

<template>
    <AppLayout title="Detalle de Pedido">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detalle de Pedido #{{ String(order.id).padStart(5, '0') }}
                </h2>
                <Link :href="route('orders.index')" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Volver a pedidos
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Columna Izquierda: Detalles e Items -->
                    <div class="md:col-span-2 space-y-6">
                        
                        <!-- Lista de Productos -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Productos Ordenados</h3>
                                <span :class="['px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full', statusColors[order.status]]">
                                    {{ statusLabels[order.status] }}
                                </span>
                            </div>
                            <div class="border-t border-gray-200">
                                <ul role="list" class="divide-y divide-gray-200">
                                    <li v-for="item in order.items" :key="item.id" class="px-4 py-4 sm:px-6 flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ item.product_name }}</div>
                                                <div class="text-sm text-gray-500">Cantidad: {{ item.quantity }} x ${{ Number(item.price).toFixed(2) }}</div>
                                            </div>
                                        </div>
                                        <div class="text-sm font-bold text-gray-900">
                                            ${{ (item.quantity * item.price).toFixed(2) }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-end">
                                <div class="text-lg font-extrabold text-gray-900">
                                    Total: ${{ Number(order.total_amount).toFixed(2) }}
                                </div>
                            </div>
                        </div>

                        <!-- Notas del Cliente -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg" v-if="order.notes">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Notas del Cliente</h3>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6 text-sm text-gray-600">
                                {{ order.notes }}
                            </div>
                        </div>
                    </div>

                    <!-- Columna Derecha: Cliente y Estado -->
                    <div class="space-y-6">
                        
                        <!-- Actualizar Estado -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Actualizar Estado</h3>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                                <form @submit.prevent="updateStatus">
                                    <label class="block text-sm font-medium text-gray-700">Estado del Pedido (Envío)</label>
                                    <select v-model="form.status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                        <option value="pending">Pendiente</option>
                                        <option value="processing">Procesando</option>
                                        <option value="shipped">Enviado</option>
                                        <option value="delivered">Entregado</option>
                                        <option value="cancelled">Cancelado</option>
                                    </select>

                                    <label class="block text-sm font-medium text-gray-700 mt-4">Estado del Pago</label>
                                    <select v-model="form.payment_status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                        <option value="pending">Pendiente</option>
                                        <option value="paid">Pagado</option>
                                        <option value="failed">Fallido</option>
                                        <option value="refunded">Reembolsado</option>
                                    </select>
                                    <button type="submit" :disabled="form.processing" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Guardar Cambio
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Info Cliente -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Datos del Cliente</h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500">Información de contacto y envío.</p>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ order.customer_name }}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Email</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2"><a :href="'mailto:'+order.customer_email" class="text-indigo-600">{{ order.customer_email }}</a></dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Teléfono</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ order.customer_phone }}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Dirección</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ order.shipping_address }}<br>
                                            {{ order.shipping_city }}, {{ order.shipping_state }}<br>
                                            CP: {{ order.shipping_zip }}
                                        </dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Fecha de Orden</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ formatDate(order.created_at) }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        <!-- Pagos y Envíos -->
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Pagos y Envíos</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Detalles de cobro y logística.</p>
                                </div>
                                <span v-if="order.payment_status" :class="['px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full', paymentStatusColors[order.payment_status]]">
                                    Pago: {{ paymentStatusLabels[order.payment_status] }}
                                </span>
                            </div>
                            <div class="border-t border-gray-200">
                                <dl>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Método de Pago</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ paymentMethodLabels[order.payment_method] || order.payment_method || 'N/A' }}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">ID de Transacción</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ order.transaction_id || 'N/A' }}</dd>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Método de Envío</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ shippingMethodLabels[order.shipping_method] || order.shipping_method || 'N/A' }}</dd>
                                    </div>
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500">Costo de Envío</dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">${{ Number(order.shipping_cost || 0).toFixed(2) }}</dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
