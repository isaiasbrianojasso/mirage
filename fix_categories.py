import re

with open('resources/views/home.blade.php', 'r') as f:
    text = f.read()

def replace_image_with_setting(text, original_url, setting_name):
    # This will replace the exact URL with the blade snippet, EXCEPT when it's inside a srcset where we need to be careful.
    # Actually, the simplest way is to replace the URL with the blade snippet everywhere it occurs!
    # Because `srcset` expects URLs. If we put `{{ ... }}` it will evaluate to a URL!
    # Wait, the original `srcset` has multiple sizes: `url 563w, url-249x300 249w`
    # If we replace ALL of them with `{{ ... }}`, we'd get `{{ ... }} 563w, url-249x300 249w`. The second one is still hardcoded!
    # Let's just find the `data-lazy-srcset="..."` and replace the WHOLE attribute with `data-lazy-srcset="{{ ... }} 563w"` (or just strip out the smaller resolutions).
    
    # 1. Replace data-lazy-srcset=".*?"
    pattern = r'data-lazy-srcset="[^"]*?' + re.escape(original_url.split('/')[-1]) + r'[^"]*?"'
    replacement = f'data-lazy-srcset="{{{{ \\\\App\\\\Models\\\\CompanySetting::get(\'{setting_name}\', \'{original_url}\') }}}} 563w"'
    text = re.sub(pattern, replacement, text)

    # 2. Replace srcset=".*?"
    pattern2 = r'srcset="[^"]*?' + re.escape(original_url.split('/')[-1]) + r'[^"]*?"'
    replacement2 = f'srcset="{{{{ \\\\App\\\\Models\\\\CompanySetting::get(\'{setting_name}\', \'{original_url}\') }}}} 563w"'
    text = re.sub(pattern2, replacement2, text)

    # 3. Replace data-lazy-src="..."
    pattern3 = r'data-lazy-src="[^"]*?' + re.escape(original_url.split('/')[-1]) + r'"'
    replacement3 = f'data-lazy-src="{{{{ \\\\App\\\\Models\\\\CompanySetting::get(\'{setting_name}\', \'{original_url}\') }}}}"'
    text = re.sub(pattern3, replacement3, text)

    # 4. Replace src="..."
    pattern4 = r'src="[^"]*?' + re.escape(original_url.split('/')[-1]) + r'"'
    replacement4 = f'src="{{{{ \\\\App\\\\Models\\\\CompanySetting::get(\'{setting_name}\', \'{original_url}\') }}}}"'
    text = re.sub(pattern4, replacement4, text)

    return text

text = replace_image_with_setting(text, 'https://mirage.mx/wp-content/uploads/2023/07/equipos_convencionales_mirage.webp', 'home_category_1_image')
text = replace_image_with_setting(text, 'https://mirage.mx/wp-content/uploads/2023/07/equipos_comercial_ligero_mirage.webp', 'home_category_2_image')
text = replace_image_with_setting(text, 'https://mirage.mx/wp-content/uploads/2023/07/linea_blanca_mirage.webp', 'home_category_3_image')

with open('resources/views/home.blade.php', 'w') as f:
    f.write(text)
print("Finished categories!")
