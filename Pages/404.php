<?php
$scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

// Obtiene el nombre del host
$host = $_SERVER['HTTP_HOST'];

// Construye la URL base
$base_url = $scheme . $host . '/';

// Muestra la URL base
$server_root = $base_url . 'webaranda/';

?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">	
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
	<link rel="stylesheet" href="<?=$server_root?>Assets/css/errors/404.css">
</head>
<body>
  <section>
    <div class="container">
      <div class="text">
        <h1>Error 404</h1>
        <a href="<?=$server_root?>" ><p >Regresa a <span class="boton"> INICIO</span>, ya que esta pagina no fue encontrada.</p></a>
      </div>
      <div><img class="image" src="https://omjsblog.files.wordpress.com/2023/07/errorimg.png" alt=""></div>
    </div>
    </div>
  </section>
</body>
</html>