<?php
$base_dir = '/Users/joseisaiasbrianojasso/mirage/www.tiendamirage.mx';
$views_dir = '/Users/joseisaiasbrianojasso/mirage/resources/views/tienda';

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
        
        $rel_path = substr($html_file, strlen($base_dir) + 1);
        $route_path = dirname($rel_path);
        
        if ($route_path == '.') {
            $route_path = basename($rel_path, '.html');
        }
        
        if ($route_path === 'index') {
            $route_path = ''; // Root of the store
        }
        
        $html_content = file_get_contents($html_file);
        
        // Clean up index.html from links
        $html_content = str_replace('/index.html', '', $html_content);
        $html_content = str_replace('index.html', '', $html_content);
        
        // Rewrite absolute domain references to our local /tienda prefix
        $html_content = str_replace('https://www.tiendamirage.mx/', '/tienda/', $html_content);
        $html_content = str_replace('https:\/\/www.tiendamirage.mx\/', '\/tienda\/', $html_content);
        
        // Escape JSON-LD @ tags so Blade doesn't treat them as directives (like @context)
        $html_content = str_replace('\"@@', '\"@', $html_content); // Revert previous mistake
        $html_content = str_replace('\"@', '\"@', $html_content); // Revert previous mistake
        
        $html_content = str_replace('"@', '"@@', $html_content);

        
        $blade_name = $route_path === '' ? 'index' : str_replace('/', '.', $route_path);
        $blade_file_path = $views_dir . '/' . ($route_path === '' ? 'index' : $route_path) . '.blade.php';
        
        $dir = dirname($blade_file_path);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        
        file_put_contents($blade_file_path, $html_content);
        
        $route_uri = $route_path === '' ? '/tienda' : "/tienda/{$route_path}";
        
        $routes[] = "Route::get('{$route_uri}', function () { return view('tienda.{$blade_name}'); });";
        $routes[] = "Route::get('{$route_uri}/index.html', function () { return view('tienda.{$blade_name}'); });";
        $routes[] = "Route::get('{$route_uri}.html', function () { return view('tienda.{$blade_name}'); });";
        $processed_count++;
    }
}

echo "Generated {$processed_count} views and routes for Tienda.\n";

if (count($routes) > 0) {
    $web_tienda = "<?php\nuse Illuminate\Support\Facades\Route;\n\n" . implode("\n", $routes);
    file_put_contents('/Users/joseisaiasbrianojasso/mirage/routes/web_tienda.php', $web_tienda);
    echo "Written to routes/web_tienda.php\n";
}
