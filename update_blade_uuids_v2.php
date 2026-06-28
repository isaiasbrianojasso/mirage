<?php
$dir = new RecursiveDirectoryIterator('/Users/joseisaiasbrianojasso/mirage/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

foreach ($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $original = $content;
    
    // Fix route with double quotes
    $content = str_replace('route("tienda.product", $product->slug)', 'route("tienda.product", $product->id)', $content);
    $content = str_replace('route("tienda.category", $product->category->slug)', 'route("tienda.category", $product->category->uuid)', $content);
    $content = str_replace('route("tienda.category", $category->slug)', 'route("tienda.category", $category->uuid)', $content);
    
    // Any remaining single-quote variations not caught previously
    $content = preg_replace("/route\(\s*['\"]tienda\.product['\"]\s*,\s*\\\$([a-zA-Z0-9_]+)->slug\s*\)/", "route('tienda.product', \$$1->id)", $content);
    $content = preg_replace("/route\(\s*['\"]tienda\.category['\"]\s*,\s*\\\$([a-zA-Z0-9_]+)->slug\s*\)/", "route('tienda.category', \$$1->uuid)", $content);

    // Specifically for wishlist
    $content = str_replace('$item->product->slug', '$item->product->id', $content);

    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Updated: $path\n";
    }
}
echo "Done.\n";
