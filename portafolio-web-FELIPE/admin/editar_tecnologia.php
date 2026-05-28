<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/conexion.php");

if(!isset($_GET['id'])){
    header("Location: tecnologias.php");
    exit();
}

$id = intval($_GET['id']);

$resultado = mysqli_query(
    $conn,
    "SELECT * FROM tecnologias WHERE id = $id"
);

$tecnologia = mysqli_fetch_assoc($resultado);

if(!$tecnologia){
    header("Location: tecnologias.php");
    exit();
}

if(isset($_POST['actualizar'])){

    $nombre = mysqli_real_escape_string(
        $conn,
        $_POST['nombre']
    );

    $porcentaje = intval(
        $_POST['porcentaje']
    );

    mysqli_query(
        $conn,
        "UPDATE tecnologias SET
        nombre='$nombre',
        porcentaje='$porcentaje'
        WHERE id=$id"
    );

    header("Location: tecnologias.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Editar Tecnología</title>

<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <h2>Editar Tecnología</h2>

    <a href="tecnologias.php"
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
                        value="<?php echo htmlspecialchars($tecnologia['nombre']); ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label>Porcentaje</label>

                    <input
                        type="number"
                        name="porcentaje"
                        min="1"
                        max="100"
                        class="form-control"
                        value="<?php echo $tecnologia['porcentaje']; ?>"
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