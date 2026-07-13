<script setup>
import { ref } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { onMounted } from 'vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const markNotificationsRead = () => {
    // Only send request if there are unread notifications
    if (usePage().props.notifications?.unread_count > 0) {
        router.post(route('notifications.mark_read'), {}, {
            preserveScroll: true,
            preserveState: true,
        });
    }
};

const logout = () => {
    router.post(route('logout'));
};

onMounted(() => {
    const key = usePage().props.google_maps_api_key;
    if (key && !document.getElementById('google-maps-script')) {
        const script = document.createElement('script');
        script.id = 'google-maps-script';
        script.src = `https://maps.google.com/maps/api/js?key=${key}&libraries=places&language=es&region=mx`;
        script.async = true;
        script.defer = true;
        script.onload = () => {
            window.dispatchEvent(new Event('google-maps-loaded'));
        };
        document.head.appendChild(script);
    } else if (window.google && window.google.maps && window.google.maps.places) {
        window.dispatchEvent(new Event('google-maps-loaded'));
    }
});
</script>

<template>
    <div>
        <Head :title="title" />
        <Banner />

        <!-- Main Layout Flex Container -->
        <div class="flex h-screen bg-gray-100 overflow-hidden font-sans">
            
            <!-- Mobile sidebar backdrop -->
            <div 
                v-if="showingNavigationDropdown" 
                class="fixed inset-0 z-20 transition-opacity bg-gray-900 opacity-50 md:hidden"
                @click="showingNavigationDropdown = false"
            ></div>

            <!-- Sidebar -->
            <aside 
                :class="[
                    showingNavigationDropdown ? 'translate-x-0' : '-translate-x-full',
                    'fixed inset-y-0 left-0 z-30 w-64 transition duration-300 transform bg-black text-slate-300 md:relative md:translate-x-0 overflow-y-auto flex flex-col shadow-xl'
                ]"
            >
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 bg-black border-b border-gray-800 shrink-0">
                    <Link :href="route('dashboard')" class="flex items-center gap-2">
                        <img v-if="$page.props.company_settings?.branding?.logo_url" 
                             :src="$page.props.company_settings.branding.logo_url" 
                             class="block h-8 w-auto object-contain max-w-[150px]" 
                             alt="Logo" />
                        <template v-else>
                            <ApplicationMark class="block h-8 w-auto text-white" />
                            <span class="text-white font-bold text-lg tracking-wide">
                                {{ $page.props.company_settings?.general?.company_name || 'Mirage Admin' }}
                            </span>
                        </template>
                    </Link>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-1 px-3 py-6 space-y-1">
                    <!-- Dashboard -->
                    <Link :href="route('dashboard')" 
                        :class="[route().current('dashboard') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </Link>

                    <!-- Compras del Usuario (Visible para todos) -->
                    <Link :href="route('customer.orders')" 
                        :class="[route().current('customer.orders*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        Mis Pedidos
                    </Link>

                    <Link :href="route('customer.notifications')" 
                        :class="[route().current('customer.notifications*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                        <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Notificaciones
                    </Link>

                    <template v-if="$page.props.auth.user.role === 'admin'">
                        <!-- CATÁLOGO -->
                        <div class="pt-4 pb-1">
                            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Catálogo</p>
                        </div>
                        <Link :href="route('categories.index')" 
                            :class="[route().current('categories.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            Categorías
                        </Link>
                        <Link :href="route('products.index')" 
                            :class="[route().current('products.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Productos
                        </Link>
                        <Link :href="route('locations.index')" 
                            :class="[route().current('locations.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Ubicaciones
                        </Link>

                        <!-- VENTAS -->
                        <div class="pt-4 pb-1">
                            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Ventas</p>
                        </div>
                        <Link :href="route('orders.index')" 
                            :class="[route().current('orders.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            Pedidos
                        </Link>
                        <Link :href="route('customers.index')" 
                            :class="[route().current('customers.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Clientes
                        </Link>
                        <Link :href="route('customer-groups.index')" 
                            :class="[route().current('customer-groups.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Grupos
                        </Link>

                        <!-- MEJORAR -->
                        <div class="pt-4 pb-1">
                            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Mejorar</p>
                        </div>
                        <Link :href="route('newsletter.create')" 
                            :class="[route().current('newsletter.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Boletines
                        </Link>
                        <Link :href="route('banners.index')" 
                            :class="[route().current('banners.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Banners
                        </Link>
                        <Link :href="route('carriers.index')" 
                            :class="[route().current('carriers.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                            </svg>
                            Transporte
                        </Link>
                        <Link :href="route('zones.index')" 
                            :class="[route().current('zones.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Zonas
                        </Link>

                        <!-- PLANTILLAS -->
                        <div class="pt-4 pb-1">
                            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Plantillas</p>
                        </div>
                        <div class="px-3 py-2">
                            <p class="text-xs font-medium text-slate-400 mb-1">Pantalla Principal</p>
                            <Link :href="route('templates.home.texts.index')" 
                                :class="[route().current('templates.home.texts.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                                Textos y Banners
                            </Link>
                            <Link :href="route('posts.index')" 
                                :class="[route().current('posts.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                </svg>
                                Novedades
                            </Link>
                        </div>
                        <div class="px-3 py-2">
                            <p class="text-xs font-medium text-slate-400 mb-1">Tienda y Catálogo</p>
                            <Link :href="route('templates.store.texts.index')" 
                                :class="[route().current('templates.store.texts.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Textos de Tienda
                            </Link>
                        </div>

                        <!-- CONFIGURAR -->
                        <div class="pt-4 pb-1">
                            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Configurar</p>
                        </div>
                        <Link :href="route('company-settings.edit')" 
                            :class="[route().current('company-settings.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Parámetros de Tienda
                        </Link>
                        <Link :href="route('email-logs.index')" 
                            :class="[route().current('email-logs.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            Registro de Correos
                        </Link>
                        <Link :href="route('admin.email-templates.index')" 
                            :class="[route().current('admin.email-templates.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Plantillas de Correo
                        </Link>
                        <Link :href="route('admin.system-update.index')" 
                            :class="[route().current('admin.system-update.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors mt-1']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Actualizaciones
                        </Link>
                    </template>
                </nav>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col w-0 overflow-hidden">
                <!-- Top Navbar -->
                <header class="flex items-center justify-between shrink-0 h-16 bg-white border-b border-gray-200 px-4 sm:px-6 lg:px-8 shadow-sm">
                    <!-- Mobile Hamburger -->
                    <div class="flex items-center md:hidden">
                        <button 
                            @click="showingNavigationDropdown = true" 
                            class="text-gray-500 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 p-2 -ml-2 rounded-md"
                        >
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>

                    <!-- Left side spacer for desktop -->
                    <div class="hidden md:flex flex-1">
                        <!-- Quick actions could go here -->
                        <a :href="route('tienda.index')" target="_blank" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-full shadow-sm text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <svg class="-ml-1 mr-1.5 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            Ver Tienda
                        </a>
                    </div>

                    <!-- Right Side Dropdowns -->
                    <div class="flex items-center ml-4 space-x-4">
                        
                        <!-- Notifications Dropdown -->
                        <Dropdown align="right" width="80" v-if="$page.props.notifications">
                            <template #trigger>
                                <button type="button" class="relative p-2 text-gray-400 hover:text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none transition-colors" @click="markNotificationsRead">
                                    <span class="sr-only">Ver notificaciones</span>
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                    </svg>
                                    <span v-if="$page.props.notifications.unread_count > 0" class="absolute top-1.5 right-1.5 block h-2.5 w-2.5 rounded-full bg-red-500 ring-2 ring-white"></span>
                                </button>
                            </template>

                            <template #content>
                                <div class="px-4 py-3 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-md">
                                    <h3 class="text-sm font-semibold text-gray-900">Notificaciones</h3>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    <template v-if="$page.props.notifications.data.length > 0">
                                        <div v-for="log in $page.props.notifications.data" :key="log.id" class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 transition-colors">
                                            <p class="text-sm font-medium text-gray-900 truncate">{{ log.subject }}</p>
                                            <p class="text-xs text-gray-500 mt-1 truncate">
                                                {{ new Date(log.created_at).toLocaleDateString('es-MX', { month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' }) }}
                                            </p>
                                        </div>
                                    </template>
                                    <div v-else class="px-4 py-6 text-center text-sm text-gray-500">
                                        No hay notificaciones recientes.
                                    </div>
                                </div>
                                <div class="border-t border-gray-100">
                                    <Link :href="route($page.props.auth.user.role === 'admin' ? 'email-logs.index' : 'customer.notifications')" class="block px-4 py-2 text-xs text-indigo-600 font-medium text-center hover:bg-gray-50 transition-colors rounded-b-md">
                                        Ver todas las notificaciones
                                    </Link>
                                </div>
                            </template>
                        </Dropdown>

                        <!-- Settings Dropdown -->
                        <Dropdown align="right" width="48">
                            <template #trigger>
                                <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="size-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                </button>
                                <span v-else class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:text-gray-900 focus:outline-none transition">
                                        <div class="h-8 w-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-2">
                                            {{ $page.props.auth.user.name.charAt(0) }}
                                        </div>
                                        {{ $page.props.auth.user.name }}
                                        <svg class="ml-2 -mr-0.5 size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <div class="block px-4 py-2 text-xs text-gray-400">Administrar Cuenta</div>
                                <DropdownLink :href="route('profile.show')">Perfil</DropdownLink>
                                <div class="border-t border-gray-200" />
                                <!-- Authentication -->
                                <form @submit.prevent="logout">
                                    <DropdownLink as="button">Cerrar Sesión</DropdownLink>
                                </form>
                            </template>
                        </Dropdown>
                    </div>
                </header>

                <!-- Scrollable Main View -->
                <main class="flex-1 overflow-y-auto focus:outline-none bg-gray-100">
                    <!-- Page Heading -->
                    <header v-if="$slots.header" class="bg-white shadow-sm ring-1 ring-black ring-opacity-5">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            <slot name="header" />
                        </div>
                    </header>

                    <!-- Content Slot -->
                    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                        <slot />
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
