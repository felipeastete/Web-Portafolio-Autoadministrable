<?php

include("config/conexion.php");

$nombre = mysqli_real_escape_string(
    $conn,
    $_POST['nombre']
);

$correo = mysqli_real_escape_string(
    $conn,
    $_POST['correo']
);

$asunto = mysqli_real_escape_string(
    $conn,
    $_POST['asunto']
);

$mensaje = mysqli_real_escape_string(
    $conn,
    $_POST['mensaje']
);

mysqli_query(
    $conn,
    "INSERT INTO contactos
    (nombre, correo, asunto, mensaje)
    VALUES
    (
        '$nombre',
        '$correo',
        '$asunto',
        '$mensaje'
    )"
);

header("Location: index.php?enviado=1");

exit();