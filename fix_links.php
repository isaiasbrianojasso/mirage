<?php

$dir = __DIR__ . '/resources/views/tienda';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$patternWishlist = '/<a\s+href="#"([^>]+)Lista de deseos \(/ism';
$replacementWishlist = '<a href="{{ route(\'wishlist.index\') }}"$1Lista de deseos (';

$patternCart = '/<a id="cart-toogle" class="cart-toogle header-btn header-cart-btn">/ism';
$replacementCart = '<a id="cart-toogle" href="{{ route(\'cart.index\') }}" class="cart-toogle header-btn header-cart-btn">';

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $originalContent = $content;
        
        $content = preg_replace($patternWishlist, $replacementWishlist, $content);
        $content = preg_replace($patternCart, $replacementCart, $content);
        
        if ($content !== $originalContent) {
            file_put_contents($path, $content);
            echo "Updated $path\n";
        }
    }
}
echo "Done.\n";
