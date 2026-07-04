@extends('layouts.tienda')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1 class="page-title text-uppercase font-weight-light mb-4" style="font-size: 2rem; color: #333;">Contactar con nosotros</h1>
            <hr class="mb-5">
        </div>
    </div>

    <div class="row">
        <!-- Información de contacto -->
        <div class="col-md-4 mb-4">
            <div class="contact-info bg-light p-4 rounded shadow-sm h-100">
                <h4 class="text-uppercase mb-4" style="font-size: 1.25rem;">Nuestra tienda</h4>

                <ul class="list-unstyled">
                    <li class="mb-3 d-flex">
                        <i class="fa fa-map-marker text-danger mr-3 mt-1" style="font-size: 1.5rem; width: 20px; text-align: center;"></i>
                        <span>
                            <strong>{{ company_name() }}</strong><br>
                            {!! nl2br(e(\App\Models\CompanySetting::get('contact_address', "Blvd. de los insurgentes No. 20501 interior 100 y 103,\nTijuana, Baja California\nMéxico"))) !!}
                        </span>
                    </li>
                    <li class="mb-3 d-flex align-items-center">
                        <i class="fa fa-envelope text-danger mr-3" style="font-size: 1.25rem; width: 20px; text-align: center;"></i>
                        <span>
                            Envíenos un correo electrónico:<br>
                            <a href="mailto:{{ company_email() }}" class="text-danger font-weight-bold">{{ company_email() }}</a>
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Formulario de contacto -->
        <div class="col-md-8 mb-4">
            <div class="contact-form p-4 rounded shadow-sm border h-100">
                <h4 class="text-uppercase mb-4" style="font-size: 1.25rem;">Envíenos un mensaje</h4>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="#" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="id_contact" class="col-md-3 col-form-label">Tema</label>
                        <div class="col-md-6">
                            <select name="id_contact" id="id_contact" class="form-control" required>
                                <option value="2">Servicio al cliente</option>
                                <option value="1">Soporte Técnico</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-3 col-form-label">Dirección de correo electrónico</label>
                        <div class="col-md-6">
                            <input class="form-control" name="from" type="email" value="" placeholder="su@correo.com" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message" class="col-md-3 col-form-label">Mensaje</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="message" id="message" rows="5" placeholder="¿En qué podemos ayudarle?" required></textarea>
                        </div>
                    </div>

                    <!-- RGPD Checkbox -->
                    <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="psgdpr_consent_checkbox_1" name="psgdpr_consent_checkbox" value="1" required>
                                <label class="custom-control-label" for="psgdpr_consent_checkbox_1">
                                    <small>Acepto las condiciones generales y la política de confidencialidad.</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col-md-9 offset-md-3 text-right">
                            <button class="btn btn-primary" type="submit" style="background-color: #e62228; border-color: #e62228; border-radius: 0; padding: 10px 30px; font-weight: bold; text-transform: uppercase;">
                                Enviar mensaje
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
