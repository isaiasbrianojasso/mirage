import os
import re
from pathlib import Path
import sys

def convert_html_to_blade(html_content, file_path):
    body_match = re.search(r'<body[^>]*>', html_content, re.IGNORECASE)
    if not body_match:
        print(f"Skipping {file_path}: No <body ...> found")
        return None
    
    body_tag = body_match.group(0)
    body_start_idx = body_match.end()
    body_end_idx = html_content.rfind('</body>')
    if body_end_idx == -1:
        body_end_idx = len(html_content)
        
    body_content = html_content[body_start_idx:body_end_idx]
    
    header_start = body_content.find('<header class="site-header"')
    if header_start != -1:
        header_end = body_content.find('</header>', header_start)
        if header_end != -1:
            body_content = body_content[:header_start] + body_content[header_end + 9:]
            
    site_container_idx = body_content.find('<div class="site-container">')
    if site_container_idx != -1:
        insert_idx = site_container_idx + len('<div class="site-container">')
        body_content = body_content[:insert_idx] + "\n    @include('components.x-menu')\n" + body_content[insert_idx:]
        
    blade_content = f"@include('components.x-header')\n{body_tag}\n{body_content}\n</body>\n</html>"
    return blade_content

def process_directory():
    base_dir = Path('/Users/joseisaiasbrianojasso/mirage/mirage.mx')
    views_dir = Path('/Users/joseisaiasbrianojasso/mirage/resources/views/pages')
    views_dir.mkdir(parents=True, exist_ok=True)
    
    routes = []
    html_files = list(base_dir.rglob('*.html'))
    print(f"Found {len(html_files)} HTML files.")
    
    processed_count = 0
    for html_file in html_files:
        if html_file == base_dir / 'index.html':
            continue
            
        rel_path = html_file.relative_to(base_dir)
        route_path = str(rel_path.parent)
        if route_path == '.':
            route_path = html_file.stem
            
        if route_path.endswith('/'):
            route_path = route_path[:-1]
            
        with open(html_file, 'r', encoding='utf-8', errors='ignore') as f:
            content = f.read()
            
        blade_content = convert_html_to_blade(content, html_file)
        if not blade_content:
            continue
            
        blade_name = route_path.replace('/', '.')
        blade_file_path = views_dir / f"{blade_name}.blade.php"
        
        # Ensure subdirectories for nested blades exist
        blade_file_path.parent.mkdir(parents=True, exist_ok=True)
        
        with open(blade_file_path, 'w', encoding='utf-8') as f:
            f.write(blade_content)
            
        routes.append(f"Route::get('/{route_path}', function () {{ return view('pages.{blade_name}'); }});")
        processed_count += 1
        
    print(f"Generated {processed_count} views and {len(routes)} routes.")
    
    if routes:
        with open('/Users/joseisaiasbrianojasso/mirage/routes/web_mirage.php', 'w') as f:
            f.write("<?php\nuse Illuminate\Support\Facades\Route;\n\n")
            f.write("\n".join(routes))
        print("Written to routes/web_mirage.php")
        
if __name__ == '__main__':
    process_directory()
