<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    zone: Object,
});

const isEditing = !!props.zone;

const form = useForm({
    name: props.zone?.name || '',
    active: props.zone?.active ?? true,
});

const submit = () => {
    if (isEditing) {
        form.put(route('zones.update', props.zone.id), {
            preserveScroll: true,
        });
    } else {
        form.post(route('zones.store'), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Zona' : 'Añadir Zona'">
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                    {{ isEditing ? 'Editar Zona Geográfica' : 'Añadir Nueva Zona Geográfica' }}
                </h2>
                <Link :href="route('zones.index')" class="bg-gray-800 text-white hover:bg-gray-700 px-4 py-2 rounded-md shadow-sm text-sm font-medium">
                    Volver al Listado
                </Link>
            </div>
        </template>

        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                
                <form @submit.prevent="submit" class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="p-8 space-y-8">
                        
                        <div>
                            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 border-b pb-2">Datos de la Zona</h3>
                            
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nombre de la Zona <span class="text-red-500">*</span></label>
                                    <input type="text" v-model="form.name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Ej: Norteamérica, Europa, Nacional...">
                                    <p v-if="form.errors.name" class="mt-1 text-sm text-red-600">{{ form.errors.name }}</p>
                                    <p class="mt-2 text-xs text-gray-500">Este nombre aparecerá en la matriz de configuración de los Transportistas.</p>
                                </div>

                                <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <div>
                                        <label class="font-medium text-gray-900 block">Estado de la Zona</label>
                                        <span class="text-sm text-gray-500">¿Está activa esta zona para envíos?</span>
                                    </div>
                                    <div class="flex items-center h-5">
                                        <button type="button" @click="form.active = !form.active" :class="[
                                            'relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2',
                                            form.active ? 'bg-green-500' : 'bg-gray-200'
                                        ]" role="switch" :aria-checked="form.active">
                                            <span aria-hidden="true" :class="[
                                                'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
                                                form.active ? 'translate-x-5' : 'translate-x-0'
                                            ]"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex items-center justify-end">
                        <Link :href="route('zones.index')" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 px-4 py-2 rounded-md shadow-sm text-sm font-medium mr-3">
                            Cancelar
                        </Link>
                        <button type="submit" :disabled="form.processing" class="bg-blue-600 border border-transparent text-white hover:bg-blue-700 px-6 py-2 rounded-md shadow-sm text-sm font-medium disabled:opacity-50">
                            {{ isEditing ? 'Guardar Cambios' : 'Crear Zona' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </AppLayout>
</template>
