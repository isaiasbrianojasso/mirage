<?php
$file = 'resources/views/tienda/index.blade.php';
$lines = file($file);

$lb_temp = file_get_contents('lb_template.txt');
$ref_temp = str_replace('$lineaBlancaProducts', '$refaccionesProducts', $lb_temp);

// Refacciones ends at 4147, starts at 2224 (0-indexed: 2223 to 4146)
// Linea Blanca ends at 2185, starts at 152 (0-indexed: 151 to 2184)

$part1 = array_slice($lines, 0, 151); // 0 to 150
$part2 = array_slice($lines, 2185, 2223 - 2185); // 2185 to 2222
$part3 = array_slice($lines, 4147); // 4147 to end

$new_lines = array_merge(
    $part1,
    [$lb_temp . "\n"],
    $part2,
    [$ref_temp . "\n"],
    $part3
);

file_put_contents($file, implode("", $new_lines));
echo "SUCCESS\n";
