<?php
session_start();
include("config/conexion.php");

$error = "";

if(isset($_POST['login'])){

    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM usuarios
            WHERE usuario='$usuario'
            AND password='$password'";

    $resultado = mysqli_query($conn,$sql);

    if(mysqli_num_rows($resultado) == 1){

        $fila = mysqli_fetch_assoc($resultado);

        $_SESSION['id'] = $fila['id'];
        $_SESSION['nombre'] = $fila['nombre'];

        header("Location: admin/dashboard.php");
        exit();

    }else{
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login</title>

<link rel="stylesheet" href="assets/CSS/style.css">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">

                    <h3>Iniciar Sesión</h3>

                </div>

                <div class="card-body">

                    <?php if($error != ""){ ?>

                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>

                    <?php } ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Usuario</label>
                            <input type="text"
                                   name="usuario"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label>Contraseña</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>
                        </div>

                        <button type="submit"
                                name="login"
                                class="btn btn-primary w-100">

                            Ingresar

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>