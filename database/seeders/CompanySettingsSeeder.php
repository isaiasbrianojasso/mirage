<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            [
                'key' => 'company_name',
                'value' => 'Mirage',
                'type' => 'string',
                'group' => 'general',
                'description' => 'Nombre principal de la empresa'
            ],
            [
                'key' => 'company_name_full',
                'value' => 'Mirage México',
                'type' => 'string',
                'group' => 'general',
                'description' => 'Nombre completo de la empresa con país/región'
            ],
            [
                'key' => 'company_description',
                'value' => 'Marca especializada en aires acondicionados y línea blanca.',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Descripción breve de la empresa'
            ],
            [
                'key' => 'company_tagline',
                'value' => 'La máxima eficiencia en climatización',
                'type' => 'string',
                'group' => 'general',
                'description' => 'Lema o tagline de la empresa'
            ],

            // Branding
            [
                'key' => 'logo_url',
                'value' => '/uploads/2023/06/mirage-v32-500x500.webp',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'URL del logo principal'
            ],
            [
                'key' => 'favicon_url',
                'value' => '/uploads/2023/05/mirage_icon.png',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'URL del favicon'
            ],
            [
                'key' => 'primary_color',
                'value' => '#a00000',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'Color primario de la marca'
            ],

            // Contact Information
            [
                'key' => 'contact_email',
                'value' => 'contacto@tienda.local',
                'type' => 'string',
                'group' => 'contact',
                'description' => 'Email de contacto principal'
            ],
            [
                'key' => 'contact_phone',
                'value' => '(644) 410 9800',
                'type' => 'string',
                'group' => 'contact',
                'description' => 'Teléfono de contacto principal'
            ],
            [
                'key' => 'contact_address',
                'value' => 'Puebla #270 Sur, Col. Centro. Ciudad Obregón, Sonora, Mx. C.P. 85000',
                'type' => 'text',
                'group' => 'contact',
                'description' => 'Dirección principal'
            ],

            // Social Media & External Links
            [
                'key' => 'social_facebook',
                'value' => '#',
                'type' => 'string',
                'group' => 'social',
                'description' => 'URL de Facebook'
            ],
            [
                'key' => 'online_store_url',
                'value' => '/tienda',
                'type' => 'string',
                'group' => 'social',
                'description' => 'URL de la tienda en línea'
            ],
            [
                'key' => 'b2b_portal_url',
                'value' => '#',
                'type' => 'string',
                'group' => 'social',
                'description' => 'URL del portal B2B'
            ],
            [
                'key' => 'certification_portal_url',
                'value' => '#',
                'type' => 'string',
                'group' => 'social',
                'description' => 'URL del portal de certificación'
            ],

            // General - Website URL
            [
                'key' => 'company_website_url',
                'value' => '/',
                'type' => 'string',
                'group' => 'general',
                'description' => 'URL del sitio web principal de la empresa'
            ],

            // Installation service
            [
                'key' => 'installation_service_url',
                'value' => '#',
                'type' => 'string',
                'group' => 'social',
                'description' => 'URL del servicio de instalación'
            ],

            // Content - Catalog page labels
            [
                'key' => 'catalog_all_products_title',
                'value' => 'Todos los Productos Mirage',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Título SEO de la página de todos los productos'
            ],
            [
                'key' => 'catalog_all_products_heading',
                'value' => 'Todos los Productos Mirage',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Encabezado H1 de la página de todos los productos'
            ],
            [
                'key' => 'catalog_menu_company_label',
                'value' => 'Mirage',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Etiqueta del menú principal con nombre de empresa'
            ],
            [
                'key' => 'catalog_menu_blog_label',
                'value' => 'Mirage Blog',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Etiqueta del menú Blog'
            ],
            [
                'key' => 'catalog_store_label',
                'value' => 'Tienda Mirage',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Etiqueta del botón Tienda en el menú'
            ],
            [
                'key' => 'catalog_certification_label',
                'value' => 'Certificacion Mirage',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Etiqueta del enlace de certificación en el footer'
            ],
            [
                'key' => 'catalog_app_home_label',
                'value' => 'Mirage Home',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Etiqueta de la app Mirage Home en el footer'
            ],
            [
                'key' => 'catalog_footer_brand_title',
                'value' => 'Mirage Electrodomésticos',
                'type' => 'string',
                'group' => 'content',
                'description' => 'Título de la sección de marca en el footer'
            ],
            [
                'key' => 'catalog_logistics_image',
                'value' => '',
                'type' => 'string',
                'group' => 'content',
                'description' => 'URL de la imagen del centro logístico en el footer (vacío = imagen por defecto)'
            ],
        ];

        foreach ($settings as $setting) {
            DB::table('company_settings')->updateOrInsert(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                    'description' => $setting['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
