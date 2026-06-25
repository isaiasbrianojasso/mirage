<?php
$base_dir = '/Users/joseisaiasbrianojasso/mirage/mirage.mx';
$views_dir = '/Users/joseisaiasbrianojasso/mirage/resources/views/pages';

if (!is_dir($views_dir)) {
    mkdir($views_dir, 0777, true);
}

$routes = [];

$di = new RecursiveDirectoryIterator($base_dir);
$it = new RecursiveIteratorIterator($di);

$processed_count = 0;
foreach ($it as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'html') {
        $html_file = $file->getPathname();
        
        if ($html_file == $base_dir . '/index.html') {
            continue;
        }
        
        $rel_path = substr($html_file, strlen($base_dir) + 1);
        $route_path = dirname($rel_path);
        
        if ($route_path == '.') {
            $route_path = basename($rel_path, '.html');
        }
        
        $html_content = file_get_contents($html_file);
        
        // Find body tag
        if (preg_match('/<body[^>]*>/i', $html_content, $matches, PREG_OFFSET_CAPTURE)) {
            $body_tag = $matches[0][0];
            $body_start_idx = $matches[0][1] + strlen($body_tag);
            
            $body_end_idx = strripos($html_content, '</body>');
            if ($body_end_idx === false) {
                $body_end_idx = strlen($html_content);
            }
            
            $body_content = substr($html_content, $body_start_idx, $body_end_idx - $body_start_idx);
            
            // Remove header
            $body_content = preg_replace('/<header\s+class="site-header".*?<\/header>/is', '', $body_content);
            
            // Insert menu
            $body_content = preg_replace('/(<div\s+class="site-container">)/is', "$1\n    @include('components.x-menu')\n", $body_content, 1);
            
            // Clean up index.html from links
            $body_content = str_replace('/index.html', '', $body_content);
            $body_content = str_replace('index.html', '', $body_content);
            
            // Fix any hardcoded links in footers to point to local tienda
            $body_content = str_replace('http://www.tiendamirage.mx', '/tienda', $body_content);
            $body_content = str_replace('https://www.tiendamirage.mx', '/tienda', $body_content);
            
            $blade_content = "@include('components.x-header')\n" . $body_tag . "\n" . $body_content . "\n</body>\n</html>";
            
            $blade_name = str_replace('/', '.', $route_path);
            $blade_file_path = $views_dir . '/' . $route_path . '.blade.php';
            
            $dir = dirname($blade_file_path);
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
            
            file_put_contents($blade_file_path, $blade_content);
            
            $routes[] = "Route::get('/{$route_path}', function () { return view('pages.{$blade_name}'); });";
            $routes[] = "Route::get('/{$route_path}/index.html', function () { return view('pages.{$blade_name}'); });";
            $routes[] = "Route::get('/{$route_path}.html', function () { return view('pages.{$blade_name}'); });";
            $processed_count++;
        }
    }
}

echo "Generated {$processed_count} views and routes.\n";

if (count($routes) > 0) {
    $web_mirage = "<?php\nuse Illuminate\Support\Facades\Route;\n\n" . implode("\n", $routes);
    file_put_contents('/Users/joseisaiasbrianojasso/mirage/routes/web_mirage.php', $web_mirage);
    echo "Written to routes/web_mirage.php\n";
}
