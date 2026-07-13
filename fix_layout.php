<?php
$dir = __DIR__ . '/resources/views';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$files = [];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $files[] = $file->getPathname();
    }
}

$oldLine = '<div class="widget-area footer-widgets-2 footer-widget-area"><!-- Novedades removidas --></div>';
$newLine = '<div class="widget-area footer-widgets-2 footer-widget-area">
            @include(\'templates.pantalla-principal.novedades\')
        </div>';

$count = 0;
foreach ($files as $file) {
    $content = file_get_contents($file);
    if (strpos($content, $oldLine) !== false) {
        $newContent = str_replace($oldLine, $newLine, $content);
        file_put_contents($file, $newContent);
        $count++;
    }
}
echo "Updated $count files.\n";
