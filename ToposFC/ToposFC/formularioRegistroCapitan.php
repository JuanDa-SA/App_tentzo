<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/formularioCapitan_view.inc.php';


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
  <title>Registro capitán</title>
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
        <h3 class="tituloCapitan">Datos del capitan</h3>
        <?php
          check_form_errors();
          ?>
        <div class="contenedor-form-nota">
          <form action="includes/formularioCapitan.inc.php" method="post">
            <div class="col-12  entrada">
              <label class="input-label" for="nombre_capitan">Nombre del capitan<span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Nombre" id="nombre_capitan" name="nombre_capitan" value="<?php echo isset($_SESSION["jugador"]['nombre_capitan']) ? htmlspecialchars($_SESSION["jugador"]['nombre_capitan']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="apellido_paterno">Apellido paterno: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Apellido" id="apellido_capitan" name="apellido_capitan" value="<?php echo isset($_SESSION["jugador"]['apellido1']) ? htmlspecialchars($_SESSION["jugador"]['apellido1']) : ''; ?>" >
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="apellido_materno">Apellido materno: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Apellido" id="apellido2_capitan" name="apellido2_capitan" value="<?php echo isset($_SESSION["jugador"]['apellido2']) ? htmlspecialchars($_SESSION["jugador"]['apellido2']) : ''; ?>" >
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="apellido_materno">Edad: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Edad" id="edad" name="edad" value="<?php echo isset($_SESSION["jugador"]['edad']) ? htmlspecialchars($_SESSION["jugador"]['edad']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="apellido_materno">Colonia: <span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="Colonia" id="colonia" name="colonia" value="<?php echo isset($_SESSION["jugador"]['colonia']) ? htmlspecialchars($_SESSION["jugador"]['colonia']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="contacto_equipo">Teléfono de Contacto ( WhatsApp )<span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="2223334445" id="contacto_equipo" name="contacto_equipo" value="<?php echo isset($_SESSION["jugador"]['contacto']) ? htmlspecialchars($_SESSION["jugador"]['contacto']) : ''; ?>">
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="correo">Correo electronico<span class="rojo">*</span>:</label>
              <input class="input-form" type="text" placeholder="alguien@algo.com " id="correo" name="correo" value="<?php echo isset($_SESSION["jugador"]['correo']) ? htmlspecialchars($_SESSION["jugador"]['correo']) : ''; ?>">
            </div>
            <div class="col-12 entrada">
                <label class="input-label" for="numero">Número de camiseta: <span class="rojo">*</span></label>
                <input class="input-form" type="number" id="numero" name="numero" placeholder="10" value="<?php echo isset($_SESSION["jugador"]['numero']) ? htmlspecialchars($_SESSION["jugador"]['numero']) : ''; ?>">
            </div>
            <input type="submit" class="boton boton--morado" name="validate" value="Continuar">
          </form>
          <div class="section2">
            <h3 class="nota">Nota. </h3>
            <p>
              Una vez enviados los datos te solicitamos estar pendiente al número de contacto para confirmar tu
              registro.
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