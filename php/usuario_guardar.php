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


//verificando sobre el formato de los campos para el nombre
if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $nombre)){
    
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    El Nombre no coencide con el formato requerido
    </div>';
    exit(); //para que no siga ejecutando
}

//validando formato apellido
if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}", $apellido)){
    
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    El Apellido no coencide con el formato requerido
    </div>';
    exit(); //para que no siga ejecutando
}

//validando formato usuario
if(verificar_datos("[a-zA-Z0-9]{4,20}", $usuario)){
    
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    El Usuario no coencide con el formato requerido
    </div>';
    exit(); //para que no siga ejecutando
}

//validando las dos claves
if(verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_1) || verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave_2)){
    
    echo '<div class="notification is-danger is-light">
    <strong>¡Ocurrio un error inesperado!</strong><br>
    La claves no coenciden con el formato requerido
    </div>';
    exit(); //para que no siga ejecutando
}

//validando formato del email y que no exita un email repetido
if ($email!="") {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $check_email=conexion();
        $check_email=$check_email->query("SELECT  usuario_email FROM usuario
        WHERE usuario_email='$email'");
        if ($check_email->rowCount()>0) {
            echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            el correo electronico ya se encuentra registrado por favor elija otro
            </div>';
            exit(); //para que no siga ejecutando
          
            
        }
        $check_email=null;
    }else{
        echo '<div class="notification is-danger is-light">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        El correo electronico no es valido
        </div 
        </div>';
        exit(); //para que no siga ejecutando

    }
}


















?>