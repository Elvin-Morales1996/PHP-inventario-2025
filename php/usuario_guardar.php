<?php

/**vamos a crear variables donde van almacenar
 * los campo input que digita el usuario y vamos hacer validaciones
 */

//requiere el archivo main donde estan las funciones que validan datos
include_once 'main.php';    

//crear variables
$nombre =  limpiar_cadena($_POST['usuario_nombre']);
$apellido =  limpiar_cadena($_POST['usuario_apellido']);
$usuario =  limpiar_cadena($_POST['usuario_usuario']);
$email=  limpiar_cadena($_POST['usuario_email']);
$clave_1 = limpiar_cadena($_POST['usuario_clave_1']);
$clave_2 =  limpiar_cadena($_POST['usuario_clave_2']);

//if que valida que cuando un campo venga vacio
//cuando quieren hakear y quitar el required
if($nombre == '' || $apellido == '' || $usuario == '' || $email == '' || $clave_1 == '' || $clave_2 == ''){

    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    No has llenado todos los campos que son obligatorios
    </div>';
    exit(); //para que no siga ejecutando
}




?>