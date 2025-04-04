
@component('mail::message')
# Restablecimiento de Contraseña

Has recibido este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.

@component('mail::button', ['url' => $resetUrl])
Restablecer Contraseña
@endcomponent

Este enlace de restablecimiento expirará en {{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} minutos.

Si no solicitaste un restablecimiento de contraseña, ignora este mensaje.

Saludos,<br>
{{ config('app.name') }}
@endcomponent