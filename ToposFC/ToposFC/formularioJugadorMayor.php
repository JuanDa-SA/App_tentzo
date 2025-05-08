<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/formularioCapFMenor_view.inc.php';



// if(isset($_SESSION["equipo"])) {
//     $equipo = $_SESSION["equipo"];
//     $nombre_equipo = $equipo["nombre_equipo"];
//     $torneo = $equipo["torneo"];
// } else {
//     echo "No hay información de equipo en la sesión.";
// }

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Jugador Mayor</title>
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
        <h3>Datos del jugador</h3>
        <p>Hemos observado que eres mayor de edad, por lo que algunos datos serán solicitados</p>
        <?php
        $id = $_GET['id'];
          check_form_errors();
          ?>
        <div class="contenedor-form-nota">
          <form action="includes/formularioJugadorMayor.inc.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="col-12  entrada">
              <label class="input-label" for="apellido_paterno">Soy mayor de edad y autorizo el uso de mi imagen en usos de multimedia para la difusión del evento, a través del Comité Organizador del Torneo de Fútbol 5 "Madriguera" <span class="rojo">*</span>:</label>
              <a class="enlace-aviso" href="https://drive.google.com/file/d/1YPWbkt8SNt5tcTi3ty6eJCwp7z4H4pJU/view?pli=1">*Consulta nuestro formato de uso de imagen para mayores de edad dando click en este enlace</a>
              <div class="opciones-aviso">
                <p>
                    <input type="radio" id="respuesta1" name="permisoImagen" value="si">
                    <label class="input-label" for="respuesta1">Sí acepto</label>
                
                <p>
                    <input type="radio" id="respuesta2" name="permisoImagen" value="no">
                    <label class="input-label" for="respuesta2">No acepto</label>
                </p>
              </div>
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="permiso1">Me comprometo a no ingerir bebidas alcohólicas ni estupefacientes en ningún espacio designado para La Liga de Fútbol 5 "Madriguera"  <span class="rojo">*</span>:</label>
              
        <input type="checkbox" id="permiso1" name="permiso1" value="permiso1">
        <label class="input-label" for="permiso1">Acepto</label>
    
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="permiso2">Deslindo y exonero de toda responsabilidad al Comité organizador de la Liga de Fútbol 5 "Madriguera" sus empleados, voluntarios, beneficiarios, consejeros, patrocinadores y demás relacionados al evento; de cualquier incidente.  <span class="rojo">*</span>:</label>
              
        <input type="checkbox" id="permiso2" name="permiso2" value="permiso2" >
        <label class="input-label" for="permiso2">Acepto</label>
    
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="permiso3">Autorizo al Comité Organizador de la Liga de Fútbol 5 "Madriguera" o a quien designe a que en caso de que ocurra algún incidente durante LAS ACTIVIDADES se me brinde la atención necesaria, y en dado caso, el traslado a alguna Unidad Médica cercana, con la finalidad de que se atienda la emergencia y deslindo de toda responsabilidad al Comité Organizador de la Liga de Fútbol 5 "Madriguera"  y LOS COLABORADORES por las acciones aquí referidas o por las consecuencias inmediatas o futuras que se pudieran derivar de las mismas.  <span class="rojo">*</span>:</label>
              
        <input type="checkbox" id="permiso3" name="permiso3" value="permiso3">
        <label class="input-label" for="permiso3">Acepto</label>
    
            </div>
            </div>
            <div class="col-12  entrada">
              <label class="input-label" for="permiso4">Acepto que es mi responsabilidad la certeza y suficiencia de la información médica entregada al Comité Organizador de la Liga de Fútbol 5 "Madriguera" que sea relevante, desde el momento de la inscripción y/o antes de participar en LAS ACTIVIDADES, y que esta información será proporcionada a las personas que me atiendan en caso de accidente. <span class="rojo">*</span>:</label>
              
              <input  type="checkbox" id="permiso4" name="permiso4" value="permiso4">
              <label class="input-label" for="permiso4">Acepto</label>
            </div>
            <input type="submit" class="boton boton--negro" name="validate" value="Continuar">
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