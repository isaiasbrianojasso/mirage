<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    orders: Array,
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
    <AppLayout title="Mis Pedidos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis Pedidos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                        <div class="mt-8 text-2xl">
                            Historial de Compras
                        </div>
                        <div class="mt-6 text-gray-500">
                            Aquí puedes ver el estado de todos tus pedidos recientes en {{ $page.props.company_settings?.general?.company_name || 'nuestra tienda' }}.
                        </div>
                    </div>

                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1 gap-6 p-6">
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            ID Pedido
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="order in orders" :key="order.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ String(order.id).padStart(5, '0') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ formatDate(order.created_at) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">
                                            ${{ Number(order.total_amount).toFixed(2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span :class="['px-2 inline-flex text-xs leading-5 font-semibold rounded-full', statusColors[order.status]]">
                                                {{ statusLabels[order.status] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <Link :href="route('customer.orders.show', order.id)" class="text-indigo-600 hover:text-indigo-900">
                                                Ver Detalles
                                            </Link>
                                        </td>
                                    </tr>
                                    <tr v-if="orders.length === 0">
                                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                            Aún no has realizado ninguna compra.
                                            <br>
                                            <a href="/tienda" class="text-indigo-600 mt-2 inline-block hover:underline">Ir a la tienda</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
