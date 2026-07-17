<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';

const props = defineProps({
    order: Object,
});

const showingImageModal = ref(false);
const selectedImageUrl = ref('');

const openImageModal = (url) => {
    selectedImageUrl.value = url;
    showingImageModal.value = true;
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
                            <div class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Productos</h3>
                                <span :class="['px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full', statusColors[order.status]]">
                                    {{ statusLabels[order.status] }}
                                </span>
                            </div>
                            <div class="border-t border-gray-200">
                                <ul role="list" class="divide-y divide-gray-200">
                                    <li v-for="item in order.items" :key="item.id" class="px-4 py-4 sm:px-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                        <div class="flex items-center">
                                            <!-- Imagen del producto -->
                                            <div class="flex-shrink-0 w-20 h-20 bg-gray-50 border border-gray-200 rounded-md overflow-hidden flex items-center justify-center">
                                                <img v-if="item.product && item.product.main_image_url" 
                                                     :src="item.product.main_image_url" 
                                                     class="w-full h-full object-cover cursor-pointer hover:opacity-75 transition-opacity"
                                                     @click="openImageModal(item.product.main_image_url)">
                                                <svg v-else class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ item.product_name }}</div>
                                                <div class="text-sm text-gray-500 mt-1">Cantidad: {{ item.quantity }} x ${{ Number(item.price).toFixed(2) }}</div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col sm:items-end mt-2 sm:mt-0 w-full sm:w-auto text-right">
                                            <div class="text-sm font-bold text-gray-900 mb-2">
                                                ${{ (item.quantity * item.price).toFixed(2) }}
                                            </div>
                                            <Link v-if="item.product && item.product.id" 
                                                  :href="route('cart.add')" 
                                                  method="post" 
                                                  as="button"
                                                  preserve-scroll
                                                  :data="{ product_id: item.product.id, quantity: item.quantity }"
                                                  class="text-blue-600 hover:text-blue-800 text-xs font-semibold uppercase tracking-wider text-left sm:text-right mt-1">
                                                Volver a comprar
                                            </Link>
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

        <!-- Image Modal -->
        <DialogModal :show="showingImageModal" @close="showingImageModal = false">
            <template #title>
                Imagen del Producto
            </template>
            <template #content>
                <div class="flex justify-center p-4">
                    <img :src="selectedImageUrl" class="max-w-full h-auto max-h-[70vh] object-contain rounded-lg shadow-sm">
                </div>
            </template>
            <template #footer>
                <button type="button" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm transition-colors" @click="showingImageModal = false">
                    Cerrar
                </button>
            </template>
        </DialogModal>
    </AppLayout>
</template>
