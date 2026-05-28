<?php

session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h1>
        Bienvenido <?php echo $_SESSION['nombre']; ?>
    </h1>

    <hr>

    <div class="row">

        <div class="col-md-3">

            <div class="list-group">

                <a href="dashboard.php"
                   class="list-group-item list-group-item-action">

                   Dashboard

                </a>

                <a href="proyectos.php"
                   class="list-group-item list-group-item-action">

                   Proyectos

                </a>

                <a href="tecnologias.php"
                   class="list-group-item list-group-item-action">

                    Tecnologías

                </a>

                <a href="habilidades.php"
                    class="list-group-item list-group-item-action">

                    Habilidades

                </a>
                
                <a href="biografia.php"
                   class="list-group-item list-group-item-action">

                   Biografía

                </a>
                <a href="contactos.php"
                    class="list-group-item list-group-item-action">

                   Mensajes de Contacto

                </a>

                <a href="../logout.php"
                   class="list-group-item list-group-item-action text-danger">

                   Cerrar Sesión

                </a>

            </div>

        </div>

        <div class="col-md-9">

            <div class="card">

                <div class="card-body">

                    <h3>Panel Administrativo</h3>

                    <p>
                        Bienvenido al sistema de administración del portafolio.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>