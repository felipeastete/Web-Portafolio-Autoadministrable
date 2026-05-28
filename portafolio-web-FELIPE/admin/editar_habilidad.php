<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/conexion.php");

if(!isset($_GET['id'])){
    header("Location: habilidades.php");
    exit();
}

$id = intval($_GET['id']);

$resultado = mysqli_query(
    $conn,
    "SELECT * FROM habilidades WHERE id = $id"
);

$habilidad = mysqli_fetch_assoc($resultado);

if(!$habilidad){
    header("Location: habilidades.php");
    exit();
}

if(isset($_POST['actualizar'])){

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
        "UPDATE habilidades SET
        nombre='$nombre',
        icono='$icono'
        WHERE id=$id"
    );

    header("Location: habilidades.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Habilidad</title>

<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <h2>Editar Habilidad</h2>

    <a href="habilidades.php"
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
                        value="<?php echo htmlspecialchars($habilidad['nombre']); ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Icono FontAwesome</label>

                    <input
                        type="text"
                        name="icono"
                        class="form-control"
                        value="<?php echo htmlspecialchars($habilidad['icono']); ?>"
                        required>

                </div>

                <button
                    type="submit"
                    name="actualizar"
                    class="btn btn-success">

                    Actualizar

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>