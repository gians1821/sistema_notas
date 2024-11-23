<p>Hola {{ $name }},</p>
<p>Has solicitado recuperar tu contraseña. Haz clic en el siguiente enlace para reestablecerla:</p>
<p>
    <a href="{{ route('password.reset', ['token' => $token]) }}">
        Reestablecer Contraseña aqui
    </a>
</p>
<p>Si no realizaste esta solicitud, ignora este mensaje.</p>
