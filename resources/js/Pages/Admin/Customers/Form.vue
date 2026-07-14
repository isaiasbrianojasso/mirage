<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    customer: Object,
    groups: Array
});

const isEditing = !!props.customer;

const form = useForm({
    social_title: props.customer ? props.customer.social_title : '',
    first_name: props.customer ? props.customer.first_name : '',
    last_name: props.customer ? props.customer.last_name : '',
    email: props.customer ? props.customer.email : '',
    password: '',
    password_confirmation: '',
    birthday: props.customer ? props.customer.birthday : '',
    is_enabled: props.customer ? (props.customer.is_enabled ? true : false) : true,
    newsletter: props.customer ? (props.customer.newsletter ? true : false) : false,
    opt_in: props.customer ? (props.customer.opt_in ? true : false) : false,
    role: props.customer ? props.customer.role : 'user',
    customer_group_id: props.customer ? props.customer.customer_group_id : 3, // Default to Customer group (ID 3 in standard seeding)
    group_ids: []
});

onMounted(() => {
    if (isEditing && props.customer.groups) {
        form.group_ids = props.customer.groups.map(g => g.id);
    } else {
        // By default, assigning to standard 3 groups
        form.group_ids = [1, 2, 3];
    }
});

const submit = () => {
    if (isEditing) {
        form.put(route('customers.update', props.customer.id));
    } else {
        form.post(route('customers.store'));
    }
};
</script>

<template>
    <AppLayout :title="isEditing ? 'Editar Cliente' : 'Crear Nuevo Cliente'">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ isEditing ? 'Editar Cliente: ' + customer.first_name + ' ' + customer.last_name : 'Crear Nuevo Cliente' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                
                <div class="mb-4">
                    <Link :href="route('customers.index')" class="text-indigo-600 hover:text-indigo-900">
                        &larr; Volver a Clientes
                    </Link>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                    <div class="bg-gray-50 px-4 py-3 border-b flex items-center">
                        <svg class="h-5 w-5 text-gray-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <h3 class="text-lg font-medium text-gray-700">Información del Cliente</h3>
                    </div>

                    <div class="p-6">
                        <form @submit.prevent="submit" class="space-y-6">
                            
                            <!-- Social title -->
                            <div class="flex flex-col sm:flex-row items-start sm:items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4">Título (Sr. / Sra.)</label>
                                <div class="w-full sm:w-2/3 flex items-center space-x-6">
                                    <label class="inline-flex items-center">
                                        <input type="radio" v-model="form.social_title" value="Mr." class="form-radio text-indigo-600 border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">Sr.</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" v-model="form.social_title" value="Mrs." class="form-radio text-indigo-600 border-gray-300">
                                        <span class="ml-2 text-sm text-gray-700">Sra.</span>
                                    </label>
                                </div>
                            </div>

                            <!-- First name -->
                            <div class="flex flex-col sm:flex-row items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4"><span class="text-red-500">*</span> Nombre(s)</label>
                                <div class="w-full sm:w-2/3">
                                    <input type="text" v-model="form.first_name" required class="block w-full sm:max-w-md border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-blue-50/30">
                                    <p v-if="form.errors.first_name" class="mt-1 text-sm text-red-600">{{ form.errors.first_name }}</p>
                                </div>
                            </div>

                            <!-- Last name -->
                            <div class="flex flex-col sm:flex-row items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4"><span class="text-red-500">*</span> Apellido(s)</label>
                                <div class="w-full sm:w-2/3">
                                    <input type="text" v-model="form.last_name" required class="block w-full sm:max-w-md border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-blue-50/30">
                                    <p v-if="form.errors.last_name" class="mt-1 text-sm text-red-600">{{ form.errors.last_name }}</p>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col sm:flex-row items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4"><span class="text-red-500">*</span> Correo Electrónico</label>
                                <div class="w-full sm:w-2/3">
                                    <div class="flex rounded shadow-sm sm:max-w-md">
                                        <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </span>
                                        <input type="email" v-model="form.email" required class="flex-1 min-w-0 block w-full rounded-none rounded-r border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-blue-50/30">
                                    </div>
                                    <p v-if="form.errors.email" class="mt-1 text-sm text-red-600">{{ form.errors.email }}</p>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="flex flex-col sm:flex-row items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4">
                                    <span v-if="!isEditing" class="text-red-500">*</span> Contraseña
                                </label>
                                <div class="w-full sm:w-2/3">
                                    <div class="flex rounded shadow-sm sm:max-w-xs">
                                        <span class="inline-flex items-center px-3 rounded-l border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                            </svg>
                                        </span>
                                        <input type="password" v-model="form.password" :required="!isEditing" class="flex-1 min-w-0 block w-full rounded-none rounded-r border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-blue-50/30">
                                    </div>
                                    <p v-if="form.errors.password" class="mt-1 text-sm text-red-600">{{ form.errors.password }}</p>
                                </div>
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="flex flex-col sm:flex-row items-center" v-if="form.password !== '' || !isEditing">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4">Confirmar Contraseña</label>
                                <div class="w-full sm:w-2/3">
                                    <input type="password" v-model="form.password_confirmation" :required="!isEditing && form.password !== ''" class="block w-full sm:max-w-xs border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-blue-50/30">
                                </div>
                            </div>

                            <!-- Birthday -->
                            <div class="flex flex-col sm:flex-row items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4">Fecha de Nacimiento</label>
                                <div class="w-full sm:w-2/3">
                                    <input type="date" v-model="form.birthday" class="block w-full sm:max-w-xs border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-blue-50/30 text-gray-500">
                                    <p v-if="form.errors.birthday" class="mt-1 text-sm text-red-600">{{ form.errors.birthday }}</p>
                                </div>
                            </div>

                            <!-- Enabled -->
                            <div class="flex flex-col sm:flex-row items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4">¿Cuenta Activa?</label>
                                <div class="w-full sm:w-2/3 flex">
                                    <div class="flex rounded-md shadow-sm">
                                        <button type="button" @click="form.is_enabled = true" :class="['px-4 py-1.5 text-sm font-medium rounded-l-md border', form.is_enabled ? 'bg-cyan-500 text-white border-cyan-500' : 'bg-white text-gray-400 border-gray-300 hover:bg-gray-50']">SÍ</button>
                                        <button type="button" @click="form.is_enabled = false" :class="['px-4 py-1.5 text-sm font-medium rounded-r-md border border-l-0', !form.is_enabled ? 'bg-red-400 text-white border-red-400' : 'bg-white text-gray-400 border-gray-300 hover:bg-gray-50']">NO</button>
                                    </div>
                                    <p class="ml-4 text-xs text-gray-500 mt-2 sm:mt-0">Si marcas "NO", el cliente no podrá iniciar sesión en la tienda.</p>
                                </div>
                            </div>

                            <!-- Newsletter -->
                            <div class="flex flex-col sm:flex-row items-center">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4">¿Recibir Boletines?</label>
                                <div class="w-full sm:w-2/3 flex flex-col sm:flex-row sm:items-center">
                                    <div class="flex rounded-md shadow-sm">
                                        <button type="button" @click="form.newsletter = true" :class="['px-4 py-1.5 text-sm font-medium rounded-l-md border', form.newsletter ? 'bg-cyan-500 text-white border-cyan-500' : 'bg-white text-gray-400 border-gray-300 hover:bg-gray-50']">SÍ</button>
                                        <button type="button" @click="form.newsletter = false" :class="['px-4 py-1.5 text-sm font-medium rounded-r-md border border-l-0', !form.newsletter ? 'bg-red-400 text-white border-red-400' : 'bg-white text-gray-400 border-gray-300 hover:bg-gray-50']">NO</button>
                                    </div>
                                    <p class="ml-0 sm:ml-4 text-xs text-gray-500 mt-2 sm:mt-0">¿El cliente aceptó recibir correos promocionales?</p>
                                </div>
                            </div>

                            <!-- Role (Extra for admin control) -->
                            <div class="flex flex-col sm:flex-row items-center mt-6 pt-4 border-t border-gray-100">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4">Rol del Usuario</label>
                                <div class="w-full sm:w-2/3 flex">
                                    <div class="flex rounded-md shadow-sm">
                                        <button type="button" @click="form.role = 'admin'" :class="['px-4 py-1.5 text-sm font-medium rounded-l-md border', form.role === 'admin' ? 'bg-purple-500 text-white border-purple-500' : 'bg-white text-gray-400 border-gray-300 hover:bg-gray-50']">ADMINISTRADOR</button>
                                        <button type="button" @click="form.role = 'user'" :class="['px-4 py-1.5 text-sm font-medium rounded-r-md border border-l-0', form.role === 'user' ? 'bg-gray-500 text-white border-gray-500' : 'bg-white text-gray-400 border-gray-300 hover:bg-gray-50']">CLIENTE NORMAL</button>
                                    </div>
                                    <p class="ml-4 text-xs text-red-500 mt-2 sm:mt-0 font-medium">Cuidado: Si le das rol de ADMINISTRADOR, esta persona podrá entrar al panel de control.</p>
                                </div>
                            </div>

                            <!-- Group access table -->
                            <div class="flex flex-col sm:flex-row items-start pt-4 border-t border-gray-100">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-gray-600 text-left sm:text-right sm:pr-4 mt-2"><span class="text-red-500">*</span> ¿A qué grupos de clientes pertenece?</label>
                                <div class="w-full sm:w-2/3">
                                    <div class="border border-gray-300 rounded overflow-hidden max-w-md">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 w-12">
                                                        <!-- Select all checkbox omitted for simplicity, but could be added -->
                                                    </th>
                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500 w-16">ID</th>
                                                    <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-500">Group name</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr v-for="group in groups" :key="group.id" class="hover:bg-gray-50">
                                                    <td class="px-3 py-2 whitespace-nowrap">
                                                        <input type="checkbox" :value="group.id" v-model="form.group_ids" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    </td>
                                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500">{{ group.id }}</td>
                                                    <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">{{ group.name }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">Marca los grupos a los que este cliente tendrá acceso (para descuentos, etc).</p>
                                    <p v-if="form.errors.group_ids" class="mt-1 text-sm text-red-600">{{ form.errors.group_ids }}</p>
                                </div>
                            </div>

                            <!-- Default customer group -->
                            <div class="flex flex-col sm:flex-row items-center pt-2">
                                <label class="w-full sm:w-1/3 text-sm font-medium text-blue-500 text-left sm:text-right sm:pr-4">Grupo Principal (Por defecto)</label>
                                <div class="w-full sm:w-2/3 flex flex-col sm:flex-row sm:items-center">
                                    <select v-model="form.customer_group_id" class="block w-full sm:max-w-xs border-gray-300 rounded shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm bg-gray-50">
                                        <option v-for="group in groups" :key="group.id" :value="group.id">{{ group.name }}</option>
                                    </select>
                                    <p class="ml-0 sm:ml-4 text-xs text-gray-500 mt-2 sm:mt-0">De este grupo tomará sus reglas de impuestos y descuentos primarios.</p>
                                    <p v-if="form.errors.customer_group_id" class="mt-1 text-sm text-red-600">{{ form.errors.customer_group_id }}</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 bg-gray-50 px-4 py-3 sm:px-6 flex justify-between items-center mt-6 -mx-6 -mb-6 rounded-b-lg">
                                <Link :href="route('customers.index')" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Cancelar
                                </Link>
                                <button type="submit" :disabled="form.processing" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 disabled:opacity-50">
                                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                    </svg>
                                    Guardar Cliente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
