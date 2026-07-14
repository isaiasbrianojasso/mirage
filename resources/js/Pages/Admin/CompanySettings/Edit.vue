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
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <!-- Explicación de la sección -->
                <div class="mb-6 bg-white p-5 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Ajustes Globales del Sistema</h3>
                    <p class="text-sm text-gray-500">
                        Este es el centro de control principal de tu empresa. Aquí puedes modificar la información básica (nombre, logo, colores), configurar cómo te pagan tus clientes, enlazar tus redes sociales y ajustar las conexiones con otros servicios (como envíos de correos y notificaciones).
                    </p>
                </div>

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
                        { key: 'company_name', label: 'Nombre de la empresa', placeholder: 'Ej: Mi Empresa' },
                        { key: 'company_name_full', label: 'Nombre completo', placeholder: 'Ej: Mi Empresa S.A. de C.V.' },
                        { key: 'company_description', label: 'Descripción', type: 'textarea', placeholder: 'Descripción breve de tu empresa...' },
                        { key: 'company_tagline', label: 'Tagline / Lema', placeholder: 'Ej: La máxima eficiencia' },
                        { key: 'company_website_url', label: 'URL del sitio web', placeholder: 'https://www.midominio.com' },
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
                        { key: 'logo_url', type: 'image', label: 'Logo de la empresa', placeholder: 'Seleccionar imagen...' },
                        { key: 'favicon_url', type: 'image', label: 'Favicon', placeholder: 'Seleccionar imagen...' },
                        { key: 'primary_color', type: 'color', label: 'Color primario (hex)', placeholder: '#a00000' },
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
                        { key: 'contact_email', label: 'Email de contacto', placeholder: 'contacto@midominio.com' },
                        { key: 'contact_phone', label: 'Teléfono', placeholder: '(55) 1234 5678' },
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
                        { key: 'social_facebook', label: 'Facebook', placeholder: 'https://www.facebook.com/tu-pagina' },
                        { key: 'online_store_url', label: 'Tienda en línea', placeholder: 'https://www.tienda.midominio.com' },
                        { key: 'b2b_portal_url', label: 'Portal B2B', placeholder: 'https://b2b.midominio.com' },
                        { key: 'certification_portal_url', label: 'Portal de Certificación', placeholder: 'https://certificacion.midominio.com' },
                        { key: 'installation_service_url', label: 'Servicio de Instalación', placeholder: 'https://www.instalacion.midominio.com' },
                    ]"
                    :settings="settings.social || {}"
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
                            { key: 'transfer_account_name', label: 'Titular de la cuenta', placeholder: `Ej: ${companyName}`, showIf: (s) => s.payment_transfer_enabled === '1' },
                            { key: 'transfer_account_number', label: 'Número de Cuenta', placeholder: 'Ej: 0123456789', showIf: (s) => s.payment_transfer_enabled === '1' },
                            { key: 'transfer_clabe', label: 'CLABE Interbancaria', placeholder: 'Ej: 012345678901234567', showIf: (s) => s.payment_transfer_enabled === '1' },
                            { key: 'transfer_instructions', label: 'Instrucciones adicionales', type: 'textarea', placeholder: 'Ej: Favor de enviar el comprobante de pago a pagos@midominio.com', showIf: (s) => s.payment_transfer_enabled === '1' },
                        ]"
                        :settings="settings.payments || {}"
                        @saved="onSaved"
                    />
                </div>

                <!-- Notifications (Mail + Firebase) -->
                <div v-if="activeTab === 'notifications'" class="space-y-6">
                    <!-- Mail -->
                    <SettingsGroup
                        title="Correo Electrónico"
                        icon='<svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>'
                        description="Configuración de envío de correos. Usa SMTP o PHPMailer para servidores externos, y log para pruebas locales."
                        group="notifications"
                        :fields="[
                            { key: 'mail_mailer', label: 'Mail Driver', type: 'select', options: [{label: 'SMTP', value: 'smtp'}, {label: 'PHPMailer', value: 'phpmailer'}, {label: 'Sendmail (Host Nativo)', value: 'sendmail'}, {label: 'Log (Pruebas)', value: 'log'}] },
                            { key: 'mail_host', label: 'Host SMTP', placeholder: 'Ej: smtp.mailtrap.io', showIf: (s) => ['smtp', 'phpmailer'].includes(s.mail_mailer) },
                            { key: 'mail_port', label: 'Puerto SMTP', placeholder: 'Ej: 2525, 465, 587', type: 'number', showIf: (s) => ['smtp', 'phpmailer'].includes(s.mail_mailer) },
                            { key: 'mail_username', label: 'Usuario SMTP', placeholder: 'Usuario', showIf: (s) => ['smtp', 'phpmailer'].includes(s.mail_mailer) },
                            { key: 'mail_password', label: 'Contraseña SMTP', type: 'password', placeholder: 'Contraseña', showIf: (s) => ['smtp', 'phpmailer'].includes(s.mail_mailer) },
                            { key: 'mail_encryption', label: 'Encriptación', type: 'select', options: [{label: 'Ninguna', value: ''}, {label: 'TLS', value: 'tls'}, {label: 'SSL', value: 'ssl'}], showIf: (s) => ['smtp', 'phpmailer'].includes(s.mail_mailer) },
                            { key: 'mail_from_address', label: 'Correo de Remitente (From)', placeholder: 'Ej: no-reply@midominio.com' },
                            { key: 'mail_from_name', label: 'Nombre de Remitente (From)', placeholder: `Ej: Tienda ${companyName}` },
                        ]"
                        :settings="settings.notifications || {}"
                        @saved="onSaved"
                    />

                    <!-- Firebase -->
                    <SettingsGroup
                        title="Notificaciones Push (Firebase)"
                        icon='<svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M4.566 17.652l-2.905-5.586a.78.78 0 01.23-.976l13.626-9.664a.78.78 0 011.134.908L14.28 10.66l2.905 5.586a.78.78 0 01-.23.976L3.33 26.886a.78.78 0 01-1.134-.908l2.37-8.326z"/></svg>'
                        description="Credenciales para enviar notificaciones web/móvil por Firebase (FCM)."
                        group="notifications"
                        :fields="[
                            { key: 'firebase_enabled', label: '¿Habilitar Firebase Push?', type: 'select', options: [{label: 'Sí, habilitar', value: '1'}, {label: 'No, deshabilitar', value: '0'}] },
                            { key: 'firebase_project_id', label: 'Project ID', placeholder: 'Ej: mi-proyecto-123', showIf: (s) => s.firebase_enabled === '1' },
                            { key: 'firebase_credentials_json', label: 'Credenciales (JSON)', type: 'textarea', placeholder: 'Pega aquí el contenido completo del archivo serviceAccountKey.json...', showIf: (s) => s.firebase_enabled === '1' }
                        ]"
                        :settings="settings.notifications || {}"
                        @saved="onSaved"
                    />
                </div>

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

                <!-- Integrations -->
                <SettingsGroup
                    v-if="activeTab === 'integrations'"
                    title="Integraciones de Terceros"
                    icon='<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>'
                    description="Claves de API y configuraciones para servicios externos."
                    group="integrations"
                    :fields="[
                        { key: 'google_maps_api_key', label: 'Google Maps API Key', placeholder: 'Ej: AIzaSy...' },
                    ]"
                    :settings="settings.integrations || {}"
                    @saved="onSaved"
                />

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, watch, onMounted, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import SettingsGroup from './SettingsGroup.vue';

const props = defineProps({
    settings: Object,
});

const page = usePage();
const companyName = computed(() => {
    return page.props.company_settings?.general?.company_name || 'Mi Empresa';
});

const tabs = [
    { key: 'general', label: 'General', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>' },
    { key: 'branding', label: 'Marca', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>' },
    { key: 'contact', label: 'Contacto', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>' },
    { key: 'social', label: 'Redes y Links', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>' },

    { key: 'payments', label: 'Pagos', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>' },
    { key: 'notifications', label: 'Notificaciones', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>' },
    { key: 'auth', label: 'Autenticación Social', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.092 2.02-.273 3.003m-3.44 2.041A9.954 9.954 0 0112 18c-3.1 0-5.874-1.41-7.7-3.626M12 18c3.1 0 5.874-1.41 7.7-3.626m-7.7 3.626v3.374"/></svg>' },
    { key: 'integrations', label: 'Integraciones', icon: '<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" /></svg>' },
];

const activeTab = ref('general');

onMounted(() => {
    const savedTab = localStorage.getItem('company_settings_tab');
    if (savedTab) {
        activeTab.value = savedTab;
    }
});

watch(activeTab, (newVal) => {
    localStorage.setItem('company_settings_tab', newVal);
});

function onSaved() {
    // La redirección con flash ya la maneja el controller
}
</script>
