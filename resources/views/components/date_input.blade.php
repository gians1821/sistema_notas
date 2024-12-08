<!--
INPUT DE TIPO FECHA
Variables:
$name       - Nombre del modelo a llamar
$label      - Para la etiqueta del input
$message    - Para el mensaje de error
-->

<div class="form-group">
  <label class="form-label" for="{{ $name }}"><strong>{{ $label }}</strong></label>
  <input type="date" class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
      name="{{ $name }}">
  @error($name)
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>
