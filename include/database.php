
<?
/**
 * Database.php
 *
 * Verión PHP 7.x
 * 
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 */
 

include("constants.php");

/* Create database connection */
$database = new MySQLDB;
      
class MySQLDB
{
   var $connection;         //The MySQL database connection

   /* Class constructor */
   //function MySQLDB(){
    function __construct(){
        /* Make connection to database */
        $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_connect_error());
        mysqli_set_charset($this->connection, 'utf8');
        mysqli_select_db( $this->connection, DB_NAME) or die(mysqli_connect_error());
     }
  

    /**
    * escape_str - Escapa carateres especiales 
    * Antes de Inserts y Updates
    */
    function escape_str($str){
		$result = mysqli_real_escape_string($this->connection, $str);
		return $result;
   }
   
   
   /**
   * dbQuery - mysql QUERY SIN RETORNO DE VALORES
   * query asking for GENERICO
   */
  function dbQuery($q){
     $result = mysqli_query($this->connection, $q);
     return $result;
  }
   

   /**
    * getQuery - Returns the result array from a mysql QUERY
    * query asking for GENERICO
    */
   function getQuery($q){
      $result = mysqli_query($this->connection, $q);
      if(!$result || (mysqli_num_rows($result) < 1)){
         return NULL;
      } 
	  $dbarray=array();		//* Return result array
	  while ($row = mysqli_fetch_array($result)) {
        array_push($dbarray, $row);
      }
      return $dbarray;
   }
   

}

?>   
      