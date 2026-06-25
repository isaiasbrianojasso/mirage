#!/bin/bash

# Script para descargar recursos externos y convertirlos a locales
# Para usar: chmod +x download_assets.sh && ./download_assets.sh

# Directorio base
BASE_DIR="public"

# Crear estructura de directorios
mkdir -p "$BASE_DIR/wp-content/themes/digital-pro"
mkdir -p "$BASE_DIR/wp-content/themes/digital-pro/lib/woocommerce"
mkdir -p "$BASE_DIR/wp-content/plugins/woocommerce/assets/css"
mkdir -p "$BASE_DIR/wp-content/plugins/fooevents/css"
mkdir -p "$BASE_DIR/wp-content/plugins/wp-store-locator/css"
mkdir -p "$BASE_DIR/wp-content/plugins/url-shortify-premium/lite/dist/styles"
mkdir -p "$BASE_DIR/wp-includes/css"
mkdir -p "$BASE_DIR/wp-includes/js/jquery"
mkdir -p "$BASE_DIR/vendor/ionicons/css"

echo "Descargando recursos..."

# Descargar archivos CSS del tema Digital Pro
curl -s -o "$BASE_DIR/wp-content/themes/digital-pro/style.css" "https://mirage.mx/wp-content/themes/digital-pro/style.css?ver=1.1.3"
echo "Descargado: style.css"

curl -s -o "$BASE_DIR/wp-content/themes/digital-pro/style-front.css" "https://mirage.mx/wp-content/themes/digital-pro/style-front.css?ver=1.1.3"
echo "Descargado: style-front.css"

curl -s -o "$BASE_DIR/wp-content/themes/digital-pro/lib/woocommerce/digital-woocommerce.css" "https://mirage.mx/wp-content/themes/digital-pro/lib/woocommerce/digital-woocommerce.css?ver=1.1.3"
echo "Descargado: digital-woocommerce.css"

# Descargar archivos CSS de WooCommerce
curl -s -o "$BASE_DIR/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css" "https://mirage.mx/wp-content/plugins/woocommerce/assets/css/woocommerce-layout.css?ver=10.8.1"
echo "Descargado: woocommerce-layout.css"

curl -s -o "$BASE_DIR/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css" "https://mirage.mx/wp-content/plugins/woocommerce/assets/css/woocommerce-smallscreen.css?ver=10.8.1"
echo "Descargado: woocommerce-smallscreen.css"

curl -s -o "$BASE_DIR/wp-content/plugins/woocommerce/assets/css/woocommerce.css" "https://mirage.mx/wp-content/plugins/woocommerce/assets/css/woocommerce.css?ver=10.8.1"
echo "Descargado: woocommerce.css"

# Descargar archivos CSS de FooEvents
curl -s -o "$BASE_DIR/wp-content/plugins/fooevents/css/events-frontend.css" "https://mirage.mx/wp-content/plugins/fooevents/css/events-frontend.css?ver=1.19.22"
echo "Descargado: events-frontend.css"

curl -s -o "$BASE_DIR/wp-content/plugins/fooevents/css/events-zoom-frontend.css" "https://mirage.mx/wp-content/plugins/fooevents/css/events-zoom-frontend.css?ver=1.19.22"
echo "Descargado: events-zoom-frontend.css"

# Descargar archivos CSS de otros plugins
curl -s -o "$BASE_DIR/wp-content/plugins/wp-store-locator/css/styles.min.css" "https://mirage.mx/wp-content/plugins/wp-store-locator/css/styles.min.css?ver=2.3.2"
echo "Descargado: styles.min.css (WP Store Locator)"

curl -s -o "$BASE_DIR/wp-content/plugins/url-shortify-premium/lite/dist/styles/url-shortify.css" "https://mirage.mx/wp-content/plugins/url-shortify-premium/lite/dist/styles/url-shortify.css?ver=2.4.1"
echo "Descargado: url-shortify.css"

# Descargar Dashicons
curl -s -o "$BASE_DIR/wp-includes/css/dashicons.min.css" "https://mirage.mx/wp-includes/css/dashicons.min.css?ver=fd0786a45cbc4281d58a506762eefc8f"
echo "Descargado: dashicons.min.css"

# Descargar jQuery
curl -s -o "$BASE_DIR/wp-includes/js/jquery/jquery.min.js" "https://mirage.mx/wp-includes/js/jquery/jquery.min.js?ver=3.7.1"
echo "Descargado: jquery.min.js"

curl -s -o "$BASE_DIR/wp-includes/js/jquery/jquery-migrate.min.js" "https://mirage.mx/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1"
echo "Descargado: jquery-migrate.min.js"

# Descargar Ionicon (desde CDN oficial)
curl -s -o "$BASE_DIR/vendor/ionicons/css/ionicons.min.css" "https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"
echo "Descargado: ionicons.min.css"

echo "¡Descarga completada!"
echo "Los archivos se han guardado en la estructura de directorios bajo '$BASE_DIR'"
echo "Asegúrate de verificar que los archivos se descargaron correctamente."
