<?
/**
 * Session.php
 *
 * Versión php 7.x
 * 
 * The Session class is meant to simplify the task of keeping
 * track of logged in users and also guests.
 *
 */

 
#  Mostrar errores en tempo de ejecución:  #
 
// error_reporting(0);                             // Desactivar toda notificación de error
 error_reporting(E_ERROR | E_WARNING | E_PARSE);// Notificar solamente errores de ejecución
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);// Notificar E_NOTICE también puede ser bueno (para informar de variables no inicializadas o capturar errores en nombres de variables ...)
//error_reporting(E_ALL ^ E_NOTICE);// Notificar todos los errores excepto E_NOTICE
//error_reporting(E_ALL);// Notificar todos los errores de PHP (ver el registro de cambios)
//error_reporting(-1);// Notificar todos los errores de PHP




// Base de datos
include("database.php");



class Session
{
   var $username;     //Username given on sign-up
   var $userid;       //Random value generated on current login
   var $userlevel;    //The level to which the user pertains
   var $time;         //Time user was last active (page loaded)
   var $logged_in;    //True if user is logged in, false otherwise
   var $userinfo = array();  //The array holding all user info
   
   /* Class constructor */
   //function Session(){
   function __construct(){
      $this->time = time();
      $this->startSession();
   }

   /**
    * startSession - Performs all the actions necessary to 
    * initialize this session object. Tries to determine if the
    * the user has logged in already, and sets the variables 
    * accordingly. Also takes advantage of this page load to
    * update the active visitors tables.
    */
   function startSession(){
      global $database;  //The database connection
      session_start();   //Tell PHP to start the session
    }

}
?>