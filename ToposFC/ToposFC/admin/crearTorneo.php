<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/crearTorneo_view.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Creacion de torneo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link href="../css/agrega_a.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="../img/MADRIGUERA-LOGO-03.png" type="image/png">

</head>

<body>
<div class="logo">
    <img src="../img/MADRIGUERA-LOGO-03.png" alt="logo de Topos FC">
</div>
<?php if(!isset($_SESSION["user_id"])){
        header("Location: ../index.html");
    } ?>
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
                    <li class="nav-item"><a class="nav-link "
                                            href="./AdministrarTorneo.php">Información de torneos</a></li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./reservas_admin.php">Información de reservas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./tabla_admin.php">Información administrador</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./editar_estadisticas.php">Editar Estadisticas</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../includes/logout.inc.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                          </svg></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
  <main class="fondo-principal">


  <div class="form-container">
  <h3>Crear Nuevo Torneo</h3>  
    
    <?php
      check_form_errors();
    ?>
        <form action="../includes/crearTorneo.inc.php" method="POST">
            <label for="input1">Nombre del torneo:</label>
            <input type="text" id="nombre_torneo" name="nombre_torneo"  value="<?php echo isset($_SESSION['nombre_torneo']) ? htmlspecialchars($_SESSION['nombre_torneo']) : ''; ?>">
            
            <label for="input2">Cantidad de equipos:</label>
            <input type="number" id="cantidad_equipos" name="cantidad_equipos" min="2" value="<?php echo isset($_SESSION['cantidad_equipos']) ? htmlspecialchars($_SESSION['cantidad_equipos']) : ''; ?>">
            
            <button type="submit">Crear torneo</button>
        </form>
    </div>

  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>