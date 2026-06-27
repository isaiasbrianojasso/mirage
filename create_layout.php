<?php

$wishlistPath = __DIR__ . '/resources/views/tienda/wishlist.blade.php';
$wishlistContent = file_get_contents($wishlistPath);

$splitMarker = '<div id="content-wrapper" class="container" style="padding-top: 40px; padding-bottom: 80px;">';
$endMarker = '<footer id="footer" class="js-footer">';

$posTop = strpos($wishlistContent, $splitMarker);
$posBottom = strpos($wishlistContent, $endMarker);

if ($posTop !== false && $posBottom !== false) {
    $header = substr($wishlistContent, 0, $posTop);
    
    // Add tailwind script to header
    $tailwindScript = '
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Modern styles to give a WOW factor */
        body {
            font-family: \'Inter\', sans-serif;
            background-color: #f9fafb;
        }
    </style>
    ';
    $header = str_replace('</head>', $tailwindScript . '</head>', $header);
    
    $footer = substr($wishlistContent, $posBottom);
    
    $layoutContent = $header . "\n        @yield('content')\n    " . $footer;
    
    file_put_contents(__DIR__ . '/resources/views/layouts/legacy.blade.php', $layoutContent);
    echo "Layout legacy.blade.php created.\n";
} else {
    echo "Markers not found.\n";
}
