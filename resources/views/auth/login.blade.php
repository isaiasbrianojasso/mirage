@extends('layouts.tienda')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="mb-4 pb-3">
                <h1 style="font-size: 28px; font-weight: 300; color: #222; margin-bottom: 0;">Inicio de sesión</h1>
            </div>

            <div class="card" style="border: 1px solid #eee; border-radius: 0; box-shadow: none;">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('login') }}" method="POST" class="mirage-login-form">
                        @csrf

                        <!-- Correo electrónico -->
                        <div class="form-group row mb-4 align-items-center">
                            <label for="email" class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Correo electrónico</label>
                            <div class="col-md-7">
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus style="background-color: #f6f6f6; border: 1px solid #f6f6f6; border-radius: 0; box-shadow: none; height: 40px;">
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group row mb-4 align-items-center">
                            <label for="password" class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Contraseña</label>
                            <div class="col-md-7">
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control" required style="background-color: #f6f6f6; border: 1px solid #f6f6f6; border-radius: 0; box-shadow: none; height: 40px;">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-danger" onclick="toggleLoginPassword()" style="border-radius: 0; padding: 0 15px; background-color: #ef4444; border-color: #ef4444;">
                                            <i class="fa fa-eye-slash" id="login-password-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Recordarme & ¿Olvidaste tu contraseña? -->
                        <div class="form-group row mb-4 align-items-center">
                            <div class="col-12 col-md-7 offset-md-3 d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember" style="color: #555; font-size: 13px;">
                                        Recordarme
                                    </label>
                                </div>
                                <a href="{{ route('password.request') }}" style="color: #999; font-size: 13px;">¿Olvidaste tu contraseña?</a>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row mb-5">
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-danger" style="border-radius: 0; padding: 8px 30px; text-transform: none; font-size: 14px; font-weight: normal; background-color: #ef4444; border-color: #ef4444; width: 100%; max-width: 250px;">
                                    Iniciar sesión
                                </button>
                                
                                <!-- Passkeys Login -->
                                <button type="button" id="btn-passkey" class="btn btn-light mt-3" style="border-radius: 0; padding: 8px 30px; text-transform: none; font-size: 14px; font-weight: normal; width: 100%; max-width: 250px; border: 1px solid #ddd; color: #555;">
                                    <i class="fa fa-fingerprint mr-2"></i> Usar Passkey (Huella/Cara)
                                </button>
                            </div>
                        </div>

                        <!-- Redes Sociales -->
                        @php
                            $googleEnabled = \App\Models\CompanySetting::get('google_login_enabled', '0') === '1';
                            $facebookEnabled = \App\Models\CompanySetting::get('facebook_login_enabled', '0') === '1';
                            $trustloginEnabled = \App\Models\CompanySetting::get('trustlogin_enabled', '0') === '1';
                        @endphp
                        @if($googleEnabled || $facebookEnabled || $trustloginEnabled)
                        <div class="form-group row mb-4">
                            <div class="col-12 text-center">
                                <p style="color: #555; font-size: 13px; margin-bottom: 15px;">Iniciar sesión a través de otros proveedores</p>
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    @if($facebookEnabled)
                                    <a href="{{ route('social.login', 'facebook') }}" class="btn btn-primary d-flex align-items-center justify-content-center" style="background-color: #3b5998; border-color: #3b5998; border-radius: 3px; font-size: 13px; padding: 8px 15px; margin: 4px;">
                                        <i class="fa fa-facebook-f mr-2"></i> Login with Facebook
                                    </a>
                                    @endif
                                    @if($googleEnabled)
                                    <a href="{{ route('social.login', 'google') }}" class="btn btn-light d-flex align-items-center justify-content-center" style="background-color: #fff; border: 1px solid #ddd; color: #555; border-radius: 3px; font-size: 13px; padding: 8px 15px; margin: 4px;">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" alt="Google" style="width: 16px; height: 16px; margin-right: 8px;"> Sign in with Google
                                    </a>
                                    @endif
                                    @if($trustloginEnabled)
                                    <a href="{{ route('social.login', 'trustlogin') }}" class="btn btn-dark d-flex align-items-center justify-content-center" style="background-color: #333; border-color: #333; color: white; border-radius: 3px; font-size: 13px; padding: 8px 15px; margin: 4px;">
                                        <i class="fa fa-shield mr-2"></i> Trust Login SSO
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <hr style="border-top: 1px solid #eee; margin: 30px 0;">

                        <!-- Link to Register -->
                        <div class="form-group row mb-0">
                            <div class="col-12 text-center">
                                <a href="{{ route('register') }}" style="color: #777; font-size: 14px; text-decoration: none;">¿No tienes una cuenta? Crea una aquí &gt;</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">
    import { get } from 'https://unpkg.com/@github/webauthn-json@2.1.1/dist/esm/webauthn-json.js';

    document.getElementById('btn-passkey').addEventListener('click', async () => {
        try {
            const email = document.getElementById('email')?.value?.trim();

            if (!email) {
                alert('Escribe tu correo electrónico para usar tu passkey.');
                document.getElementById('email')?.focus();
                return;
            }

            // 1. Get options
            const optionsUrl = new URL('{{ route('passkey.login-options.email') }}', window.location.origin);
            optionsUrl.searchParams.set('email', email);

            const response = await fetch(optionsUrl, {
                headers: {
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                const errorData = await response.json();
                alert(errorData.message || 'No encontramos una passkey activa para este correo.');
                return;
            }

            const { options } = await response.json();

            // 2. Authenticate locally
            const credential = await get({
                publicKey: options
            });

            // 3. Verify on server
            const verifyResponse = await fetch('{{ route('passkey.login') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    credential,
                    remember: document.getElementById('remember')?.checked || false
                })
            });

            if (verifyResponse.ok) {
                const data = await verifyResponse.json();
                window.location.href = data.redirect || '{{ route('dashboard') }}';
            } else {
                const errorData = await verifyResponse.json();
                alert('Fallo al iniciar sesión: ' + (errorData.message || 'Credencial inválida.'));
            }
        } catch (error) {
            console.error(error);
            alert('Cancelado o error en el proceso biométrico.');
        }
    });
</script>
<script>
    function toggleLoginPassword() {
        var pwdInput = document.getElementById('password');
        var pwdIcon = document.getElementById('login-password-icon');
        
        if (pwdInput.type === 'password') {
            pwdInput.type = 'text';
            pwdIcon.classList.remove('fa-eye-slash');
            pwdIcon.classList.add('fa-eye');
        } else {
            pwdInput.type = 'password';
            pwdIcon.classList.remove('fa-eye');
            pwdIcon.classList.add('fa-eye-slash');
        }
    }
</script>
@endsection
