/* =========================================
   PORTAFOLIO FELIPE - JAVASCRIPT
========================================= */

/* SCROLL SUAVE NAVBAR */

document.querySelectorAll('a[href^="#"]').forEach(anchor => {

    anchor.addEventListener('click', function(e){

        e.preventDefault();

        document.querySelector(
            this.getAttribute('href')
        ).scrollIntoView({
            behavior:'smooth'
        });

    });

});

/* BOTÓN VOLVER ARRIBA */

const btnTop =
document.getElementById("btnTop");

window.addEventListener("scroll", function(){

    if(window.scrollY > 300){

        btnTop.style.display = "flex";

    }else{

        btnTop.style.display = "none";

    }

});

btnTop.addEventListener("click", function(){

    window.scrollTo({
        top:0,
        behavior:'smooth'
    });

});

/* VALIDACIÓN CONTACTO */

const contactoForm =
document.querySelector("#contactForm");

if(contactoForm){

    contactoForm.addEventListener("submit", function(e){

        const correo =
        document.querySelector(
            'input[name="correo"]'
        ).value;

        if(!correo.includes("@")){

            alert("Ingrese un correo válido");

            e.preventDefault();

        }

    });

}

/* ANIMACIONES AOS */

AOS.init({
    duration:1000,
    once:true
});