<?php
$dir = __DIR__ . '/resources/views';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$files = [];

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $files[] = $file->getPathname();
    }
}

$startPattern = '/<h3 class="widgettitle widget-title">Corporativo Nacional<\/h3>\s*<div class="textwidget custom-html-widget">\s*<p>Puebla #270 Sur/';
$endPattern = '/Ir arriba<\/a><\/div>\s*<\/div>/';

$replacement = <<<'EOD'
<h3 class="widgettitle widget-title">Corporativo Nacional</h3>
                    <div class="textwidget custom-html-widget">
                        @foreach(\App\Models\Location::where('is_active', true)->get() as $index => $location)
                            @if($index > 0)
                                <div class="su-divider su-divider-style-default"
                                    style="margin:15px 0;border-width:3px;border-color:#ffffff"></div>
                            @endif
                            <h5>{{ $location->name }}</h5>
                            <p>{{ $location->address }}</p>
                        @endforeach
                        <div class="su-divider su-divider-style-default"
                            style="margin:15px 0;border-width:3px;border-color:#ffffff"><a href="#"
                                style="color:#ffffff">Ir arriba</a></div>
                    </div>
EOD;

$count = 0;
foreach ($files as $file) {
    // skip the components we already updated
    if (strpos($file, 'components/x-legacy-footer.blade.php') !== false) continue;
    if (strpos($file, 'components/footer.blade.php') !== false) continue;

    $content = file_get_contents($file);
    if (preg_match($startPattern, $content)) {
        // we find start index and end index
        $regex = '/<h3 class="widgettitle widget-title">Corporativo Nacional<\/h3>\s*<div class="textwidget custom-html-widget">.*?<a href="#"[^>]*>Ir arriba<\/a><\/div>\s*<\/div>/s';
        
        $newContent = preg_replace($regex, $replacement, $content);
        if ($newContent !== $content) {
            file_put_contents($file, $newContent);
            $count++;
        }
    }
}
echo "Updated $count files.\n";
