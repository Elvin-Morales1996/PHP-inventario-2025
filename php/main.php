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

//funcion para evitar inyecciones sql
function limpiar_cadena($cadena){
    $cadena=trim($cadena); // Elimina espacios en blanco al inicio y al final.
    $cadena=stripslashes($cadena); // Elimina barras invertidas.
    $cadena=str_ireplace("<script>", "", $cadena); // Elimina la etiqueta <script>.
    $cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
        /**
         * Se vuelven a ejecutar para asegurarse de que no queden caracteres sospechosos.
        *   Finalmente, la función devuelve la cadena limpia.
 */
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;

}



//funcion para renombrar fotos
function renombrar_fotos($nombre){
	$nombre=str_ireplace(" ", "_", $nombre);
	$nombre=str_ireplace("/", "_", $nombre);
	$nombre=str_ireplace("#", "_", $nombre);
	$nombre=str_ireplace("-", "_", $nombre);
	$nombre=str_ireplace("$", "_", $nombre);
	$nombre=str_ireplace(".", "_", $nombre);
	$nombre=str_ireplace(",", "_", $nombre);
	$nombre = $nombre."_".rand(0, 100);
	return $nombre;

}


	# Funcion paginador de tablas #
	function paginador_tablas($pagina,$Npaginas,$url,$botones){
		$tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

		if($pagina<=1){
			$tabla.='
			<a class="pagination-previous is-disabled" disabled >Anterior</a>
			<ul class="pagination-list">';
		}else{
			$tabla.='
			<a class="pagination-previous" href="'.$url.($pagina-1).'" >Anterior</a>
			<ul class="pagination-list">
				<li><a class="pagination-link" href="'.$url.'1">1</a></li>
				<li><span class="pagination-ellipsis">&hellip;</span></li>
			';
		}

		$ci=0;
		for($i=$pagina; $i<=$Npaginas; $i++){
			if($ci>=$botones){
				break;
			}
			if($pagina==$i){
				$tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'">'.$i.'</a></li>';
			}else{
				$tabla.='<li><a class="pagination-link" href="'.$url.$i.'">'.$i.'</a></li>';
			}
			$ci++;
		}

		if($pagina==$Npaginas){
			$tabla.='
			</ul>
			<a class="pagination-next is-disabled" disabled >Siguiente</a>
			';
		}else{
			$tabla.='
				<li><span class="pagination-ellipsis">&hellip;</span></li>
				<li><a class="pagination-link" href="'.$url.$Npaginas.'">'.$Npaginas.'</a></li>
			</ul>
			<a class="pagination-next" href="'.$url.($pagina+1).'" >Siguiente</a>
			';
		}

		$tabla.='</nav>';
		return $tabla;
	}


?>