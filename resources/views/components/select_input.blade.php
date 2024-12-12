<!--
INPUT DE TIPO SELECT
Variables:
$name       - Nombre del modelo a llamar
$label      - Para la etiqueta del input
$message    - Para el mensaje de error
$options    - Para los desplegables de la lista
$id_property        - el nombre del id (distinto de 'id')
$property           - el nombre del campo mostrado (distinto de 'name')
-->

<div class="form-group">
    <label class="form-label" for="{{ $name }}"><strong>{{ $label }}</strong></label>
    <select class="form-control @error($name) is-invalid @enderror" id="{{ $name }}" name="{{ $name }}" {{ $attributes ?? '' }}>
        <option value="" disabled {{ old($name, $selected ?? '') ? '' : 'selected' }}>
            Seleccione opción
        </option>

        @foreach ($options as $option)
            <option value="{{ $option->{$id_property ?? 'id'} }}"
                {{ (string) $option->{$id_property ?? 'id'} === (string) old($name, $selected ?? '') ? 'selected' : '' }}>
                {{ $option->{$property ?? 'name'} }}
            </option>
        @endforeach
    </select>
    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
