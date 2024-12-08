<!--
INPUT DE TIPO SELECT
Variables:
$name       - Nombre del modelo a llamar
$label      - Para la etiqueta del input
$message    - Para el mensaje de error
$options    - Para los desplegables de la lista
-->

<div class="form-group">
    <label class="form-label" for="{{ $name }}"><strong>{{ $label }}</strong></label>
    <select class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}">
        <option value="default" selected disabled>Seleccione opción</option>
        @foreach ($options as $option)
            <option value="{{ $option->id }}" {{ $option->id == old($name, $selected) ? 'selected' : '' }}>
                {{ $option->name }}
            </option>
        @endforeach
    </select>
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
