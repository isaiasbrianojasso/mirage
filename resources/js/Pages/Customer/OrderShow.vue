<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    order: Object,
});

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
                    Pedido #{{ String(order.id).padStart(5, '0') }}
                </h2>
                <Link :href="route('customer.orders')" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Volver a mis pedidos
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Columna Izquierda: Items -->
                    <div class="md:col-span-2 space-y-6">
                        
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Productos</h3>
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
                                    Total Pagado: ${{ Number(order.total_amount).toFixed(2) }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Columna Derecha: Envio -->
                    <div class="space-y-6">
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Dirección de Envío</h3>
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6 text-sm text-gray-900">
                                {{ order.shipping_address }}<br>
                                {{ order.shipping_city }}, {{ order.shipping_state }}<br>
                                CP: {{ order.shipping_zip }}
                            </div>
                            <div class="border-t border-gray-200 px-4 py-5 sm:px-6 text-sm text-gray-600 bg-gray-50">
                                <strong>Teléfono de contacto:</strong> {{ order.customer_phone }}<br>
                                <strong>Fecha de compra:</strong> {{ formatDate(order.created_at) }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
