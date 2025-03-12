<?php include "./inc/session_start.php";  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "./inc/head.php";?>
</head>
<body >
<?php
/*Si no se envía ?vista=alguna_pagina en la URL, por defecto se carga "login".
Por ejemplo, si el usuario accede a index.php sin parámetros, se asigna $_GET['vista'] = "login". */
if (!isset($_GET['vista'])|| $_GET['vista']=="") {
    $_GET['vista']="login";
  
}


/*is_file("./vistas/".$_GET['vista'].".php") verifica si el archivo existe en la carpeta vistas/.
Evita incluir login.php y 404.php dentro de este bloque, ya que esas vistas se manejan aparte.
Si la vista existe y no es "login" ni "404", se cargan navbar.php, la vista solicitada y los scripts */
if (is_file("./vistas/".$_GET['vista'].".php") && $_GET['vista']!="login" && $_GET['vista']!="404") {
    include "./inc/navbar.php";
    include "./vistas/".$_GET['vista'].".php";
    include "./inc/script.php";
}else{
    /*Si en la URL está ?vista=login, solo se carga login.php sin navbar ni scripts adicionales.
 */
    if ($_GET['vista']=="login") {
        include "./vistas/login.php";
    }else{
        /*Si el archivo solicitado no existe en vistas/, se muestra la página de error 404.php. */
        include "./vistas/404.php";
    }
}


?>
    
</body>
</html>