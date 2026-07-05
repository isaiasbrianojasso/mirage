<template>
    <AppLayout :title="'Editar Plantilla: ' + templateName">
        <template #header>
            <div class="flex items-center gap-4">
                <Link :href="route('admin.email-templates.index')" class="text-gray-500 hover:text-gray-800 transition">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </Link>
                <div class="flex items-center gap-2">
                    <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Editar Plantilla: <span class="text-blue-600 font-mono">{{ templateName }}.blade.php</span>
                    </h2>
                </div>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <!-- Flash error from controller if any -->
                <div v-if="$page.props.flash?.error" class="mb-4 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                    <span>{{ $page.props.flash.error }}</span>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-6">
                        <div class="mb-4 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <p class="text-sm text-gray-500 max-w-2xl">
                                Estás editando el código HTML sin procesar de esta plantilla. Ten cuidado de no romper las etiquetas de sintaxis (ej. <code>&#123;&#123; $variable &#125;&#125;</code> o <code>@foreach</code>). Las variables disponibles varían según el correo que estés editando.
                            </p>
                            <button type="submit" :disabled="form.processing" class="shrink-0 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring focus:ring-blue-300 disabled:opacity-25 transition">
                                <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Guardar Cambios
                            </button>
                        </div>

                        <!-- Variables Helper -->
                        <div v-if="templateName === 'order_receipt'" class="mb-5 bg-blue-50 border border-blue-100 rounded-md p-4">
                            <h4 class="text-sm font-bold text-blue-800 mb-2 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                Variables de Orden Disponibles (Cheat Sheet)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-xs text-blue-700 font-mono">
                                <div><code>&#123;&#123; $order->id &#125;&#125;</code> - ID del pedido</div>
                                <div><code>&#123;&#123; $order->customer_name &#125;&#125;</code> - Nombre del cliente</div>
                                <div><code>&#123;&#123; $order->customer_email &#125;&#125;</code> - Correo del cliente</div>
                                <div><code>&#123;&#123; number_format($order->total_amount, 2) &#125;&#125;</code> - Total a pagar</div>
                                <div><code>&#123;&#123; $order->shipping_address &#125;&#125;</code> - Dirección de envío</div>
                                <div><code>@foreach($order->items as $item) ... @endforeach</code> - Ciclo de productos</div>
                            </div>
                        </div>

                        <!-- Editor Textarea -->
                        <div class="border border-gray-300 rounded-md overflow-hidden bg-gray-50">
                            <textarea
                                v-model="form.content"
                                class="w-full h-[700px] p-4 font-mono text-sm bg-gray-900 text-gray-100 focus:ring-0 focus:outline-none border-0"
                                spellcheck="false"
                            ></textarea>
                        </div>
                        
                        <div v-if="form.errors.content" class="text-red-500 text-sm mt-2">
                            {{ form.errors.content }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    templateName: String,
    content: String,
});

const form = useForm({
    content: props.content,
});

const submit = () => {
    form.put(route('admin.email-templates.update', props.templateName));
};
</script>
