# Ejemplos de Actualización de Vistas

## Antes (Hardcoded)

```blade
<!-- resource/views/catalog/index.blade.php -->
<title>Todos los Productos Mirage</title>
<p class="site-title"><a href="{{ url('/') }}">Mirage México</a></p>
<p class="site-description">Marca especializada en aires acondicionados y línea blanca.</p>
```

## Después (Usando Helpers)

```blade
<!-- resource/views/catalog/index.blade.php -->
<title>Todos los Productos {{ company_name() }}</title>
<p class="site-title"><a href="{{ url('/') }}">{{ company_name_full() }}</a></p>
<p class="site-description">{{ company_description() }}</p>
```

## Más Ejemplos

### Meta Tags
```blade
<!-- Antes -->
<meta property="og:title" content="Todos los Productos Mirage" />
<meta property="og:image:alt" content="Mirage México" />

<!-- Después -->
<meta property="og:title" content="Todos los Productos {{ company_name() }}" />
<meta property="og:image:alt" content="{{ company_name_full() }}" />
```

### Footer
```blade
<!-- Antes -->
<p>&copy; Copyright 2021 <a href="{{ url('/') }}">Mirage México</a></p>
<li><a href="https://www.facebook.com/miragemx">Facebook</a></li>
<a href="https://www.tiendamirage.mx">Tienda Mirage</a>

<!-- Después -->
<p>&copy; Copyright {{ date('Y') }} <a href="{{ url('/') }}">{{ company_name_full() }}</a></p>
<li><a href="{{ social_facebook() }}">Facebook</a></li>
<a href="{{ company_store_url() }}">Tienda {{ company_name() }}</a>
```

### Contact Information
```blade
<!-- Antes -->
<p>Puebla #270 Sur, Col. Centro. Ciudad Obregón, Sonora, Mx. C.P. 85000 - Tel (644) 410 9800</p>

<!-- Después -->
<p>{{ company_address() }} - Tel {{ company_phone() }}</p>
```

### Email
```blade
<!-- Antes -->
<a href="mailto:contacto@mirage.mx">contacto@mirage.mx</a>

<!-- Después -->
<a href="mailto:{{ company_email() }}">{{ company_email() }}</a>
```

### Logo
```blade
<!-- Antes -->
<img src="{{ asset('uploads/2023/06/mirage-v32-500x500.webp') }}" alt="Mirage">

<!-- Después -->
<img src="{{ company_logo() }}" alt="{{ company_name() }}">
```

### Favicon
```blade
<!-- Antes -->
<link rel="icon" href="{{ asset('uploads/2023/05/mirage_icon.png') }}">

<!-- Después -->
<link rel="icon" href="{{ company_favicon() }}">
```

### Colores Dinámicos
```blade
<!-- Antes -->
<style>
    :root { --primary-color: #a00000; }
</style>

<!-- Después -->
<style>
    :root { --primary-color: {{ company_color() }}; }
</style>
```

## Proceso de Migración Sugerido

1. Ejecutar migraciones y seeders
2. Actualizar vistas una por una
3. Probar que sigue funcionando igual
4. Confirmar que todos los datos se ven bien
5. Usar el panel de admin o API para cambiar valores de prueba
6. Desplegar a producción

## Validación

Para asegurarte de que todo está correctamente configurado:

```bash
# Ver todas las configuraciones
php artisan company:settings

# Ver configuraciones de un grupo específico
php artisan company:settings --group=general
php artisan company:settings --group=contact
php artisan company:settings --group=branding
php artisan company:settings --group=social
```
