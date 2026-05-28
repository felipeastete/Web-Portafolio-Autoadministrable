<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/conexion.php");

$contactos = mysqli_query(
    $conn,
    "SELECT * FROM contactos
     ORDER BY fecha DESC"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<title>Mensajes</title>

<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Mensajes Recibidos</h2>

    <a href="dashboard.php"
       class="btn btn-secondary mb-3">

       Volver

    </a>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>Nombre</th>
                <th>Correo</th>
                <th>Asunto</th>
                <th>Mensaje</th>
                <th>Fecha</th>

            </tr>

        </thead>

        <tbody>

            <?php while($fila = mysqli_fetch_assoc($contactos)){ ?>

            <tr>

                <td><?php echo htmlspecialchars($fila['nombre']); ?></td>

                <td><?php echo htmlspecialchars($fila['correo']); ?></td>

                <td><?php echo htmlspecialchars($fila['asunto']); ?></td>

                <td><?php echo htmlspecialchars($fila['mensaje']); ?></td>

                <td><?php echo $fila['fecha']; ?></td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

</body>

</html>