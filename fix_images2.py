import re

# Read the file
with open('resources/views/home.blade.php', 'r') as f:
    content = f.read()

# Fix banner 1
banner1_broken = """                                                    data-lazy-src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }}" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }}"
                                                        class="" alt="" decoding="async" /></noscript></a>"""

banner1_fixed = """                                                    data-lazy-srcset="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }} 1135w"
                                                    data-lazy-sizes="(max-width: 1135px) 100vw, 1135px"
                                                    data-lazy-src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }}" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }}"
                                                        class="" alt="" decoding="async"
                                                        srcset="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }} 1135w"
                                                        sizes="(max-width: 1135px) 100vw, 1135px" /></noscript></a>"""

# Fix banner 2
banner2_broken = """                                                    data-lazy-src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_2_image', 'https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp') }}" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_2_image', 'https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp') }}"
                                                        class="" alt="" decoding="async" /></noscript></a>"""

banner2_fixed = """                                                    data-lazy-srcset="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_2_image', 'https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp') }} 1135w"
                                                    data-lazy-sizes="(max-width: 1135px) 100vw, 1135px"
                                                    data-lazy-src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_2_image', 'https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp') }}" /><noscript><img
                                                        loading="lazy" width="1135" height="738"
                                                        src="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_2_image', 'https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp') }}"
                                                        class="" alt="" decoding="async"
                                                        srcset="{{ \\App\\Models\\CompanySetting::get('home_bottom_banner_2_image', 'https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp') }} 1135w"
                                                        sizes="(max-width: 1135px) 100vw, 1135px" /></noscript></a>"""

content = content.replace(banner1_broken, banner1_fixed)
content = content.replace(banner2_broken, banner2_fixed)

# Now apply CompanySetting to the 3 category images
content = re.sub(
    r'data-lazy-srcset="(.*?equipos_convencionales_mirage.*?)"',
    r'data-lazy-srcset="{{ \App\Models\CompanySetting::get(\'home_category_1_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp\') }} 563w"',
    content
)
content = re.sub(
    r'data-lazy-src=".*?equipos_convencionales_mirage.*?"',
    r'data-lazy-src="{{ \App\Models\CompanySetting::get(\'home_category_1_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp\') }}"',
    content
)
content = re.sub(
    r'src="(.*?equipos_convencionales_mirage.*?)"\n(.*?)class=""',
    r'src="{{ \App\Models\CompanySetting::get(\'home_category_1_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp\') }}"\n\2class=""',
    content
)
content = re.sub(
    r'srcset="(.*?equipos_convencionales_mirage.*?)"',
    r'srcset="{{ \App\Models\CompanySetting::get(\'home_category_1_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp\') }} 563w"',
    content
)

# And category 2
content = re.sub(
    r'data-lazy-srcset="(.*?equipos_comercial_ligero_mirage.*?)"',
    r'data-lazy-srcset="{{ \App\Models\CompanySetting::get(\'home_category_2_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp\') }} 563w"',
    content
)
content = re.sub(
    r'data-lazy-src=".*?equipos_comercial_ligero_mirage.*?"',
    r'data-lazy-src="{{ \App\Models\CompanySetting::get(\'home_category_2_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp\') }}"',
    content
)
content = re.sub(
    r'src="(.*?equipos_comercial_ligero_mirage.*?)"\n(.*?)class=""',
    r'src="{{ \App\Models\CompanySetting::get(\'home_category_2_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp\') }}"\n\2class=""',
    content
)
content = re.sub(
    r'srcset="(.*?equipos_comercial_ligero_mirage.*?)"',
    r'srcset="{{ \App\Models\CompanySetting::get(\'home_category_2_image\', \'https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp\') }} 563w"',
    content
)

# And category 3
content = re.sub(
    r'data-lazy-srcset="(.*?linea_blanca_mirage.*?)"',
    r'data-lazy-srcset="{{ \App\Models\CompanySetting::get(\'home_category_3_image\', \'https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp\') }} 563w"',
    content
)
content = re.sub(
    r'data-lazy-src=".*?linea_blanca_mirage.*?"',
    r'data-lazy-src="{{ \App\Models\CompanySetting::get(\'home_category_3_image\', \'https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp\') }}"',
    content
)
content = re.sub(
    r'src="(.*?linea_blanca_mirage.*?)"\n(.*?)class=""',
    r'src="{{ \App\Models\CompanySetting::get(\'home_category_3_image\', \'https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp\') }}"\n\2class=""',
    content
)
content = re.sub(
    r'srcset="(.*?linea_blanca_mirage.*?)"',
    r'srcset="{{ \App\Models\CompanySetting::get(\'home_category_3_image\', \'https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp\') }} 563w"',
    content
)

with open('resources/views/home.blade.php', 'w') as f:
    f.write(content)
print("done")
