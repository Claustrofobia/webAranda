<?php
$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

// Obtiene el nombre del host
$host = $_SERVER['HTTP_HOST'];

// Construye la URL base
$base_url = $scheme . $host . '/';

// Muestra la URL base
$server_root = $base_url . 'webaranda/';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="<?= $server_root ?>Assets/img/Generales/HAP.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <title>HAP / <?php echo isset($title) ? $title : ''; ?></title>
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/js/datatables-1.13.4/jquery.dataTables.min.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/js/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/css/util.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/js/sweetalert/sweetalert2.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/js/fontawesome-6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/js/animate-css/animatecss.css" />
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/css/modal.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/css/select2.min.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/css/loader.css">
    <link rel="stylesheet" href="<?= $server_root ?>Plugins/js/bootstrap-5.0.2/css/bootstrap.min.css">
    <style>
        @font-face {
            font-family: 'roboto';
            src: url('<?= $server_root ?>Assets/fonts/Roboto/Roboto-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'roboto', sans-serif;
        }
    </style>
    <?php if (isset($css)): ?>
        <?php echo $css; // Aquí se incluirá CSS adicional 
        ?>
    <?php endif; ?>
</head>

<body>
    <!-- MENU -->
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-xs-12 text-center logo">
                <img src="<?= $server_root ?>Assets/img/Generales/HAP85N.png" alt="" width="120px;">
            </div>
            <div class="col-12 col-sm-12 col-lg-10 col-xs-12 mt-5 text-center menu">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <span class="navbar-brand"></span>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Hospitales</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="#">Servicios</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Más del Hospital
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Admisión Hospitalaria</a></li>
                                        <li><a class="dropdown-item" href="#">Banco de Sangre</a></li>
                                        <li><a class="dropdown-item" href="#">Certificaciones</a></li>
                                        <li><a class="dropdown-item" href="#">Credencialización</a></li>
                                        <li><a class="dropdown-item" href="#">Historia</a></li>
                                        <li><a class="dropdown-item" href="#">Publicaciones</a></li>
                                        <li><a class="dropdown-item" href="#">Tecnología</a></li>
                                        <li><a class="dropdown-item" href="#">Aviso de Privacidad</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Directorio Médico</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contacto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Facturación</a>
                                </li>
                            </ul>
                            <form class="d-flex">
                                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Buscar</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Contenido principal -->
        <?php if (isset($content)): ?>
            <?php echo $content; // Aquí se incluirá el contenido de la página 
            ?>
        <?php endif; ?>
    </div>
    <!-- FOOTER  -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 footer">
                <p>
                    El Hospital Aranda De la Parra, durante su proceso de certificación,
                    no ha sido auspiciado o patrocinado por algún despacho, gabinete o firma,
                    por lo que no autoriza para que su nombre, logotipo y marca sean utilizados
                    por persona alguna como publicidad o sugestión para patrocinar o asesorar
                    en la certificación a otras instituciones de salud. A la vez, se deslinda
                    de cualquier publicidad y sugestión en la que a través del uso de su nombre,
                    marca y logotipo se pretenda convencer a otras instituciones de salud a
                    someterse a un procedimiento de certificación. <br> Para más información pulsa
                    <a href="" class="btn"> AQUÍ </a>
                </p>
            </div>
            <div class="col-lg-4 footer izquierda">
                <a class="social" href=""><img src="<?= $server_root ?>Assets/img/Generales/sf.svg" alt="facebook" width="36px;"></a>
                <a class="social" href=""><img src="<?= $server_root ?>Assets/img/Generales/si.svg" alt="facebook" width="36px;"></a>
                <a class="social" href=""><img src="<?= $server_root ?>Assets/img/Generales/sx.svg" alt="facebook" width="36px;"></a>
                <a class="social" href=""><img src="<?= $server_root ?>Assets/img/Generales/sy.svg" alt="facebook" width="36px;"></a>
                <br><br>
                <a href=""> www.arandadelaparra.com.mx </a>
                <br>
                Toda la vida contigo
                <br>
                Urgencias: 01 [477] 7197101
                <br>
                Hospital: 01 [477] 7197100
                <br>
                Hidalgo 329, Centro, 37000 León, Gto México
                <br>
                © 2017 Hospital Aranda de la Parra
            </div>
        </div>
    </div>

    <!-- Modals -->
    <?php if (isset($modals)): ?>
        <?php echo $modals; // Aquí se incluirán los modales 
        ?>
    <?php endif; ?>

    <!-- LOADER -->
    <div id="openModal3" class="modalDialog3">
        <div>
            <div class="container" style="max-width: 400px;">
                <div class="CargaContent" id="cookiesPopup" style="justify-content: flex-start; padding-top: 20px;">
                    <img src="<?= $server_root ?>Assets/img/Generales/HAP85N.png" alt="logo-img" style="width: 190px; margin-bottom: 30px;" />
                    <div class="absCenter">
                        <div class="loaderPill">
                            <div class="loaderPill-anim">
                                <div class="loaderPill-anim-bounce">
                                    <div class="loaderPill-anim-flop">
                                        <div class="loaderPill-pill"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="loaderPill-floor">
                                <div class="loaderPill-floor-shadow"></div>
                            </div>
                            <div class="loaderPill-text" style="font-size: 20px">Cargando</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts JS -->
    <script src="<?= $server_root ?>Plugins/js/jquery-3.7.1.min.js"></script>
    <script src="<?= $server_root ?>Plugins/js/datatables-1.13.4/jquery.dataTables.min.js"></script>
    <script src="<?= $server_root ?>Plugins/js/toastr/toastr.min.js"></script>
    <script src="<?= $server_root ?>Plugins/js/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= $server_root ?>Plugins/js/jquery-validation/additional-methods.js"></script>
    <script src="<?= $server_root ?>Plugins/js/sweetalert/sweetalert2.js" charset="UTF-8"></script>
    <script src="<?= $server_root ?>Plugins/js/fontawesome-6.4.0/js/all.min.js" charset="UTF-8"></script>
    <script src="<?= $server_root ?>Plugins/js/generales.js?ver=1.7" charset="UTF-8"></script>
    <script src="<?= $server_root ?>Plugins/js/bootstrap-5.0.2/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= $server_root ?>Plugins/js/popper.min.js"></script>
    <script src="<?= $server_root ?>Plugins/js/chartjs.min.js"></script>
    <script src="<?= $server_root ?>Plugins/js/bootstrap-5.0.2/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <?php if (isset($js)): ?>
        <?php echo $js; // Aquí se incluirán los scripts adicionales 
        ?>
    <?php endif; ?>
</body>

</html>