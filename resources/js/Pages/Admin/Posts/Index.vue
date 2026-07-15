<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    posts: Object,
    filters: Object,
});

const search = ref(props.filters?.search || '');
const sortField = ref(props.filters?.sort_field || 'title');
const sortDirection = ref(props.filters?.sort_direction || 'asc');
let searchTimeout = null;

const applyFilters = () => {
    router.get(route('posts.index'), {
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
    <AppLayout title="Novedades">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Novedades
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-full">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                        <div class="w-full md:w-1/3">
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Listado de Novedades</h3>
                            <p class="text-xs text-gray-500">Publica noticias, avisos o artículos de interés para tus clientes. Es como el blog de tu tienda.</p>
                        </div>
                        <div class="w-full md:w-1/3">
                            <input type="text" v-model="search" placeholder="Buscar novedades..." class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        </div>
                        <Link :href="route('posts.create')" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                            Nueva Novedad
                        </Link>
                    </div>

                    <!-- Vista Previa / Explicación Intuitiva -->
                    <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 mb-6">
                        <h4 class="font-semibold text-indigo-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            ¿Cómo se ve esto en mi tienda?
                        </h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                            <div class="text-sm text-indigo-700 space-y-3">
                                <p>
                                    La sección de <strong>Novedades</strong> funciona como un "Blog" o cartelera de anuncios. 
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-start gap-2"><span class="text-indigo-400 mt-0.5">•</span> <strong>Visibilidad:</strong> Aparecen en una página dedicada a donde tus clientes pueden entrar a leer artículos.</li>
                                    <li class="flex items-start gap-2"><span class="text-indigo-400 mt-0.5">•</span> <strong>Uso común:</strong> Ideal para anunciar promociones por temporada (Buen Fin, Navidad), consejos sobre tus productos, o avisos importantes.</li>
                                    <li class="flex items-start gap-2"><span class="text-indigo-400 mt-0.5">•</span> <strong>SEO:</strong> Escribir artículos de interés ayuda a que más gente encuentre tu tienda en Google.</li>
                                </ul>
                            </div>
                            
                            <!-- Wireframe Visual -->
                            <div class="bg-white border border-gray-200 rounded-lg p-4 shadow-sm relative">
                                <div class="absolute -top-3 -left-3 bg-indigo-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow">Vista del Cliente</div>
                                <div class="w-full h-4 bg-gray-100 rounded mb-4"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="border border-gray-100 rounded-md p-2 bg-gray-50 flex flex-col gap-2">
                                        <div class="w-full h-20 bg-gray-200 rounded-sm flex items-center justify-center text-gray-400 text-xs">Imagen de portada</div>
                                        <div class="w-3/4 h-3 bg-gray-300 rounded"></div>
                                        <div class="w-full h-2 bg-gray-200 rounded"></div>
                                        <div class="w-full h-2 bg-gray-200 rounded"></div>
                                        <div class="w-1/2 h-2 bg-gray-200 rounded"></div>
                                        <div class="text-[10px] text-indigo-500 font-medium mt-1">Leer más →</div>
                                    </div>
                                    <div class="border border-gray-100 rounded-md p-2 bg-gray-50 flex flex-col gap-2 opacity-60">
                                        <div class="w-full h-20 bg-gray-200 rounded-sm"></div>
                                        <div class="w-3/4 h-3 bg-gray-300 rounded"></div>
                                        <div class="w-full h-2 bg-gray-200 rounded"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('title')">
                                        Título <span class="ml-1">{{ getSortIcon('title') }}</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" @click="sortBy('status')">
                                        Estado <span class="ml-1">{{ getSortIcon('status') }}</span>
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="post in posts.data" :key="post.id">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ post.title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ post.slug }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <span v-if="post.status === 'published'" class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Publicado</span>
                                        <span v-else class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Borrador</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('posts.edit', post.id)" class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</Link>
                                        <Link :href="route('posts.destroy', post.id)" method="delete" as="button" class="text-red-600 hover:text-red-900" preserve-scroll>Eliminar</Link>
                                    </td>
                                </tr>
                                <tr v-if="posts.data.length === 0">
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">No hay novedades registradas.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6">
                        <Pagination :links="posts.links" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
