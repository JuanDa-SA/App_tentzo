<?php
// Configuración de la conexión a la base de datos
require_once 'includes/database.php';

try {
    // Crear conexión


    // Consulta SQL para obtener los torneos
    $sql = "SELECT id_torneo, nombre FROM topos_torneo";

    // Preparar y ejecutar la consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obtener los resultados
    $torneos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/index.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="./css/estadisticasPhp.css">
    <link rel="icon" href="img/MADRIGUERA-LOGO-03.png" type="image/png">

    <title>Estadísticas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#formulario').submit(function (event) {
                event.preventDefault(); // Evitar el envío del formulario tradicional
                var formData = $(this).serialize(); // Serializar los datos del formulario
                $.ajax({
                    type: 'GET',
                    url: 'tabla_posiciones.php',
                    data: formData,
                    success: function (response) {
                        $('#tabla-posiciones').html(response); // Actualizar el contenido del contenedor div con la tabla recibida
                    }
                });
            });
        });
    </script>
</head>

<body>

<div class="logo">
    <img src="img/MADRIGUERA-LOGO-03.png" alt="logo de Topos FC">
  </div>
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="nv collapse navbar-collapse" id="navbarNav">
        <div class="nav-links">
          <ul class="navbar-nav">
            <li class="nav-item"> 
              <a class="nav-link" aria-current="page" href="index.html">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="estadisticas.php">Estadisticas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link"  href="formularioRegistroEquipo.php">Registro de equipo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="renta_canchas.html">Renta de canchas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Iniciar sesión</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

    <div class="contenedor-principal">
      <h1>Seleccione un Torneo</h1>
      <form id="formulario" >

          <select class="input-form" name="torneo" id="torneo">
              <!-- Generar opciones de torneos -->
              <?php
              require_once "includes/database.php";
              $query = 'SELECT id_torneo, nombre FROM topos_torneo';
              foreach ($pdo->query($query) as $row) {
                  echo '<option value="' . $row['id_torneo'] . '">' . $row['nombre'] . '</option>';
              }
              ?>

          </select>
          <button class="boton-torneo" type="submit">Ver Tabla de Posiciones</button>
      </form>
    </div>

      <div id="tabla-posiciones" class="tabla-wrap">
          <!-- La tabla de posiciones se actualizará aquí -->
      </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    
</body>

</html>