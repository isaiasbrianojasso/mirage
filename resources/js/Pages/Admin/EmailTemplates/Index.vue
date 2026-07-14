<template>
    <AppLayout title="Plantillas de Correos">
        <template #header>
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Plantillas de Correos
                    </h2>
                </div>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Flash messages -->
                <div v-if="$page.props.flash?.success" class="mb-4 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    <span>{{ $page.props.flash.success }}</span>
                </div>
                <div v-if="$page.props.flash?.error" class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    <span>{{ $page.props.flash.error }}</span>
                </div>

                <!-- Lista de plantillas -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                            <p class="text-gray-600 text-sm">
                                <strong>¿Qué son las plantillas de correo?</strong> Es el diseño y texto que reciben tus clientes por email (cuando compran, cuando se envían sus paquetes, etc). Aquí puedes modificar su apariencia y contenido.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div v-for="template in templates" :key="template.name" class="border border-gray-200 rounded-lg p-5 hover:shadow-md transition">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <Link :href="route('admin.email-templates.edit', template.name)" class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                                        Editar <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                    </Link>
                                </div>
                                <h3 class="font-bold text-gray-800 text-lg mb-1">{{ template.name }}</h3>
                                <p class="text-xs text-gray-500 font-mono mb-3">{{ template.filename }}</p>
                                <div class="flex justify-between items-center text-xs text-gray-400 mt-4 pt-4 border-t border-gray-100">
                                    <span>Modificado: {{ template.last_modified }}</span>
                                    <span>{{ (template.size / 1024).toFixed(1) }} KB</span>
                                </div>
                            </div>
                            
                            <div v-if="templates.length === 0" class="col-span-full py-12 text-center text-gray-500">
                                No se encontraron plantillas de correo en el directorio de vistas.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    templates: Array,
});
</script>
