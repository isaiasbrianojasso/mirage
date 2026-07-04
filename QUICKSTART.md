# 🚀 QUICK START - Sistema de Configuración Personalizable

## En 3 pasos usa el sistema

### Paso 1: Instalar
```bash
# Ejecutar migración
php artisan migrate

# Cargar datos
php artisan db:seed --class=CompanySettingsSeeder

# Actualizar autoload
composer dump-autoload
```

### Paso 2: Usar en Vistas
```blade
<!-- Tu vista (ejemplo: resources/views/catalog/index.blade.php) -->

<!-- Antes: -->
<title>Todos los Productos Mirage</title>
<h1>Mirage México</h1>

<!-- Después: -->
<title>Todos los Productos {{ company_name() }}</title>
<h1>{{ company_name_full() }}</h1>
```

### Paso 3: Cambiar en Producción
```bash
# Opción A: Por CLI
php artisan company:setting company_name "Mi Nueva Empresa"
php artisan company:setting company_email "hola@empresa.com" --group=contact

# Opción B: Por API
curl -X PUT "https://tusite.com/api/company-settings/company_name" \
  -H "Content-Type: application/json" \
  -d '{"value": "Mi Nueva Empresa"}'

# Opción C: En código PHP
CompanySetting::set('company_name', 'Mi Nueva Empresa', 'string', 'general');
```

---

## Helpers Disponibles (Copy & Paste)

```blade
{{ company_name() }}           <!-- Mirage -->
{{ company_name_full() }}      <!-- Mirage México -->
{{ company_description() }}    <!-- Marca especializada... -->
{{ company_email() }}          <!-- contacto@mirage.mx -->
{{ company_phone() }}          <!-- (644) 410 9800 -->
{{ company_address() }}        <!-- Puebla #270 Sur... -->
{{ company_logo() }}           <!-- <img src...> -->
{{ company_favicon() }}        <!-- <link rel=icon...> -->
{{ company_color() }}          <!-- #a00000 -->
{{ company_store_url() }}      <!-- https://tienda.com -->
{{ social_facebook() }}        <!-- https://facebook.com/... -->
```

---

## Ejemplo Real

```blade
<!DOCTYPE html>
<html>
<head>
    <title>{{ company_name_full() }}</title>
    <link rel="icon" href="{{ company_favicon() }}">
    <style>
        :root { --brand-color: {{ company_color() }}; }
    </style>
</head>
<body>
    <header>
        <h1>{{ company_name_full() }}</h1>
        <p>{{ company_description() }}</p>
    </header>
    
    <footer>
        <p>{{ company_address() }}</p>
        <p>{{ company_phone() }} | {{ company_email() }}</p>
        <a href="{{ company_store_url() }}">Tienda</a>
        <a href="{{ social_facebook() }}">Facebook</a>
    </footer>
</body>
</html>
```

---

## Comandos Útiles

```bash
# Ver todo
php artisan company:settings

# Ver un grupo
php artisan company:settings --group=general
php artisan company:settings --group=contact

# Cambiar un valor
php artisan company:setting company_name "Mi Marca"
php artisan company:setting contact_phone "(555) 123-4567"

# En PHP
CompanySetting::get('company_name') // Lee un valor
CompanySetting::set('company_name', 'Nueva') // Escribe un valor
```

---

## API REST (Para Frontend)

```javascript
// Obtener todas las configuraciones
fetch('/api/company-settings')
  .then(r => r.json())
  .then(data => console.log(data));

// Cambiar una configuración
fetch('/api/company-settings/company_name', {
  method: 'PUT',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ value: 'Nueva Empresa' })
})
.then(r => r.json())
.then(data => console.log(data));

// Crear múltiples a la vez
fetch('/api/company-settings/bulk-update', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    settings: [
      { key: 'company_name', value: 'Mi Empresa' },
      { key: 'contact_phone', value: '(555) 123-4567' }
    ]
  })
})
```

---

## 5 Minutos de Configuración

| Paso | Tiempo | Acción |
|------|--------|--------|
| 1 | 1 min | `php artisan migrate` |
| 2 | 1 min | `php artisan db:seed --class=CompanySettingsSeeder` |
| 3 | 1 min | `composer dump-autoload` |
| 4 | 2 min | Reemplaza "Mirage" por `{{ company_name() }}` en vistas |
| | | **LISTO** ✅ |

---

## Verificar que funciona

```bash
# 1. Ver configuraciones
php artisan company:settings

# 2. Cambiar una
php artisan company:setting company_name "Test"

# 3. Verificar
php artisan company:settings --group=general

# 4. En tu vista
{{ company_name() }} <!-- Debe mostrar "Test" -->
```

---

## 📚 Documentación Completa

- **IMPLEMENTATION_SUMMARY.md** - Resumen de qué se creó
- **COMPANY_SETTINGS_GUIDE.md** - Guía completa
- **SETUP_COMPANY_SETTINGS.md** - Instalación paso a paso
- **VIEW_MIGRATION_EXAMPLES.md** - Ejemplos de vistas
- **EXAMPLE_ADMIN_ROUTES.md** - Panel de administración

---

**¡Listo para empezar!** 🎉
