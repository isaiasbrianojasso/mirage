<template>
    <AppLayout title="Textos de Tienda y Catálogo">
        <template #header>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Textos de Tienda y Catálogo
                </h2>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Explicación de la sección -->
                <div class="mb-6 bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Personaliza tu Tienda</h3>
                    <p class="text-sm text-gray-500">
                        Aquí puedes cambiar las palabras y frases que ven tus clientes cuando están navegando por el catálogo de productos. Modifica los títulos, los textos de los botones y la información del pie de página para que tengan la voz de tu marca.
                    </p>
                </div>

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
                        <!-- 1. Títulos de Secciones (Tienda) -->
                        <div v-show="activeTab === 0">
                            <SettingsGroup
                                title="Títulos de Secciones"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>'
                                description="Títulos principales para los listados de productos en la página de la tienda."
                                group="tienda"
                                :fields="[
                                    { key: 'store_featured_title', label: 'Productos Destacados', placeholder: 'PRODUCTOS DESTACADOS' },
                                    { key: 'store_appliances_title', label: 'Línea Blanca', placeholder: 'LINEA BLANCA' },
                                    { key: 'store_parts_title', label: 'Refacciones', placeholder: 'REFACCIONES' },
                                ]"
                                :settings="settings.tienda || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 2. Banners Informativos (Tienda) -->
                        <div v-show="activeTab === 1">
                            <SettingsGroup
                                title="Banners de Servicio"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                                description="Textos informativos sobre satisfacción, pagos y envíos."
                                group="tienda"
                                :fields="[
                                    { key: 'store_banner_satisfaction_title', label: 'Título - Satisfacción', placeholder: 'SATISFACCIÓN GARANTIZADA' },
                                    { key: 'store_banner_satisfaction_desc', label: 'Desc - Satisfacción', placeholder: 'Cumplimos con las mas exigentes normas...' },
                                    { key: 'store_banner_payments_title', label: 'Título - Pagos Seguros', placeholder: 'Pagos Seguros' },
                                    { key: 'store_banner_payments_desc', label: 'Desc - Pagos Seguros', placeholder: 'Todos tus pagos son seguros...' },
                                    { key: 'store_banner_shipping_title', label: 'Título - Envíos', placeholder: 'Envíos a todo el país' },
                                    { key: 'store_banner_shipping_desc', label: 'Desc - Envíos', placeholder: 'Llevamos hasta tu casa...' },
                                ]"
                                :settings="settings.tienda || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 3. Suscripción / Newsletter (Tienda) -->
                        <div v-show="activeTab === 2">
                            <SettingsGroup
                                title="Boletín (Newsletter)"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>'
                                description="Formulario de suscripción a correos promocionales."
                                group="tienda"
                                :fields="[
                                    { key: 'store_newsletter_title', label: 'Título', placeholder: 'Newsletter' },
                                    { key: 'store_newsletter_desc', label: 'Descripción', placeholder: 'Entérate de nuestras promociones...' },
                                    { key: 'store_newsletter_btn', label: 'Texto del Botón', placeholder: 'Suscribirse' },
                                    { key: 'store_newsletter_placeholder', label: 'Texto de ayuda en input', placeholder: 'Su correo electrónico' },
                                ]"
                                :settings="settings.tienda || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 4. SEO y Títulos (Catálogo) -->
                        <div v-show="activeTab === 3">
                            <SettingsGroup
                                title="Encabezados del Catálogo"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>'
                                description="Configuración de títulos y SEO para la vista general de productos."
                                group="content"
                                :fields="[
                                    { key: 'catalog_all_products_title', label: 'Título en Navegador (SEO)', placeholder: `Todos los Productos de ${companyName}` },
                                    { key: 'catalog_all_products_heading', label: 'Título Principal en Página (H1)', placeholder: `Todos los Productos de ${companyName}` },
                                ]"
                                :settings="settings.content || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 5. Menú Superior (Catálogo) -->
                        <div v-show="activeTab === 4">
                            <SettingsGroup
                                title="Enlaces del Menú"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>'
                                description="Textos de los botones que aparecen en el menú superior."
                                group="content"
                                :fields="[
                                    { key: 'catalog_menu_company_label', label: 'Botón - Empresa', placeholder: companyName },
                                    { key: 'catalog_menu_blog_label', label: 'Botón - Blog', placeholder: `Blog de ${companyName}` },
                                    { key: 'catalog_store_label', label: 'Botón - Tienda', placeholder: `Tienda ${companyName}` },
                                ]"
                                :settings="settings.content || {}"
                                @saved="onSaved"
                            />
                        </div>

                        <!-- 6. Pie de Página / Footer (Catálogo) -->
                        <div v-show="activeTab === 5">
                            <SettingsGroup
                                title="Pie de Página (Footer)"
                                icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" /></svg>'
                                description="Información de certificaciones y logística al fondo de la página."
                                group="content"
                                :fields="[
                                    { key: 'catalog_certification_label', label: 'Enlace - Certificación', placeholder: `Certificaciones de ${companyName}` },
                                    { key: 'catalog_app_home_label', label: 'Enlace - App Home', placeholder: `${companyName} Home` },
                                    { key: 'catalog_footer_brand_title', label: 'Título de Marca', placeholder: companyName },
                                    { key: 'catalog_logistics_image', type: 'image', label: 'Imagen de Logística', placeholder: 'Dejar vacío para imagen por defecto' },
                                ]"
                                :settings="settings.content || {}"
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
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingsGroup from '../CompanySettings/SettingsGroup.vue';

const props = defineProps({
    settings: Object,
});

const page = usePage();
// Get company name from general settings or fallback to 'Mi Tienda'
const companyName = computed(() => {
    return page.props.company_settings?.general?.company_name || 'Mi Tienda';
});

const activeTab = ref(0);

const tabs = [
    { name: 'Títulos de Secciones' },
    { name: 'Banners de Servicio' },
    { name: 'Boletín (Newsletter)' },
    { name: 'Encabezados del Catálogo' },
    { name: 'Enlaces del Menú' },
    { name: 'Pie de Página (Footer)' },
];

function onSaved() {
    // handled by controller flash message
}
</script>
