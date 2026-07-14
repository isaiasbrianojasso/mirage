<template>
    <AppLayout title="Gestión de Banners">
        <template #header>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Gestión de Banners
                </h2>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-6xl space-y-6">

                <!-- Header Actions -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                    <p class="text-gray-600 bg-white p-4 rounded-lg border border-gray-200 shadow-sm text-sm flex-1">
                        <strong>¿Qué son los Banners?</strong> Son las imágenes grandes que aparecen en la página principal de la tienda (el carrusel). Úsalos para anunciar promociones, meses sin intereses o productos destacados.
                    </p>
                    <Link
                        :href="route('banners.create')"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#25b9d7] hover:bg-[#1a9ab4] text-white text-sm font-semibold rounded-lg shadow transition-all hover:-translate-y-0.5 hover:shadow-md shrink-0"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nuevo Banner
                    </Link>
                </div>

                <!-- Flash Message -->
                <div v-if="$page.props.flash?.success" class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ $page.props.flash.success }}</span>
                </div>

                <!-- Empty State -->
                <div v-if="banners.length === 0" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-5">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Sin banners registrados</h3>
                    <p class="text-gray-500 mb-6 text-sm">Agrega el primer banner para el carrusel de tu tienda.</p>
                    <Link :href="route('banners.create')" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#25b9d7] hover:bg-[#1a9ab4] text-white text-sm font-semibold rounded-lg transition">
                        Crear primer banner
                    </Link>
                </div>

                <!-- Banners Grid -->
                <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="banner in banners"
                        :key="banner.id"
                        class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all flex flex-col group"
                    >
                        <!-- Image -->
                        <div class="relative h-48 bg-gray-100 overflow-hidden shrink-0 border-b border-gray-100">
                            <img
                                :src="banner.image_url"
                                :alt="banner.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                @error="e => e.target.src='https://via.placeholder.com/800x400?text=Sin+Imagen'"
                            />
                            <!-- Status badge -->
                            <span
                                :class="banner.is_active ? 'bg-green-500' : 'bg-gray-400'"
                                class="absolute top-3 right-3 text-white text-xs font-bold px-2.5 py-1 rounded-md shadow"
                            >
                                {{ banner.is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                            <!-- Order badge -->
                            <span class="absolute top-3 left-3 bg-slate-800/80 backdrop-blur-sm text-white text-xs font-bold px-2.5 py-1 rounded-md shadow">
                                Orden #{{ banner.order }}
                            </span>
                        </div>

                        <!-- Info -->
                        <div class="p-5 flex-1 flex flex-col">
                            <h4 class="font-semibold text-gray-900 truncate mb-1" :title="banner.title">{{ banner.title }}</h4>
                            <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-4 truncate">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                                <a v-if="banner.link_url" :href="banner.link_url" target="_blank" class="truncate hover:text-[#25b9d7] hover:underline">{{ banner.link_url }}</a>
                                <span v-else>Sin enlace</span>
                            </div>

                            <div class="mt-auto"></div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2 pt-4 border-t border-gray-100">
                                <Link
                                    :href="route('banners.edit', banner.id)"
                                    class="flex-1 flex justify-center items-center gap-1.5 py-2 text-sm font-semibold text-slate-700 bg-slate-50 border border-slate-200 rounded-lg hover:bg-slate-100 hover:text-slate-900 transition"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    Editar
                                </Link>
                                <Link
                                    :href="route('banners.destroy', banner.id)"
                                    method="delete"
                                    as="button"
                                    @click.prevent="confirmDelete(banner)"
                                    class="flex-1 flex justify-center items-center gap-1.5 py-2 text-sm font-semibold text-red-600 bg-red-50 border border-red-100 rounded-lg hover:bg-red-100 hover:text-red-700 transition"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    Eliminar
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirm Modal -->
        <div v-if="deletingBanner" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full mx-4">
                <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 text-center mb-2">¿Eliminar Banner?</h3>
                <p class="text-gray-500 text-center text-sm mb-6">Esta acción no se puede deshacer. El banner "<strong>{{ deletingBanner?.title }}</strong>" será eliminado permanentemente.</p>
                <div class="flex gap-3">
                    <button @click="deletingBanner = null" class="flex-1 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition text-sm">
                        Cancelar
                    </button>
                    <Link
                        :href="route('banners.destroy', deletingBanner.id)"
                        method="delete"
                        as="button"
                        class="flex-1 py-2.5 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition text-sm"
                        @click="deletingBanner = null"
                    >
                        Sí, eliminar
                    </Link>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    banners: Array,
});

const deletingBanner = ref(null);

function confirmDelete(banner) {
    deletingBanner.value = banner;
}
</script>
