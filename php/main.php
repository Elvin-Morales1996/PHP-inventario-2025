<?php
/*
en el archivo  main.php se va a encontrar funciones ejemplo
- conectarse a la base de datos
- evitar inyecciones sql
*/
/*
new PDO(...): Crea un nuevo objeto PDO para conectarse a la base de datos. 
mysql:host=localhost;dbname=inventario': Especifica que se usará MySQL y define los datos de conexión:
mysql: Indica que la base de datos es MySQL.
host=localhost: El servidor de la base de datos está en la misma máquina (localhost).
dbname=inventario: Se conectará a la base de datos llamada "inventario".
'root': Es el nombre de usuario de la base de datos (por defecto en XAMPP y MAMP).
'': Es la contraseña (vacía en XAMPP por defecto).
 Ventajas de usar PDO
Soporta múltiples motores de bases de datos (MySQL, PostgreSQL, SQLite, etc.).
Permite uso de consultas preparadas para evitar inyecciones SQL.
Es más seguro y flexible que mysqli.

*/

//conexion a la base de datos usando PDO
function conexion(){
    $pdo = new PDO('mysql:host=localhost;dbname=inventario', 'root', '');
    return $pdo;

}


//VALIDAR FORMULARIOS con EXPRESIONES REGULARES
function verificar_datos($filtro, $cadena){
    /**$filtro: Es la expresión regular que define el formato permitido.
    $cadena: Es el texto que se validará.
    preg_match("/^".$filtro."$/", $cadena): Compara la cadena con el filtro.
^ y $ aseguran que toda la cadena debe cumplir el filtro.
Si cumple la expresión, devuelve false (porque la validación es correcta).
Si no cumple, devuelve true (porque la validación falla).
 */

 /**Expresión regular [a-zA-Z]{5,10}

Solo permite letras mayúsculas y minúsculas (a-zA-Z).
Debe tener entre 5 y 10 caracteres.
$nombre = "el"; → "el" tiene solo 2 caracteres, por lo que NO cumple la validación.

verificar_datos() devuelve true, entonces se muestra "Nombre no válido". */
    if (preg_match("/^".$filtro."$/", $cadena)) {
        return false;
    }else{
        return true;
    }
}




?>