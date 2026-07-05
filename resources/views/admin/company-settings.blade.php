<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Empresa - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .tab-content { display: none; }
        .tab-content.active { display: block; }
        .tab-btn.active { @apply bg-slate-800 text-white shadow; }
        .tab-btn { @apply bg-white text-gray-600 border border-gray-200 hover:bg-gray-50; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-5xl mx-auto p-6">
        <div class="bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="px-8 py-6 border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-900">🏢 Configuración de Empresa</h1>
                <p class="text-gray-600 mt-1">Edita la información general de tu negocio</p>
            </div>

            <!-- Flash Message -->
            @if(session('success'))
            <div class="mx-8 mt-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            @endif

            <!-- Tabs -->
            <div class="px-8 pt-6 border-b border-gray-200">
                <div class="flex gap-2 flex-wrap">
                    <button onclick="switchTab('general')" class="tab-btn active tab-btn-general px-4 py-2 rounded-lg text-sm font-medium transition">
                        🏢 General
                    </button>
                    <button onclick="switchTab('branding')" class="tab-btn tab-btn-branding px-4 py-2 rounded-lg text-sm font-medium transition">
                        🎨 Branding
                    </button>
                    <button onclick="switchTab('contact')" class="tab-btn tab-btn-contact px-4 py-2 rounded-lg text-sm font-medium transition">
                        📞 Contacto
                    </button>
                    <button onclick="switchTab('social')" class="tab-btn tab-btn-social px-4 py-2 rounded-lg text-sm font-medium transition">
                        🔗 Redes Sociales
                    </button>
                    <button onclick="switchTab('content')" class="tab-btn tab-btn-content px-4 py-2 rounded-lg text-sm font-medium transition">
                        📝 Contenido
                    </button>
                    <button onclick="switchTab('home_template')" class="tab-btn tab-btn-home_template px-4 py-2 rounded-lg text-sm font-medium transition">
                        🏠 Página Principal
                    </button>
                    <button onclick="switchTab('store_template')" class="tab-btn tab-btn-store_template px-4 py-2 rounded-lg text-sm font-medium transition">
                        🛍️ Tienda
                    </button>
                    <button onclick="switchTab('payments')" class="tab-btn tab-btn-payments px-4 py-2 rounded-lg text-sm font-medium transition">
                        💳 Pagos
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">

                <!-- General Tab -->
                <div id="general" class="tab-content active">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="general">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre de la Empresa</label>
                            <input type="text" name="settings[company_name]" value="{{ old('settings.company_name', $settings['general']['company_name']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Este nombre aparece en el SEO y en el alt del logo</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
                            <input type="text" name="settings[company_name_full]" value="{{ old('settings.company_name_full', $settings['general']['company_name_full']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                            <textarea name="settings[company_description]" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.company_description', $settings['general']['company_description']->value ?? '') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                            <input type="text" name="settings[company_tagline]" value="{{ old('settings.company_tagline', $settings['general']['company_tagline']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL del Sitio Web</label>
                            <input type="url" name="settings[company_website_url]" value="{{ old('settings.company_website_url', $settings['general']['company_website_url']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

                <!-- Branding Tab -->
                <div id="branding" class="tab-content">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="branding">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL del Logo</label>
                            <input type="url" name="settings[logo_url]" value="{{ old('settings.logo_url', $settings['branding']['logo_url']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL del Favicon</label>
                            <input type="url" name="settings[favicon_url]" value="{{ old('settings.favicon_url', $settings['branding']['favicon_url']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color Primario</label>
                            <input type="color" name="settings[primary_color]" value="{{ old('settings.primary_color', $settings['branding']['primary_color']->value ?? '#a00000') }}"
                                class="w-20 h-12 border border-gray-300 rounded-lg cursor-pointer">
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

                <!-- Contact Tab -->
                <div id="contact" class="tab-content">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="contact">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email de Contacto</label>
                            <input type="email" name="settings[contact_email]" value="{{ old('settings.contact_email', $settings['contact']['contact_email']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                            <input type="tel" name="settings[contact_phone]" value="{{ old('settings.contact_phone', $settings['contact']['contact_phone']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Dirección</label>
                            <textarea name="settings[contact_address]" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.contact_address', $settings['contact']['contact_address']->value ?? '') }}</textarea>
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

                <!-- Social Tab -->
                <div id="social" class="tab-content">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="social">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Facebook</label>
                            <input type="url" name="settings[social_facebook]" value="{{ old('settings.social_facebook', $settings['social']['social_facebook']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Twitter</label>
                            <input type="url" name="settings[social_twitter]" value="{{ old('settings.social_twitter', $settings['social']['social_twitter']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">YouTube</label>
                            <input type="url" name="settings[social_youtube]" value="{{ old('settings.social_youtube', $settings['social']['social_youtube']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tienda Online</label>
                            <input type="url" name="settings[online_store_url]" value="{{ old('settings.online_store_url', $settings['social']['online_store_url']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Portal B2B</label>
                            <input type="url" name="settings[b2b_portal_url]" value="{{ old('settings.b2b_portal_url', $settings['social']['b2b_portal_url']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Portal de Certificación</label>
                            <input type="url" name="settings[certification_portal_url]" value="{{ old('settings.certification_portal_url', $settings['social']['certification_portal_url']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL Servicio de Instalación</label>
                            <input type="url" name="settings[installation_service_url]" value="{{ old('settings.installation_service_url', $settings['social']['installation_service_url']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

                <!-- Content Tab -->
                <div id="content" class="tab-content">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="content">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título: Todos los Productos</label>
                            <input type="text" name="settings[catalog_all_products_title]" value="{{ old('settings.catalog_all_products_title', $settings['content']['catalog_all_products_title']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Encabezado: Todos los Productos</label>
                            <input type="text" name="settings[catalog_all_products_heading]" value="{{ old('settings.catalog_all_products_heading', $settings['content']['catalog_all_products_heading']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Etiqueta Menú: Empresa</label>
                            <input type="text" name="settings[catalog_menu_company_label]" value="{{ old('settings.catalog_menu_company_label', $settings['content']['catalog_menu_company_label']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Etiqueta: Tienda</label>
                            <input type="text" name="settings[catalog_store_label]" value="{{ old('settings.catalog_store_label', $settings['content']['catalog_store_label']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

                <!-- Home Template Tab -->
                <div id="home_template" class="tab-content">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="home_template">

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Banner Principal</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Fijo (Ej. TECNOLOGÍA)</label>
                            <input type="text" name="settings[home_banner_title_fixed]" value="{{ old('settings.home_banner_title_fixed', $settings['home_template']['home_banner_title_fixed']->value ?? 'TECNOLOGÍA') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Textos Dinámicos (Ej. INVERTER, MODERNA, CONFIABLE)</label>
                            <input type="text" name="settings[home_banner_title_dynamic]" value="{{ old('settings.home_banner_title_dynamic', $settings['home_template']['home_banner_title_dynamic']->value ?? 'INVERTER, MODERNA, CONFIABLE') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                            <p class="text-xs text-gray-500 mt-1">Separados por coma</p>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Cajas de Información (Instalación)</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título: Instalación</label>
                            <input type="text" name="settings[home_info_install_title]" value="{{ old('settings.home_info_install_title', $settings['home_template']['home_info_install_title']->value ?? 'Sobre la instalación') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción: Instalación</label>
                            <textarea name="settings[home_info_install_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.home_info_install_desc', $settings['home_template']['home_info_install_desc']->value ?? 'Si compró su equipo en una tienda departamental o de autoservicio que incluía el servicio de instalación gratis') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Trasero: Instalación</label>
                            <input type="text" name="settings[home_info_install_back_title]" value="{{ old('settings.home_info_install_back_title', $settings['home_template']['home_info_install_back_title']->value ?? 'Programe su visita') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Botón: Instalación</label>
                            <input type="text" name="settings[home_info_install_btn]" value="{{ old('settings.home_info_install_btn', $settings['home_template']['home_info_install_btn']->value ?? 'Clic Aquí') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Cajas de Información (Garantía)</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título: Garantía</label>
                            <input type="text" name="settings[home_info_warranty_title]" value="{{ old('settings.home_info_warranty_title', $settings['home_template']['home_info_warranty_title']->value ?? 'Garantía y Soporte') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción: Garantía</label>
                            <textarea name="settings[home_info_warranty_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.home_info_warranty_desc', $settings['home_template']['home_info_warranty_desc']->value ?? 'El departamento de garantías atiende las reclamaciones a través de los centros de servicio de los distribuidores.') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Trasero: Garantía</label>
                            <input type="text" name="settings[home_info_warranty_back_title]" value="{{ old('settings.home_info_warranty_back_title', $settings['home_template']['home_info_warranty_back_title']->value ?? 'Inicie una solicitud de servicio') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción Trasera: Garantía</label>
                            <textarea name="settings[home_info_warranty_back_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.home_info_warranty_back_desc', $settings['home_template']['home_info_warranty_back_desc']->value ?? 'Por favor dé "clic" en el siguiente botón y complete el formulario.') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Botón: Garantía</label>
                            <input type="text" name="settings[home_info_warranty_btn]" value="{{ old('settings.home_info_warranty_btn', $settings['home_template']['home_info_warranty_btn']->value ?? 'Clic Aquí') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Cajas de Información (Ubicaciones)</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título: Ubicaciones</label>
                            <input type="text" name="settings[home_info_location_title]" value="{{ old('settings.home_info_location_title', $settings['home_template']['home_info_location_title']->value ?? '¿Dónde estamos?') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción: Ubicaciones</label>
                            <textarea name="settings[home_info_location_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.home_info_location_desc', $settings['home_template']['home_info_location_desc']->value ?? 'Contamos con varios almacenes de distribucion de fábrica, tiendas oficiales, puntos de venta y centros de servicio.') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Trasero: Ubicaciones</label>
                            <input type="text" name="settings[home_info_location_back_title]" value="{{ old('settings.home_info_location_back_title', $settings['home_template']['home_info_location_back_title']->value ?? 'Localízenos') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción Trasera: Ubicaciones (HTML Permitido)</label>
                            <textarea name="settings[home_info_location_back_desc]" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.home_info_location_back_desc', $settings['home_template']['home_info_location_back_desc']->value ?? 'Puede encontrar ayuda en nuestro directorio de ubicaciones para <a href="//mirage.mx/ubicaciones/tiendas-oficiales/" style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Tiendas Oficiales</a>, <a href="//mirage.mx/ubicaciones/distribuidores/" style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Distribuidores Mayoristas</a> y <a href="//mirage.mx/ubicaciones/centros-de-servicio/" style="color:white;background-color:#000;padding:.5em;border-radius:.2em">Centros de Servicio</a>.') }}</textarea>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Enlaces de Categorías</h3>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL Categoría 1 (Ej. Minisplits On/Off)</label>
                            <input type="url" name="settings[home_cat1_url]" value="{{ old('settings.home_cat1_url', $settings['home_template']['home_cat1_url']->value ?? '//mirage.mx/catalogo/todo/aire-acondicionado/minisplit/on-off/') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL Categoría 2 (Ej. Comercial Ligero)</label>
                            <input type="url" name="settings[home_cat2_url]" value="{{ old('settings.home_cat2_url', $settings['home_template']['home_cat2_url']->value ?? '//mirage.mx/catalogo/todo/aire-acondicionado/comercial-ligero/') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL Categoría 3 (Ej. Línea Blanca)</label>
                            <input type="url" name="settings[home_cat3_url]" value="{{ old('settings.home_cat3_url', $settings['home_template']['home_cat3_url']->value ?? '//mirage.mx/catalogo/todo/linea-blanca/') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Video Promocional</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título del Video (Ej. Función Sígueme)</label>
                            <input type="text" name="settings[home_video_title]" value="{{ old('settings.home_video_title', $settings['home_template']['home_video_title']->value ?? 'Función Sígueme') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL del Video (MP4)</label>
                            <input type="url" name="settings[home_video_url]" value="{{ old('settings.home_video_url', $settings['home_template']['home_video_url']->value ?? 'https://c5k4h6e2.rocketcdn.me/wp-content/uploads/2023/04/magnum22_720p@2mbps.mp4') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Banner Especialistas</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">URL Especialistas</label>
                            <input type="url" name="settings[home_specialists_url]" value="{{ old('settings.home_specialists_url', $settings['home_template']['home_specialists_url']->value ?? 'https://especialistas.mirage.mx') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

                <!-- Store Template Tab -->
                <div id="store_template" class="tab-content">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="store_template">

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Títulos de Secciones</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Productos Destacados</label>
                            <input type="text" name="settings[store_featured_title]" value="{{ old('settings.store_featured_title', $settings['store_template']['store_featured_title']->value ?? 'PRODUCTOS DESTACADOS') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Línea Blanca</label>
                            <input type="text" name="settings[store_appliances_title]" value="{{ old('settings.store_appliances_title', $settings['store_template']['store_appliances_title']->value ?? 'LINEA BLANCA') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Refacciones</label>
                            <input type="text" name="settings[store_parts_title]" value="{{ old('settings.store_parts_title', $settings['store_template']['store_parts_title']->value ?? 'REFACCIONES') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Newsletter</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Newsletter</label>
                            <input type="text" name="settings[store_newsletter_title]" value="{{ old('settings.store_newsletter_title', $settings['store_template']['store_newsletter_title']->value ?? 'Newsletter') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción Newsletter</label>
                            <textarea name="settings[store_newsletter_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.store_newsletter_desc', $settings['store_template']['store_newsletter_desc']->value ?? 'Entérate de nuestras promociones y sé parte de la comunidad.') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Botón Newsletter</label>
                            <input type="text" name="settings[store_newsletter_btn]" value="{{ old('settings.store_newsletter_btn', $settings['store_template']['store_newsletter_btn']->value ?? 'Suscribirse') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Placeholder Newsletter</label>
                            <input type="text" name="settings[store_newsletter_placeholder]" value="{{ old('settings.store_newsletter_placeholder', $settings['store_template']['store_newsletter_placeholder']->value ?? 'Su correo electrónico') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Banners Informativos (Satisfacción)</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Satisfacción</label>
                            <input type="text" name="settings[store_banner_satisfaction_title]" value="{{ old('settings.store_banner_satisfaction_title', $settings['store_template']['store_banner_satisfaction_title']->value ?? 'SATISFACCIÓN GARANTIZADA') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción Satisfacción</label>
                            <textarea name="settings[store_banner_satisfaction_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.store_banner_satisfaction_desc', $settings['store_template']['store_banner_satisfaction_desc']->value ?? 'Cumplimos con las mas exigentes normas de producción, garantizamos tu descanso.') }}</textarea>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Banners Informativos (Pagos)</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Pagos</label>
                            <input type="text" name="settings[store_banner_payments_title]" value="{{ old('settings.store_banner_payments_title', $settings['store_template']['store_banner_payments_title']->value ?? 'Pagos Seguros') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción Pagos</label>
                            <textarea name="settings[store_banner_payments_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.store_banner_payments_desc', $settings['store_template']['store_banner_payments_desc']->value ?? 'Todos tus pagos son seguros y tenemos diferentes metodos de pago para ti.') }}</textarea>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Banners Informativos (Envíos)</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título Envíos</label>
                            <input type="text" name="settings[store_banner_shipping_title]" value="{{ old('settings.store_banner_shipping_title', $settings['store_template']['store_banner_shipping_title']->value ?? 'Envíos a todo el país') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción Envíos</label>
                            <textarea name="settings[store_banner_shipping_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.store_banner_shipping_desc', $settings['store_template']['store_banner_shipping_desc']->value ?? 'Cumplimos con las mas exigentes normas de producción, garantizamos tu descanso') }}</textarea>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Modal "Añadir a Lista de Deseos"</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Título del Modal</label>
                            <input type="text" name="settings[store_wishlist_modal_title]" value="{{ old('settings.store_wishlist_modal_title', $settings['store_template']['store_wishlist_modal_title']->value ?? 'Necesitas iniciar sesión o crear una cuenta') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Descripción del Modal</label>
                            <textarea name="settings[store_wishlist_modal_desc]" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.store_wishlist_modal_desc', $settings['store_template']['store_wishlist_modal_desc']->value ?? 'Guarda productos en tu lista de deseos para comprarlos más tarde o compartirlos con tus amigos.') }}</textarea>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2 mt-6">Textos del Footer</h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Texto "¿Quiénes somos?"</label>
                            <textarea name="settings[store_footer_about_text]" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent">{{ old('settings.store_footer_about_text', $settings['store_template']['store_footer_about_text']->value ?? company_name().', está consolidado como la marca número 1 en ventas de aires acondicionados tipo minisplit en México. Contamos con una amplia gama de productos con los más altos estándares de calidad y ahorro energético.') }}</textarea>
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

                <!-- Payments Tab -->
                <div id="payments" class="tab-content">
                    <form action="{{ route('company-settings.update') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="payments">

                        <h3 class="text-lg font-semibold text-gray-900 border-b pb-2">Configuración de PayPal</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">PayPal Client ID</label>
                            <input type="text" name="settings[paypal_client_id]" value="{{ old('settings.paypal_client_id', $settings['payments']['paypal_client_id']->value ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-slate-800 focus:border-transparent" placeholder="Ej. AYSq3v... o 'test' para pruebas">
                            <p class="text-xs text-gray-500 mt-1">Obtén tu Client ID desde el dashboard de PayPal Developer. Usa la palabra "test" si quieres usar el entorno de simulación predeterminado.</p>
                        </div>

                        <button type="submit" class="bg-slate-800 text-white px-6 py-2 rounded-lg font-medium hover:bg-slate-900">
                            Guardar Cambios
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(el => el.classList.remove('active'));

            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));

            // Show selected tab
            document.getElementById(tabName).classList.add('active');

            // Add active class to clicked button
            document.querySelector(`.tab-btn-${tabName}`).classList.add('active');
        }
    </script>
</body>
</html>
