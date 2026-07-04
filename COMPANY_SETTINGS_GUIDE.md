# Sistema de Configuración de Empresa (Personalizable)

## Descripción

Este sistema permite personalizar todos los elementos relacionados con el nombre y datos de la empresa ("Mirage") directamente desde la base de datos, sin necesidad de editar código.

## Tabla de Configuración

Todas las configuraciones se almacenan en la tabla `company_settings` con los siguientes campos:

- `id`: ID único
- `key`: Clave única de la configuración (ej: `company_name`)
- `value`: Valor de la configuración
- `type`: Tipo de dato (string, text, number, boolean, json, file)
- `group`: Grupo de configuración (general, contact, social, branding)
- `description`: Descripción legible para administradores
- `timestamps`: Fechas de creación y actualización
- `deleted_at`: Soft delete

## Configuraciones Disponibles

### Generales (`group: general`)
- `company_name`: Nombre principal (ej: "Mirage")
- `company_name_full`: Nombre completo con región (ej: "Mirage México")
- `company_description`: Descripción breve de la empresa
- `company_tagline`: Lema o tagline

### Branding (`group: branding`)
- `logo_url`: URL del logo
- `favicon_url`: URL del favicon
- `primary_color`: Color primario en hexadecimal

### Contacto (`group: contact`)
- `contact_email`: Email de contacto
- `contact_phone`: Teléfono de contacto
- `contact_address`: Dirección principal

### Redes Sociales (`group: social`)
- `social_facebook`: URL de Facebook
- `online_store_url`: URL de la tienda online
- `b2b_portal_url`: URL del portal B2B
- `certification_portal_url`: URL del portal de certificación

## Uso en Código

### Método 1: Helpers Globales (Recomendado)

En tus vistas Blade o código PHP:

```blade
<!-- En vistas Blade -->
<h1>{{ company_name_full() }}</h1>
<p>{{ company_description() }}</p>
<a href="{{ company_store_url() }}">Tienda Online</a>

<!-- En controladores o helpers -->
$email = company_email();
$phone = company_phone();
$logo = company_logo();
```

### Método 2: Modelo Directo

```php
use App\Models\CompanySetting;

// Obtener un valor
$name = CompanySetting::get('company_name');

// Establecer o actualizar
CompanySetting::set('company_name', 'Nueva Empresa', 'string', 'general');

// Obtener por grupo
$contactSettings = CompanySetting::getByGroup('contact');

// Obtener todos agrupados
$allSettings = CompanySetting::getGrouped();
```

### Método 3: API HTTP

**Listar todas las configuraciones:**
```bash
GET /api/company-settings
```

**Obtener configuraciones por grupo:**
```bash
GET /api/company-settings/group/{group}
```

**Obtener una configuración específica:**
```bash
GET /api/company-settings/{key}
```

**Crear una configuración:**
```bash
POST /api/company-settings
Content-Type: application/json

{
  "key": "custom_setting",
  "value": "valor",
  "type": "string",
  "group": "general",
  "description": "Mi configuración personalizada"
}
```

**Actualizar una configuración:**
```bash
PUT /api/company-settings/{key}
Content-Type: application/json

{
  "value": "nuevo_valor",
  "type": "string",
  "description": "Nueva descripción"
}
```

**Actualizar múltiples configuraciones:**
```bash
POST /api/company-settings/bulk-update
Content-Type: application/json

{
  "settings": [
    {"key": "company_name", "value": "Nueva Empresa"},
    {"key": "contact_phone", "value": "555-1234"}
  ]
}
```

**Eliminar una configuración:**
```bash
DELETE /api/company-settings/{key}
```

## Helpers Disponibles

```php
company_name()           // Nombre principal
company_name_full()      // Nombre completo con región
company_description()    // Descripción
company_email()          // Email
company_phone()          // Teléfono
company_address()        // Dirección
company_logo()           // URL del logo (con asset())
company_favicon()        // URL del favicon
company_color()          // Color primario
company_store_url()      // URL tienda online
social_facebook()        // URL de Facebook
company('key')           // Obtener cualquier configuración genérica
```

## Instalación

1. Ejecutar la migración:
```bash
php artisan migrate
```

2. Ejecutar el seeder con valores iniciales:
```bash
php artisan db:seed --class=CompanySettingsSeeder
```

3. Ejecutar composer dump-autoload para registrar los helpers:
```bash
composer dump-autoload
```

## Ejemplos de Uso

### En una vista Blade

```blade
<!DOCTYPE html>
<html>
<head>
    <title>{{ company_name() }}</title>
    <link rel="icon" href="{{ company_favicon() }}">
    <style>
        :root {
            --primary-color: {{ company_color() }};
        }
    </style>
</head>
<body>
    <header>
        <img src="{{ company_logo() }}" alt="{{ company_name() }}">
        <h1>{{ company_name_full() }}</h1>
        <p>{{ company_description() }}</p>
    </header>
    
    <footer>
        <p>{{ company_address() }}</p>
        <p>{{ company_email() }} | {{ company_phone() }}</p>
        <a href="{{ company_store_url() }}">Tienda Online</a>
        <a href="{{ social_facebook() }}">Facebook</a>
    </footer>
</body>
</html>
```

### En un Controlador

```php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'companyName' => company_name_full(),
            'email' => company_email(),
            'storeUrl' => company_store_url(),
        ]);
    }
}
```

### Cambiar configuraciones programáticamente

```php
use App\Models\CompanySetting;

// En un Job, Seeder, Artisan Command, etc.
CompanySetting::set('company_name', 'Nueva Marca', 'string', 'general', 'Nombre de la marca');
CompanySetting::set('primary_color', '#FF5733', 'string', 'branding', 'Color principal');
CompanySetting::set('contact_phone', '(555) 123-4567', 'string', 'contact', 'Nuevo teléfono');
```

## Panel de Administración (Recomendación)

Se recomienda crear un panel de administración o usar herramientas como:
- **Filament**: Para un panel de admin completo
- **Laravel Nova**: Para gestión de recursos
- **Livewire**: Para interfaces interactivas

Esto permitiría a los administradores cambiar todas las configuraciones visualmente sin código.

## Ventajas

✅ Centralizado en base de datos  
✅ Fácil de actualizar sin redeployar  
✅ Soporta múltiples tipos de datos  
✅ Organizado por grupos  
✅ API disponible para automatización  
✅ Helpers globales para acceso simple  
✅ Completamente personalizable  

## Notas

- Todas las configuraciones se almacenan en `company_settings`
- Los valores iniciales están en el seeder `CompanySettingsSeeder`
- Para cambios en producción, usar API o Artisan commands
- Los helpers usan cache después de la primera carga (opcional, configurable)
