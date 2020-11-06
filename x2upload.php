<?

// Upload foto    

$id = $_POST['id'];

$error =  array();
$message = '';  

// check file is upload
if(!empty($_FILES['file'])){
    $get_files = pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);
        $image_data = time().'.'.$get_files;
        $aux=move_uploaded_file($_FILES["file"]["tmp_name"], 'data/users/'.$image_data);
        if($aux){             
            $message= $image_data." Foto uploaded ";          
            
            $q = "UPDATE tbl_sample SET foto = '$image_data' WHERE id = $id";
            $resultado = $database->dbQuery($q);	 
            if($resultado){
                $message = 'Foto Modificada';
            }else{
                $error.=" Error ejecutando $q ";
                array_push($error, "Error ejecutando $q ");
            }
        }else{
            array_push($error, "No se ha podido subir la foto");
        }
}else{    
    array_push($error, "Invalid or Empty File/Format");
}
// Montar mensajes de salida

$output = array(
    'message' => $message
);
$output["error"] = $error;  

echo json_encode($output);

?>