import re

with open('resources/views/tienda/index.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Get featured products block
match = re.search(r'(<div class="swiper-wrapper">\s*@foreach\(\$featuredProducts.*?</div>\s*</div>)', content, re.DOTALL)
if not match:
    print("Could not find featured products wrapper.")
    exit(1)

featured_wrapper = match.group(1)

# 2. Find LINEA BLANCA section and replace its swiper-wrapper
# We'll use regex to find the swiper-wrapper under LINEA BLANCA
lb_pattern = r'(<span>LINEA BLANCA</span>.*?<div class="swiper-container-wrapper swiper-overflow swiper-arrows-above">.*?<div class="products.*?>\s*)<div class="swiper-wrapper">.*?</div>\s*</div>(\s*</div>\s*</div>\s*<div class="swiper-button-prev)'
def lb_repl(m):
    replacement = featured_wrapper.replace('$featuredProducts', '$lineaBlancaProducts')
    return m.group(1) + replacement + m.group(2)

content = re.sub(lb_pattern, lb_repl, content, count=1, flags=re.DOTALL)

# 3. Find REFACCIONES section and replace its swiper-wrapper
ref_pattern = r'(<span>REFACCIONES</span>.*?<div class="swiper-container-wrapper swiper-overflow swiper-arrows-above">.*?<div class="products.*?>\s*)<div class="swiper-wrapper">.*?</div>\s*</div>(\s*</div>\s*</div>\s*<div class="swiper-button-prev)'
def ref_repl(m):
    replacement = featured_wrapper.replace('$featuredProducts', '$refaccionesProducts')
    return m.group(1) + replacement + m.group(2)

content = re.sub(ref_pattern, ref_repl, content, count=1, flags=re.DOTALL)

with open('resources/views/tienda/index.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("SUCCESS")
