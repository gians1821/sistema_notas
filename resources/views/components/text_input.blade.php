<!--
INPUT DE TIPO TEXT
Variables:
$name       - Nombre del modelo a llamar
$label      - Para la etiqueta del input
-->

<div class="form-group">
    <label class="form-label" for="{{ $name }}"><strong> {{ $label }} </strong></label>
    <input type="text" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}" value="{{ old($name, $value ?? '') }}">
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
