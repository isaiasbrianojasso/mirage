<?php
$dir = __DIR__ . '/resources/views';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$files = [];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $files[] = $file->getPathname();
    }
}

$oldLine = '<p>{{ $location->address }}</p>';
$newLine = "<p>{{ collect([\$location->address, \$location->city, \$location->state, \$location->country])->filter()->implode(', ') }}{{ \$location->zip ? ' C.P. ' . \$location->zip : '' }}{{ \$location->phone ? ' - Tel ' . \$location->phone : '' }}</p>";

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
