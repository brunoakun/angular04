<? 

//Leer datos.php

include("../include/session.php");

$q = "SELECT * FROM tbl_sample ORDER BY id";
$nomList = $database->getQuery($q);	

if ($nomList){
    foreach($nomList as $rec){		    
        $data[] = $rec;
    }
}

echo json_encode($data);
?>