<?php
// Establecer el título
$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

// Obtiene el nombre del host
$host = $_SERVER['HTTP_HOST'];

// Construye la URL base
$base_url = $scheme . $host . '/';

// Muestra la URL base
$ruta = $base_url.'webaranda/';

$server_root = $_SERVER['DOCUMENT_ROOT'] . '/webaranda/';


$title = "Inicio";
// Contenido del cuerpo de la página
ob_start();
?>
<link rel="stylesheet" href="<?= $ruta ?>Assets/css/inicio/inicio.css">
<?php
$css = ob_get_clean(); // Guarda el contenido

// Modals
ob_start();
?>
<div class="row">
    <div class="col-12">
        <hr>
    </div>
    <div class="col-6 col-md-3 pubPrincipal">
        <a href=""> <img src="<?=$ruta?>Assets/img/inicio/Pag_DM.jpg" alt=""> </a>
    </div>
    <div class="col-6 col-md-3 pubPrincipal">
        <a href=""> <img src="<?=$ruta?>Assets/img/inicio/Pag_PM.jpg" alt=""> </a>
    </div>
    <div class="col-6 col-md-3 pubPrincipal">
        <a href=""> <img src="<?=$ruta?>Assets/img/inicio/Pag_Lab.jpg" alt=""> </a>
    </div>
    <div class="col-6 col-md-3 pubPrincipal">
        <a href="../DirectorioServ"> <img src="<?=$ruta?>Assets/img/inicio/Pag_DMS.jpg" alt=""> </a>
    </div>
    <br>
    <div class="col-md-12 col-lg-12 col-xs-12">
        <h1 class="tituloP text-center">
            Promociones del Mes <br>
            <div class="smallP text-center">
                Conoce nuestras promociones solo aquí en el Hospital Aranda de la Parra.
            </div>
        </h1>
    </div>
    <br>
    <div class="col-6 col-md-4 align-self-center pubPrincipal">
        <a href=""> <img src="<?=$ruta?>Assets/img/inicio/PRO_1.jpg" alt=""> </a>
    </div>
    <div class="col-6 col-md-4 pubPrincipal">
        <a href=""> <img src="<?=$ruta?>Assets/img/inicio/PRO_2.jpg" alt=""> </a>
    </div>
    <div class="col-6 col-md-4 pubPrincipal">
        <a href=""> <img src="<?=$ruta?>Assets/img/inicio/PRO_3.jpg" alt=""> </a>
    </div>
    <br>
    <div class="col-md-12 col-lg-12 col-xs-12">
        <h1 class="tituloP text-center">
            Ubícanos <br>
            <div class="smallP text-center">
                Ubíca nuestros hospitales en el Hospital Aranda de la Parra.
            </div>
        </h1>
    </div>
    <br>
    <div class="col">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.673155053041!2d-101.68416112415683!3d21.125592984444456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842bbf0cfb3510db%3A0x4f041cca7c9d6540!2sHospital%20Aranda%20de%20la%20Parra!5e0!3m2!1ses!2smx!4v1721504228083!5m2!1ses!2smx"
            allowfullscreen=""
            loading="lazy"
            class="maps"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    <div class="col">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.703146239676!2d-101.51236282415911!3d21.00453338860913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842bbfe14760a229%3A0xc62ebd01d6238c0e!2sHospital%20Aranda%20de%20la%20Parra%20Puerto%20Interior!5e0!3m2!1ses!2smx!4v1721504467772!5m2!1ses!2smx"
            allowfullscreen=""
            loading="lazy"
            class="maps"
            referrerpolicy="no-referrer-when-downgrade">

        </iframe>
    </div>
    <br>
</div>

<?php
$content = ob_get_clean(); // Guarda el contenido

// Modals
ob_start();
?>
<?php
$modals = ob_get_clean(); // Guarda el contenido de los modales

// Scripts adicionales
ob_start();
?>
<script src="<?= $ruta ?>Assets/js/inicio/inicio.js"></script>
<?php
$js = ob_get_clean(); // Guarda los scripts
// Incluir la plantilla principal
include $server_root . 'index.php';
