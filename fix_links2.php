<?php

$dir = __DIR__ . '/resources/views/tienda';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$patternWishlist1 = '/<a\s+href="\/\/www\.tiendamirage\.mx\/module\/iqitwishlist\/view"/ism';
$replacementWishlist1 = '<a href="{{ route(\'wishlist.index\') }}"';

$patternCart1 = '/<a id="cart-toogle" class="cart-toogle header-btn header-cart-btn"[^>]*>/ism';
$replacementCart1 = '<a id="cart-toogle" href="{{ route(\'cart.index\') }}" class="cart-toogle header-btn header-cart-btn" data-toggle="dropdown" data-display="static">';

$patternCart2 = '/<a id="mobile-cart-toogle" class="m-nav-btn"[^>]*>/ism';
$replacementCart2 = '<a id="mobile-cart-toogle" href="{{ route(\'cart.index\') }}" class="m-nav-btn" data-display="static" data-toggle="dropdown">';

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $originalContent = $content;
        
        $content = preg_replace($patternWishlist1, $replacementWishlist1, $content);
        $content = preg_replace($patternCart1, $replacementCart1, $content);
        $content = preg_replace($patternCart2, $replacementCart2, $content);
        
        if ($content !== $originalContent) {
            file_put_contents($path, $content);
            echo "Updated $path\n";
        }
    }
}
echo "Done.\n";
