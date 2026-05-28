<?php

$host = "localhost";
$user = "fastete2025";
$password = "fastete2025LdF6x9";
$db = "fastete2025_db2";

$conn = mysqli_connect($host, $user, $password, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

?>