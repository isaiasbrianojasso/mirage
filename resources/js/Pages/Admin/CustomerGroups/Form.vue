<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    group: Object,
    categories: Array
});

const isEditing = !!props.group;

const form = useForm({
    name: props.group ? props.group.name : '',
    discount_percentage: props.group ? props.group.discount_percentage : 0,
    show_taxes: props.group ? props.group.show_taxes : true,
    show_prices: props.group ? props.group.show_prices : true,
    category_ids: []
});

onMounted(() => {
    if (isEditing && props.group.categories) {
        form.category_ids = props.group.categories.map(c => c.id);
    } else if (!isEditing && props.categories) {
        // Por defecto al crear un grupo, asignamos todas las categorías
        form.category_ids = props.categories.map(c => c.id);
    }
});

const submit = () => {
    if (isEditing) {
        form.put(route('customer-groups.update', props.group.id));
    } else {
        form.post(route('customer-groups.store'));
    }
};

const toggleAllCategories = (e) => {
    if (e.target.checked) {
        form.category_ids = props.categories.map(c => c.id);
    } else {
        form.category_ids = [];
    }
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Grupo' : 'Añadir Grupo'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditing ? 'Editar Grupo de Clientes' : 'Añadir Nuevo Grupo' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="mb-4">
                    <Link :href="route('customer-groups.index')" class="text-indigo-600 hover:text-indigo-900">
                        &larr; Volver a Grupos
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 max-w-4xl">
                    <form @submit.prevent="submit" class="space-y-6">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Columna Izquierda: Ajustes Generales -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2">Ajustes Generales</h3>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre del Grupo</label>
                                    <input type="text" v-model="form.name" placeholder="Ej. Mayoristas, Técnicos, VIP" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Este nombre te ayudará a identificar al grupo cuando se lo asignes a un cliente.</p>
                                    <p v-if="form.errors.name" class="mt-2 text-sm text-red-600">{{ form.errors.name }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Descuento Global (%)</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <input type="number" step="0.01" min="0" max="100" v-model="form.discount_percentage" required class="flex-1 block w-full rounded-none rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            %
                                        </span>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">
                                        Si pones por ejemplo "20", todos los clientes de este grupo verán los precios un 20% más baratos en toda la tienda automáticamente. Pon 0 si no quieres darles descuento especial.
                                    </p>
                                    <p v-if="form.errors.discount_percentage" class="mt-2 text-sm text-red-600">{{ form.errors.discount_percentage }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">¿Pueden ver los precios de los productos?</label>
                                    <div class="mt-2 space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                        <div class="flex items-center">
                                            <input type="radio" :value="true" v-model="form.show_prices" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label class="ml-3 block text-sm font-medium text-gray-700">Sí, mostrar precios</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" :value="false" v-model="form.show_prices" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label class="ml-3 block text-sm font-medium text-gray-700">No (Solo verán el catálogo, como un folleto)</label>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">¿Cómo ven los precios estos clientes?</label>
                                    <div class="mt-2 space-y-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-10">
                                        <div class="flex items-center">
                                            <input type="radio" :value="true" v-model="form.show_taxes" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label class="ml-3 block text-sm font-medium text-gray-700">Precio normal (Con IVA incluido)</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" :value="false" v-model="form.show_taxes" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                            <label class="ml-3 block text-sm font-medium text-gray-700">Precio para negocio (Sin IVA)</label>
                                        </div>
                                    </div>
                                    <p v-if="form.errors.show_taxes" class="mt-2 text-sm text-red-600">{{ form.errors.show_taxes }}</p>
                                </div>
                            </div>

                            <!-- Columna Derecha: Restricciones de Categoría -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 border-b pb-2">Permisos de Categorías</h3>
                                <p class="text-sm text-gray-500">
                                    Elige qué categorías pueden ver en la tienda los clientes que pertenezcan a este grupo. Si no marcas una categoría, no podrán ver los productos de esa familia (Por ejemplo, puedes hacer que los "Mayoristas de Refrigeración" no vean los de Línea Blanca).
                                </p>
                                
                                <div class="border rounded-md p-4 bg-gray-50 max-h-80 overflow-y-auto">
                                    <div class="mb-3 border-b pb-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" @change="toggleAllCategories" :checked="form.category_ids.length === categories.length && categories.length > 0" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <span class="ml-2 font-semibold text-sm text-gray-700">Seleccionar todas</span>
                                        </label>
                                    </div>
                                    <div v-for="category in categories" :key="category.id" class="mt-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" :value="category.id" v-model="form.category_ids" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-700">{{ category.name }}</span>
                                        </label>
                                    </div>
                                    <div v-if="categories.length === 0" class="text-sm text-gray-500 italic">
                                        No hay categorías creadas en la tienda.
                                    </div>
                                </div>
                                <p v-if="form.errors.category_ids" class="mt-2 text-sm text-red-600">{{ form.errors.category_ids }}</p>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 border-t border-gray-200">
                            <button type="submit" :disabled="form.processing" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50">
                                {{ isEditing ? 'Guardar Cambios' : 'Crear Grupo' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
