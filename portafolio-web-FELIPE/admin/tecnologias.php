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
    "DELETE FROM tecnologias WHERE id = $id");

    header("Location: tecnologias.php");
    exit();
}

/* AGREGAR */

if(isset($_POST['guardar'])){

    $nombre = mysqli_real_escape_string(
        $conn,
        $_POST['nombre']
    );

    $porcentaje = intval(
        $_POST['porcentaje']
    );

    mysqli_query(
        $conn,
        "INSERT INTO tecnologias
        (nombre, porcentaje)
        VALUES
        ('$nombre', '$porcentaje')"
    );

    header("Location: tecnologias.php");
    exit();
}

$tecnologias = mysqli_query(
    $conn,
    "SELECT * FROM tecnologias
    ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Tecnologías</title>

<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Tecnologías</h2>

    <a href="dashboard.php"
       class="btn btn-secondary mb-3">

       Volver

    </a>

    <div class="card mb-4">

        <div class="card-header">
            Nueva Tecnología
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
                    type="number"
                    name="porcentaje"
                    class="form-control mb-2"
                    placeholder="Porcentaje"
                    min="1"
                    max="100"
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
                <th>Tecnología</th>
                <th>Porcentaje</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody>

        <?php while($fila =
        mysqli_fetch_assoc($tecnologias)){ ?>

            <tr>

                <td>
                    <?php echo $fila['id']; ?>
                </td>

                <td>
                    <?php echo $fila['nombre']; ?>
                </td>

                <td>
                    <?php echo $fila['porcentaje']; ?>%
                </td>

                <td>

                    <td>

                        <a href="editar_tecnologia.php?id=<?php echo $fila['id']; ?>"
                          class="btn btn-warning btn-sm">

                          Editar

                         </a>
 
                         <a href="tecnologias.php?eliminar=<?php echo $fila['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Eliminar tecnología?')">
     
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