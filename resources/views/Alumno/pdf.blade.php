<!doctype html>
<html lang="en">

<head>
  <title>Registro de Estudiantes</title>
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
    <p><strong>Nivel:</strong> {{ $nivel->nombre_nivel }}</p>
  </div>
  <div class="info-section">
    <p><strong>Grado:</strong> {{ $grado->nombre_grado }}</p>
  </div>
  <div class="info-section">
    <p><strong>Sección:</strong> {{ $seccion->nombre_seccion}}</p>
  </div>
  <div class="description">
    <p>Lista de Estudiantes correspondiente al año escolar {{ $año_actual }}.</p>
  </div>

  <div class="content">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col" style="text-align: center;">Alumno</th>
          <th scope="col" style="text-align: center;">Apoderado</th>
          <th scope="col" style="text-align: center;">Telefono</th>
          <th scope="col" style="text-align: center;">Año de Matricula</th>
        </tr>
      </thead>
      <tbody>
        @foreach($alumnos as $alumno)
        <tr>
          <td style="text-align: center;">{{$alumno['id_alumno']}}</td>
          <td style="text-align: center;">{{$alumno['nombre_alumno'] . ' ' . $alumno['apellido_alumno']}}</td>
          <td style="text-align: center;">{{$alumno['padre']['user']['name']}}</td>
          <td style="text-align: center;">{{$alumno['telefono']}}</td>
          <td style="text-align: center;">{{$alumno['periodo']}}</td>
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