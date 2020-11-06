<? 
/***********************************************
 * process.php
 *   
 *  26/10/2020: V1.0
 *
 * Procesos:
 *  Procesar formulario
 * 
 * Inputs:
 *  POST data
 * 
 **************************************************/
  
include("../include/session.php");

$error  = 0;        // Nº total errores
$error2 = array();  // Campos con errores
$error3 = array();  // Literales de errores
$message = '';  

// Capturar datos del form
$form_data  = json_decode(file_get_contents("php://input"));
$action     = $form_data->action;

$id         = $form_data->id;
$first_name = $form_data->first_name;
$last_name  = $form_data->last_name;

// Limpiar valores antes de Inserts/Update
$first_name =  $database->escape_str($form_data->first_name); 
$last_name  =  $database->escape_str($form_data->last_name); 

//////////////
// ACCIONES //
//////////////


// Insertar registro
if($action == 'Insert') {
            
    // Validar
    if(empty($first_name)){
        $error++;
        $error2["first_name"] = 1;
        array_push($error3, 'Nombre obligatorio');
    }

    if(empty($last_name)){
        $error++;
        $error2["last_name"] = 1;
        array_push($error3, 'Apellido obligatorio');
    }

    if(!$error3){
        $q = "INSERT INTO tbl_sample (first_name, last_name, foto) VALUES ('$first_name', '$last_name','noFoto.png')";
        $resultado = $database->dbQuery($q);	 
        if($resultado){
            $message .= ' Datos añadidos';
        }else{           
            array_push($error3, "Error ejecutando $q ");
        }
    }
}


// Editar registro
if($action == 'Edit') {
            
    // Validar
    if(empty($first_name)){
        $error++;
        $error2["first_name"] = 1;
        array_push($error3, "Nombre obligatorio");
    }

    if(empty($last_name)){
        $error++;
        $error2["last_name"] = 1;
        array_push($error3, "Apellido obligatorio");
    }

    if(!$error3){
        $q = "UPDATE tbl_sample SET first_name = '$first_name', last_name = '$last_name' WHERE id = $id";
        $resultado = $database->dbQuery($q);	 
        if($resultado){
            $message = 'Datos Modificados';
        }else{
            array_push($error3, "Error ejecutando $q ");
        }
    }
}


// Delete registro  
if($action == 'Delete') {
    $q = "DELETE FROM tbl_sample WHERE id=$id";
    $resultado = $database->dbQuery($q);	 
    if($resultado){
        $message = 'Registro Eliminado';
    }else{
        $error++;
        array_push($error3, "Error ejecutando $q ");
    }
}


// Borrar foto
if($action == 'borraFoto') {    
    $q="SELECT * from tbl_sample WHERE id = $id";    
    $rec = $database->getQuery($q);
	$deleteFile = $rec[0]['foto'];
    
    $q = "UPDATE tbl_sample SET foto = 'noFoto.png' WHERE id = $id";
    $resultado = $database->dbQuery($q);	 
    if($resultado){
        if($deleteFile <> "nofoto,png") unlink("../data/users/$deleteFile");
        $message = "Foto Borrada";
    }else{
        $error++;
        array_push($error3, "Error ejecutando $q ");
    }
}



// Montar mensajes de salida

 $output = array(   
  'message' => $message,
  'error' => $error
 );
  
$output["error2"] = $error2;
$output["error3"] = $error3;

echo json_encode($output);

?>