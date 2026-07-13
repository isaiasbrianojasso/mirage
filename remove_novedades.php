<?php
$dir = __DIR__ . '/resources/views';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$files = [];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $files[] = $file->getPathname();
    }
}

$startPattern = '/<div class="widget-area footer-widgets-2 footer-widget-area">\s*<section id="custom_html-7" class="widget_text widget widget_custom_html">\s*<div class="widget_text widget-wrap">\s*<h3 class="widgettitle widget-title">Mirage Electrodomésticos<\/h3>/s';

$count = 0;
foreach ($files as $file) {
    // We already handled x-legacy-footer.blade.php and home.blade.php
    if (strpos($file, 'components/x-legacy-footer.blade.php') !== false) continue;
    if (strpos($file, 'templates/pantalla-principal/novedades.blade.php') !== false) continue;

    $content = file_get_contents($file);
    if (preg_match($startPattern, $content)) {
        // Find everything from footer-widgets-2 until the end of that section
        // Note: the end is before footer-widgets-3
        $regex = '/<div class="widget-area footer-widgets-2 footer-widget-area">.*?<\/section>\s*<\/div>\s*(?=<div class="widget-area footer-widgets-3 footer-widget-area">)/s';
        
        $newContent = preg_replace($regex, '<div class="widget-area footer-widgets-2 footer-widget-area"><!-- Novedades removidas --></div>', $content);
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            $count++;
        }
    }
}
echo "Updated $count files.\n";
