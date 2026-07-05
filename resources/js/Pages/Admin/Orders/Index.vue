<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    orders: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const sortField = ref(props.filters?.sort_field || 'created_at');
const sortDirection = ref(props.filters?.sort_direction || 'desc');
let searchTimeout = null;

const applyFilters = () => {
    router.get(route('orders.index'), {
        search: search.value,
        sort_field: sortField.value,
        sort_direction: sortDirection.value
    }, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    });
};

watch(search, () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
        applyFilters();
    }, 300);
});

const sortBy = (field) => {
    if (sortField.value === field) {
        sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
    } else {
        sortField.value = field;
        sortDirection.value = 'asc';
    }
    applyFilters();
};

const getSortIcon = (field) => {
    if (sortField.value !== field) return '';
    return sortDirection.value === 'asc' ? '↑' : '↓';
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
    <AppLayout title="Pedidos">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Pedidos Recibidos
                </h2>
                <Link :href="route('orders.create')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                    Añadir Nuevo Pedido
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-full">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
                    <div class="p-6 sm:px-20 bg-white border-b border-gray-200 flex justify-between items-center">
                        <div>
                            <div class="mt-8 text-2xl">
                                Administración de Pedidos
                            </div>
                            <div class="mt-2 text-gray-500">
                                Aquí puedes revisar todos los pedidos realizados a través de la tienda, confirmar pagos y actualizar el estado de envío.
                            </div>
                        </div>
                        <div class="w-1/3">
                            <input type="text" v-model="search" placeholder="Buscar pedidos..." class="mt-8 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                        </div>
                    </div>

                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-1 gap-6 p-6">
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('id')">
                                            ID Pedido <span class="ml-1">{{ getSortIcon('id') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('customer_name')">
                                            Cliente <span class="ml-1">{{ getSortIcon('customer_name') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('created_at')">
                                            Fecha <span class="ml-1">{{ getSortIcon('created_at') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('total_amount')">
                                            Total <span class="ml-1">{{ getSortIcon('total_amount') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('status')">
                                            Estado <span class="ml-1">{{ getSortIcon('status') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('payment_status')">
                                            Pago <span class="ml-1">{{ getSortIcon('payment_status') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="order in orders.data" :key="order.id">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            #{{ String(order.id).padStart(5, '0') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ order.customer_name }}</div>
                                            <div class="text-sm text-gray-500">{{ order.customer_email }}</div>
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
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span v-if="order.payment_status" :class="['px-2 inline-flex text-xs leading-5 font-semibold rounded-full', paymentStatusColors[order.payment_status]]">
                                                {{ paymentStatusLabels[order.payment_status] }}
                                            </span>
                                            <span v-else class="text-sm text-gray-500">N/A</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <Link :href="route('orders.show', { order: order.id })" class="text-indigo-600 hover:text-indigo-900">
                                                Ver Detalles
                                            </Link>
                                        </td>
                                    </tr>
                                    <tr v-if="orders.data.length === 0">
                                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                            No hay pedidos registrados por el momento.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <Pagination :links="orders.links" />
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
