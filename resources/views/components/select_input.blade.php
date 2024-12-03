<!--
INPUT DE TIPO SELECT
Variables:
$name       - Nombre del modelo a llamar
$label      - Para la etiqueta del input
$message    - Para el mensaje de error
$options    - Para los desplegables de la lista
-->

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" {{ $key == $selected ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
</div>
