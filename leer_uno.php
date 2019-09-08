<!DOCTYPE HTML>
<html>
<head>
    <title>Detalles</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <?php include 'header.php';?>
 
</head>
<body>
 

    <div class="container">
  
        <div class="page-header">
            <h1>Leer Propiedad</h1>
        </div>
         
<?php

$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Registro no encontrado');
 

include 'config/database.php';
 

try {
    
    $query = "SELECT id, tipo, zona, direccion, ndormitorios, precio, tamano, extra, foto, observaciones FROM viviendas WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    $stmt->bindParam(1, $id);
 
    $stmt->execute();
 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    
    $tipo = $row['tipo'];
    $zona = $row['zona'];
    $direccion = $row['direccion'];
    $ndormitorios = $row['ndormitorios'];
    $precio = $row['precio'];
    $tamano = $row['tamano'];    
    $extra = $row['extra'];
    $foto = $row['foto'];
    $observaciones = $row['observaciones'];
    
}
 
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
 <table class='table table-hover table-responsive table-bordered'>
    <tr>
        <td>Tipo</td>
        <td><?php echo htmlspecialchars($tipo, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Zona</td>
        <td><?php echo htmlspecialchars($zona, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Dirección</td>
        <td><?php echo htmlspecialchars($direccion, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Dormitorios</td>
        <td><?php echo htmlspecialchars($ndormitorios, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Precio</td>
        <td><?php echo htmlspecialchars($precio, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Tamaño</td>
        <td><?php echo htmlspecialchars($tamano, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Extra</td>
        <td><?php echo htmlspecialchars($extra, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>Foto</td>
        <td>
        <?php echo $foto ? "<img src='uploads/{$foto}' style='width:300px;' />" : "No image found.";  ?>
        </td>
    </tr>
    <tr>
        <td>Observaciones</td>
        <td><?php echo htmlspecialchars($observaciones, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='index.php' class='btn btn-danger'>Volver al Index</a>
        </td>
    </tr>
</table>


 
    </div> 
     
<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<?php include 'footer.php';?>
</body>
</html>