<template>
    <AppLayout title="Configuración de Empresa">
        <template #header>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Configuración de Empresa
                </h2>
            </div>
        </template>

        <div class="py-10">
            <div class="max-w-6xl space-y-6">

                <!-- Flash message -->
                <div v-if="$page.props.flash?.success"
                    class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl shadow-sm">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium">{{ $page.props.flash.success }}</span>
                </div>

                <!-- Tabs -->
                <div class="flex gap-2 flex-wrap">
                    <button
                        v-for="tab in tabs"
                        :key="tab.key"
                        @click="activeTab = tab.key"
                        :class="[
                            'flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition',
                            activeTab === tab.key
                                ? 'bg-slate-800 text-white shadow'
                                : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50'
                        ]"
                    >
                        <span v-html="tab.icon"></span> 
                        {{ tab.label }}
                    </button>
                </div>

                <!-- General -->
                <SettingsGroup
                    v-if="activeTab === 'general'"
                    title="General"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>'
                    description="Nombre, descripción y URL del sitio web."
                    group="general"
                    :fields="[
                        { key: 'company_name', label: 'Nombre de la empresa', placeholder: 'Ej: Mirage' },
                        { key: 'company_name_full', label: 'Nombre completo', placeholder: 'Ej: Mirage México' },
                        { key: 'company_description', label: 'Descripción', type: 'textarea', placeholder: 'Descripción breve...' },
                        { key: 'company_tagline', label: 'Tagline / Lema', placeholder: 'Ej: La máxima eficiencia' },
                        { key: 'company_website_url', label: 'URL del sitio web', placeholder: 'https://www.ejemplo.mx' },
                    ]"
                    :settings="settings.general || {}"
                    @saved="onSaved"
                />

                <!-- Branding -->
                <SettingsGroup
                    v-if="activeTab === 'branding'"
                    title="Marca"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>'
                    description="Logo, favicon y color principal."
                    group="branding"
                    :fields="[
                        { key: 'logo_url', label: 'URL del logo', placeholder: '/uploads/logo.webp' },
                        { key: 'favicon_url', label: 'URL del favicon', placeholder: '/uploads/favicon.png' },
                        { key: 'primary_color', label: 'Color primario (hex)', placeholder: '#a00000' },
                    ]"
                    :settings="settings.branding || {}"
                    @saved="onSaved"
                />

                <!-- Contact -->
                <SettingsGroup
                    v-if="activeTab === 'contact'"
                    title="Contacto"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>'
                    description="Email, teléfono y dirección."
                    group="contact"
                    :fields="[
                        { key: 'contact_email', label: 'Email de contacto', placeholder: 'contacto@ejemplo.mx' },
                        { key: 'contact_phone', label: 'Teléfono', placeholder: '(644) 410 9800' },
                        { key: 'contact_address', label: 'Dirección', type: 'textarea', placeholder: 'Calle, Colonia, Ciudad...' },
                    ]"
                    :settings="settings.contact || {}"
                    @saved="onSaved"
                />

                <!-- Social -->
                <SettingsGroup
                    v-if="activeTab === 'social'"
                    title="Redes y Links"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>'
                    description="URLs de redes sociales y portales externos."
                    group="social"
                    :fields="[
                        { key: 'social_facebook', label: 'Facebook', placeholder: 'https://www.facebook.com/...' },
                        { key: 'online_store_url', label: 'Tienda en línea', placeholder: 'https://www.tienda.mx' },
                        { key: 'b2b_portal_url', label: 'Portal B2B', placeholder: 'https://b2b.ejemplo.mx' },
                        { key: 'certification_portal_url', label: 'Portal de Certificación', placeholder: 'https://certificacion.ejemplo.mx' },
                        { key: 'installation_service_url', label: 'Servicio de Instalación', placeholder: 'https://www.instalacion.mx' },
                    ]"
                    :settings="settings.social || {}"
                    @saved="onSaved"
                />

                <!-- Content -->
                <SettingsGroup
                    v-if="activeTab === 'content'"
                    title="Textos del Catálogo"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>'
                    description="Etiquetas y títulos visibles en las páginas del catálogo."
                    group="content"
                    :fields="[
                        { key: 'catalog_all_products_title', label: 'Título SEO — Todos los productos', placeholder: 'Todos los Productos Mirage' },
                        { key: 'catalog_all_products_heading', label: 'Encabezado H1 — Todos los productos', placeholder: 'Todos los Productos Mirage' },
                        { key: 'catalog_menu_company_label', label: 'Menú — Etiqueta empresa', placeholder: 'Mirage' },
                        { key: 'catalog_menu_blog_label', label: 'Menú — Blog', placeholder: 'Mirage Blog' },
                        { key: 'catalog_store_label', label: 'Menú — Tienda', placeholder: 'Tienda Mirage' },
                        { key: 'catalog_certification_label', label: 'Footer — Certificación', placeholder: 'Certificacion Mirage' },
                        { key: 'catalog_app_home_label', label: 'Footer — App Home', placeholder: 'Mirage Home' },
                        { key: 'catalog_footer_brand_title', label: 'Footer — Título marca', placeholder: 'Mirage Electrodomésticos' },
                        { key: 'catalog_logistics_image', label: 'Footer — Imagen logística (URL)', placeholder: 'Dejar vacío para imagen por defecto' },
                    ]"
                    :settings="settings.content || {}"
                    @saved="onSaved"
                />

                <!-- Tienda -->
                <SettingsGroup
                    v-if="activeTab === 'tienda'"
                    title="Textos de Tienda"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>'
                    description="Textos, banners y newsletter de la página de inicio de tienda."
                    group="tienda"
                    :fields="[
                        { key: 'store_featured_title', label: 'Título - Productos Destacados', placeholder: 'PRODUCTOS DESTACADOS' },
                        { key: 'store_appliances_title', label: 'Título - Línea Blanca', placeholder: 'LINEA BLANCA' },
                        { key: 'store_parts_title', label: 'Título - Refacciones', placeholder: 'REFACCIONES' },
                        { key: 'store_newsletter_title', label: 'Newsletter - Título', placeholder: 'Newsletter' },
                        { key: 'store_newsletter_desc', label: 'Newsletter - Descripción', placeholder: 'Entérate de nuestras promociones...' },
                        { key: 'store_newsletter_btn', label: 'Newsletter - Botón', placeholder: 'Suscribirse' },
                        { key: 'store_newsletter_placeholder', label: 'Newsletter - Placeholder', placeholder: 'Su correo electrónico' },
                        { key: 'store_banner_satisfaction_title', label: 'Banner 1 - Título', placeholder: 'SATISFACCIÓN GARANTIZADA' },
                        { key: 'store_banner_satisfaction_desc', label: 'Banner 1 - Descripción', placeholder: 'Cumplimos con las mas exigentes normas...' },
                        { key: 'store_banner_payments_title', label: 'Banner 2 - Título', placeholder: 'Pagos Seguros' },
                        { key: 'store_banner_payments_desc', label: 'Banner 2 - Descripción', placeholder: 'Todos tus pagos son seguros...' },
                        { key: 'store_banner_shipping_title', label: 'Banner 3 - Título', placeholder: 'Envíos a todo el país' },
                        { key: 'store_banner_shipping_desc', label: 'Banner 3 - Descripción', placeholder: 'Llevamos hasta tu casa...' },
                    ]"
                    :settings="settings.tienda || {}"
                    @saved="onSaved"
                />

                <!-- Home / Welcome -->
                <SettingsGroup
                    v-if="activeTab === 'home_template'"
                    title="Textos de Inicio (Welcome)"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>'
                    description="Textos y banners principales de la página de inicio (Home)."
                    group="home_template"
                    :fields="[
                        { key: 'home_banner_title_fixed', label: 'Banner Principal - Fijo', placeholder: 'TECNOLOGÍA' },
                        { key: 'home_banner_title_dynamic', label: 'Banner Principal - Dinámico (separado por comas)', placeholder: 'INVERTER,MODERNA,CONFIABLE' },
                        { key: 'home_video_title', label: 'Video - Título', placeholder: 'Función Sígueme' },
                        { key: 'home_video_url', label: 'Video - URL', placeholder: 'https://...' },
                        { key: 'home_info_install_title', label: 'Info - Título Instalación', placeholder: 'Sobre la instalación' },
                        { key: 'home_info_install_desc', label: 'Info - Descripción Instalación', placeholder: 'Si compró su equipo...' },
                        { key: 'home_info_install_back_title', label: 'Info - Instalación (Atrás)', placeholder: 'Programe su visita' },
                        { key: 'home_info_install_btn', label: 'Info - Botón Instalación', placeholder: 'Clic Aquí' },
                        { key: 'home_info_warranty_title', label: 'Info - Título Garantía', placeholder: 'Garantía y Soporte' },
                        { key: 'home_info_warranty_desc', label: 'Info - Descripción Garantía', placeholder: 'El departamento...' },
                        { key: 'home_info_warranty_back_title', label: 'Info - Garantía (Atrás)', placeholder: 'Inicie una solicitud' },
                        { key: 'home_info_warranty_back_desc', label: 'Info - Descripción Garantía (Atrás)', placeholder: 'Por favor...' },
                        { key: 'home_info_warranty_btn', label: 'Info - Botón Garantía', placeholder: 'Clic Aquí' },
                        { key: 'home_info_location_title', label: 'Info - Título Ubicaciones', placeholder: '¿Dónde estamos?' },
                        { key: 'home_info_location_desc', label: 'Info - Descripción Ubicaciones', placeholder: 'Contamos con...' },
                        { key: 'home_info_location_back_title', label: 'Info - Ubicaciones (Atrás)', placeholder: 'Localízenos' },
                        { key: 'home_info_location_back_desc', label: 'Info - Descripción Ubicaciones (Atrás)', placeholder: 'Puede encontrar...' },
                    ]"
                    :settings="settings.home_template || {}"
                    @saved="onSaved"
                />

                <!-- Payments (Separados en Módulos tipo PrestaShop) -->
                <div v-if="activeTab === 'payments'" class="space-y-6">
                    <!-- PayPal -->
                    <SettingsGroup
                        title="PayPal"
                        icon='<svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106z"/></svg>'
                        description="Recibe pagos con tarjeta de crédito o débito mediante PayPal."
                        group="payments"
                        :fields="[
                            { key: 'payment_paypal_enabled', label: '¿Habilitar PayPal?', type: 'select', options: [{label: 'Sí, habilitar', value: '1'}, {label: 'No, deshabilitar', value: '0'}] },
                            { key: 'paypal_client_id', label: 'PayPal Client ID', placeholder: 'Ej: Ad2V...', showIf: (s) => s.payment_paypal_enabled === '1' },
                            { key: 'paypal_secret', label: 'PayPal Secret', type: 'password', placeholder: 'Ej: EPT5x...', showIf: (s) => s.payment_paypal_enabled === '1' },
                            { key: 'paypal_mode', label: 'Entorno de PayPal', type: 'select', options: [{label: 'Pruebas (Sandbox)', value: 'sandbox'}, {label: 'Producción (Live)', value: 'live'}], showIf: (s) => s.payment_paypal_enabled === '1' },
                            { key: 'payment_paypal_commission', label: 'Comisión extra a cobrar al cliente (%)', placeholder: 'Ej: 4.5', type: 'number', showIf: (s) => s.payment_paypal_enabled === '1' },
                        ]"
                        :settings="settings.payments || {}"
                        @saved="onSaved"
                    />

                    <!-- Mercado Pago -->
                    <SettingsGroup
                        title="Mercado Pago"
                        icon='<svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="currentColor"><path d="M14.67 4h-5.34l-2 5.5h9.34l-2-5.5zm4.8 5.5l-3.2-8.8A1.1 1.1 0 0 0 15.24 0H8.76a1.1 1.1 0 0 0-1.03.7L4.53 9.5H0v12.2c0 .6.5 1.1 1.1 1.1h21.8c.6 0 1.1-.5 1.1-1.1V9.5h-4.53z"/></svg>'
                        description="Pasarela de pagos en línea: Tarjetas, Transferencia SPEI y efectivo (OXXO)."
                        group="payments"
                        :fields="[
                            { key: 'payment_mercadopago_enabled', label: '¿Habilitar MercadoPago?', type: 'select', options: [{label: 'Sí, habilitar', value: '1'}, {label: 'No, deshabilitar', value: '0'}] },
                            { key: 'mercadopago_public_key', label: 'MercadoPago Public Key', placeholder: 'Ej: TEST-...', showIf: (s) => s.payment_mercadopago_enabled === '1' },
                            { key: 'mercadopago_access_token', label: 'MercadoPago Access Token', type: 'password', placeholder: 'Ej: TEST-...', showIf: (s) => s.payment_mercadopago_enabled === '1' },
                            { key: 'payment_mercadopago_commission', label: 'Comisión extra a cobrar al cliente (%)', placeholder: 'Ej: 3.5', type: 'number', showIf: (s) => s.payment_mercadopago_enabled === '1' },
                        ]"
                        :settings="settings.payments || {}"
                        @saved="onSaved"
                    />

                    <!-- Transferencia Bancaria -->
                    <SettingsGroup
                        title="Transferencia Bancaria / Depósito"
                        icon='<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>'
                        description="Recibe pagos manuales directo a tu cuenta bancaria con validación manual."
                        group="payments"
                        :fields="[
                            { key: 'payment_transfer_enabled', label: '¿Habilitar Transferencia?', type: 'select', options: [{label: 'Sí, habilitar', value: '1'}, {label: 'No, deshabilitar', value: '0'}] },
                            { key: 'transfer_bank_name', label: 'Nombre del Banco', placeholder: 'Ej: BBVA Bancomer', showIf: (s) => s.payment_transfer_enabled === '1' },
                            { key: 'transfer_account_name', label: 'Titular de la cuenta', placeholder: 'Ej: Mirage México S.A. de C.V.', showIf: (s) => s.payment_transfer_enabled === '1' },
                            { key: 'transfer_account_number', label: 'Número de Cuenta', placeholder: 'Ej: 0123456789', showIf: (s) => s.payment_transfer_enabled === '1' },
                            { key: 'transfer_clabe', label: 'CLABE Interbancaria', placeholder: 'Ej: 012345678901234567', showIf: (s) => s.payment_transfer_enabled === '1' },
                            { key: 'transfer_instructions', label: 'Instrucciones adicionales', type: 'textarea', placeholder: 'Ej: Favor de enviar el comprobante de pago a pagos@mirage.mx', showIf: (s) => s.payment_transfer_enabled === '1' },
                        ]"
                        :settings="settings.payments || {}"
                        @saved="onSaved"
                    />
                </div>

                <!-- Mail -->
                <SettingsGroup
                    v-if="activeTab === 'mail'"
                    title="Notificaciones y Correos"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>'
                    description="Configuración de envío de correos. Usa 'smtp' para un servidor externo o 'log' para pruebas locales."
                    group="mail"
                    :fields="[
                        { key: 'mail_mailer', label: 'Mail Driver', type: 'select', options: [{label: 'SMTP', value: 'smtp'}, {label: 'Sendmail (Host Nativo)', value: 'sendmail'}, {label: 'Log (Pruebas)', value: 'log'}] },
                        { key: 'mail_host', label: 'Host SMTP', placeholder: 'Ej: smtp.mailtrap.io', showIf: (s) => s.mail_mailer === 'smtp' },
                        { key: 'mail_port', label: 'Puerto SMTP', placeholder: 'Ej: 2525, 465, 587', type: 'number', showIf: (s) => s.mail_mailer === 'smtp' },
                        { key: 'mail_username', label: 'Usuario SMTP', placeholder: 'Usuario', showIf: (s) => s.mail_mailer === 'smtp' },
                        { key: 'mail_password', label: 'Contraseña SMTP', type: 'password', placeholder: 'Contraseña', showIf: (s) => s.mail_mailer === 'smtp' },
                        { key: 'mail_encryption', label: 'Encriptación', type: 'select', options: [{label: 'Ninguna', value: ''}, {label: 'TLS', value: 'tls'}, {label: 'SSL', value: 'ssl'}], showIf: (s) => s.mail_mailer === 'smtp' },
                        { key: 'mail_from_address', label: 'Correo de Remitente (From)', placeholder: 'Ej: no-reply@tiendamirage.mx' },
                        { key: 'mail_from_name', label: 'Nombre de Remitente (From)', placeholder: 'Ej: Tienda Mirage' },
                    ]"
                    :settings="settings.mail || {}"
                    @saved="onSaved"
                />

                <!-- Auth -->
                <div v-if="activeTab === 'auth'" class="space-y-6">
                    <!-- Google -->
                    <SettingsGroup
                        title="Google"
                        icon='<svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z"/></svg>'
                        description="Permitir iniciar sesión como administrador con una cuenta de Google."
                        group="auth"
                        :fields="[
                            { key: 'google_login_enabled', label: '¿Habilitar Login con Google?', type: 'select', options: [{label: 'Sí, habilitar', value: '1'}, {label: 'No, deshabilitar', value: '0'}] },
                            { key: 'google_client_id', label: 'Google Client ID', placeholder: 'Ej: 123456.apps.googleusercontent.com', showIf: (s) => s.google_login_enabled === '1' },
                            { key: 'google_client_secret', label: 'Google Client Secret', type: 'password', placeholder: 'Ej: GOCSPX-...', showIf: (s) => s.google_login_enabled === '1' },
                        ]"
                        :settings="settings.auth || {}"
                        @saved="onSaved"
                    />

                    <!-- Facebook -->
                    <SettingsGroup
                        title="Facebook"
                        icon='<svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>'
                        description="Permitir iniciar sesión como administrador con una cuenta de Facebook."
                        group="auth"
                        :fields="[
                            { key: 'facebook_login_enabled', label: '¿Habilitar Login con Facebook?', type: 'select', options: [{label: 'Sí, habilitar', value: '1'}, {label: 'No, deshabilitar', value: '0'}] },
                            { key: 'facebook_client_id', label: 'Facebook App ID', placeholder: 'Ej: 1234567890', showIf: (s) => s.facebook_login_enabled === '1' },
                            { key: 'facebook_client_secret', label: 'Facebook App Secret', type: 'password', placeholder: 'Ej: 123abc...', showIf: (s) => s.facebook_login_enabled === '1' },
                        ]"
                        :settings="settings.auth || {}"
                        @saved="onSaved"
                    />
                    <!-- Trust Login -->
                    <SettingsGroup
                        title="Trust Login"
                        icon='<svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>'
                        description="Permitir iniciar sesión mediante GMO Trust Login (OIDC SSO Empresarial)."
                        group="auth"
                        :fields="[
                            { key: 'trustlogin_enabled', label: '¿Habilitar Trust Login?', type: 'select', options: [{label: 'Sí, habilitar', value: '1'}, {label: 'No, deshabilitar', value: '0'}] },
                            { key: 'trustlogin_client_id', label: 'Client ID', placeholder: 'Ej: 123456...', showIf: (s) => s.trustlogin_enabled === '1' },
                            { key: 'trustlogin_client_secret', label: 'Client Secret', type: 'password', placeholder: 'Ej: abcdef...', showIf: (s) => s.trustlogin_enabled === '1' },
                            { key: 'trustlogin_auth_url', label: 'Authorization Endpoint URL', placeholder: 'https://...', showIf: (s) => s.trustlogin_enabled === '1' },
                            { key: 'trustlogin_token_url', label: 'Token Endpoint URL', placeholder: 'https://...', showIf: (s) => s.trustlogin_enabled === '1' },
                            { key: 'trustlogin_userinfo_url', label: 'UserInfo Endpoint URL', placeholder: 'https://...', showIf: (s) => s.trustlogin_enabled === '1' },
                        ]"
                        :settings="settings.auth || {}"
                        @saved="onSaved"
                    />
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingsGroup from './SettingsGroup.vue';

const props = defineProps({
    settings: Object,
});

const tabs = [
    { key: 'general', label: 'General', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>' },
    { key: 'branding', label: 'Marca', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>' },
    { key: 'contact', label: 'Contacto', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>' },
    { key: 'social', label: 'Redes y Links', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>' },
    { key: 'content', label: 'Textos del Catálogo', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>' },
    { key: 'tienda', label: 'Textos de Tienda', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>' },
    { key: 'home_template', label: 'Textos de Inicio', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>' },
    { key: 'payments', label: 'Pagos', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>' },
    { key: 'mail', label: 'Correos', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>' },
    { key: 'auth', label: 'Autenticación Social', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.092 2.02-.273 3.003m-3.44 2.041A9.954 9.954 0 0112 18c-3.1 0-5.874-1.41-7.7-3.626M12 18c3.1 0 5.874-1.41 7.7-3.626m-7.7 3.626v3.374"/></svg>' },
];

const activeTab = ref('general');

onMounted(() => {
    const savedTab = localStorage.getItem('mirage_settings_tab');
    if (savedTab) {
        activeTab.value = savedTab;
    }
});

watch(activeTab, (newVal) => {
    localStorage.setItem('mirage_settings_tab', newVal);
});

function onSaved() {
    // La redirección con flash ya la maneja el controller
}
</script>
