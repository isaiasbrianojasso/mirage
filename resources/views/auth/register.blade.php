@extends('layouts.tienda')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="mb-4 pb-3" style="border-bottom: 1px solid #eee;">
                <h1 style="font-size: 28px; font-weight: 300; color: #222; margin-bottom: 0;">Crear una Cuenta</h1>
            </div>

            <p class="mb-4" style="font-size: 14px; color: #777;">
                <i class="fa fa-question-circle" style="color: #999;"></i> ¿Ya tiene una cuenta? <a href="{{ route('login') }}" style="color: #222; text-decoration: underline;">¡Inicie sesión!</a>
            </p>

            <form action="{{ route('register') }}" method="POST" class="mirage-register-form">
                @csrf

                <!-- Tratamiento -->
                <div class="form-group row mb-4 align-items-center">
                    <label class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Tratamiento</label>
                    <div class="col-md-9">
                        <div class="custom-control custom-radio custom-control-inline mr-4">
                            <input type="radio" id="social_title_mr" name="social_title" class="custom-control-input" value="Sr." {{ old('social_title') == 'Sr.' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="social_title_mr" style="font-size: 14px; color: #555;">Sr.</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="social_title_mrs" name="social_title" class="custom-control-input" value="Sra." {{ old('social_title') == 'Sra.' ? 'checked' : '' }}>
                            <label class="custom-control-label" for="social_title_mrs" style="font-size: 14px; color: #555;">Sra.</label>
                        </div>
                        @error('social_title') <span class="text-danger small d-block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Nombre -->
                <div class="form-group row mb-4">
                    <label for="first_name" class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Nombre</label>
                    <div class="col-md-9">
                        <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name') }}" required style="background-color: #f6f6f6; border: 1px solid #f6f6f6; border-radius: 0; box-shadow: none;">
                        <small class="form-text mt-2" style="color: #999; font-size: 11px;">Solo se permiten caracteres alfabéticos (letras) y el punto (.), seguidos de un espacio.</small>
                        @error('first_name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Apellidos -->
                <div class="form-group row mb-4">
                    <label for="last_name" class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Apellidos</label>
                    <div class="col-md-9">
                        <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name') }}" required style="background-color: #f6f6f6; border: 1px solid #f6f6f6; border-radius: 0; box-shadow: none;">
                        <small class="form-text mt-2" style="color: #999; font-size: 11px;">Solo se permiten caracteres alfabéticos (letras) y el punto (.), seguidos de un espacio.</small>
                        @error('last_name') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Correo electrónico -->
                <div class="form-group row mb-4">
                    <label for="email" class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Correo electrónico</label>
                    <div class="col-md-9">
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required style="background-color: #f6f6f6; border: 1px solid #f6f6f6; border-radius: 0; box-shadow: none;">
                        @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Contraseña -->
                <div class="form-group row mb-4">
                    <label for="password" class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Contraseña</label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" required style="background-color: #f6f6f6; border: 1px solid #f6f6f6; border-radius: 0; box-shadow: none;">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger" onclick="toggleRegisterPassword()" style="border-radius: 0; padding: 0 15px;">
                                    <i class="fa fa-eye-slash" id="register-password-icon"></i>
                                </button>
                            </div>
                        </div>
                        @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Fecha de nacimiento -->
                <div class="form-group row mb-4 align-items-center">
                    <label for="birthday" class="col-md-3 col-form-label text-md-left" style="color: #555; font-size: 14px;">Fecha de nacimiento</label>
                    <div class="col-md-9 d-flex align-items-center">
                        <div class="flex-grow-1">
                            <input type="date" id="birthday" name="birthday" class="form-control" value="{{ old('birthday') }}" style="background-color: #f6f6f6; border: 1px solid #f6f6f6; border-radius: 0; box-shadow: none;">
                            <small class="form-text mt-2" style="color: #999; font-size: 11px;">(Ejemplo: 31/05/1970)</small>
                        </div>
                        <span class="ml-3" style="color: #999; font-size: 11px;">Opcional</span>
                    </div>
                    @error('birthday') <div class="col-md-9 offset-md-3"><span class="text-danger small">{{ $message }}</span></div> @enderror
                </div>

                <!-- Checkboxes -->
                <div class="form-group row mb-3">
                    <div class="col-md-9 offset-md-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="opt_in" name="opt_in" value="1" {{ old('opt_in') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="opt_in" style="font-size: 14px; color: #555;">Reciba ofertas especiales de nuestros socios</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-5">
                    <div class="col-md-9 offset-md-3">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="newsletter" name="newsletter" value="1" {{ old('newsletter') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="newsletter" style="font-size: 14px; color: #555;">Suscribirse a nuestro boletín de noticias</label>
                        </div>
                        <small class="form-text mt-1" style="color: #999; font-size: 11px; margin-left: 1.5rem; font-style: italic;">
                            Puede darse de baja en cualquier momento. Por ello, lo invitamos a ver nuestro aviso de privacidad e información de contacto.
                        </small>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-group row mt-5">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-danger" style="border-radius: 0; padding: 8px 30px; text-transform: none; font-size: 14px; font-weight: normal; background-color: #ef4444; border-color: #ef4444;">
                            Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleRegisterPassword() {
        var pwdInput = document.getElementById('password');
        var pwdIcon = document.getElementById('register-password-icon');
        
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
