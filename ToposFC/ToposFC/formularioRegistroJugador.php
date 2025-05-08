<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/formularioJugador_view.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Registro de Jugador</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="css/formularioRegistroEquipo.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="img/MADRIGUERA-LOGO-03.png" type="image/png">
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
        <h2>Registro de jugadores</h2>
             <?php
          check_form_errors();
          $id = $_GET['id'];
          ?>
          <div class="contenedor-form-nota">
          <form action="includes/formularioJugador.inc.php?id=<?php echo $id; ?>" method="post">
          <div class="col-12  entrada">
              <label class="input-label" for="nombreJugador">Nombre del jugador<span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Nombre" id="nombreJugador" name="nombreJugador" value="<?php echo isset($_SESSION['nombre_capitan']) ? htmlspecialchars($_SESSION['nombre_capitan']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="apellido1Jugador">Apellido paterno: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Apellido" id="apellido1Jugador" name="apellido1Jugador" value="<?php echo isset($_SESSION['apellido_capitan']) ? htmlspecialchars($_SESSION['apellido_capitan']) : ''; ?>" >
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="apellido2Jugador">Apellido materno: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Apellido" id="apellido2Jugador" name="apellido2Jugador" value="<?php echo isset($_SESSION['apellido2_capitan']) ? htmlspecialchars($_SESSION['apellido2_capitan']) : ''; ?>" >
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="edad">Edad: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Edad" id="edad" name="edad" value="<?php echo isset($_SESSION['edad']) ? htmlspecialchars($_SESSION['edad']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="colonia">Colonia: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Colonia" id="colonia" name="colonia" value="<?php echo isset($_SESSION['colonia']) ? htmlspecialchars($_SESSION['colonia']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="contacto_equipo">Teléfono de Contacto ( WhatsApp )<span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="2223334445" id="contacto_equipo" name="contacto_equipo" value="<?php echo isset($_SESSION['contacto_equipo']) ? htmlspecialchars($_SESSION['contacto_equipo']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="correo">Correo electronico<span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="alguien@algo.com " id="correo" name="correo" value="<?php echo isset($_SESSION['correo']) ? htmlspecialchars($_SESSION['correo']) : ''; ?>">
            </div>
            <div class="col-12 entrada">
                <label class="input-label" for="numero">Número de camiseta: <span class="rojo">*</span></label>
                <input class="input-form" type="number" id="numero" name="numero" placeholder="10" value="<?php echo isset($_SESSION['numero']) ? htmlspecialchars($_SESSION['numero']) : ''; ?>">
            </div>
                <input type="submit" class="boton boton--negro" name="validate" value="Siguiente pagina">
          </form>
          
          </div>
          <a class="boton boton--morado" href="registro_exitoso_equipo.html">Terminar registro</a>
          <div>
            <h3 class="nota">Nota. </h3>
            <p>
              Favor de completar el formualrio con datos veridicos para evitar cualquier problema de comunicación.
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>