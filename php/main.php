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

function conexion(){
    $pdo = new PDO('mysql:host=localhost;dbname=inventario', 'root', '');
    return $pdo;

}
?>