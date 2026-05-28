<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/conexion.php");

if(isset($_POST['guardar'])){

    $nombre = mysqli_real_escape_string($conn,$_POST['nombre']);
    $titulo = mysqli_real_escape_string($conn,$_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conn,$_POST['descripcion']);

    $sql = "UPDATE biografia
            SET nombre='$nombre',
                titulo='$titulo',
                descripcion='$descripcion'
            WHERE id=1";

    mysqli_query($conn,$sql);

    header("Location: biografia.php");
    exit();
}

$bio = mysqli_query($conn,"SELECT * FROM biografia WHERE id=1");
$datos = mysqli_fetch_assoc($bio);

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Biografía</title>

<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2>Administrar Biografía</h2>

    <a href="dashboard.php"
       class="btn btn-secondary mb-3">

       Volver

    </a>

    <div class="card">

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label>Nombre</label>

                    <input
                        type="text"
                        name="nombre"
                        class="form-control"
                        value="<?php echo $datos['nombre']; ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Título</label>

                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
                        value="<?php echo $datos['titulo']; ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Descripción</label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                        rows="5"
                        required><?php echo $datos['descripcion']; ?></textarea>

                </div>

                <button
                    type="submit"
                    name="guardar"
                    class="btn btn-success">

                    Guardar Cambios

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>