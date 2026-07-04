<?php
$files = array_merge(glob("resources/views/tienda/*.blade.php"), glob("resources/views/layouts/*.blade.php"));
foreach ($files as $file) {
    if (!is_file($file)) continue;
    $content = file_get_contents($file);
    // Fix route("tienda.product", $id) -> route("tienda.product", ["uuid" => $id])
    // The previous regex had a bug, let's just use simple preg_replace for all variants.
    // Replace route('tienda.product', something) with route('tienda.product', ['uuid' => something])
    // We only replace if it doesn't already have ['uuid' => 
    $content = preg_replace("/route\(\s*'tienda\.product'\s*,\s*([^\[]+?)\s*\)/", "route('tienda.product', ['uuid' => $1])", $content);
    $content = preg_replace("/route\(\s*'tienda\.category'\s*,\s*([^\[]+?)\s*\)/", "route('tienda.category', ['uuid' => $1])", $content);
    
    file_put_contents($file, $content);
}
echo "Done\n";
