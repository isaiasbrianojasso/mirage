<?php
$index = file_get_contents('resources/views/tienda/index.blade.php');

$startStr = '<style class="elementor-frontend-stylesheet">';
$endStr = '</section>


        
    </div>';

$posStart = strpos($index, $startStr);
$posEnd = strpos($index, $endStr, $posStart);

if ($posStart !== false && $posEnd !== false) {
    // Everything before the start string is the Header
    $header = substr($index, 0, $posStart);
    
    // Everything after the start string but before the end string is the home page content
    $content = substr($index, $posStart, $posEnd - $posStart);
    
    // Everything from the end string onwards is the Footer
    $footer = substr($index, $posEnd);
    
    // Modify Header to support dynamic content classes
    $header = str_replace('<section id="content" class="page-home">', '<section id="content" class="@yield(\'content_class\', \'page-home\')">', $header);
    
    // Create the master layout
    $layout = $header . "\n    @yield('content')\n" . $footer;
    
    // Inject AJAX script and beautiful Toast before </body>
    $ajaxScript = '
<!-- Custom Toast Notification -->
<div id="tienda-toast" style="position: fixed; bottom: 30px; right: 30px; background: #2b2b2b; color: #ffffff; padding: 16px 24px; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); transform: translateY(150%); opacity: 0; transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55); z-index: 999999; display: flex; align-items: center; gap: 12px; font-family: inherit; font-size: 14px; border-left: 4px solid #ed1b24;">
    <i class="fa fa-check-circle" style="color: #4CAF50; font-size: 1.5rem;"></i>
    <span id="tienda-toast-msg" style="font-weight: 500;">Mensaje de prueba</span>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    function showToast(msg, isError = false) {
        const toast = document.getElementById("tienda-toast");
        const msgEl = document.getElementById("tienda-toast-msg");
        const icon = toast.querySelector("i");
        
        msgEl.innerText = msg;
        if (isError) {
            toast.style.borderLeftColor = "#d32f2f";
            icon.className = "fa fa-exclamation-circle";
            icon.style.color = "#d32f2f";
        } else {
            toast.style.borderLeftColor = "#4CAF50";
            icon.className = "fa fa-check-circle";
            icon.style.color = "#4CAF50";
        }
        
        toast.style.transform = "translateY(0)";
        toast.style.opacity = "1";
        
        setTimeout(() => {
            toast.style.transform = "translateY(150%)";
            toast.style.opacity = "0";
        }, 3000);
    }

    // Intercept functional button forms (wishlist, compare, cart)
    const functionalForms = document.querySelectorAll(".product-functional-buttons-links form");
    
    functionalForms.forEach(form => {
        form.addEventListener("submit", function(e) {
            e.preventDefault(); // Prevent navigating to raw JSON
            
            const formData = new FormData(this);
            const url = this.getAttribute("action");
            
            fetch(url, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === "success" || data.success) {
                    showToast(data.message || "Agregado correctamente", false);
                } else {
                    showToast("Ocurrió un error.", true);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showToast("Ocurrió un error al procesar la solicitud.", true);
            });
        });
    });
});
</script>
';
    $layout = str_replace('</body>', $ajaxScript . '</body>', $layout);
    
    // Create the new index file
    $newIndex = "@extends('layouts.tienda')\n\n@section('content')\n" . $content . "\n@endsection\n";
    
    if (!is_dir('resources/views/layouts')) {
        mkdir('resources/views/layouts', 0755, true);
    }
    
    file_put_contents('resources/views/layouts/tienda.blade.php', $layout);
    file_put_contents('resources/views/tienda/index.blade.php', $newIndex);
    
    echo "Layout extracted successfully!\n";
} else {
    echo "Failed to find boundaries in index.blade.php\n";
}
