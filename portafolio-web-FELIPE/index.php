<?php

include("config/conexion.php");

$proyectos = mysqli_query(
$conn,
"SELECT * FROM proyectos ORDER BY id DESC"
);

$bio = mysqli_query(
$conn,
"SELECT * FROM biografia WHERE id=1"
);

$datosBio = mysqli_fetch_assoc($bio);

?>

<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Portafolio Profesional
</title>

<!-- CSS -->

<link rel="stylesheet"
href="assets/CSS/style.css">

<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- FontAwesome -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<!-- AOS -->

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css"
rel="stylesheet">

</head>

<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar navbar-expand-lg sticky-top">

<div class="container">

<a class="navbar-brand fw-bold d-flex align-items-center"
href="#">

<span class="logo-circle me-2">
PF
</span>

Portafolio

</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div class="collapse navbar-collapse"
id="menu">

<ul class="navbar-nav mx-auto">

<li class="nav-item">
<a class="nav-link"
href="#biografia">
Biografía
</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="#habilidades">
Habilidades
</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="#tecnologias">
Tecnologías
</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="#proyectos">
Proyectos
</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="#contacto">
Contacto
</a>
</li>

</ul>

<a href="login.php"
class="btn-login">

Inicio de Sesión

</a>

</div>

</div>

</nav>

<!-- =========================
     HERO
========================= -->

<section id="biografia"
class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-4 text-center"
data-aos="fade-right">

<img
src="assets/img/usuario44.png"
class="avatar">

</div>

<div class="col-lg-8"
data-aos="fade-left">

<h1>

<?php echo $datosBio['nombre']; ?>

</h1>

<h3>

<?php echo $datosBio['titulo']; ?>

</h3>

<p class="lead">

<?php echo $datosBio['descripcion']; ?>

</p>

</div>

</div>

</div>

</section>

<!-- =========================
     HABILIDADES
========================= -->

<section id="habilidades"
class="skills-section py-5">

<div class="container">

<h2 class="skills-title">

Habilidades y Herramientas

</h2>

<p class="skills-subtitle">

Tecnologías que domino y utilizo en mis proyectos

</p>

<div class="row g-4">

<?php

$habilidades = mysqli_query(
$conn,
"SELECT * FROM habilidades"
);

while($hab = mysqli_fetch_assoc($habilidades)){

?>

<div class="col-lg-3 col-md-6"
data-aos="zoom-in">

<div class="skill-card">

<div class="icon-box">

<?php if($hab['icono'] == 'fa-database'){ ?>

<i class="fa-solid fa-database"></i>

<?php } elseif($hab['icono'] == 'fa-code'){ ?>

<i class="fa-solid fa-code"></i>

<?php } else { ?>

<i class="fa-brands <?php echo $hab['icono']; ?>"></i>

<?php } ?>

</div>

<h5>

<?php echo $hab['nombre']; ?>

</h5>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<!-- =========================
     TECNOLOGÍAS
========================= -->

<section id="tecnologias">

<div class="container py-5">

<h2 class="section-title mb-5">

Tecnologías Dominadas

</h2>

<?php

$tecnologiasIndex = mysqli_query(
$conn,
"SELECT * FROM tecnologias ORDER BY porcentaje DESC"
);

while($tec = mysqli_fetch_assoc($tecnologiasIndex)){

?>

<div class="tech-box"
data-aos="fade-up">

<p class="fw-bold">

<?php echo $tec['nombre']; ?>

</p>

<div class="progress">

<div class="progress-bar"
style="width: <?php echo $tec['porcentaje']; ?>%">

<?php echo $tec['porcentaje']; ?>%

</div>

</div>

</div>

<?php } ?>

</div>

</section>

<!-- =========================
     PROYECTOS
========================= -->

<section id="proyectos">

<div class="container py-5">

<h2 class="section-title mb-5">

Proyectos

</h2>

<div class="row g-4">

<?php while($fila = mysqli_fetch_assoc($proyectos)){ ?>

<div class="col-lg-4 col-md-6"
data-aos="flip-left">

<div class="card project-card h-100">

<?php if(!empty($fila['imagen'])){ ?>

<img
src="assets/img/<?php echo $fila['imagen']; ?>"
class="card-img-top">

<?php } else { ?>

<div class="project-placeholder"></div>

<?php } ?>

<div class="card-body">

<h5 class="card-title">

<?php echo htmlspecialchars($fila['titulo']); ?>

</h5>

<p class="card-text">

<?php echo htmlspecialchars($fila['descripcion']); ?>

</p>

</div>

<div class="card-footer">

<?php if(!empty($fila['demo'])){ ?>

<a href="<?php echo $fila['demo']; ?>"
target="_blank"
class="btn btn-primary btn-sm">

Demo

</a>

<?php } ?>

<?php if(!empty($fila['github'])){ ?>

<a href="<?php echo $fila['github']; ?>"
target="_blank"
class="btn btn-dark btn-sm">

GitHub

</a>

<?php } ?>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<!-- =========================
     CONTACTO
========================= -->

<section id="contacto">

<div class="container py-5">

<h2 class="section-title mb-5">

Contacto

</h2>

<div class="contact-card"
data-aos="zoom-in">

<form
action="guardar_contacto.php"
method="POST"
id="contactForm">

<div class="mb-3">

<input
type="text"
name="nombre"
class="form-control"
placeholder="Nombre"
required>

</div>

<div class="mb-3">

<input
type="email"
name="correo"
class="form-control"
placeholder="Correo"
required>

</div>

<div class="mb-3">

<input
type="text"
name="asunto"
class="form-control"
placeholder="Asunto"
required>

</div>

<div class="mb-3">

<textarea
name="mensaje"
class="form-control"
rows="5"
placeholder="Mensaje"
required></textarea>

</div>

<button
type="submit"
class="btn btn-primary">

Enviar Mensaje

</button>

</form>

</div>

</div>

</section>

<!-- =========================
     FOOTER
========================= -->

<footer class="text-center">

© 2026 Felipe Andres Astete Vásquez

</footer>

<!-- BOTÓN TOP -->

<button id="btnTop">

<i class="fa-solid fa-arrow-up"></i>

</button>

<!-- Bootstrap -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS -->

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<!-- JS -->

<script src="assets/js/main.js"></script>

</body>
</html>
```
