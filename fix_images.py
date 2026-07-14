import re

with open('resources/views/home.blade.php', 'r') as f:
    content = f.read()

# Define the images we want to replace and their corresponding setting keys
images_to_replace = {
    'equipos_convencionales_mirage.webp': 'home_category_1_image',
    'equipos_comercial_ligero_mirage.webp': 'home_category_2_image',
    'linea_blanca_mirage.webp': 'home_category_3_image',
    'especialistas_mirage_web.webp': 'home_bottom_banner_1_image',
    'oportunidades_mirage.webp': 'home_bottom_banner_2_image',
    'centro_de_servicio_mirage_web.webp': 'home_bottom_banner_3_image',
    'garantia_extendida_mirage_web.webp': 'home_bottom_banner_4_image',
}

# The goal is to find all URLs containing the image name, and replace them with the CompanySetting call.
# E.g. https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp -> {{ \App\Models\CompanySetting::get('home_category_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp') }}
# BUT wait! `srcset` and `sizes` were completely deleted from the bottom banners in 1356a86!
# So for the bottom banners, we need to RESTORE them from pristine!
