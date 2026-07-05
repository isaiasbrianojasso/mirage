<script setup>
import { ref, watch } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    carriers: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const sortField = ref(props.filters?.sort_field || 'created_at');
const sortDirection = ref(props.filters?.sort_direction || 'desc');
let searchTimeout = null;

const applyFilters = () => {
    router.get(route('carriers.index'), {
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

const deleteForm = useForm({});

const toggleActive = (carrier) => {
    router.put(route('carriers.toggle-active', carrier.id), {}, {
        preserveScroll: true,
        preserveState: true,
    });
};

const deleteCarrier = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este transportista? Esta acción no se puede deshacer.')) {
        deleteForm.delete(route('carriers.destroy', id), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AppLayout title="Transportistas">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    Transportistas
                </h2>
                <Link :href="route('carriers.create')" class="bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md shadow-sm text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Añadir Transportista
                </Link>
            </div>
        </template>

        <div class="py-8 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Feedback Messages -->
                <div v-if="$page.props.flash && $page.props.flash.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                </div>

                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-200">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <input type="text" v-model="search" placeholder="Buscar transportistas..." class="w-full md:w-1/3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('id')">
                                            ID <span class="ml-1">{{ getSortIcon('id') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('name')">
                                            Nombre <span class="ml-1">{{ getSortIcon('name') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('transit_time')">
                                            Tiempo de Tránsito <span class="ml-1">{{ getSortIcon('transit_time') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('speed_grade')">
                                            Velocidad <span class="ml-1">{{ getSortIcon('speed_grade') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('is_free')">
                                            Envío Gratis <span class="ml-1">{{ getSortIcon('is_free') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('active')">
                                            Estado <span class="ml-1">{{ getSortIcon('active') }}</span>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="carrier in carriers.data" :key="carrier.id" class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ carrier.id }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="h-10 w-10 bg-gray-100 rounded border border-gray-200 flex items-center justify-center overflow-hidden">
                                                <img v-if="carrier.logo_path" :src="'/storage/' + carrier.logo_path" class="h-10 w-10 object-contain" :alt="carrier.name">
                                                <svg v-else class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ carrier.name }}</div>
                                            <div v-if="!carrier.is_free" class="text-xs text-gray-500">Costo: ${{ Number(carrier.fixed_cost).toFixed(2) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ carrier.transit_time || 'No especificado' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                {{ carrier.speed_grade }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span v-if="carrier.is_free" class="text-green-600 font-bold">
                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </span>
                                            <span v-else class="text-gray-400">
                                                <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <button @click="toggleActive(carrier)" :class="[
                                                'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2',
                                                carrier.active ? 'bg-green-500' : 'bg-gray-200'
                                            ]" role="switch" :aria-checked="carrier.active">
                                                <span aria-hidden="true" :class="[
                                                    'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                                                    carrier.active ? 'translate-x-5' : 'translate-x-0'
                                                ]"></span>
                                            </button>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <Link :href="route('carriers.edit', carrier.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                Editar
                                            </Link>
                                            <button @click="deleteCarrier(carrier.id)" class="text-red-600 hover:text-red-900">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="carriers.data.length === 0">
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 italic">
                                            No hay transportistas registrados.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6">
                            <Pagination :links="carriers.links" />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
