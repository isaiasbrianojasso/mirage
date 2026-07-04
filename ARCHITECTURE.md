# 📊 Arquitectura del Sistema de Configuración

## Flujo de Datos

```
┌─────────────────────────────────────────────────────────┐
│          ADMINISTRADOR / USUARIO                        │
└────────────────────┬────────────────────────────────────┘
                     │
        ┌────────────┼────────────┐
        │            │            │
        ▼            ▼            ▼
    ┌────────┐  ┌──────────┐  ┌────────────┐
    │  CLI   │  │  API     │  │  Panel     │
    │Artisan │  │  REST    │  │ Admin      │
    └───┬────┘  └────┬─────┘  └─────┬──────┘
        │            │              │
        └────────────┼──────────────┘
                     │
         ┌───────────▼───────────┐
         │ CompanySettingController
         │ AdminCompanySettingController
         └───────────┬───────────┘
                     │
         ┌───────────▼───────────┐
         │   CompanySetting      │
         │    (Model)            │
         │                       │
         │  - get(key)           │
         │  - set(key, value)    │
         │  - getGrouped()       │
         │  - getByGroup()       │
         └───────────┬───────────┘
                     │
        ┌────────────▼────────────┐
        │   company_settings      │
        │      (DATABASE)         │
        │                         │
        │ ┌────────────────────┐  │
        │ │ id, key, value     │  │
        │ │ type, group        │  │
        │ │ description, dates │  │
        │ └────────────────────┘  │
        └────────────────────────┘
                     │
        ┌────────────▼────────────┐
        │   CompanyHelper         │
        │   (Helpers Globales)    │
        │                         │
        │  - company_name()       │
        │  - company_email()      │
        │  - company_logo()       │
        │  - ... (11 funciones)   │
        └────────────┬────────────┘
                     │
         ┌───────────▼───────────┐
         │   VISTAS BLADE        │
         │                       │
         │ {{ company_name() }}  │
         │ {{ company_email() }} │
         └───────────┬───────────┘
                     │
         ┌───────────▼───────────┐
         │  HTML RENDERIZADO     │
         │                       │
         │ <h1>Mirage México</h1>│
         │ <a>...@mirage.mx</a>  │
         └───────────────────────┘
```

---

## Componentes

```
┌─────────────────────────────────────────────────────────────┐
│                    SISTEMA COMPLETO                         │
├─────────────────────────────────────────────────────────────┤
│                                                             │
│  DATABASE                                                  │
│  ├── Tabla: company_settings                              │
│  └── Seeder: CompanySettingsSeeder                        │
│                                                             │
│  MODELS                                                    │
│  └── CompanySetting (CRUD + helpers estáticos)            │
│                                                             │
│  CONTROLLERS                                               │
│  ├── CompanySettingController (API REST)                  │
│  └── AdminCompanySettingController (Panel Admin)          │
│                                                             │
│  HELPERS                                                   │
│  └── CompanyHelper (11 funciones globales)                │
│                                                             │
│  COMMANDS                                                  │
│  ├── UpdateCompanySettingCommand                          │
│  └── ShowCompanySettingsCommand                           │
│                                                             │
│  ROUTES                                                    │
│  └── API endpoints (/api/company-settings/...)            │
│                                                             │
│  DOCUMENTATION                                             │
│  ├── QUICKSTART.md (comienza aquí)                        │
│  ├── IMPLEMENTATION_SUMMARY.md                            │
│  ├── COMPANY_SETTINGS_GUIDE.md                            │
│  ├── SETUP_COMPANY_SETTINGS.md                            │
│  └── VIEW_MIGRATION_EXAMPLES.md                           │
│                                                             │
└─────────────────────────────────────────────────────────────┘
```

---

## Configuraciones Disponibles

```
GENERAL (general)
├── company_name              → "Mirage"
├── company_name_full         → "Mirage México"
├── company_description       → "Marca especializada..."
└── company_tagline          → "La máxima eficiencia..."

CONTACT (contact)
├── contact_email             → "contacto@mirage.mx"
├── contact_phone             → "(644) 410 9800"
└── contact_address           → "Puebla #270 Sur..."

BRANDING (branding)
├── logo_url                  → "/uploads/2023/06/..."
├── favicon_url               → "/uploads/2023/05/..."
└── primary_color             → "#a00000"

SOCIAL (social)
├── social_facebook           → "https://facebook.com/..."
├── online_store_url          → "https://tiendamirage.mx"
├── b2b_portal_url            → "https://b2b.mirage.mx"
└── certification_portal_url  → "https://certificacion.com"
```

---

## Casos de Uso

```
CASO 1: Cambiar nombre de empresa
┌────────────────────────────────────┐
│ Admin ejecuta CLI:                 │
│ company:setting company_name       │
│ "Nueva Empresa"                    │
└─────────────┬──────────────────────┘
              │
         ┌────▼─────┐
         │ Database  │ ← Se actualiza
         └────┬─────┘
              │
         ┌────▼──────────────┐
         │ Próxima visita:   │
         │ {{ company_name() │
         │ }} muestra        │
         │ "Nueva Empresa"   │
         └───────────────────┘

CASO 2: Cambiar datos desde frontend
┌──────────────────────────────────────┐
│ Usuario edita panel de admin         │
└─────────────┬──────────────────────────┘
              │
         ┌────▼──────────────────┐
         │ POST /api/            │
         │ company-settings      │
         └────┬──────────────────┘
              │
         ┌────▼─────────────────┐
         │ CompanySettingController
         │ bulk-update()        │
         └────┬──────────────────┘
              │
         ┌────▼─────┐
         │ Database  │ ← Se actualiza
         └─────────┘

CASO 3: Leer en código
┌──────────────────────────────────────┐
│ @php                                 │
│ $name = company_name();              │
│ @endphp                              │
└─────────────┬──────────────────────────┘
              │
         ┌────▼──────────────────┐
         │ CompanyHelper         │
         │ company_name()        │
         └────┬──────────────────┘
              │
         ┌────▼──────────────────┐
         │ CompanySetting::get() │
         └────┬──────────────────┘
              │
         ┌────▼─────┐
         │ Database  │ ← Lee
         └────┬─────┘
              │
         ┌────▼──────────────┐
         │ Retorna valor     │
         │ "Mirage México"   │
         └───────────────────┘
```

---

## Estados de Datos

```
CREAR
  ↓
  CompanySetting::set('key', 'value')
  ↓
  INSERT INTO company_settings
  ↓
LEER (cache)
  ↓
  company('key') / CompanySetting::get('key')
  ↓
  SELECT * FROM company_settings WHERE key = ?
  ↓
ACTUALIZAR
  ↓
  CompanySetting::set('key', 'new_value')
  ↓
  UPDATE company_settings SET value = ? WHERE key = ?
  ↓
ELIMINAR (soft delete)
  ↓
  $setting->delete()
  ↓
  UPDATE company_settings SET deleted_at = NOW() WHERE key = ?
  ↓
```

---

## Integración con Vistas

```
┌───────────────────────────────────┐
│    resources/views/               │
│    catalog/index.blade.php        │
└────────────┬──────────────────────┘
             │
             │ {{ company_name() }}
             │ {{ company_description() }}
             │ {{ company_logo() }}
             │
       ┌─────▼────────────┐
       │ CompanyHelper    │
       │ (Autocargado)    │
       └─────┬────────────┘
             │
       ┌─────▼───────────────┐
       │ CompanySetting::get │
       └─────┬───────────────┘
             │
       ┌─────▼──────────────┐
       │ Database           │
       │ (1 query)          │
       └─────┬──────────────┘
             │
       ┌─────▼──────────────────┐
       │ Resultado en HTML      │
       │ <h1>Mirage México</h1> │
       └────────────────────────┘
```

---

## Mejoras Futuras (Opcionales)

```
NIVEL 1: Actual
└── Configuraciones básicas

NIVEL 2: Cache
├── Redis/Memcached
├── Cache por grupo
└── Invalidación automática

NIVEL 3: Historial
├── Auditoría de cambios
├── Rollback a versiones anteriores
└── Logs de quién cambió qué

NIVEL 4: Validación
├── Validadores por tipo
├── Valores permitidos
└── Restricciones personalizadas

NIVEL 5: Webhooks
├── Notificaciones de cambios
├── Integración con sistemas externos
└── Triggers en eventos
```

---

**Diagrama de Arquitectura Completa ✅**
