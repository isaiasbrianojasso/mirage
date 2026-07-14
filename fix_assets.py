import re

def revert_asset(filepath):
    with open(filepath, "r") as f:
        content = f.read()

    # Regex to match {{ asset('wp-...') }} or {{ asset("wp-...") }}
    content = re.sub(r"\{\{\s*asset\([\'\"](wp-[^\'\"]+)[\'\"]\)\s*\}\}", r"https://mirage.mx/\1", content)
    content = re.sub(r"\{\{\s*asset\([\'\"](vendor/[^\'\"]+)[\'\"]\)\s*\}\}", r"https://mirage.mx/\1", content)
    
    with open(filepath, "w") as f:
        f.write(content)
    print(f"Reverted assets in {filepath}")

revert_asset("resources/views/components/x-header.blade.php")
revert_asset("resources/views/catalog/index.blade.php")
