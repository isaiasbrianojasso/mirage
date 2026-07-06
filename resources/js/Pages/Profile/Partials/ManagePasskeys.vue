<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';
import DangerButton from '@/Components/DangerButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { create, get } from '@github/webauthn-json';
import axios from 'axios';

const passkeys = ref(usePage().props.passkeys || []);
const creatingPasskey = ref(false);
const passkeyName = ref('');
const form = useForm({
    name: '',
});

const startRegistration = async () => {
    creatingPasskey.value = true;
};

const registerPasskey = async () => {
    try {
        // 1. Get options from server
        const optionsResponse = await axios.get(route('passkey.registration-options'));
        
        // 2. Pass options to WebAuthn API
        const credential = await create({
            publicKey: optionsResponse.data.publicKey
        });
        
        // 3. Send response back to server
        await axios.post(route('passkey.store'), {
            name: form.name,
            credential: JSON.stringify(credential)
        });

        // Close modal and refresh page
        creatingPasskey.value = false;
        form.name = '';
        window.location.reload();
        
    } catch (error) {
        console.error("Passkey registration failed:", error);
        alert('Error al registrar Passkey. Por favor intenta de nuevo.');
    }
};

const deletePasskey = async (id) => {
    if (confirm('¿Estás seguro de que deseas eliminar este Passkey?')) {
        await axios.delete(route('passkey.destroy', id));
        window.location.reload();
    }
};
</script>

<template>
    <ActionSection>
        <template #title>
            Passkeys (Inicio de Sesión Biométrico)
        </template>

        <template #description>
            Administra tus huellas dactilares, FaceID o llaves de seguridad físicas para iniciar sesión rápidamente y sin contraseñas.
        </template>

        <template #content>
            <h3 class="text-lg font-medium text-gray-900" v-if="passkeys.length > 0">
                Tus Passkeys Guardados
            </h3>
            
            <div class="mt-3 max-w-xl text-sm text-gray-600" v-else>
                No tienes ningún Passkey registrado. Añade uno para iniciar sesión usando tu huella, rostro o llave física.
            </div>

            <!-- List of Passkeys -->
            <div class="mt-5 space-y-4" v-if="passkeys.length > 0">
                <div v-for="passkey in passkeys" :key="passkey.id" class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                    <div>
                        <div class="font-semibold text-gray-900">{{ passkey.name }}</div>
                        <div class="text-xs text-gray-500 mt-1">
                            Agregado el {{ new Date(passkey.created_at).toLocaleDateString('es-MX') }}
                        </div>
                    </div>
                    <button class="text-sm text-red-600 hover:text-red-900" @click="deletePasskey(passkey.id)">
                        Eliminar
                    </button>
                </div>
            </div>

            <div class="mt-5">
                <PrimaryButton @click="startRegistration">
                    Registrar Nuevo Passkey
                </PrimaryButton>
            </div>

            <!-- Create Passkey Modal -->
            <DialogModal :show="creatingPasskey" @close="creatingPasskey = false">
                <template #title>
                    Registrar Nuevo Passkey
                </template>

                <template #content>
                    Dale un nombre a este dispositivo (Ej: "iPhone de Juan", "MacBook Pro").
                    
                    <div class="mt-4">
                        <InputLabel for="name" value="Nombre del Dispositivo" />
                        <TextInput
                            id="name"
                            v-model="form.name"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Ej: Mi Celular"
                            autofocus
                        />
                        <InputError :message="form.errors.name" class="mt-2" />
                    </div>
                </template>

                <template #footer>
                    <SecondaryButton @click="creatingPasskey = false">
                        Cancelar
                    </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing || !form.name"
                        @click="registerPasskey"
                    >
                        Continuar
                    </PrimaryButton>
                </template>
            </DialogModal>
        </template>
    </ActionSection>
</template>
