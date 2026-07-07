<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    locations: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const sortField = ref(props.filters?.sort_field || 'name');
const sortDirection = ref(props.filters?.sort_direction || 'asc');
let searchTimeout = null;

const applyFilters = () => {
    router.get(route('locations.index'), {
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
</script>

<template>
    <AppLayout title="Ubicaciones">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ubicaciones (Centros de Servicio y Distribuidores)
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-full">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="w-1/3">
                            <input type="text" v-model="search" placeholder="Buscar por nombre, ciudad..." class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        </div>
                        <Link :href="route('locations.create')" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                            Nueva Ubicación
                        </Link>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('name')">
                                        Nombre <span class="ml-1">{{ getSortIcon('name') }}</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('type')">
                                        Tipo <span class="ml-1">{{ getSortIcon('type') }}</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('city')">
                                        Ciudad <span class="ml-1">{{ getSortIcon('city') }}</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('is_active')">
                                        Estado <span class="ml-1">{{ getSortIcon('is_active') }}</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="location in locations.data" :key="location.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ location.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ location.type === 'centro_de_servicio' ? 'Centro de Servicio' : 'Distribuidor' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ location.city || '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span v-if="location.is_active" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                                        <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('locations.edit', location.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</Link>
                                        <Link :href="route('locations.destroy', location.id)" method="delete" as="button" class="text-red-600 hover:text-red-900" preserve-scroll>Eliminar</Link>
                                    </td>
                                </tr>
                                <tr v-if="locations.data.length === 0">
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No hay ubicaciones registradas.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        <Pagination :links="locations.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
