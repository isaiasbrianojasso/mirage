<?php

$dir = __DIR__ . '/resources/views/tienda';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$pattern = '/<span class="cart-toggle-details"[^>]*>Vacío<\/span>/i';
$replacement = '<span class="cart-toggle-details" style="display: block; font-size: 13px; font-weight: normal; margin-top: -2px;">{{ $cartCount > 0 ? $cartCount . \' articulos\' : \'Vacío\' }}</span>';

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        
        if (preg_match($pattern, $content)) {
            $newContent = preg_replace($pattern, $replacement, $content);
            file_put_contents($path, $newContent);
            echo "Updated: $path\n";
        }
    }
}
echo "Done.\n";
