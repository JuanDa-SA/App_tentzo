<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/crearTorneo_view.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Aquí procesamos la inserción en la base de datos después de la confirmación
    if (isset($_POST['torneo'], $_POST['encuentro'], $_POST['equipo'], $_POST['jugador'], $_POST['evento'], $_POST['minuto'])) {
        $torneo = $_POST['torneo'];
        $encuentro = $_POST['encuentro'];
        $equipo = $_POST['equipo'];
        $jugador = $_POST['jugador'];
        $evento = $_POST['evento'];
        $minuto = $_POST['minuto'];

        $sql = "INSERT INTO topos_evento_encuentro (torneo, encuentro, equipo, jugador, evento, minuto) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$torneo, $encuentro, $equipo, $jugador, $evento, $minuto])) {
            echo "<script>alert('Evento registrado correctamente');</script>";
        } else {
            echo "<script>alert('Error al registrar el evento');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Goleo</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <link href="../css/index.css" rel="stylesheet" type="text/css" />
    <link href="../css/goleo.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="../img/MADRIGUERA-LOGO-03.png" type="image/png">

<body>
<?php if(!isset($_SESSION["user_id"])){
        header("Location: ../index.html");
   } ?>
<header>
<div class="logo">
    <img src="../img/MADRIGUERA-LOGO-03.png" alt="logo de Topos FC">
  </div>
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

    <div class="container">
     <form id="goleoForm" method="POST" action="../includes/procesar.php" onsubmit="return validarFormulario()">
        <label for="equipo">Selecciona un equipo:</label>
        <select id="equipo" name="equipo" onchange="cargarJugadores(this.value)">
            <option value="">Selecciona un equipo</option>
            <?php
            require_once "../includes/database.php";
            $query = 'SELECT * FROM topos_equipo';
            foreach ($pdo->query($query) as $row) {
                echo '<option value="' . $row['id_equipo'] . '">' .  $row['nombre_equipo'] . '</option>';
            }
            ?>
        </select>

        <label for="jugador">Selecciona un jugador:</label>
        <select id="jugador" name="jugador">
            <option value="">Seleccione un jugador</option>
        </select>

        <label for="goles">Goles:</label>
        <input type="number" id="goles" name="goles" required>

        <button type="submit">Actualizar</button>
     </form>
    </div>
    <script>
        function cargarJugadores(equipoId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../includes/cargar_jugadores.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                console.log("Respuesta del servidor:", this.responseText);
                if (this.status === 200) {
                    document.getElementById('jugador').innerHTML = this.responseText;
                }
            };
            xhr.send('equipo=' + equipoId);
        }

        function validarFormulario() {
            const equipo = document.getElementById('equipo').value;
            const jugador = document.getElementById('jugador').value;
            const goles = document.getElementById('goles').value;

            if (equipo === '' || jugador === '' || goles === '') {
                alert('Por favor, llene todos los campos requeridos.');
                return false; // Evita que el formulario se envíe
            }

                    // Mostrar una alerta después de que el formulario se envíe exitosamente
                alert('¡Añadido correctamente!');
                return true; // Envía el formulario si todos los campos están llenos

            return true; // Envía el formulario si todos los campos están llenos
        }
    </script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>




