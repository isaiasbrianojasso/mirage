<?php
$views_dir = '/Users/joseisaiasbrianojasso/mirage/resources/views/tienda';

$di = new RecursiveDirectoryIterator($views_dir);
$it = new RecursiveIteratorIterator($di);

$new_desktop_search = '
<!-- Block search module TOP -->
<div id="search_widget" class="search-widget autocomplete-wrapper" data-search-controller-url="">
    <form method="get" action="/tienda/buscar">
        <div class="input-group">
            <input type="text" name="q" id="search-input" value="" placeholder="Buscar productos..." autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="form-control form-search-control" />
            <button type="submit" class="search-btn">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
    
    <!-- Dropdown de Resultados -->
    <div id="search-results" class="autocomplete-dropdown hidden">
        <div id="search-results-list" class="autocomplete-list">
            <!-- Resultados inyectados por JS -->
        </div>
        <div id="search-loading" class="autocomplete-loading hidden">
            Buscando...
        </div>
    </div>
</div>
<style>
.autocomplete-wrapper { position: relative; }
.autocomplete-dropdown { 
    position: absolute; 
    top: 100%; 
    left: 0; 
    width: 100%; 
    background: #fff; 
    border: 1px solid #eee; 
    border-radius: 4px; 
    box-shadow: 0 10px 25px rgba(0,0,0,0.1); 
    z-index: 9999; 
    margin-top: 5px;
    overflow: hidden;
}
.autocomplete-dropdown.hidden { display: none !important; }
.autocomplete-list { max-height: 400px; overflow-y: auto; }
.autocomplete-item { display: flex; align-items: center; padding: 10px; border-bottom: 1px solid #f5f5f5; text-decoration: none; transition: background 0.2s; }
.autocomplete-item:hover { background: #f9f9f9; text-decoration: none; }
.autocomplete-img-container { width: 50px; height: 50px; flex-shrink: 0; background: #f5f5f5; border-radius: 4px; overflow: hidden; display: flex; align-items: center; justify-content: center; }
.autocomplete-img-container img { width: 100%; height: 100%; object-fit: cover; }
.autocomplete-details { margin-left: 15px; flex-grow: 1; }
.autocomplete-title { font-size: 14px; font-weight: 500; color: #333; margin-bottom: 3px; display: block; }
.autocomplete-price { font-size: 14px; font-weight: bold; color: #e62228; display: block; }
.autocomplete-loading { padding: 15px; text-align: center; color: #777; font-size: 13px; }
.autocomplete-empty { padding: 15px; text-align: center; color: #777; font-size: 13px; }
</style>
<!-- /Block search module TOP -->
';

$js_script = '
<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("search-input");
    const searchResults = document.getElementById("search-results");
    const searchResultsList = document.getElementById("search-results-list");
    const searchLoading = document.getElementById("search-loading");
    let timeoutId;

    if (!searchInput) return;

    searchInput.addEventListener("input", function(e) {
        const query = e.target.value.trim();
        
        clearTimeout(timeoutId);

        if (query.length < 2) {
            searchResults.classList.add("hidden");
            return;
        }

        searchResults.classList.remove("hidden");
        searchResultsList.innerHTML = "";
        searchLoading.classList.remove("hidden");

        timeoutId = setTimeout(() => {
            fetch(`/buscar/autocomplete?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchLoading.classList.add("hidden");
                    searchResultsList.innerHTML = "";
                    
                    if (data.length === 0) {
                        searchResultsList.innerHTML = \'<div class="autocomplete-empty">No se encontraron productos.</div>\';
                        return;
                    }

                    data.forEach(product => {
                        const html = `
                            <a href="${product.url}" class="autocomplete-item">
                                <div class="autocomplete-img-container">
                                    ${product.image ? `<img src="${product.image}">` : `<span style="color:#ccc; font-size:10px;">Sin img</span>`}
                                </div>
                                <div class="autocomplete-details">
                                    <span class="autocomplete-title">${product.name}</span>
                                    <span class="autocomplete-price">${product.price}</span>
                                </div>
                            </a>
                        `;
                        searchResultsList.insertAdjacentHTML("beforeend", html);
                    });
                })
                .catch(error => {
                    searchLoading.classList.add("hidden");
                    console.error("Error fetching search results:", error);
                });
        }, 300);
    });

    document.addEventListener("click", function(e) {
        const container = document.getElementById("search_widget");
        if (container && !container.contains(e.target)) {
            searchResults.classList.add("hidden");
        }
    });
});
</script>
</body>
';

$count = 0;
foreach ($it as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) == 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);

        // Replace desktop search
        // We will use regex to find the block search module
        $pattern = '/<!-- Block search module TOP -->.*?<!-- \/Block search module TOP -->/s';
        
        $new_content = preg_replace($pattern, $new_desktop_search, $content);
        
        // Add script before </body>
        if (strpos($new_content, 'const searchInput = document.getElementById("search-input");') === false) {
            $new_content = str_replace('</body>', $js_script, $new_content);
        }

        if ($new_content !== $content) {
            file_put_contents($path, $new_content);
            $count++;
        }
    }
}

echo "Replaced search in {$count} files.\n";
