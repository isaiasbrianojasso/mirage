<?php
$dir = new RecursiveDirectoryIterator('/Users/joseisaiasbrianojasso/mirage/resources/views');
$ite = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($ite, '/.*\.blade\.php$/', RegexIterator::GET_MATCH);

$replacements = [
    // Dynamic replacements
    "route('tienda.category', \$category->slug)" => "route('tienda.category', \$category->uuid)",
    "route('tienda.category', \$child->slug)" => "route('tienda.category', \$child->uuid)",
    "route('tienda.category', \$cat->slug)" => "route('tienda.category', \$cat->uuid)",
    "route('tienda.category', \$product->category->slug)" => "route('tienda.category', \$product->category->uuid)",
    
    "route('tienda.product', \$product->slug)" => "route('tienda.product', \$product->id)",
    "route('tienda.product', \$other->slug)" => "route('tienda.product', \$other->id)",
    
    // Form reviews
    "route('tienda.product.review', \$product->slug)" => "route('tienda.product.review', \$product->id)",
];

foreach ($files as $file) {
    $path = $file[0];
    $content = file_get_contents($path);
    $original = $content;
    
    foreach ($replacements as $search => $replace) {
        $content = str_replace($search, $replace, $content);
    }
    
    // Replace hardcoded category slugs with a dynamic lookup
    $content = preg_replace(
        "/route\('tienda\.category',\s*'([^']+)'\)/", 
        "route('tienda.category', optional(\App\Models\Category::where('slug', '$1')->orWhere('slug', preg_replace('/^\d+-/', '', '$1'))->first())->uuid ?? '$1')", 
        $content
    );

    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Updated: $path\n";
    }
}
echo "Done.\n";
