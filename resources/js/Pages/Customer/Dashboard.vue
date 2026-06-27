<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

defineProps({
    metrics: Object,
    recent_orders: Array,
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

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('es-MX', {
        month: 'short', day: 'numeric', year: 'numeric'
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
    <AppLayout title="Mi Cuenta">
        
        <!-- Aesthetic Clean Background -->
        <div class="min-h-screen bg-gray-50/50 text-gray-900 font-sans">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
                
                <!-- Welcome Header -->
                <div :class="['transition-all duration-700 transform border-b border-gray-200 pb-6', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-2']">
                    <h1 class="text-3xl font-semibold tracking-tight text-gray-900 mb-1">
                        Hola, {{ $page.props.auth.user.name }}
                    </h1>
                    <p class="text-gray-500 text-sm">Bienvenido a tu panel de control.</p>
                </div>

                <!-- KPI Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    
                    <!-- Mis Pedidos -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200 flex flex-col justify-between', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 50ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Total de Pedidos</span>
                        </div>
                        <div class="flex items-end justify-between">
                            <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">{{ metrics.total_orders }}</h3>
                            <Link :href="route('customer.orders')" class="text-sm font-medium text-black hover:underline transition-all">Ver historial</Link>
                        </div>
                    </div>

                    <!-- Wishlist -->
                    <div :class="['bg-white border border-gray-200 rounded-2xl p-5 shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] hover:shadow-[0_4px_12px_-4px_rgba(0,0,0,0.08)] transition-all duration-200 flex flex-col justify-between', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 100ms;">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm font-medium text-gray-500">Lista de Deseos</span>
                        </div>
                        <div class="flex items-end justify-between">
                            <h3 class="text-2xl font-semibold text-gray-900 tracking-tight">{{ metrics.wishlist_count }}</h3>
                            <Link :href="route('wishlist.index')" class="text-sm font-medium text-black hover:underline transition-all">Ver lista</Link>
                        </div>
                    </div>
                </div>

                <!-- Ventas Recientes (Clean Table) -->
                <div :class="['bg-white border border-gray-200 rounded-2xl shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] overflow-hidden transition-all duration-500', isLoaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4']" style="transition-delay: 150ms;">
                    <div class="px-5 py-4 border-b border-gray-100 flex justify-between items-center bg-white">
                        <h3 class="text-base font-semibold text-gray-900 tracking-tight">Pedidos Recientes</h3>
                        <Link :href="route('customer.orders')" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition-colors">
                            Ver todos →
                        </Link>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50/50 text-gray-500 font-medium border-b border-gray-100">
                                <tr>
                                    <th scope="col" class="px-5 py-3 font-medium">No. Pedido</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Fecha</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Monto</th>
                                    <th scope="col" class="px-5 py-3 font-medium">Estado</th>
                                    <th scope="col" class="px-5 py-3 font-medium text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="order in recent_orders" :key="order.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4 font-medium text-gray-900">
                                        #{{ String(order.id).padStart(4, '0') }}
                                    </td>
                                    <td class="px-5 py-4 text-gray-500">
                                        {{ formatDate(order.created_at) }}
                                    </td>
                                    <td class="px-5 py-4 font-medium text-gray-900">
                                        ${{ Number(order.total_amount).toFixed(2) }}
                                    </td>
                                    <td class="px-5 py-4">
                                        <span :class="['px-2.5 py-1 inline-flex text-xs font-medium rounded-md', statusColors[order.status]]">
                                            {{ statusLabels[order.status] }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        <Link :href="route('customer.orders.show', order.id)" class="text-gray-500 hover:text-black font-medium transition-colors">
                                            Ver detalle
                                        </Link>
                                    </td>
                                </tr>
                                <tr v-if="recent_orders.length === 0">
                                    <td colspan="5" class="px-5 py-10 text-center text-gray-400">
                                        Aún no has realizado ninguna compra.
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
