<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/conexion.php");

if(!isset($_GET['id'])){
    header("Location: proyectos.php");
    exit();
}

$id = intval($_GET['id']);

$resultado = mysqli_query(
    $conn,
    "SELECT * FROM proyectos WHERE id = $id"
);

$proyecto = mysqli_fetch_assoc($resultado);

if(!$proyecto){
    header("Location: proyectos.php");
    exit();
}

/* ACTUALIZAR */

if(isset($_POST['actualizar'])){

    $titulo = mysqli_real_escape_string(
        $conn,
        $_POST['titulo']
    );

    $descripcion = mysqli_real_escape_string(
        $conn,
        $_POST['descripcion']
    );

    $demo = mysqli_real_escape_string(
        $conn,
        $_POST['demo']
    );

    $github = mysqli_real_escape_string(
        $conn,
        $_POST['github']
    );

    /* MANTENER IMAGEN ACTUAL */

    $imagenNombre = $proyecto['imagen'];

    /* NUEVA IMAGEN */

    if(!empty($_FILES['imagen']['name'])){

        $imagenNombre =
        time() . "_" .
        basename($_FILES['imagen']['name']);

        move_uploaded_file(
            $_FILES['imagen']['tmp_name'],
            "../assets/img/" . $imagenNombre
        );
    }

    mysqli_query(
        $conn,
        "UPDATE proyectos SET

        titulo='$titulo',
        descripcion='$descripcion',
        imagen='$imagenNombre',
        demo='$demo',
        github='$github'

        WHERE id=$id"
    );

    header("Location: proyectos.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Editar Proyecto</title>

<link rel="stylesheet"
href="../assets/css/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">
        Editar Proyecto
    </h2>

    <a href="proyectos.php"
       class="btn btn-secondary mb-4">

       Volver

    </a>

    <div class="card shadow">

        <div class="card-body">

            <form method="POST"
                  enctype="multipart/form-data">

                <div class="mb-3">

                    <label class="form-label">
                        Título
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
                        value="<?php echo htmlspecialchars($proyecto['titulo']); ?>"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Descripción
                    </label>

                    <textarea
                        name="descripcion"
                        class="form-control"
                        rows="4"
                        required><?php echo htmlspecialchars($proyecto['descripcion']); ?></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        URL Demo
                    </label>

                    <input
                        type="text"
                        name="demo"
                        class="form-control"
                        value="<?php echo htmlspecialchars($proyecto['demo']); ?>">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        URL GitHub
                    </label>

                    <input
                        type="text"
                        name="github"
                        class="form-control"
                        value="<?php echo htmlspecialchars($proyecto['github']); ?>">

                </div>

                <!-- IMAGEN ACTUAL -->

                <div class="mb-3">

                    <label class="form-label">
                        Imagen Actual
                    </label>

                    <br>

                    <?php if(!empty($proyecto['imagen'])){ ?>

                    <img
                    src="../assets/img/<?php echo $proyecto['imagen']; ?>"
                    width="220"
                    class="img-fluid rounded shadow">

                    <?php } else { ?>

                    <p>No hay imagen subida.</p>

                    <?php } ?>

                </div>

                <!-- NUEVA IMAGEN -->

                <div class="mb-3">

                    <label class="form-label">
                        Cambiar Imagen
                    </label>

                    <input
                    type="file"
                    name="imagen"
                    class="form-control">

                </div>

                <button
                    type="submit"
                    name="actualizar"
                    class="btn btn-success">

                    Actualizar Proyecto

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>