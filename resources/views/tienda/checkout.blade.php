@extends('layouts.legacy')

@section('title', 'Finalizar Compra | Tienda Mirage')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto pt-16 pb-24 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto lg:max-w-none">
            <h1 class="sr-only">Checkout</h1>

            <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST" class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
                @csrf
                <input type="hidden" name="transaction_id" id="transaction_id" value="">

                <!-- Lado Izquierdo: Formulario -->
                <div>
                    <!-- Contenedor para errores JS del Frontend (PayPal / Envío) -->
                    <div id="frontend-error-banner" class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md hidden">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">No se puede procesar el pago</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul id="frontend-error-list" class="list-disc pl-5 space-y-1">
                                        <!-- JS inyectará errores aquí -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mostrar errores de validación Backend -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Hubo un problema con tu envío</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md text-red-700 text-sm font-medium">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div>
                        <h2 class="text-lg font-medium text-gray-900">Información de Contacto</h2>
                        <div class="mt-4">
                            <label for="customer_email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                            <div class="mt-1">
                                <input type="email" id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h2 class="text-lg font-medium text-gray-900">Datos de Envío</h2>
                        <div class="mt-4 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-4">
                            
                            <div class="sm:col-span-2">
                                <label for="customer_name" class="block text-sm font-medium text-gray-700">Nombre completo</label>
                                <div class="mt-1">
                                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="customer_phone" class="block text-sm font-medium text-gray-700">Teléfono (Celular)</label>
                                <div class="mt-1">
                                    <input type="text" id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700">Dirección completa (Calle, número exterior/interior, colonia)</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div>
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700">Ciudad / Municipio</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_city" name="shipping_city" value="{{ old('shipping_city') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div>
                                <label for="shipping_state" class="block text-sm font-medium text-gray-700">Estado</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_state" name="shipping_state" value="{{ old('shipping_state') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                            <div>
                                <label for="shipping_zip" class="block text-sm font-medium text-gray-700">Código Postal</label>
                                <div class="mt-1">
                                    <input type="text" id="shipping_zip" name="shipping_zip" value="{{ old('shipping_zip') }}" required class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-10 border-t border-gray-200 pt-10">
                        <h2 class="text-lg font-medium text-gray-900">Método de Pago</h2>
                        <div class="mt-4 space-y-4">
                            <!-- Efectivo -->
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <div class="flex items-center">
                                    <input id="payment_cash" name="payment_method" type="radio" value="cash" required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="payment_cash" class="ml-3 block text-sm font-medium text-gray-900">
                                        Pago en Efectivo (Contra Entrega)
                                    </label>
                                </div>
                                <div id="desc_payment_cash" class="mt-3 text-sm text-gray-500 hidden pl-7">
                                    Pagarás el total de tu pedido al momento de recibirlo. Este método no tiene comisiones adicionales.
                                </div>
                            </div>
                            
                            <!-- PayPal -->
                            <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                                <div class="flex items-center">
                                    <input id="payment_paypal" name="payment_method" type="radio" value="paypal" required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                    <label for="payment_paypal" class="ml-3 block text-sm font-medium text-gray-900 flex items-center gap-2">
                                        Pagar con PayPal <img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" alt="PayPal" class="h-5">
                                    </label>
                                </div>
                                <div id="desc_payment_paypal" class="mt-3 text-sm text-gray-500 hidden pl-7">
                                    Serás redirigido a la plataforma segura de PayPal para completar tu pago con tarjeta de crédito o débito.
                                </div>
                            </div>
                        </div>

                        <h2 class="text-lg font-medium text-gray-900 mt-10">Método de Envío</h2>
                        <div class="mt-4 space-y-4">
                            <div class="flex items-center">
                                <input id="shipping_local" name="shipping_method" type="radio" value="local_pickup" checked class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="shipping_local" class="ml-3 block text-sm font-medium text-gray-700">
                                    Recoger en Sucursal (Gratis)
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="shipping_delivery" name="shipping_method" type="radio" value="home_delivery" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="shipping_delivery" class="ml-3 block text-sm font-medium text-gray-700">
                                    Envío a Domicilio (Por Acordar)
                                </label>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notas del pedido (Opcional)</label>
                            <div class="mt-1">
                                <textarea id="notes" name="notes" rows="3" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm p-3 border"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lado Derecho: Resumen del Pedido -->
                <div class="mt-10 lg:mt-0">
                    <h2 class="text-lg font-medium text-gray-900">Resumen de tu compra</h2>

                    <div class="mt-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <h3 class="sr-only">Artículos en tu carrito</h3>
                        <ul role="list" class="divide-y divide-gray-200">
                            @php $subtotal = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php $subtotal += $item['price'] * $item['quantity']; @endphp
                                <li class="flex py-6 px-4 sm:px-6">
                                    <div class="flex-shrink-0">
                                        @if($item['image_url'])
                                            @php
                                                $checkoutImgUrl = \Illuminate\Support\Str::startsWith($item['image_url'], 'http') ? $item['image_url'] : Storage::url($item['image_url']);
                                            @endphp
                                            <img src="{{ $checkoutImgUrl }}" alt="{{ $item['name'] }}" class="w-20 h-20 rounded-md object-center object-cover">
                                        @else
                                            <div class="w-20 h-20 rounded-md bg-gray-200"></div>
                                        @endif
                                    </div>
                                    <div class="ml-6 flex-1 flex flex-col">
                                        <div class="flex">
                                            <div class="min-w-0 flex-1">
                                                <h4 class="text-sm font-medium text-gray-900">
                                                    {{ $item['name'] }}
                                                </h4>
                                                <p class="mt-1 text-sm text-gray-500">Cantidad: {{ $item['quantity'] }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex-1 flex items-end justify-between">
                                            <p class="text-sm font-medium text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        
                        <dl class="border-t border-gray-200 py-6 px-4 space-y-6 sm:px-6">
                            <div class="flex items-center justify-between">
                                <dt class="text-sm text-gray-600">Subtotal</dt>
                                <dd class="text-sm font-medium text-gray-900">${{ number_format($subtotal, 2) }}</dd>
                            </div>
                            <div class="flex items-center justify-between">
                                <dt class="text-sm text-gray-600">Envío</dt>
                                <dd class="text-sm font-medium text-gray-900">Por acordar</dd>
                            </div>
                            <div class="flex items-center justify-between border-t border-gray-200 pt-6">
                                <dt class="text-base font-medium text-gray-900">Total a Pagar</dt>
                                <dd class="text-base font-medium text-gray-900">${{ number_format($subtotal, 2) }}</dd>
                            </div>
                        </dl>

                        <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                            
                            <!-- Términos y Condiciones (PrestaShop Style) -->
                            <div class="flex items-start mb-6 bg-gray-50 p-4 rounded-md border border-gray-200">
                                <div class="flex items-center h-5">
                                    <input id="terms_conditions" name="terms_conditions" type="checkbox" required class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="terms_conditions" class="font-medium text-gray-900">Estoy de acuerdo con los términos de servicio y los acepto incondicionalmente.</label>
                                </div>
                            </div>
                            
                            <!-- Botón Estándar (Efectivo) -->
                            <button type="submit" id="submit-button" disabled class="w-full bg-indigo-600 border border-transparent rounded-md shadow-sm py-3 px-4 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed transition">
                                Pedido con obligación de pago
                            </button>
                            
                            <!-- Overlay para bloquear PayPal si no aceptan términos -->
                            <div id="paypal-wrapper" class="relative mt-4" style="display: none;">
                                <div id="paypal-overlay" class="absolute inset-0 z-10 bg-white/60 cursor-not-allowed" title="Debes aceptar los términos de servicio primero."></div>
                                <div id="paypal-button-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>

@php
    $paypalClientId = \App\Models\CompanySetting::get('paypal_client_id');
    if (empty($paypalClientId)) {
        $paypalClientId = 'test';
    }
@endphp
<script src="https://www.paypal.com/sdk/js?client-id={{ trim($paypalClientId) }}&currency=MXN"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentCash = document.getElementById('payment_cash');
        const paymentPaypal = document.getElementById('payment_paypal');
        const submitButton = document.getElementById('submit-button');
        const paypalWrapper = document.getElementById('paypal-wrapper');
        const paypalOverlay = document.getElementById('paypal-overlay');
        const termsCheckbox = document.getElementById('terms_conditions');
        
        const descCash = document.getElementById('desc_payment_cash');
        const descPaypal = document.getElementById('desc_payment_paypal');

        const frontendErrorBanner = document.getElementById('frontend-error-banner');
        const frontendErrorList = document.getElementById('frontend-error-list');

        function showErrorBanner(messages) {
            frontendErrorList.innerHTML = '';
            messages.forEach(msg => {
                const li = document.createElement('li');
                li.innerText = msg;
                frontendErrorList.appendChild(li);
            });
            frontendErrorBanner.classList.remove('hidden');
            // Hacer scroll hacia el error
            frontendErrorBanner.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function hideErrorBanner() {
            frontendErrorBanner.classList.add('hidden');
            frontendErrorList.innerHTML = '';
        }

        function updateUI() {
            // 1. Mostrar/ocultar descripciones de métodos
            if (paymentCash.checked) {
                descCash.classList.remove('hidden');
                descPaypal.classList.add('hidden');
                
                submitButton.style.display = 'block';
                paypalWrapper.style.display = 'none';
            } else if (paymentPaypal.checked) {
                descPaypal.classList.remove('hidden');
                descCash.classList.add('hidden');
                
                submitButton.style.display = 'none';
                paypalWrapper.style.display = 'block';
            }

            // 2. Controlar estado habilitado/deshabilitado de los botones finales según los términos
            const termsAccepted = termsCheckbox.checked;
            
            // Botón nativo (Efectivo)
            submitButton.disabled = !termsAccepted;
            
            // Botón PayPal (Usamos un overlay transparente para bloquear clics si no aceptan términos)
            if (termsAccepted) {
                paypalOverlay.style.display = 'none';
            } else {
                paypalOverlay.style.display = 'block';
            }
        }

        paymentCash.addEventListener('change', updateUI);
        paymentPaypal.addEventListener('change', updateUI);
        termsCheckbox.addEventListener('change', updateUI);

        // Run once on load
        updateUI();
        
        if (typeof paypal !== 'undefined') {
            paypal.Buttons({
                onClick: function(data, actions) {
                    const form = document.getElementById('checkout-form');
                    hideErrorBanner();
                    let errors = [];
                    
                    // Valida que los términos estén aceptados
                    if (!termsCheckbox.checked) {
                        errors.push("Debes aceptar los Términos de Servicio antes de continuar.");
                    }

                    // Valida HTML5 native form requirements
                    if (!form.checkValidity()) {
                        // Recolectar nombres de los campos que fallaron
                        const inputs = form.querySelectorAll('input[required]');
                        inputs.forEach(input => {
                            if (!input.validity.valid) {
                                // Buscar el label asociado o usar un nombre genérico
                                const label = form.querySelector(`label[for="${input.id}"]`);
                                const fieldName = label ? label.innerText : input.name;
                                errors.push(`El campo "${fieldName}" es obligatorio y debe ser válido.`);
                            }
                        });
                    }

                    if (errors.length > 0) {
                        showErrorBanner(errors);
                        return actions.reject(); // Evita que se abra PayPal
                    }
                    
                    return actions.resolve();
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: '{{ number_format($subtotal, 2, ".", "") }}'
                            }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    // Mostrar estado de carga para evitar doble envío
                    const container = document.getElementById('paypal-button-container');
                    container.innerHTML = '<div style="text-align: center; padding: 20px;"><i class="fa fa-spinner fa-spin fa-3x fa-fw" style="color: #e62228;"></i><br><p style="margin-top: 15px; font-weight: bold; color: #333;">Procesando pago, por favor no cierres esta ventana...</p></div>';

                    return actions.order.capture().then(function(details) {
                        // Guardar el transaction_id devuelto por PayPal
                        document.getElementById('transaction_id').value = details.id;
                        
                        // Submit form manually
                        const form = document.getElementById('checkout-form');
                        form.submit();
                    }).catch(function(err) {
                        alert("Hubo un error al capturar el pago con PayPal.");
                        window.location.reload();
                    });
                }
            }).render('#paypal-button-container').catch(function(err) {
                console.error('PayPal Buttons rendered error', err);
            });
        } else {
            console.error('El SDK de PayPal no se pudo cargar. Verifica que el Client ID sea correcto.');
            document.getElementById('paypal-button-container').innerHTML = '<div class="p-4 bg-red-50 text-red-600 rounded-lg text-sm border border-red-200"><strong>Error:</strong> No se pudo conectar con PayPal. Si eres el administrador, por favor verifica que el <strong>Client ID</strong> en la Configuración de Empresa sea correcto y no tenga espacios en blanco.</div>';
        }
    });
</script>
@endsection
