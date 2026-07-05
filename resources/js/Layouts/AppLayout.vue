<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const logout = () => {
    router.post(route('logout'));
};
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
                    'fixed inset-y-0 left-0 z-30 w-64 transition duration-300 transform bg-slate-900 text-slate-300 md:relative md:translate-x-0 overflow-y-auto flex flex-col shadow-xl'
                ]"
            >
                <!-- Logo -->
                <div class="flex items-center justify-center h-16 bg-slate-950 border-b border-slate-800 shrink-0">
                    <Link :href="route('dashboard')" class="flex items-center gap-2">
                        <ApplicationMark class="block h-8 w-auto text-white" />
                        <span class="text-white font-bold text-lg tracking-wide">Mirage Admin</span>
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
                            :class="[route().current('products.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            Productos
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
                        <Link :href="route('banners.index')" 
                            :class="[route().current('banners.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
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

                        <!-- CONFIGURAR -->
                        <div class="pt-4 pb-1">
                            <p class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Configurar</p>
                        </div>
                        <Link :href="route('company-settings.edit')" 
                            :class="[route().current('company-settings.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Parámetros de Tienda
                        </Link>
                        <Link :href="route('admin.email-templates.index')" 
                            :class="[route().current('admin.email-templates.*') ? 'bg-indigo-600 text-white' : 'hover:bg-slate-800 hover:text-white', 'group flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors']">
                            <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Plantillas de Correo
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
