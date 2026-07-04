# Setup del Sistema de Configuración de Empresa

## Pasos de Instalación

### 1. Ejecutar Migraciones

```bash
# Crear la tabla company_settings
php artisan migrate
```

### 2. Cargar Datos Iniciales

```bash
# Llenar la tabla con valores iniciales de Mirage
php artisan db:seed --class=CompanySettingsSeeder
```

### 3. Actualizar Autoload

```bash
# Registrar los helpers globales
composer dump-autoload
```

### 4. Verificar Instalación

```bash
# Ver todas las configuraciones
php artisan company:settings

# Ver configuraciones de un grupo
php artisan company:settings --group=general
php artisan company:settings --group=contact
php artisan company:settings --group=branding
php artisan company:settings --group=social
```

## Uso Inmediato

Una vez instalado, puedes usar en tus vistas:

```blade
<h1>{{ company_name_full() }}</h1>
<p>{{ company_description() }}</p>
<a href="{{ company_store_url() }}">{{ company_name() }} Tienda</a>
```

## API Endpoints

| Método | Endpoint | Descripción |
|--------|----------|-------------|
| GET | `/api/company-settings` | Listar todas |
| GET | `/api/company-settings/group/{group}` | Por grupo |
| GET | `/api/company-settings/{key}` | Una configuración |
| POST | `/api/company-settings` | Crear |
| PUT | `/api/company-settings/{key}` | Actualizar |
| DELETE | `/api/company-settings/{key}` | Eliminar |
| POST | `/api/company-settings/bulk-update` | Actualizar múltiples |

## Comandos Artisan

```bash
# Ver todas las configuraciones
php artisan company:settings

# Ver por grupo
php artisan company:settings --group=general

# Crear/actualizar una configuración
php artisan company:setting company_name "Mi Empresa" --type=string --group=general

# Ejemplos
php artisan company:setting company_name_full "Mi Empresa México" --group=general
php artisan company:setting primary_color "#FF5733" --group=branding
php artisan company:setting contact_phone "(555) 123-4567" --group=contact
```

## Próximos Pasos

1. **Actualizar vistas**: Reemplazar valores hardcoded por helpers (ver `VIEW_MIGRATION_EXAMPLES.md`)
2. **Panel Admin** (Opcional): Crear panel con Filament o Nova para editar configuraciones
3. **Caché** (Opcional): Implementar caché en helpers para mejor rendimiento
4. **Webhooks** (Opcional): Ejecutar acciones cuando cambie una configuración

## Ejemplo Completo

```php
// Usar en controlador
class HomeController extends Controller {
    public function index() {
        return view('home', [
            'company' => [
                'name' => company_name(),
                'fullName' => company_name_full(),
                'email' => company_email(),
                'phone' => company_phone(),
                'logo' => company_logo(),
                'store' => company_store_url(),
            ]
        ]);
    }
}
```

```blade
<!-- Usar en vista -->
<div class="header">
    <img src="{{ $company['logo'] }}" alt="{{ $company['name'] }}">
    <h1>{{ $company['fullName'] }}</h1>
</div>

<footer>
    <p>{{ $company['phone'] }} | {{ $company['email'] }}</p>
    <a href="{{ $company['store'] }}">Comprar</a>
</footer>
```

## Documentación Completa

Ver `COMPANY_SETTINGS_GUIDE.md` para documentación detallada de todas las funciones.
