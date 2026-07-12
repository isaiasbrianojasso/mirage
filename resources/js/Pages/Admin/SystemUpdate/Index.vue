<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    currentBranch: String,
    currentCommit: String,
});

const isChecking = ref(false);
const isApplying = ref(false);
const hasUpdates = ref(false);
const commits = ref([]);
const checkMessage = ref('');
const checkError = ref(false);

const runNpmBuild = ref(false);

const updateLog = ref('');
const updateSuccess = ref(false);
const updateError = ref(false);
const showLog = ref(false);

const githubPat = ref('');

const checkUpdates = async () => {
    isChecking.value = true;
    checkMessage.value = '';
    checkError.value = false;
    hasUpdates.value = false;
    commits.value = [];
    showLog.value = false;

    try {
        const response = await axios.post(route('admin.system-update.check'), {
            github_pat: githubPat.value
        });
        
        if (response.data.success) {
            hasUpdates.value = response.data.has_updates;
            commits.value = response.data.commits || [];
            
            if (hasUpdates.value) {
                checkMessage.value = `Se encontraron ${commits.value.length} actualización(es) pendiente(s).`;
            } else {
                checkMessage.value = 'El sistema está actualizado. No hay nuevos commits en la rama ' + props.currentBranch + '.';
            }
        }
    } catch (error) {
        checkError.value = true;
        checkMessage.value = error.response?.data?.message || 'Error de conexión al verificar actualizaciones.';
    } finally {
        isChecking.value = false;
    }
};

const applyUpdate = async () => {
    if (!confirm('¿Estás seguro de que deseas aplicar esta actualización en producción? Este proceso puede tardar unos minutos y pondrá el sistema en modo mantenimiento temporalmente.')) {
        return;
    }

    isApplying.value = true;
    updateLog.value = 'Iniciando actualización...\n';
    showLog.value = true;
    updateSuccess.value = false;
    updateError.value = false;

    try {
        const response = await axios.post(route('admin.system-update.apply'), {
            run_npm_build: runNpmBuild.value,
            github_pat: githubPat.value
        });

        if (response.data.success) {
            updateSuccess.value = true;
            updateLog.value += response.data.log;
            hasUpdates.value = false;
            commits.value = [];
            checkMessage.value = 'Actualización aplicada con éxito. Por favor recarga la página.';
        }
    } catch (error) {
        updateError.value = true;
        updateLog.value += (error.response?.data?.log || error.response?.data?.message || 'Ocurrió un error inesperado al aplicar la actualización.');
    } finally {
        isApplying.value = false;
    }
};
</script>

<template>
    <AppLayout title="Actualizaciones del Sistema">
        <div class="min-h-screen bg-gray-50/50 text-gray-900 font-sans">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">
                
                <div class="border-b border-gray-200 pb-6 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-semibold tracking-tight text-gray-900 mb-1">
                            Actualizaciones del Sistema
                        </h1>
                        <p class="text-gray-500 text-sm">Gestiona y aplica actualizaciones directamente desde GitHub.</p>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="block text-sm font-medium text-gray-500 mb-1">Rama Actual</span>
                            <span class="text-lg font-semibold text-gray-900">{{ currentBranch }}</span>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <span class="block text-sm font-medium text-gray-500 mb-1">Commit Local</span>
                            <span class="text-lg font-mono text-gray-900">{{ currentCommit }}</span>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="githubPat" class="block text-sm font-medium text-gray-700 mb-1">Personal Access Token (PAT) de GitHub</label>
                        <input 
                            id="githubPat" 
                            type="password" 
                            v-model="githubPat" 
                            placeholder="Opcional: ghp_xxxxxxxxxxxx..."
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-black focus:ring-black sm:text-sm"
                        />
                        <p class="mt-1 text-xs text-gray-500">Ingresa tu token si el repositorio es privado. Este dato no se guardará por seguridad, solo se usa para la ejecución actual.</p>
                    </div>

                    <div class="flex items-center justify-between">
                        <button 
                            @click="checkUpdates" 
                            :disabled="isChecking || isApplying"
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 disabled:opacity-50 transition-colors"
                        >
                            <svg v-if="isChecking" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ isChecking ? 'Verificando...' : 'Buscar Actualizaciones' }}
                        </button>

                        <div v-if="checkMessage" :class="['text-sm font-medium', checkError ? 'text-red-600' : (hasUpdates ? 'text-blue-600' : 'text-green-600')]">
                            {{ checkMessage }}
                        </div>
                    </div>
                </div>

                <!-- Updates List -->
                <div v-if="hasUpdates && commits.length > 0" class="bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-base font-semibold text-gray-900">Cambios Pendientes ({{ commits.length }})</h3>
                    </div>
                    <ul class="divide-y divide-gray-100 max-h-64 overflow-y-auto">
                        <li v-for="commit in commits" :key="commit.hash" class="px-6 py-3 flex items-start space-x-3 hover:bg-gray-50">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-mono font-medium bg-gray-100 text-gray-800">
                                {{ commit.hash }}
                            </span>
                            <span class="text-sm text-gray-600">{{ commit.message }}</span>
                        </li>
                    </ul>
                    <div class="px-6 py-5 bg-gray-50 border-t border-gray-100">
                        
                        <div class="mb-4 flex items-center">
                            <input id="runNpmBuild" type="checkbox" v-model="runNpmBuild" class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                            <label for="runNpmBuild" class="ml-2 block text-sm text-gray-900">
                                Ejecutar <code class="bg-gray-200 px-1 rounded text-xs">npm run build</code> (Marcar solo si hay cambios en JS/CSS/Vue)
                            </label>
                        </div>

                        <button 
                            @click="applyUpdate" 
                            :disabled="isApplying"
                            class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 disabled:opacity-50 transition-colors"
                        >
                            <svg v-if="isApplying" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ isApplying ? 'Aplicando actualización...' : 'Aplicar Actualización Ahora' }}
                        </button>
                    </div>
                </div>

                <!-- Log Output -->
                <div v-if="showLog" class="bg-gray-900 rounded-2xl shadow-sm overflow-hidden">
                    <div class="px-6 py-3 border-b border-gray-700 bg-gray-800 flex justify-between items-center">
                        <h3 class="text-sm font-semibold text-white">Registro del Proceso (Log)</h3>
                        <span v-if="updateSuccess" class="text-green-400 text-xs font-bold uppercase">Completado</span>
                        <span v-if="updateError" class="text-red-400 text-xs font-bold uppercase">Error</span>
                    </div>
                    <div class="p-6">
                        <pre class="text-gray-300 font-mono text-xs whitespace-pre-wrap max-h-96 overflow-y-auto">{{ updateLog }}</pre>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
