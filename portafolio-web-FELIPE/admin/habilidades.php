<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/conexion.php");

/* ELIMINAR */

if(isset($_GET['eliminar'])){

    $id = intval($_GET['eliminar']);

    mysqli_query($conn,
    "DELETE FROM habilidades WHERE id = $id");

    header("Location: habilidades.php");
    exit();
}

/* AGREGAR */

if(isset($_POST['guardar'])){

    $nombre = mysqli_real_escape_string(
        $conn,
        $_POST['nombre']
    );

    $icono = mysqli_real_escape_string(
        $conn,
        $_POST['icono']
    );

    mysqli_query(
        $conn,
        "INSERT INTO habilidades
        (nombre, icono)
        VALUES
        ('$nombre','$icono')"
    );

    header("Location: habilidades.php");
    exit();
}

$habilidades = mysqli_query(
    $conn,
    "SELECT * FROM habilidades
    ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Habilidades</title>
<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="container mt-5">

    <h2>Administrar Habilidades</h2>

    <a href="dashboard.php"
       class="btn btn-secondary mb-3">

       Volver

    </a>

    <div class="card mb-4">

        <div class="card-header">
            Nueva Habilidad
        </div>

        <div class="card-body">

            <form method="POST">

                <input
                    type="text"
                    name="nombre"
                    class="form-control mb-2"
                    placeholder="Nombre"
                    required>

                <input
                    type="text"
                    name="icono"
                    class="form-control mb-2"
                    placeholder="Ej: fa-html5"
                    required>

                <button
                    type="submit"
                    name="guardar"
                    class="btn btn-success">

                    Guardar

                </button>

            </form>

        </div>

    </div>

    <table class="table table-bordered">

        <thead>

            <tr>
                <th>ID</th>
                <th>Icono</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

        <?php while($fila = mysqli_fetch_assoc($habilidades)){ ?>

            <tr>

                <td>
                    <?php echo $fila['id']; ?>
                </td>

                <td>
                    <i class="fa-brands <?php echo $fila['icono']; ?>"></i>
                </td>

                <td>
                    <?php echo $fila['nombre']; ?>
                </td>

                <td>

                    <td>

                        <a href="editar_habilidad.php?id=<?php echo $fila['id']; ?>"
                         class="btn btn-warning btn-sm">

                           Editar

                        </a>

                        <a href="habilidades.php?eliminar=<?php echo $fila['id']; ?>"
                          class="btn btn-danger btn-sm"
                          onclick="return confirm('¿Eliminar habilidad?')">

                           Eliminar

                        </a>

                    </td>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>