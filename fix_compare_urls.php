<?php

$dir = __DIR__ . '/resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

foreach ($files as $file) {
    if ($file->isFile() && pathinfo($file->getFilename(), PATHINFO_EXTENSION) == 'php') {
        $content = file_get_contents($file->getRealPath());
        $newContent = str_replace('//www.tiendamirage.mx/module/iqitcompare/actions', '/module/iqitcompare/actions', $content);
        if ($content !== $newContent) {
            file_put_contents($file->getRealPath(), $newContent);
            echo "Updated: " . $file->getRealPath() . "\n";
        }
    }
}
echo "Done.\n";
