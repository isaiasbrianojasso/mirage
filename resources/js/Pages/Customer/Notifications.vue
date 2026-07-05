<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    logs: Object
});

const selectedEmail = ref(null);

const viewEmail = (email) => {
    selectedEmail.value = email;
};

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('es-MX', {
        month: 'long', day: 'numeric', year: 'numeric', hour: '2-digit', minute: '2-digit'
    });
};
</script>

<template>
    <AppLayout title="Notificaciones">
        <div class="min-h-screen bg-gray-50/50 text-gray-900 font-sans py-10">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="mb-8">
                    <h1 class="text-3xl font-semibold tracking-tight text-gray-900 mb-1">
                        Notificaciones
                    </h1>
                    <p class="text-gray-500 text-sm">Historial de correos y avisos que la tienda te ha enviado.</p>
                </div>

                <div class="bg-white border border-gray-200 rounded-2xl shadow-[0_2px_8px_-4px_rgba(0,0,0,0.05)] overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-gray-50/50 text-gray-500 font-medium border-b border-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-4 font-medium">Fecha</th>
                                    <th scope="col" class="px-6 py-4 font-medium">Asunto</th>
                                    <th scope="col" class="px-6 py-4 font-medium text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr v-for="log in logs.data" :key="log.id" class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-gray-500 w-1/4">
                                        {{ formatDate(log.created_at) }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 truncate max-w-sm">
                                        {{ log.subject }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button @click="viewEmail(log)" class="text-indigo-600 hover:text-indigo-900 font-medium bg-indigo-50 px-3 py-1.5 rounded-md hover:bg-indigo-100 transition-colors">
                                            Ver Mensaje
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="logs.data.length === 0">
                                    <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                                        No tienes notificaciones por el momento.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div v-if="logs.links && logs.links.length > 3" class="px-6 py-4 border-t border-gray-100 bg-gray-50/30 flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <Link :href="logs.prev_page_url" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50" :class="{'opacity-50 pointer-events-none': !logs.prev_page_url}">
                                Anterior
                            </Link>
                            <Link :href="logs.next_page_url" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50" :class="{'opacity-50 pointer-events-none': !logs.next_page_url}">
                                Siguiente
                            </Link>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Mostrando <span class="font-medium text-gray-900">{{ logs.from || 0 }}</span> a <span class="font-medium text-gray-900">{{ logs.to || 0 }}</span> de <span class="font-medium text-gray-900">{{ logs.total }}</span> resultados
                                </p>
                            </div>
                            <div>
                                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                    <Link v-for="(link, key) in logs.links" :key="key" :href="link.url" v-html="link.label" class="relative inline-flex items-center px-4 py-2 border text-sm font-medium" :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-200 text-gray-500 hover:bg-gray-50', !link.url ? 'opacity-50 pointer-events-none' : '']" />
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Email View Modal -->
        <div v-if="selectedEmail" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="selectedEmail = null"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-xl leading-6 font-semibold text-gray-900 mb-1" id="modal-title">
                                    {{ selectedEmail.subject }}
                                </h3>
                                <div class="mt-1 mb-5 text-sm text-gray-500 flex justify-between border-b border-gray-100 pb-4">
                                    <p>Recibido el {{ formatDate(selectedEmail.created_at) }}</p>
                                </div>
                                <div class="mt-4 bg-gray-50/50 rounded-xl overflow-hidden">
                                    <iframe :srcdoc="selectedEmail.body" style="width:100%; min-height:500px; border:none;" title="Contenido del mensaje"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-4 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-100">
                        <button type="button" @click="selectedEmail = null" class="w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-5 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
