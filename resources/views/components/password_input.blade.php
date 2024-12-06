<!--
INPUT DE TIPO PASSWORD
Variables:
$name       - Nombre del modelo a llamar
$label      - Para la etiqueta del input
$message    - Para el mensaje de error
-->

<div class="form-group">
    <label class="h5" for="{{ $name }}">{{ $label }}</label>
    <input type="password" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

