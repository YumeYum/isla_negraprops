<?php
include 'config/database.php';
 
try {
     
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: No se encontró registro');
 
    $query = "DELETE FROM viviendas WHERE id = ?";
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute()){
        header('Location: index.php?action=deleted');
    }else{
        die('No se puede eliminar registro');
    }
}
 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>