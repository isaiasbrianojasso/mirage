<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, watch } from 'vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    groups: Object,
    filters: Object
});

const search = ref(props.filters?.search || '');
const sortField = ref(props.filters?.sort_field || 'name');
const sortDirection = ref(props.filters?.sort_direction || 'asc');
let searchTimeout = null;

const applyFilters = () => {
    router.get(route('customer-groups.index'), {
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

const deleteGroup = (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este grupo?')) {
        router.delete(route('customer-groups.destroy', id));
    }
};
</script>

<template>
    <AppLayout title="Grupos de Clientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Grupos de Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="mb-4 flex justify-between items-center">
                    <div class="w-1/3">
                        <input type="text" v-model="search" placeholder="Buscar grupos..." class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    </div>
                    <Link :href="route('customer-groups.create')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        Añadir Nuevo Grupo
                    </Link>
                </div>

                <div class="mb-4 p-4 bg-indigo-50 rounded-md border border-indigo-100">
                    <p class="text-sm text-indigo-800">
                        Los <b>Grupos de Clientes</b> te permiten dar precios, reglas o descuentos especiales a ciertos usuarios. Por ejemplo, puedes crear un grupo llamado "Mayoristas" que siempre tenga un 20% de descuento automático o "Técnicos" que vean los precios sin IVA. Luego, asignas ese grupo a los clientes desde la sección de "Clientes".
                    </p>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="$page.props.flash && $page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                    </div>
                    <div v-if="$page.props.flash && $page.props.flash.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.error }}</span>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('id')">
                                    ID <span class="ml-1">{{ getSortIcon('id') }}</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('name')">
                                    Nombre del Grupo <span class="ml-1">{{ getSortIcon('name') }}</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('discount_percentage')">
                                    Descuento (%) <span class="ml-1">{{ getSortIcon('discount_percentage') }}</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('show_prices')">
                                    Ver Precios <span class="ml-1">{{ getSortIcon('show_prices') }}</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('show_taxes')">
                                    Mostrar Impuestos <span class="ml-1">{{ getSortIcon('show_taxes') }}</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('users_count')">
                                    Clientes <span class="ml-1">{{ getSortIcon('users_count') }}</span>
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="group in groups.data" :key="group.id">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ group.id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ group.name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ group.discount_percentage }}%</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span v-if="group.show_prices" class="text-green-600">Sí</span>
                                    <span v-else class="text-red-600 font-bold">No</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span :class="group.show_taxes ? 'text-green-600 font-semibold' : 'text-orange-600 font-semibold'">
                                        {{ group.show_taxes ? 'Con IVA' : 'Sin IVA' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ group.users_count }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <Link :href="route('customer-groups.edit', group.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</Link>
                                    <button @click="deleteGroup(group.id)" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </td>
                            </tr>
                            <tr v-if="groups.data.length === 0">
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No hay grupos de clientes configurados.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <Pagination :links="groups.links" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
