<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/formularioRegistro_view.inc.php';
// if(isset($_SESSION["equipo"])) {
//   $equipo = $_SESSION["equipo"];
//   $nombre_equipo = $equipo["nombre_equipo"];
//   $torneo = $equipo["torneo"];
//   var_dump($_SESSION["equipo"]);
//   echo " asdsadasdsasad";
// } else {
//   echo "No hay información de equipo en la sesión.";
// }

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Registro de equipo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/formularioRegistroEquipo.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="img/MADRIGUERA-LOGO-03.png" type="image/png">
  <style>
    .horar{
      padding: 20px;
    }
  </style>
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
  <main class="fondo-principal">
    <div class="contenedor contenedor-registro">
      <div class="cont-registro ">
        <h2>Torneo Futbol 5</h2>
        <div class="contenedor-reglas">
          <div class="horar">
            <h3>Reglas generales</h3>
            <p>Inscripción: $0 <br />
              Arbitraje: $0</p>
          </div>
          <div class="horar">
            <h3>Horarios</h3>
            <p>Lun - Vie <br />
              1er partido: 7:00 pm<br />
              2do partido: 8:00 pm</p>
          </div>
        </div>
        <br>
        <p>Este formulario fue realizado por el comité organizador de la Liga Varonil de Fútbol 5 "Madriguera"  los datos que proporciones serán resguardados y no se hará ningún uso inadecuado de la información, ni se compartirá con entidades externas al comité.</p> 
        <a class="enlace-aviso" href="https://toposfc.org/wp-content/uploads/2023/09/aviso-de-privacidad-integral.pdf">Aviso de privacidad</a>
        <?php
          check_form_errors();
          ?>
        <div class="contenedor-form-nota">
        
          <form id="registroForm" action="includes/formularioRegistro.inc.php" method="post" enctype="multipart/form-data">
            <div class="col-12 entrada">
              <label class="input-label" for="nombre_equipo">Nombre del equipo<span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Ejemplo. " id="nombre_equipo" name="nombre_equipo" value="<?php if(isset($_SESSION["equipo"])) {echo isset($_SESSION['equipo']["nombre_equipo"]) ? htmlspecialchars($_SESSION['equipo']["nombre_equipo"]) : '';} ?>">
            </div>
            <div class="col-12 entrada">
              <label class="input-label" for="torneo">Torneo al que desea registrar su equipo<span class="rojo">*</span>:</label>
              <select class="input-form" id="torneo" name="torneo">
                <option value="">Selecciona un torneo</option>
                <?php
                require_once "includes/database.php";
                $query = 'SELECT id_torneo, nombre FROM topos_torneo';
                foreach ($pdo->query($query) as $row) {
                  echo '<option value="' . $row['id_torneo'] . '">' .  $row['nombre'] . '</option>';
                }
                ?>
              </select>
            </div>
            <input type="submit" class="boton boton--morado" name="validate" value="Comenzar registro">
          </form>
        </div>
        
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>
