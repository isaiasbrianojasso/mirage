<?php
$file = 'resources/views/tienda/index.blade.php';
$content = file_get_contents($file);
$item = file_get_contents('correct_item.blade.php');

$replacements = [
    '$featuredProducts',
    '$lineaBlancaProducts',
    '$refaccionesProducts'
];

foreach ($replacements as $var) {
    $pattern = '/(@foreach\(' . preg_quote($var) . ' as \$product\)).*?(@endforeach)/s';
    $replacement = "$1\n" . $item . "\n$2";
    $content = preg_replace($pattern, $replacement, $content);
}

file_put_contents($file, $content);
echo "REPLACED ALL LOOPS\n";
