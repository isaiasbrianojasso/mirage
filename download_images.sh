#!/bin/bash

# Script para descargar imágenes externas y convertirlas a locales
# Para usar: chmod +x download_images.sh && ./download_images.sh

# Directorio base
BASE_DIR="public"

echo "Descargando imágenes..."

# Crear estructura de directorios para imágenes
mkdir -p "$BASE_DIR/wp-content/uploads/2023/07"
mkdir -p "$BASE_DIR/wp-content/uploads/2023/05"
mkdir -p "$BASE_DIR/wp-content/uploads/2017/03"

# Descargar imágenes específicas
curl -s -o "$BASE_DIR/wp-content/uploads/2023/07/followme_cover.webp" "https://mirage.mx/wp-content/uploads/2023/07/followme_cover.webp"
echo "Descargado: followme_cover.webp"

curl -s -o "$BASE_DIR/wp-content/uploads/2023/05/mirage_icon.png" "https://mirage.mx/wp-content/uploads/2023/05/mirage_icon.png"
echo "Descargado: mirage_icon.png"

curl -s -o "$BASE_DIR/wp-content/uploads/2017/03/cropped-logo-aires-mirage.png" "https://mirage.mx/wp-content/uploads/2017/03/cropped-logo-aires-mirage.png"
echo "Descargado: cropped-logo-aires-mirage.png"

curl -s -o "$BASE_DIR/wp-content/uploads/2017/03/cropped-ms-icon-310x310-32x32.png" "https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-32x32.png"
echo "Descargado: cropped-ms-icon-310x310-32x32.png"

curl -s -o "$BASE_DIR/wp-content/uploads/2017/03/cropped-ms-icon-310x310-192x192.png" "https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-192x192.png"
echo "Descargado: cropped-ms-icon-310x310-192x192.png"

curl -s -o "$BASE_DIR/wp-content/uploads/2017/03/cropped-ms-icon-310x310-180x180.png" "https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-180x180.png"
echo "Descargado: cropped-ms-icon-310x310-180x180.png"

curl -s -o "$BASE_DIR/wp-content/uploads/2017/03/cropped-ms-icon-310x310-270x270.png" "https://mirage.mx/wp-content/uploads/2017/03/cropped-ms-icon-310x310-270x270.png"
echo "Descargado: cropped-ms-icon-310x310-270x270.png"

echo "¡Descarga de imágenes completada!"
echo "Las imágenes se han guardado en la estructura de directorios bajo '$BASE_DIR/wp-content/uploads/'"
echo "Asegúrate de verificar que las imágenes se descargaron correctamente."
