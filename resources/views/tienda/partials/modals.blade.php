<!-- Mirage Interactive Modals Partial -->
<div id="mirage-modal-container" class="mirage-modal-wrapper">
    <div class="mirage-modal-overlay" onclick="closeMirageModal()"></div>

    <!-- 1. AUTH / LOGIN MODAL -->
    <div id="mirage-auth-modal" class="mirage-modal-content" style="max-width: 550px; width: 100%;">
        <button class="mirage-modal-close" onclick="closeMirageModal()">&times;</button>
        <div class="mirage-auth-header">
            <h3>Necesitas iniciar sesión o crear una cuenta</h3>
            <p>Guarda productos en tu lista de deseos para comprarlos más tarde o compartirlos con tus amigos.</p>
        </div>
        <form id="mirage-auth-form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mirage-form-group">
                <label for="modal-email">Correo electrónico</label>
                <input type="email" id="modal-email" name="email" required placeholder="tu@correo.com">
            </div>
            <div class="mirage-form-group password-group">
                <label for="modal-password">Contraseña</label>
                <div class="input-password-wrapper">
                    <input type="password" id="modal-password" name="password" required minlength="5" placeholder="Al menos 5 caracteres">
                    <button type="button" class="btn-toggle-password" onclick="toggleModalPassword()">
                        <i class="fa fa-eye-slash" id="password-toggle-icon"></i>
                    </button>
                </div>
            </div>
            <div class="mirage-auth-actions">
                <a href="{{ route('password.request') }}" class="forgot-pass-link">¿Olvidaste tu contraseña?</a>
            </div>
            <button type="submit" class="btn-mirage-submit">Iniciar sesión</button>
            <div class="mirage-register-prompt">
                <p>¿Aún no tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
            </div>
        </form>
    </div>

    <!-- 2. COMPARE MODAL -->
    <div id="mirage-compare-modal" class="mirage-modal-content" style="max-width: 850px; width: 100%;">
        <button class="mirage-modal-close" onclick="closeMirageModal()">&times;</button>
        <div class="mirage-compare-header">
            <h3>Productos para comparar</h3>
            <a href="#" class="clear-compare-link" onclick="clearAllComparison(event)">
                <i class="fa fa-trash"></i> Quitar todos los productos
            </a>
        </div>
        <div class="mirage-compare-body">
            <div class="mirage-compare-grid" id="mirage-compare-grid-content">
                <!-- Dynamic content here -->
            </div>
        </div>
    </div>

    <!-- 3. QUICK VIEW MODAL -->
    <div id="mirage-quickview-modal" class="mirage-modal-content" style="max-width: 950px; width: 100%;">
        <button class="mirage-modal-close" onclick="closeMirageModal()">&times;</button>
        <div class="mirage-quickview-body" id="mirage-quickview-body">
            <!-- Dynamic content here -->
        </div>
    </div>
</div>

<style>
/* --- BASE MODAL STYLES --- */
.mirage-modal-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}
.mirage-modal-wrapper.active {
    opacity: 1;
    visibility: visible;
}
.mirage-modal-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 23, 42, 0.4);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}
.mirage-modal-content {
    position: relative;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    padding: 30px;
    max-height: 90vh;
    overflow-y: auto;
    transform: scale(0.95);
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 10;
    display: none;
    font-family: 'Montserrat', sans-serif;
}
.mirage-modal-wrapper.active .mirage-modal-content.active {
    transform: scale(1);
    display: block;
}
.mirage-modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: #f1f5f9;
    border: none;
    font-size: 22px;
    line-height: 1;
    color: #64748b;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}
.mirage-modal-close:hover {
    background: #e2e8f0;
    color: #0f172a;
}

/* --- AUTH MODAL DESIGN --- */
.mirage-auth-header {
    text-align: center;
    margin-bottom: 25px;
}
.mirage-auth-header h3 {
    font-size: 22px;
    font-weight: 600;
    color: #333333;
    margin-bottom: 12px;
}
.mirage-auth-header p {
    font-size: 14px;
    color: #666666;
    line-height: 1.5;
}
.mirage-form-group {
    margin-bottom: 20px;
}
.mirage-form-group label {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: #333333;
    margin-bottom: 6px;
}
.mirage-form-group input {
    width: 100%;
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 12px;
    font-size: 14px;
    color: #333333;
    outline: none;
    transition: border-color 0.2s;
}
.mirage-form-group input:focus {
    border-color: #ef4444;
}
.input-password-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}
.btn-toggle-password {
    position: absolute;
    right: 0;
    top: 0;
    height: 100%;
    background: #ef4444;
    border: none;
    color: #ffffff;
    padding: 0 16px;
    border-top-right-radius: 6px;
    border-bottom-right-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}
.mirage-auth-actions {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
}
.forgot-pass-link {
    font-size: 13px;
    color: #ef4444;
    text-decoration: none;
}
.forgot-pass-link:hover {
    text-decoration: underline;
}
.btn-mirage-submit {
    width: 100%;
    background: #ef4444;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 14px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
}
.btn-mirage-submit:hover {
    background: #dc2626;
}
.mirage-register-prompt {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #666666;
}
.mirage-register-prompt a {
    color: #ef4444;
    text-decoration: none;
    font-weight: 500;
}
.mirage-register-prompt a:hover {
    text-decoration: underline;
}

/* --- COMPARE MODAL DESIGN --- */
.mirage-compare-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e2e8f0;
    padding-bottom: 15px;
    margin-bottom: 25px;
}
.mirage-compare-header h3 {
    font-size: 20px;
    font-weight: 600;
    color: #0f172a;
    margin: 0;
}
.clear-compare-link {
    color: #64748b;
    text-decoration: none;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s;
}
.clear-compare-link:hover {
    color: #ef4444;
}
.mirage-compare-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}
.mirage-compare-column {
    position: relative;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 20px;
    background: #ffffff;
}
.btn-remove-compare-item {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    color: #94a3b8;
    cursor: pointer;
    font-size: 16px;
    transition: color 0.2s;
}
.btn-remove-compare-item:hover {
    color: #ef4444;
}
.mirage-compare-img {
    height: 160px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
}
.mirage-compare-img img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}
.mirage-compare-title {
    font-size: 15px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 10px;
    height: 44px;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.mirage-compare-price {
    margin-bottom: 15px;
}
.mirage-compare-price .offer {
    font-size: 18px;
    font-weight: 700;
    color: #ef4444;
    margin-right: 8px;
}
.mirage-compare-price .regular {
    font-size: 14px;
    text-decoration: line-through;
    color: #94a3b8;
}
.btn-compare-add-cart {
    width: 100%;
    background: #94a3b8;
    color: #ffffff;
    border: none;
    border-radius: 4px;
    padding: 10px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background-color 0.2s;
    margin-bottom: 20px;
}
.btn-compare-add-cart:hover {
    background: #64748b;
}
.mirage-compare-specs-table {
    width: 100%;
    border-collapse: collapse;
}
.mirage-compare-specs-table tr {
    border-bottom: 1px solid #f1f5f9;
}
.mirage-compare-specs-table td {
    padding: 10px 0;
    font-size: 14px;
}
.mirage-compare-specs-table td.label {
    color: #64748b;
    font-weight: 500;
    width: 40%;
}
.mirage-compare-specs-table td.value {
    color: #0f172a;
    font-weight: 600;
    text-align: right;
}

/* --- QUICK VIEW MODAL DESIGN --- */
.mirage-qv-grid {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 40px;
}
@media (max-width: 768px) {
    .mirage-qv-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }
}
.mirage-qv-main-img-container {
    height: 350px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid #f1f5f9;
    border-radius: 8px;
    padding: 15px;
    background: #ffffff;
    margin-bottom: 15px;
}
.mirage-qv-main-img-container img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}
.mirage-qv-gallery {
    display: flex;
    gap: 10px;
    margin-bottom: 25px;
    overflow-x: auto;
    padding-bottom: 5px;
}
.qv-thumb-btn {
    width: 65px;
    height: 65px;
    border: 2px solid #e2e8f0;
    border-radius: 6px;
    background: #ffffff;
    cursor: pointer;
    padding: 4px;
    flex-shrink: 0;
    transition: border-color 0.2s;
}
.qv-thumb-btn.active {
    border-color: #ef4444;
}
.mirage-qv-video-section {
    border-top: 1px solid #f1f5f9;
    padding-top: 20px;
}
.mirage-qv-section-title {
    font-size: 15px;
    font-weight: 600;
    color: #334155;
    margin-bottom: 10px;
}
.mirage-qv-video-wrapper {
    position: relative;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: 8px;
    background: #000000;
}
.mirage-qv-video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
.mirage-qv-title {
    font-size: 24px;
    font-weight: 600;
    color: #0f172a;
    margin-top: 0;
    margin-bottom: 15px;
}
.mirage-qv-price-block {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 10px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 15px;
}
.discount-badge {
    background: #eff6ff;
    color: #1d4ed8;
    font-size: 13px;
    font-weight: 600;
    padding: 3px 8px;
    border-radius: 4px;
    border: 1px solid #bfdbfe;
    align-self: center;
}
.mirage-qv-tax-label {
    width: 100%;
    font-size: 12px;
    color: #94a3b8;
    margin-top: 4px;
}
.mirage-qv-specs {
    margin-bottom: 20px;
}
.mirage-qv-specs ul {
    list-style: none;
    padding: 0;
    margin: 0;
}
.mirage-qv-specs li {
    font-size: 14px;
    color: #475569;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}
.mirage-qv-desc {
    font-size: 14px;
    line-height: 1.6;
    color: #64748b;
    margin-bottom: 25px;
}
.mirage-qv-add-form {
    display: flex;
    gap: 15px;
    margin-bottom: 25px;
    border-bottom: 1px solid #f1f5f9;
    padding-bottom: 25px;
}
.mirage-qv-qty-selector {
    display: flex;
    align-items: center;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    overflow: hidden;
}
.mirage-qv-qty-selector button {
    background: #f8fafc;
    border: none;
    width: 40px;
    height: 48px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    color: #64748b;
    transition: background-color 0.2s;
}
.mirage-qv-qty-selector button:hover {
    background: #f1f5f9;
}
.mirage-qv-qty-selector input {
    width: 50px;
    height: 48px;
    border: none;
    border-left: 1px solid #e2e8f0;
    border-right: 1px solid #e2e8f0;
    text-align: center;
    font-size: 15px;
    font-weight: 600;
    color: #0f172a;
    outline: none;
}
/* Hide spinner arrows on number input */
.mirage-qv-qty-selector input::-webkit-outer-spin-button,
.mirage-qv-qty-selector input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
.btn-mirage-add-cart {
    flex-grow: 1;
    background: #ef4444;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    height: 48px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background-color 0.2s;
}
.btn-mirage-add-cart:hover {
    background: #dc2626;
}
.mirage-qv-secondary-actions {
    display: flex;
    gap: 15px;
}
.btn-qv-action {
    flex: 1;
    background: #ef4444;
    color: #ffffff;
    border: none;
    border-radius: 6px;
    padding: 12px 10px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: background-color 0.2s;
}
.btn-qv-action:hover {
    background: #dc2626;
}
</style>

<script>
// --- CLIENT STATE ---
let comparisonList = JSON.parse(localStorage.getItem('mirage_compare_list')) || [];

// Check if user is logged in (from PrestaShop's global variable set in the layout)
var isUserLoggedIn = false;
try { isUserLoggedIn = prestashop && prestashop.customer && prestashop.customer.is_logged; } catch(e) {}
@if(auth()->check())
isUserLoggedIn = true;
@endif

// REGISTER CAPTURE PHASE LISTENER — runs BEFORE any legacy PrestaShop handler
document.addEventListener('click', function(e) {

    // 1. WISHLIST — open auth modal immediately if not logged in
    var wishlistBtn = e.target.closest('.js-iqitwishlist-add');
    if (wishlistBtn) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        
        if (!isUserLoggedIn) {
            // Not logged in → show login modal immediately (no AJAX needed)
            openSpecificModal('mirage-auth-modal');
        } else {
            // Logged in → do the AJAX add
            var productId = wishlistBtn.getAttribute('data-id-product');
            if (productId) handleWishlistClick(productId, wishlistBtn);
        }
        return;
    }

    // 2. COMPARE
    var compareBtn = e.target.closest('.js-iqitcompare-add');
    if (compareBtn) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var productId = compareBtn.getAttribute('data-id-product');
        if (!productId) {
            var card = compareBtn.closest('.product-miniature, .product-functional-buttons-links, article');
            if (card) {
                var wb = card.querySelector('[data-id-product]');
                if (wb) productId = wb.getAttribute('data-id-product');
            }
        }
        if (productId) addToCompare(productId);
        return;
    }

    // 3. QUICK VIEW
    var qvBtn = e.target.closest('.js-quick-view-iqit');
    if (qvBtn) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        var productId = qvBtn.getAttribute('data-id-product');
        // Fallback: get ID from any sibling element with data-id-product
        if (!productId) {
            var card = qvBtn.closest('.product-miniature, .product-functional-buttons-links, article');
            if (card) {
                var wb = card.querySelector('[data-id-product]');
                if (wb) productId = wb.getAttribute('data-id-product');
            }
        }
        if (productId) openQuickView(productId);
        return;
    }

}, true); // true = Capturing phase

// --- HELPER FUNCTIONS (pure DOM, no jQuery dependency) ---

function openSpecificModal(modalId) {
    var container = document.getElementById('mirage-modal-container');
    if (!container) return;
    
    // Hide all modal sub-contents first
    var allModals = container.querySelectorAll('.mirage-modal-content');
    for (var i = 0; i < allModals.length; i++) {
        allModals[i].classList.remove('active');
        allModals[i].style.display = 'none';
    }
    
    // Show the target modal content
    var target = document.getElementById(modalId);
    if (target) {
        target.classList.add('active');
        target.style.display = '';
    }
    
    // Show the overlay/wrapper
    container.style.visibility = 'visible';
    container.style.opacity = '1';
    container.style.display = 'flex';
    container.classList.add('active');
}

function closeMirageModal() {
    var container = document.getElementById('mirage-modal-container');
    if (!container) return;
    container.classList.remove('active');
    container.style.visibility = 'hidden';
    container.style.opacity = '0';
    var allModals = container.querySelectorAll('.mirage-modal-content');
    for (var i = 0; i < allModals.length; i++) {
        allModals[i].classList.remove('active');
        allModals[i].style.display = 'none';
    }
}

function toggleModalPassword() {
    const passwordInput = document.getElementById('modal-password');
    const toggleIcon = document.getElementById('password-toggle-icon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    }
}

// --- WISH LIST SCRIPT ---
function handleWishlistClick(productId, btn) {
    $.ajax({
        url: '/tienda/wishlist',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            product_id: productId
        },
        success: function(response) {
            showWishlistNotification();
            if (btn) {
                $(btn).find('.not-added').hide();
                $(btn).find('.added').show();
                // Si es el botón de la página de producto, cambiar su fondo a rojo
                if ($(btn).css('background-color') !== 'transparent' && $(btn).css('background-color') !== 'rgba(0, 0, 0, 0)') {
                    $(btn).css('background-color', '#ef4444');
                }
            }
        },
        error: function(xhr) {
            if (xhr.status === 401 || xhr.status === 419) {
                openSpecificModal('mirage-auth-modal');
            } else {
                console.error('Error adding to wishlist', xhr);
            }
        }
    });
}

function showWishlistNotification() {
    let notif = document.getElementById('iqitwishlist-notification');
    
    // If notif doesn't exist in the layout, create it dynamically
    if (!notif) {
        notif = document.createElement('div');
        notif.id = 'iqitwishlist-notification';
        notif.className = 'ns-box ns-effect-slidetop ns-type-notice';
        notif.innerHTML = '<div class="ns-box-inner"><span class="ns-title"><i class="fa fa-check" aria-hidden="true"></i> <strong>Producto añadido a tu lista de deseos</strong></span></div>';
        document.body.appendChild(notif);
        
        // Add minimal styling if the stylesheet isn't loaded
        notif.style.position = 'fixed';
        notif.style.top = '20px';
        notif.style.right = '20px';
        notif.style.background = '#333';
        notif.style.color = '#fff';
        notif.style.padding = '15px 20px';
        notif.style.borderRadius = '5px';
        notif.style.zIndex = '9999';
        notif.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
        notif.style.transition = 'opacity 0.3s ease-in-out';
        notif.style.opacity = '0';
        notif.style.pointerEvents = 'none';
    }
    
    // Show the notification
    notif.style.opacity = '1';
    notif.classList.add('ns-show');
    
    setTimeout(() => {
        notif.style.opacity = '0';
        notif.classList.remove('ns-show');
    }, 3000);
}

function addToCompare(productId) {
    $.ajax({
        url: '/module/iqitcompare/actions',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            process: 'add',
            idProduct: productId
        },
        success: function(response) {
            if (response.success) {
                // Remove old floating wrapper if exists
                $('#iqitcompare-floating-wrapper').remove();
                // Append new one
                $('body').append(response.floatCompare);
                
                // Show notification
                const notif = $('#iqitcompare-notification');
                if (notif.length) {
                    notif.addClass('ns-show');
                    setTimeout(() => {
                        notif.removeClass('ns-show');
                    }, 3000);
                }
            } else {
                alert('No se pudo agregar el producto a la comparación.');
            }
        },
        error: function(xhr) {
            console.error('Error adding to compare', xhr);
        }
    });
}


// --- QUICK VIEW SCRIPTS ---
function openQuickView(productId) {
    $.ajax({
        url: '/tienda/producto/quickview/' + productId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            let thumbsHtml = '';
            data.images.forEach((img, idx) => {
                thumbsHtml += `
                    <button class="qv-thumb-btn ${idx === 0 ? 'active' : ''}" onclick="changeQvImage('${img}', this)">
                        <img src="${img}" style="width: 100%; height: 100%; object-fit: contain;">
                    </button>
                `;
            });

            let priceHtml = '';
            if (data.discount_price) {
                priceHtml += `
                    <span style="font-size: 24px; font-weight: 700; color: #ef4444;">$${data.discount_price}</span>
                    <span style="font-size: 18px; text-decoration: line-through; color: #94a3b8;">$${data.price}</span>
                    <span class="discount-badge">-${data.discount_percentage}%</span>
                `;
            } else {
                priceHtml += `
                    <span style="font-size: 24px; font-weight: 700; color: #0f172a;">$${data.price}</span>
                `;
            }

            let specsHtml = '';
            data.specifications.forEach(spec => {
                specsHtml += `<li><i class="fa fa-check-circle" style="color: #ef4444;"></i> ${spec}</li>`;
            });

            let html = `
                <div class="mirage-qv-grid">
                    <!-- Left Column -->
                    <div class="mirage-qv-left">
                        <div class="mirage-qv-main-img-container">
                            <img id="qv-main-img" src="${data.images[0]}">
                        </div>
                        <div class="mirage-qv-gallery">
                            ${thumbsHtml}
                        </div>
                        ${data.video_id ? `
                        <div class="mirage-qv-video-section">
                            <h4 class="mirage-qv-section-title">Product Video</h4>
                            <div class="mirage-qv-video-wrapper">
                                <iframe src="https://www.youtube.com/embed/${data.video_id}" allowfullscreen></iframe>
                            </div>
                        </div>
                        ` : ''}
                    </div>
                    
                    <!-- Right Column -->
                    <div class="mirage-qv-right">
                        <h2 class="mirage-qv-title">${data.name}</h2>
                        <div class="mirage-qv-price-block">
                            ${priceHtml}
                            <div class="mirage-qv-tax-label">IVA incluido</div>
                        </div>
                        
                        <div class="mirage-qv-specs">
                            <ul>
                                ${specsHtml}
                            </ul>
                        </div>
                        
                        <p class="mirage-qv-desc">${data.description}</p>
                        
                        <form action="${data.add_to_cart_url}" method="POST" class="mirage-qv-add-form">
                            <input type="hidden" name="_token" value="${data.csrf_token}">
                            <input type="hidden" name="product_id" value="${data.id}">
                            
                            <div class="mirage-qv-qty-selector">
                                <button type="button" onclick="adjustQvQty(-1)">-</button>
                                <input type="number" name="quantity" id="qv-qty-input" value="1" min="1" max="${data.stock}">
                                <button type="button" onclick="adjustQvQty(1)">+</button>
                            </div>
                            
                            <button type="submit" class="btn-mirage-add-cart">
                                <i class="fa fa-shopping-bag"></i> Añadir al carrito
                            </button>
                        </form>
                        
                        <div class="mirage-qv-secondary-actions">
                            <button type="button" class="btn-qv-action" onclick="wishlistFromQv('${data.id}')" title="Añadir a deseos">
                                <i class="fa fa-heart-o"></i>
                            </button>
                            <button type="button" class="btn-qv-action" onclick="compareFromQv('${data.id}')" title="Comparar">
                                <i class="fa fa-random"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;

            $('#mirage-quickview-body').html(html);
            openSpecificModal('mirage-quickview-modal');
        },
        error: function(err) {
            console.error('Error loading quickview details', err);
            alert('No se pudo cargar la vista rápida del producto.');
        }
    });
}

function changeQvImage(imgSrc, element) {
    $('#qv-main-img').attr('src', imgSrc);
    $('.qv-thumb-btn').removeClass('active');
    $(element).addClass('active');
}

function adjustQvQty(change) {
    const input = $('#qv-qty-input');
    let val = parseInt(input.val()) || 1;
    val += change;
    const min = parseInt(input.attr('min')) || 1;
    const max = parseInt(input.attr('max')) || 99;
    if (val < min) val = min;
    if (val > max) val = max;
    input.val(val);
}

function wishlistFromQv(productId) {
    closeMirageModal();
    handleWishlistClick(productId, null);
}

// Ensure clean direct execution for compare modal trigger
function compareFromQv(productId) {
    closeMirageModal();
    addToCompare(productId);
}
</script>
