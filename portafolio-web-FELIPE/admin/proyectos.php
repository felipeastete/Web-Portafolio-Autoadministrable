
<?php

session_start();


if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/conexion.php");

/* ELIMINAR PROYECTO */
if (isset($_GET['eliminar'])) {

    $id = intval($_GET['eliminar']);

    mysqli_query($conn, "DELETE FROM proyectos WHERE id = $id");

    header("Location: proyectos.php");
    exit();
}

/* AGREGAR PROYECTO */
if (isset($_POST['guardar'])) {

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

 $imagenNombre = "";

if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0){

    $carpetaDestino =
    "/home/fastete2025/public_html/portafolio-web-FELIPE/assets/img/";

    $imagenNombre =
    time() . "_" .
    basename($_FILES['imagen']['name']);

    $rutaCompleta =
    $carpetaDestino . $imagenNombre;

    if(move_uploaded_file(
        $_FILES['imagen']['tmp_name'],
        $rutaCompleta
    )){

        echo "IMAGEN SUBIDA OK";

    }else{

        echo "ERROR AL SUBIR";

    }

}
    $sql = "INSERT INTO proyectos
            (titulo, descripcion, imagen, demo, github)
            VALUES
            (
            '$titulo',
            '$descripcion',
            '$imagenNombre',
            '$demo',
            '$github'
            )";

    mysqli_query($conn, $sql);

    header("Location: proyectos.php");
    exit();
}
$proyectos = mysqli_query($conn, "SELECT * FROM proyectos ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Proyectos</title>
    
    <link rel="stylesheet" href="assets/CSS/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Administrar Proyectos</h2>

        <a href="dashboard.php" class="btn btn-secondary">
            Volver al Dashboard
        </a>

    </div>

    <!-- FORMULARIO -->

    <div class="card shadow mb-4">

        <div class="card-header bg-primary text-white">

            Nuevo Proyecto

        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">

                    <label class="form-label">
                        Título
                    </label>

                    <input
                        type="text"
                        name="titulo"
                        class="form-control"
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
                        required></textarea>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        URL Demo
                    </label>

                    <input
                        type="text"
                        name="demo"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        URL GitHub
                    </label>

                    <input
                        type="text"
                        name="github"
                        class="form-control">

                </div>

                <div class="mb-3">

                     <label>Imagen del Proyecto</label>

                    <input
                    type="file"
                    name="imagen"
                    class="form-control">

                </div>

                <button
                    type="submit"
                    name="guardar"
                    class="btn btn-success">

                    Guardar Proyecto

                </button>

            </form>

        </div>

    </div>

    <!-- TABLA -->

    <div class="card shadow">

        <div class="card-header">

            Lista de Proyectos

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                    <tr>

                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Demo</th>
                        <th>GitHub</th>
                        <th>Acciones</th>

                    </tr>

</thead>

                    <tbody>

                        <?php while($fila = mysqli_fetch_assoc($proyectos)) { ?>

                        <tr>

                            <tr>

                            <td><?php echo $fila['id']; ?></td>

                            <td>

                               <?php if(!empty($fila['imagen'])){ ?>

                               <img
                               src="../assets/img/<?php echo $fila['imagen']; ?>"
                               width="100">

                               <?php } ?>

                            </td>

                            <td><?php echo htmlspecialchars($fila['titulo']); ?></td>

                            <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>

                            <td><?php echo htmlspecialchars($fila['titulo']); ?></td>

                            <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>

                            <td>

                                <?php if(!empty($fila['demo'])) { ?>

                                    <a href="<?php echo $fila['demo']; ?>" target="_blank">
                                        Ver Demo
                                    </a>

                                <?php } ?>

                            </td>

                            <td>

                                <?php if(!empty($fila['github'])) { ?>

                                    <a href="<?php echo $fila['github']; ?>" target="_blank">
                                        GitHub
                                    </a>

                                <?php } ?>

                            </td>

                            <td>

                                <td>

                                    <a href="editar_proyecto.php?id=<?php echo $fila['id']; ?>"
                                     class="btn btn-warning btn-sm">

                                     Editar

                                    </a>

                                    <a href="proyectos.php?eliminar=<?php echo $fila['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Eliminar proyecto?')">

                                    Eliminar

                                     </a>

                                </td>

                            </td>

                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>