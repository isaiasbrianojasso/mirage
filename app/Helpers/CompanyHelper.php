<?php

use App\Models\CompanySetting;

if (!function_exists('company')) {
    /**
     * Get a company setting value
     *
     * @param string $key The setting key
     * @param mixed $default Default value if not found
     * @return mixed
     */
    function company($key, $default = null)
    {
        return CompanySetting::get($key, $default);
    }
}

if (!function_exists('company_name')) {
    /**
     * Get the company name
     */
    function company_name()
    {
        return company('company_name', 'Mi Empresa');
    }
}

if (!function_exists('company_name_full')) {
    /**
     * Get the full company name with region
     */
    function company_name_full()
    {
        return company('company_name_full', 'Mi Empresa');
    }
}

if (!function_exists('company_description')) {
    /**
     * Get the company description
     */
    function company_description()
    {
        return company('company_description', 'Marca especializada en aires acondicionados y línea blanca.');
    }
}

if (!function_exists('company_email')) {
    /**
     * Get the company email
     */
    function company_email()
    {
        return company('contact_email', 'contacto@empresa.com');
    }
}

if (!function_exists('company_phone')) {
    /**
     * Get the company phone
     */
    function company_phone()
    {
        return company('contact_phone', '(644) 410 9800');
    }
}

if (!function_exists('company_address')) {
    /**
     * Get the company address
     */
    function company_address()
    {
        return company('contact_address', 'Puebla #270 Sur, Col. Centro. Ciudad Obregón, Sonora, Mx. C.P. 85000');
    }
}

if (!function_exists('company_logo')) {
    /**
     * Get the company logo URL
     */
    function company_logo()
    {
        return asset(company('logo_url', '/uploads/2023/06/mirage-v32-500x500.webp'));
    }
}

if (!function_exists('company_favicon')) {
    /**
     * Get the company favicon URL
     */
    function company_favicon()
    {
        return asset(company('favicon_url', '/uploads/2023/05/mirage_icon.png'));
    }
}

if (!function_exists('company_color')) {
    /**
     * Get the company primary color
     */
    function company_color()
    {
        return company('primary_color', '#a00000');
    }
}

if (!function_exists('company_store_url')) {
    /**
     * Get the online store URL
     */
    function company_store_url()
    {
        return company('online_store_url', url('/tienda'));
    }
}

if (!function_exists('social_facebook')) {
    /**
     * Get Facebook URL
     */
    function social_facebook()
    {
        return company('social_facebook', '#');
    }
}
