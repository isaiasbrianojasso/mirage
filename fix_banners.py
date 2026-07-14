import re

with open('resources/views/home.blade.php', 'r') as f:
    text = f.read()

def restore_bottom_banner(text, banner_id, original_image):
    # In 1356a86, it looks like this:
    # data-lazy-src="{{ \App\Models\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }}" /><noscript><img
    #     loading="lazy" width="1135" height="738"
    #     src="{{ \App\Models\CompanySetting::get('home_bottom_banner_1_image', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp') }}"
    #     class="" alt="" decoding="async" /></noscript></a>
    
    # We want to add back data-lazy-srcset, data-lazy-sizes, srcset, and sizes.
    setting_name = f'home_bottom_{banner_id}_image'
    
    pattern = r'data-lazy-src="\{\{ \\App\\Models\\CompanySetting::get\(\'' + setting_name + r'\'.*?\}\}" />(.*?)src="\{\{ \\App\\Models\\CompanySetting::get\(\'' + setting_name + r'\'.*?\}\}"(.*?)/>'
    
    def repl(m):
        noscript_start = m.group(1)
        noscript_end = m.group(2)
        
        replacement = f'''data-lazy-srcset="{{{{ \\App\\Models\\CompanySetting::get('{setting_name}', '{original_image}') }}}} 1135w"
                                                    data-lazy-sizes="(max-width: 1135px) 100vw, 1135px"
                                                    data-lazy-src="{{{{ \\App\\Models\\CompanySetting::get('{setting_name}', '{original_image}') }}}}" />{noscript_start}src="{{{{ \\App\\Models\\CompanySetting::get('{setting_name}', '{original_image}') }}}}"{noscript_end} srcset="{{{{ \\App\\Models\\CompanySetting::get('{setting_name}', '{original_image}') }}}} 1135w" sizes="(max-width: 1135px) 100vw, 1135px" />'''
        return replacement

    return re.sub(pattern, repl, text, flags=re.DOTALL)


text = restore_bottom_banner(text, 'banner_1', 'https://mirage.mx/wp-content/uploads/2023/07/especialistas_mirage_web.webp')
text = restore_bottom_banner(text, 'banner_2', 'https://mirage.mx/wp-content/uploads/2023/07/oportunidades_mirage.webp')
text = restore_bottom_banner(text, 'banner_3', 'https://mirage.mx/wp-content/uploads/2023/07/centro_de_servicio_mirage_web.webp')
text = restore_bottom_banner(text, 'banner_4', 'https://mirage.mx/wp-content/uploads/2023/07/garantia_extendida_mirage_web.webp')

with open('resources/views/home.blade.php', 'w') as f:
    f.write(text)
print("Finished banners!")
