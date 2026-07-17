<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';
import { computed } from 'vue';

const props = defineProps({
    post: {
        type: Object,
        default: null
    }
});

const isEditing = !!props.post;

const form = useForm({
    _method: isEditing ? 'put' : 'post',
    title: props.post?.title || '',
    content: props.post?.content || '',
    status: props.post ? props.post.status : 'published',
    image: null,
});

const isPublished = computed({
    get: () => form.status === 'published',
    set: (val) => { form.status = val ? 'published' : 'draft'; }
});

const submit = () => {
    if (isEditing) {
        form.post(route('posts.update', props.post.id), {
            preserveScroll: true,
        });
    } else {
        form.post(route('posts.store'), {
            preserveScroll: true,
        });
    }
};

const handleImageChange = (e) => {
    form.image = e.target.files[0];
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Novedad' : 'Nueva Novedad'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditing ? 'Editar Novedad' : 'Nueva Novedad' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <!-- Explicación Intuitiva -->
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mb-6 text-sm text-blue-800">
                        <h4 class="font-semibold mb-2 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            ¿Qué estás editando?
                        </h4>
                        <ul class="space-y-1 ml-6 list-disc marker:text-blue-400">
                            <li><strong>Título:</strong> Es el encabezado principal de la noticia. Intenta que sea llamativo.</li>
                            <li><strong>Contenido:</strong> El texto completo del artículo. Puedes escribir la noticia o aviso detallado aquí.</li>
                            <li><strong>Imagen:</strong> Es la "portada" del artículo. Se mostrará en la lista de novedades y al entrar a leerlo.</li>
                        </ul>
                    </div>

                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <InputLabel for="title" value="Título" />
                                <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required autofocus autocomplete="title" />
                                <InputError class="mt-2" :message="form.errors.title" />
                            </div>

                            <div>
                                <InputLabel for="content" value="Contenido" />
                                <textarea id="content" v-model="form.content" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" rows="6"></textarea>
                                <InputError class="mt-2" :message="form.errors.content" />
                            </div>

                            <div>
                                <InputLabel for="image" value="Imagen (Opcional)" />
                                <input id="image" type="file" @change="handleImageChange" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                <InputError class="mt-2" :message="form.errors.image" />
                                <div v-if="props.post?.image_url && !form.image" class="mt-4">
                                    <p class="text-sm text-gray-500 mb-2">Imagen Actual:</p>
                                    <img :src="`/storage/${props.post.image_url}`" class="w-32 h-32 object-cover rounded-lg shadow-sm" alt="Novedad" />
                                </div>
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox v-model:checked="isPublished" />
                                    <span class="ml-2 text-sm text-gray-600">Publicado (Visible en el sitio web)</span>
                                </label>
                            </div>

                            <div class="flex items-center justify-end mt-4 border-t border-gray-200 pt-4">
                                <Link :href="route('posts.index')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                                    Cancelar
                                </Link>

                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    {{ isEditing ? 'Actualizar' : 'Guardar' }}
                                </PrimaryButton>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>