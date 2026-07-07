<script setup>
import { useForm, Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    subscriberCount: Number,
});

const form = useForm({
    subject: '',
    content: '',
});

const submit = () => {
    if (confirm(`¿Estás seguro de enviar este boletín a los ${props.subscriberCount} suscriptores? Esta acción no se puede deshacer.`)) {
        form.post(route('newsletter.store'), {
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <AppLayout title="Enviar Boletín">
        <Head title="Enviar Boletín" />

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Enviar Boletín
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <div v-if="$page.props.flash && $page.props.flash.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.success }}</span>
                    </div>
                    <div v-if="$page.props.flash && $page.props.flash.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ $page.props.flash.error }}</span>
                    </div>

                    <div class="mb-6 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded">
                        <strong>Información:</strong> Tienes <strong>{{ subscriberCount }}</strong> suscriptores que han aceptado recibir boletines u ofertas.
                    </div>

                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700">Asunto del Correo</label>
                            <input 
                                type="text" 
                                id="subject" 
                                v-model="form.subject" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                required
                            >
                            <div v-if="form.errors.subject" class="text-red-500 text-sm mt-1">{{ form.errors.subject }}</div>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Contenido del Mensaje</label>
                            <textarea 
                                id="content" 
                                v-model="form.content" 
                                rows="10" 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                required
                            ></textarea>
                            <div v-if="form.errors.content" class="text-red-500 text-sm mt-1">{{ form.errors.content }}</div>
                        </div>

                        <div class="flex items-center justify-end">
                            <button 
                                type="submit" 
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                                :disabled="form.processing || subscriberCount === 0"
                            >
                                <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enviar a todos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
