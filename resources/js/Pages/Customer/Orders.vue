<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import DialogModal from '@/Components/DialogModal.vue';

const props = defineProps({
    orders: Array,
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

const formatDateHeader = (dateString) => {
    return new Date(dateString).toLocaleDateString('es-MX', {
        month: 'long', day: 'numeric'
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

        <div class="py-12 bg-gray-100 min-h-screen">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                
                <div v-if="orders.length === 0" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center border border-gray-200">
                    <p class="text-gray-500 mb-4">Aún no has realizado ninguna compra.</p>
                    <Link href="/tienda" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-md transition inline-block">
                        Ir a la tienda
                    </Link>
                </div>

                <div v-else class="space-y-6">
                    <div v-for="order in orders" :key="order.id" class="bg-white shadow-sm sm:rounded-lg overflow-hidden border border-gray-200">
                        <!-- Header del card: Fecha -->
                        <div class="px-6 py-3 border-b border-gray-200 bg-white">
                            <h3 class="text-sm font-bold text-gray-900">
                                {{ formatDateHeader(order.created_at) }}
                            </h3>
                        </div>

                        <!-- Lista de items del pedido -->
                        <div class="divide-y divide-gray-100">
                            <div v-for="item in order.items" :key="item.id" class="p-6 flex flex-col md:flex-row gap-6">
                                
                                <!-- Imagen del producto -->
                                <div class="flex-shrink-0 w-24 h-24 bg-gray-50 border border-gray-200 rounded-md overflow-hidden flex items-center justify-center">
                                    <img v-if="item.product && item.product.main_image_url" 
                                         :src="item.product.main_image_url" 
                                         class="w-full h-full object-cover cursor-pointer hover:opacity-75 transition-opacity"
                                         @click="openImageModal(item.product.main_image_url)">
                                    <svg v-else class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>

                                <!-- Detalles del producto y estado -->
                                <div class="flex-1 flex flex-col justify-center">
                                    <div class="mb-1">
                                        <span class="text-sm font-bold" :class="{
                                            'text-green-600': order.status === 'delivered',
                                            'text-blue-600': order.status === 'shipped' || order.status === 'processing',
                                            'text-yellow-600': order.status === 'pending',
                                            'text-red-600': order.status === 'cancelled'
                                        }">
                                            {{ statusLabels[order.status] }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-800 mb-1 font-medium">
                                        {{ item.product_name }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ item.quantity }} unidad<span v-if="item.quantity > 1">es</span>
                                    </div>
                                </div>

                                <!-- Botones de acción -->
                                <div class="flex flex-col gap-2 w-full md:w-48 justify-center">
                                    <Link :href="route('customer.orders.show', order.id)" class="text-center w-full bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold py-2 px-4 rounded-md transition duration-150">
                                        Ver compra
                                    </Link>
                                    <Link v-if="item.product && item.product.id" 
                                          :href="route('cart.add')" 
                                          method="post" 
                                          as="button"
                                          preserve-scroll
                                          :data="{ product_id: item.product.id, quantity: item.quantity }"
                                          class="text-center w-full bg-blue-50 text-blue-600 hover:bg-blue-100 text-sm font-semibold py-2 px-4 rounded-md transition duration-150">
                                        Volver a comprar
                                    </Link>
                                </div>
                                
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
