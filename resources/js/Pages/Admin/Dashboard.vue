<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

defineProps({
    metrics: Object,
    recent_orders: Array,
    recent_distributors: Array,
});

const statusColors = {
    pending: 'bg-gray-100 text-gray-800 border border-gray-200',
    processing: 'bg-blue-50 text-blue-700 border border-blue-200',
    shipped: 'bg-indigo-50 text-indigo-700 border border-indigo-200',
    delivered: 'bg-green-50 text-green-700 border border-green-200',
    cancelled: 'bg-red-50 text-red-700 border border-red-200',
};

const statusLabels = {
    pending: 'Pendiente',
    processing: 'Procesando',
    shipped: 'Enviado',
    delivered: 'Entregado',
    cancelled: 'Cancelado',
};

const paymentStatusColors = {
    pending: 'bg-gray-100 text-gray-800 border border-gray-200',
    paid: 'bg-black text-white border border-gray-900',
    failed: 'bg-red-50 text-red-700 border border-red-200',
    refunded: 'bg-gray-100 text-gray-500 border border-gray-200',
};

const paymentStatusLabels = {
    pending: 'Pendiente',
    paid: 'Pagado',
    failed: 'Fallido',
    refunded: 'Reembolsado',
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('es-MX', {
        month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit'
    });
};

const isLoaded = ref(false);

onMounted(() => {
    setTimeout(() => {
        isLoaded.value = true;
    }, 50);
});
</script>

<template>
    <AppLayout title="Panel de Control">
        
        <!-- Aesthetic Clean Background -->
        <div class="min-h-screen bg-gray-50/50 text-gray-900 font-sans">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
                
                <!-- Welcome Header -->
                <div :class="['transition-all duration-700 transform border-b border-gray-200 pb-6', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-2']">
                    <h1 class="text-3xl font-semibold tracking-tight text-gray-900 mb-1">
                        Resumen Ejecutivo
                    </h1>
                    <p class="text-gray-500 text-sm">Métricas de rendimiento y actividad reciente.</p>
                </div>

                <!-- KPI Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    
                    <!-- Ventas del Mes -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 50ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Ingresos del Mes</span>
                            <span class="text-xs font-medium text-gray-900 bg-gray-100 px-2 py-0.5 rounded-full border border-gray-200">Mes Actual</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">${{ Number(metrics.total_sales || 0).toLocaleString('es-MX', {minimumFractionDigits: 2}) }}</h3>
                    </div>

                    <!-- Total de Pedidos -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 75ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Total Pedidos</span>
                            <span class="text-xs font-medium text-gray-900 bg-gray-100 px-2 py-0.5 rounded-full border border-gray-200">Mes Actual</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">{{ metrics.total_orders || 0 }}</h3>
                    </div>

                    <!-- Ticket Promedio -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 100ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Ticket Promedio</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">${{ Number(metrics.average_ticket || 0).toLocaleString('es-MX', {minimumFractionDigits: 2}) }}</h3>
                    </div>

                    <!-- Órdenes Activas -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 125ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Órdenes Activas</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">{{ metrics.active_orders }}</h3>
                    </div>

                    <!-- Total Clientes -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 150ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Clientes Totales</span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">{{ metrics.total_customers }}</h3>
                    </div>

                    <!-- Alertas Stock -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200 relative overflow-hidden', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 200ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Bajo Inventario</span>
                            <span v-if="metrics.low_stock_products > 0" class="flex h-2.5 w-2.5 relative">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                            </span>
                        </div>
                        <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">{{ metrics.low_stock_products }}</h3>
                    </div>
                </div>

                <!-- Ventas Recientes (Clean Table) -->
                <div :class="['bg-white border border-gray-200 rounded-2xl shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] overflow-hidden transition-all duration-500', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 250ms;">
                    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-base font-semibold text-gray-900 tracking-tight">Ventas Recientes</h3>
                        <Link :href="route('orders.index')" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">
                            Ver todas →
                        </Link>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50/50 text-gray-500 font-medium border-b border-gray-100">
                                <tr>
                                    <th scope="col" class="px-5 py-3 font-medium">Orden</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Cliente</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Monto</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Pago</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Envío</th>
                                    <th scope="col" class="px-5 py-3 font-medium text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="order in recent_orders" :key="order.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4">
                                        <div class="font-medium text-gray-900">
                                            #{{ String(order.id).padStart(4, '0') }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="font-medium text-gray-900">{{ order.customer_name }}</div>
                                        <div class="text-gray-400 text-xs mt-0.5">{{ formatDate(order.created_at) }}</div>
                                    </td>
                                    <td class="px-5 py-4 font-medium text-gray-900">
                                        ${{ Number(order.total_amount).toFixed(2) }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span v-if="order.payment_status" :class="['px-2.5 py-1 inline-flex text-xs font-medium rounded-md', paymentStatusColors[order.payment_status]]">
                                            {{ paymentStatusLabels[order.payment_status] }}
                                        </span>
                                        <span v-else class="text-xs text-gray-400">N/A</span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span :class="['px-2.5 py-1 inline-flex text-xs font-medium rounded-md', statusColors[order.status]]">
                                            {{ statusLabels[order.status] }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <Link :href="route('orders.show', order.id)" class="text-gray-500 hover:text-black font-medium transition-colors">
                                            Detalles
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="recent_orders.length === 0">
                                    <td colspan="6" class="px-5 py-10 text-center text-gray-400">
                                        No hay órdenes recientes.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Distribuidores Recientes (MVP) -->
                <div :class="['bg-white border border-gray-200 rounded-2xl shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] overflow-hidden transition-all duration-500 mt-8', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 300ms;">
                    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-base font-semibold text-gray-900 tracking-tight">Distribuidores Recientes</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50/50 text-gray-500 font-medium border-b border-gray-100">
                                <tr>
                                    <th scope="col" class="px-5 py-3 font-medium">Nombre</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Ciudad/Estado</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Teléfono</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Tipo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="distributor in recent_distributors" :key="distributor.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4 font-medium text-gray-900">
                                        {{ distributor.name }}
                                    </td>
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ distributor.city || 'N/A' }}, {{ distributor.state || 'N/A' }}
                                    </td>
                                    <td class="px-5 py-4 text-gray-600">
                                        {{ distributor.phone || 'N/A' }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="px-2.5 py-1 inline-flex text-xs font-medium rounded-md bg-gray-100 text-gray-800 border border-gray-200 capitalize">
                                            {{ distributor.type }}
                                        </span>
                                    </td>
                                </tr>
                                <tr v-if="!recent_distributors || recent_distributors.length === 0">
                                    <td colspan="4" class="px-5 py-10 text-center text-gray-400">
                                        No hay distribuidores registrados.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
