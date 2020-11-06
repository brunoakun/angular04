
<?
/**
 * Constants.php
 *
 * Fichero de configuración
 * Constantes definidas en la aplicación
 * Formato MAYUSCULAS espacios marcados como "_"
 *
 */
  

/**
 * Errores y avisos
 */
//error_reporting(E_ALL);											// DESARROLLO EXTRICTO 
//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ); 				// PRUEBAS
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING );		// PRODUCCION


/**
 * Constantes
 */
define("APP_TITLE", "CRUD angular JS");
 
/**
 * Parámetros de conexión al
 * Servidor MySQL. 
 */
include("connex.php");	// acceso a BBDD

?>