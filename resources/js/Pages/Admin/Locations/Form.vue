<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, Link } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Checkbox from '@/Components/Checkbox.vue';

import AddressAutocomplete from '@/Components/AddressAutocomplete.vue';

const props = defineProps({
    location: {
        type: Object,
        default: null
    }
});

const isEditing = !!props.location;

const form = useForm({
    _method: isEditing ? 'put' : 'post',
    name: props.location?.name || '',
    type: props.location?.type || 'distribuidor',
    address: props.location?.address || '',
    city: props.location?.city || '',
    state: props.location?.state || '',
    zip: props.location?.zip || '',
    country: props.location?.country || 'México',
    phone: props.location?.phone || '',
    email: props.location?.email || '',
    latitude: props.location?.latitude || '',
    longitude: props.location?.longitude || '',
    is_active: props.location ? !!props.location.is_active : true,
});

const onAddressSelected = (locationData) => {
    form.address = locationData.address || form.address;
    form.city = locationData.city || form.city;
    form.state = locationData.state || form.state;
    form.zip = locationData.zip || form.zip;
    form.country = locationData.country || form.country;
    form.latitude = locationData.lat || form.latitude;
    form.longitude = locationData.lng || form.longitude;
};

const submit = () => {
    if (isEditing) {
        form.post(route('locations.update', props.location.id), {
            preserveScroll: true,
        });
    } else {
        form.post(route('locations.store'), {
            preserveScroll: true,
        });
    }
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Ubicación' : 'Nueva Ubicación'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditing ? 'Editar Ubicación' : 'Nueva Ubicación' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <form @submit.prevent="submit">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="col-span-2 md:col-span-1">
                                <InputLabel for="name" value="Nombre de la Ubicación" />
                                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <InputLabel for="type" value="Tipo" />
                                <select id="type" v-model="form.type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" required>
                                    <option value="centro_de_servicio">Centro de Servicio</option>
                                    <option value="distribuidor">Distribuidor</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.type" />
                            </div>

                            <div class="col-span-2">
                                <InputLabel for="address_search" value="Buscar Dirección en Mapa" />
                                <AddressAutocomplete
                                    v-model="form.address"
                                    :with-map="true"
                                    :initial-lat="form.latitude"
                                    :initial-lng="form.longitude"
                                    @update:lat="val => form.latitude = val"
                                    @update:lng="val => form.longitude = val"
                                    @addressSelected="onAddressSelected"
                                    class="mt-1 block w-full"
                                />
                                <InputError class="mt-2" :message="form.errors.address" />
                            </div>

                            <div>
                                <InputLabel for="city" value="Ciudad" />
                                <TextInput id="city" v-model="form.city" type="text" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.city" />
                            </div>

                            <div>
                                <InputLabel for="state" value="Estado" />
                                <TextInput id="state" v-model="form.state" type="text" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.state" />
                            </div>

                            <div>
                                <InputLabel for="zip" value="Código Postal" />
                                <TextInput id="zip" v-model="form.zip" type="text" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.zip" />
                            </div>
                            
                            <div>
                                <InputLabel for="country" value="País" />
                                <TextInput id="country" v-model="form.country" type="text" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.country" />
                            </div>

                            <div>
                                <InputLabel for="phone" value="Teléfono" />
                                <TextInput id="phone" v-model="form.phone" type="text" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.phone" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Correo Electrónico" />
                                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            
                            <div class="col-span-2">
                                <hr class="my-4 border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Coordenadas para el Mapa</h3>
                            </div>

                            <div>
                                <InputLabel for="latitude" value="Latitud" />
                                <TextInput id="latitude" v-model="form.latitude" type="text" class="mt-1 block w-full" placeholder="Ej. 19.432608" />
                                <InputError class="mt-2" :message="form.errors.latitude" />
                            </div>
                            
                            <div>
                                <InputLabel for="longitude" value="Longitud" />
                                <TextInput id="longitude" v-model="form.longitude" type="text" class="mt-1 block w-full" placeholder="Ej. -99.133209" />
                                <InputError class="mt-2" :message="form.errors.longitude" />
                            </div>

                            <div class="block mt-4 col-span-2">
                                <label class="flex items-center">
                                    <Checkbox v-model:checked="form.is_active" name="is_active" />
                                    <span class="ml-2 text-sm text-gray-600">Ubicación Activa</span>
                                </label>
                            </div>

                            <div class="col-span-2 flex items-center justify-end mt-4 border-t border-gray-200 pt-4">
                                <Link :href="route('locations.index')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
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
