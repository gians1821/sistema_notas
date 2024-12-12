<!doctype html>
<html lang="en">

<head>
  <title>Registro de Notas</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Fuente Burning -->
  <link href="https://fonts.googleapis.com/css2?family=Burning:wght@700&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    header {
      text-align: center;
      margin-bottom: 30px;
      position: relative;
    }

    .school-name {
      font-family: 'Burning', sans-serif;
      font-size: 36px;
      color: #333;
    }

    .description {
      text-align: center;
      margin-bottom: 20px;
    }

    .table thead {
      background-color: #343a40;
      color: white;
    }

    .table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .table {
      margin-top: 20px;
      width: 100%;
    }

    img {
      position: absolute;
      left: 20px;
    }

    .signature-section {
      margin-top: 50px;
      text-align: center;
    }

    .signature {
      margin-top: 50px;
      display: inline-block;
      text-align: center;
    }

    .signature img {
      display: block;
      margin: 0 auto;
      width: 150px;
      height: auto;
    }

    .director {
      margin-top: 20px;
      font-weight: bold;
    }

    .seal {
      margin-top: 20px;
      text-align: center;
    }

    .seal img {
      width: 100px;
      height: auto;
    }
  </style>
</head>

<body>
  <header>
    <img src="plantilla/src/img/logo/peque.png" alt="Logo Colegio" width="80px" height="80px">
    <h1 class="school-name">COLEGIO BRUNING</h1>
  </header>
  <br>
  <div class="info-section">
    <p><strong>Alumno:</strong> {{ $alumno->nombre_alumno }} {{$alumno->apellido_alumno}}</p>
    <p><strong>Telefono:</strong> {{ $alumno->telefono }}</p>
  </div>
  <div class="description">
    <p>Boleta de notas correspondiente al año escolar 2024. A continuación se presenta el detalle de las calificaciones obtenidas por el alumno en el programa académico.</p>
  </div>

  <div class="content">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Curso</th>
          <th>Nombre de la Competencia</th>
          <th>Nota 1</th>
          <th>Nota 2</th>
          <th>Nota 3</th>
          <th>Nota Final</th>
        </tr>
      </thead>
      <tbody>
        @foreach($notas as $nota)
        <tr>
          <td>{{ $nota->catedra->curso->nombre_curso }}</td>
          <td>{{ $nota->competencia->nombre_competencia }}</td>
          <td>{{ $nota->nota1 }}</td>
          <td>{{ $nota->nota2 }}</td>
          <td>{{ $nota->nota3 }}</td>
          <td>{{ $nota->nota_final }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <br>
  <br>
  <div class="signature-section">
    <div class="signature">
      <p class="director">Firma del Director del Colegio</p>
    </div>
    <div class="seal">
      <img src="plantilla/src/img/logo/sello.png" alt="Sello del Colegio">
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>

</html>