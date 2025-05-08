<?php
require_once '../includes/config_session.inc.php';
require_once '../includes/eventos_view.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Eventos partido</title>
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
  <h3>Agrega evento a partido</h3>  
    
    <?php
      check_form_errors();
    ?>
        <form action="../includes/Eventos.inc.php" method="POST" id="eventoForm">
            <div class="col-12  entrada">
                <label class="input-label" for="torneo">Torneo:</label>
                <select class="input-form" id = "torneo" name="torneo">
                        <option value="">Selecciona un torneo</option>
                            <?php
                            require_once "../includes/database.php";
                            $query = 'SELECT * FROM topos_torneo';
                                foreach ($pdo->query($query) as $row) {
                                echo '<option value="' . $row['id_torneo'] . '">' .  $row['nombre'] . '</option>';
                            }
                            ?>
                </select>
            </div>
            <div class="col-12  entrada">
                <label class="input-label" for="encuentro">Encuentro:</label>
                <select class="input-form" id = "encuentro" name="encuentro">
                        <option value="">Selecciona un encuentro</option>
                </select>
            </div>
            <div class="col-12  entrada">
                <label class="input-label" for="equipo">Equipo:</label>
                <select class="input-form" id = "equipo" name="equipo">
                        <option value="">Selecciona un equipo:</option>
                </select>
            </div>
            <div class="col-12  entrada">
                <label class="input-label" for="jugador">Jugador:</label>
                <select class="input-form" id = "jugador" name="jugador">
                        <option value="">Selecciona un jugador:</option>
                </select>
            </div>
            <div class="col-12  entrada">
                <label class="input-label" for="evento">Evento a agregar:</label>
                <select class="input-form" id = "evento" name="evento">
                        <option value="">Selecciona un evento:</option>
                        <option value="1">Gol</option>
                        <option value="2">Tarjeta Roja</option>
                        <option value="3">Tarjeta Amarilla</option>
                </select>
            </div>
            <div class="col-12  entrada">
                <label class="input-label" for="minuto">Minuto del evento:</label>
                <input type="number" class="input-form" id = "minuto" name="minuto" placeholder="Ejemplo: 85">
            </div>
            
            <button type="submit">Registrar evento</button>
        </form>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

    <script>
    document.getElementById('torneo').addEventListener('change', function() {
        var torneoSeleccionado = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var encuentros = JSON.parse(xhr.responseText);
                var selectEncuentro = document.getElementById('encuentro');
                selectEncuentro.innerHTML = '<option value="">Selecciona un encuentro</option>';
                encuentros.forEach(function(encuentro) {
                    var option = document.createElement('option');
                    option.value = encuentro.id;
                    option.textContent = encuentro.equipo_local + ' vs ' + encuentro.equipo_visitante;
                    selectEncuentro.appendChild(option);
                });
            }
        };
        xhr.open('POST', 'obtener_encuentros.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('torneo=' + torneoSeleccionado);
    });



    document.getElementById('encuentro').addEventListener('change', function() {
        var encuentroSeleccionado = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var equipos = JSON.parse(xhr.responseText);
                var selectEquipo = document.getElementById('equipo');
                selectEquipo.innerHTML = '<option value="">Selecciona un equipo</option>';
                equipos.forEach(function(equipo) {
                    var option = document.createElement('option');
                    option.value = equipo.id;
                    option.textContent = equipo.nombre_equipo;
                    selectEquipo.appendChild(option);
                });
            }
        };
        xhr.open('POST', 'obtener_equipos.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('encuentro=' + encuentroSeleccionado);
    });

    document.getElementById('equipo').addEventListener('change', function() {
        var equipoSeleccionado = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var jugadores = JSON.parse(xhr.responseText);
                var selectJugador = document.getElementById('jugador');
                selectJugador.innerHTML = '<option value="">Selecciona un jugador</option>';
                jugadores.forEach(function(jugador) {
                    var option = document.createElement('option');
                    option.value = jugador.id;
                    option.textContent = jugador.nombre + ' ' + jugador.apellido_paterno;
                    selectJugador.appendChild(option);
                });
            }
        };
        xhr.open('POST', 'obtener_jugadores.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('equipo=' + equipoSeleccionado);
    });

    // document.getElementById('eventoForm').addEventListener('submit', function(event) {
    //     var confirmacion = confirm('¿Estás seguro de que quieres registrar este evento?');
    //     if (!confirmacion) {
    //         event.preventDefault();
    //     }
    // });
</script>
</body>

</html>