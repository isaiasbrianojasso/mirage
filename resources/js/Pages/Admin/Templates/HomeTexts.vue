<template>
    <AppLayout title="Textos y Banners - Pantalla Principal">
        <template #header>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Textos y Banners (Home)
                </h2>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Flash message -->
                <div v-if="$page.props.flash?.success"
                    class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ $page.props.flash.success }}</span>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Sidebar Tabs -->
                    <div class="w-full lg:w-64 flex-shrink-0">
                        <nav class="space-y-1">
                            <button
                                v-for="(tab, index) in tabs"
                                :key="index"
                                @click="activeTab = index"
                                :class="[
                                    activeTab === index 
                                        ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' 
                                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium',
                                    'w-full flex items-center px-4 py-3 text-sm rounded-xl transition-all text-left'
                                ]"
                            >
                                {{ tab.name }}
                            </button>
                        </nav>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <!-- 1. Banners Principales -->
                        <div v-show="activeTab === 0">
                            <SettingsGroup
                                title="Banners Principales"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>'
                                description="Textos del carrusel principal que aparece en la cabecera de la página."
                                group="home_template"
                                :fields="[
                                    { key: 'home_banner_title_fixed', label: 'Texto Fijo', placeholder: 'TECNOLOGÍA' },
                                    { key: 'home_banner_title_dynamic', label: 'Texto Dinámico (separado por comas)', placeholder: 'INVERTER,MODERNA,CONFIABLE' },
                                    { key: 'home_banner_main_image', type: 'image', label: 'Imagen Principal del Equipo', placeholder: 'https://...' },
                                    { key: 'home_banner_info_url', label: 'Enlace (Icono Información)', placeholder: 'https://...' },
                                    { key: 'home_banner_cart_url', label: 'Enlace (Icono Carrito)', placeholder: 'https://...' },
                                ]"
                                :settings="settings.home_template || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 2. Video Promocional -->
                        <div v-show="activeTab === 1">
                            <SettingsGroup
                                title="Video Promocional"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                                description="Video incrustado en la sección media del inicio."
                                group="home_template"
                                :fields="[
                                    { key: 'home_video_title', label: 'Título del Video', placeholder: 'Función Sígueme' },
                                    { key: 'home_video_url', label: 'URL del Video', placeholder: 'https://...' },
                                ]"
                                :settings="settings.home_template || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 3. Información de Instalación -->
                        <div v-show="activeTab === 2">
                            <SettingsGroup
                                title="Sección: Instalación"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
                                description="Textos de la tarjeta frontal y posterior de Instalación."
                                group="home_template"
                                :fields="[
                                    { key: 'home_info_install_title', label: 'Título Frontal', placeholder: 'Sobre la instalación' },
                                    { key: 'home_info_install_desc', type: 'textarea', label: 'Descripción Frontal', placeholder: 'Si compró su equipo...' },
                                    { key: 'home_info_install_back_title', label: 'Título Trasero', placeholder: 'Programe su visita' },
                                    { key: 'home_info_install_btn', label: 'Texto de Botón', placeholder: 'Clic Aquí' },
                                ]"
                                :settings="settings.home_template || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 4. Información de Garantía -->
                        <div v-show="activeTab === 3">
                            <SettingsGroup
                                title="Sección: Garantía"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>'
                                description="Textos de la tarjeta frontal y posterior de Soporte."
                                group="home_template"
                                :fields="[
                                    { key: 'home_info_warranty_title', label: 'Título Frontal', placeholder: 'Garantía y Soporte' },
                                    { key: 'home_info_warranty_desc', type: 'textarea', label: 'Descripción Frontal', placeholder: 'El departamento...' },
                                    { key: 'home_info_warranty_back_title', label: 'Título Trasero', placeholder: 'Inicie una solicitud' },
                                    { key: 'home_info_warranty_back_desc', type: 'textarea', label: 'Descripción Trasera', placeholder: 'Por favor...' },
                                    { key: 'home_info_warranty_btn', label: 'Texto de Botón', placeholder: 'Clic Aquí' },
                                ]"
                                :settings="settings.home_template || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 5. Información de Ubicaciones -->
                        <div v-show="activeTab === 4">
                            <SettingsGroup
                                title="Sección: Ubicaciones"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>'
                                description="Textos de la tarjeta frontal y posterior de Puntos de Venta."
                                group="home_template"
                                :fields="[
                                    { key: 'home_info_location_title', label: 'Título Frontal', placeholder: '¿Dónde estamos?' },
                                    { key: 'home_info_location_desc', type: 'textarea', label: 'Descripción Frontal', placeholder: 'Contamos con...' },
                                    { key: 'home_info_location_back_title', label: 'Título Trasero', placeholder: 'Localízenos' },
                                    { key: 'home_info_location_back_desc', type: 'textarea', label: 'Descripción Trasera', placeholder: 'Puede encontrar...' },
                                ]"
                                :settings="settings.home_template || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 6. Tarjetas de Categorías -->
                        <div v-show="activeTab === 5">
                            <SettingsGroup
                                title="Tarjetas de Categorías"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>'
                                description="Imágenes y títulos para las 3 tarjetas de categorías principales."
                                group="home_template"
                                :fields="[
                                    { key: 'home_category_1_title', label: 'Título (Tarjeta 1)', placeholder: 'Equipos convencionales' },
                                    { key: 'home_category_1_url', label: 'Enlace (Tarjeta 1)', placeholder: '/categoria' },
                                    { key: 'home_category_1_image', type: 'image', label: 'Imagen (Tarjeta 1)', placeholder: 'https://...' },
                                    { key: 'home_category_2_title', label: 'Título (Tarjeta 2)', placeholder: 'Equipos comercial ligero' },
                                    { key: 'home_category_2_url', label: 'Enlace (Tarjeta 2)', placeholder: '/categoria' },
                                    { key: 'home_category_2_image', type: 'image', label: 'Imagen (Tarjeta 2)', placeholder: 'https://...' },
                                    { key: 'home_category_3_title', label: 'Título (Tarjeta 3)', placeholder: 'Línea Blanca' },
                                    { key: 'home_category_3_url', label: 'Enlace (Tarjeta 3)', placeholder: '/categoria' },
                                    { key: 'home_category_3_image', type: 'image', label: 'Imagen (Tarjeta 3)', placeholder: 'https://...' },
                                ]"
                                :settings="settings.home_template || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 7. Banners Inferiores -->
                        <div v-show="activeTab === 6">
                            <SettingsGroup
                                title="Banners Promocionales Inferiores"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>'
                                description="Imágenes con enlace ubicadas al final de la página (Academia, Empleos, etc)."
                                group="home_template"
                                :fields="[
                                    { key: 'home_bottom_banner_1_url', label: 'Enlace (Banner Izquierdo)', placeholder: 'https://especialistas.mirage.mx' },
                                    { key: 'home_bottom_banner_1_image', type: 'image', label: 'Imagen (Banner Izquierdo)', placeholder: 'https://mirage.mx/.../banner1.webp' },
                                    { key: 'home_bottom_banner_2_url', label: 'Enlace (Banner Derecho)', placeholder: 'mailto:correo@mirage.mx' },
                                    { key: 'home_bottom_banner_2_image', type: 'image', label: 'Imagen (Banner Derecho)', placeholder: 'https://mirage.mx/.../banner2.webp' },
                                ]"
                                :settings="settings.home_template || {}"
                                @saved="onSaved"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingsGroup from '../CompanySettings/SettingsGroup.vue';

const props = defineProps({
    settings: Object,
});

const activeTab = ref(0);

const tabs = [
    { name: 'Banners Principales' },
    { name: 'Video Promocional' },
    { name: 'Sección: Instalación' },
    { name: 'Sección: Garantía' },
    { name: 'Sección: Ubicaciones' },
    { name: 'Tarjetas de Categorías' },
    { name: 'Banners Promocionales Inferiores' },
];

function onSaved() {
    // handled by controller flash message
}
</script>
