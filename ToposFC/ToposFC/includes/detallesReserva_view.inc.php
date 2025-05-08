<?php
declare(strict_types=1);

function mostrarDetallesReserva(int $id){
    require 'database.php';
    
    $consulta2 = "SELECT * from topos_reservas WHERE id = :id";
    $stmt2 = $pdo->prepare($consulta2);
    $stmt2->bindParam(":id", $id);
    $stmt2->execute();
    $row = $stmt2->fetch(PDO::FETCH_ASSOC);

    echo "<style>
        .contenedor {
            margin: 0 auto;
            max-width: 1200px;
            padding: 20px;
        }
        .titulo {
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em; /* Aumenta el tamaño de la fuente de los títulos */
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 1.5em; /* Aumenta el tamaño de la fuente de las tablas */
        }
        .table th, .table td {
            padding: 12px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .border-black {
            border-color: black;
        }
    </style>";

    echo "<div class='contenedor formulario mt-5 pe-5 ps-5'>";
    echo "<h2 class='titulo'>Detalles de la reserva</h2>";
    
    if ($row) {
        $estado = "";
        switch ($row['estado']) {
            case 0:
                $estado = "Sin confirmar";
                break;
            case 1:
                $estado = "Confirmada";
                break;
            case 3:
                $estado = "Proceso de reagendar";
                break;
            default:
                $estado = "Desconocido"; // Por si hay otros estados no especificados
        }
        
        // Tabla 1: Datos principales
        echo "<h3 class='titulo'>Datos Principales</h3>";
        echo "<div class='table-responsive'>
                <table class='table table-hover border-black tabla'>
                    <thead>
                        <tr>
                            <th scope='col'>Titulo</th>
                            <th scope='col'>Motivo</th>
                            <th scope='col'>Nombre</th>
                            <th scope='col'>Correo</th>
                            <th scope='col'>Teléfono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{$row['titulo']}</td>
                            <td>{$row['motivo']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['correo']}</td>
                            <td>{$row['telefono']}</td>
                        </tr>
                    </tbody>
                </table>
              </div>";
        
        // Tabla 2: Detalles adicionales
        echo "<h3 class='titulo'>Detalles Adicionales</h3>";
        echo "<div class='table-responsive'>
                <table class='table table-hover border-black tabla'>
                    <thead>
                        <tr>
                            <th scope='col'>Fecha</th>
                            <th scope='col'>Hora de inicio</th>
                            <th scope='col'>Hora de fin</th>
                            <th scope='col'>Hora en la que se hizo la reserva</th>
                            <th scope='col'>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{$row['fecha']}</td>
                            <td>{$row['hora_inicio']}</td>
                            <td>{$row['hora_fin']}</td>
                            <td>{$row['hora_de_reserva']}</td>
                            <td>{$estado}</td>
                        </tr>
                    </tbody>
                </table>";
                if($row['estado']==0){
                    echo "<td><a class='boton boton--morado' onclick='confirmarReporte($id)'>Confirmar Reserva</a></td>";
                }
                    

              echo "</div>";
    } else {
        echo "<div class='table-responsive'>
                <table class='table table-hover border-black tabla'>
                    <thead>
                        <tr>
                            <th colspan='5'>No se encontraron resultados</th>
                        </tr>
                    </thead>
                </table>
              </div>";
    }

    echo "</div>";


}
