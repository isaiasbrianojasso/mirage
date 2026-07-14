<?php
$files = ["resources/views/components/x-header.blade.php", "resources/views/catalog/index.blade.php"];
foreach($files as $file) {
    if(!file_exists($file)) continue;
    $content = file_get_contents($file);
    $content = preg_replace('/\{\{\s*asset\([\'"](wp-[^\'"]+)[\'"]\)\s*\}\}/', 'https://mirage.mx/$1', $content);
    $content = preg_replace('/\{\{\s*asset\([\'"](vendor\/[^\'"]+)[\'"]\)\s*\}\}/', 'https://mirage.mx/$1', $content);
    file_put_contents($file, $content);
    echo "Reverted $file\n";
}
