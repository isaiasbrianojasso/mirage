<x-mail::message>
# {{ $subjectLine }}

{!! nl2br(e($content)) !!}

<br>
Saludos,<br>
{{ config('app.name') }}

---
<small>Has recibido este correo porque aceptaste suscribirte a nuestro boletín.</small>
</x-mail::message>
