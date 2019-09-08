<!DOCTYPE HTML>
<html>
<head>
    <title>Editar</title>
     
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <?php include 'header.php';?>
         
</head>
<body>
 
    <div class="container">
  
        <div class="page-header">
            <h1>Editar Propiedad</h1>
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
<?php
 
 if($_POST){
      
     try{

         $query = "UPDATE viviendas 
                     SET tipo=:tipo, zona=:zona, direccion=:direccion, ndormitorios=:ndormitorios, precio=:precio, tamano=:tamano, extra=:extra, foto=:foto, observaciones=:observaciones 
                     WHERE id = :id";
  
         $stmt = $con->prepare($query);

         $tipo=htmlspecialchars(strip_tags($_POST['tipo']));
         $zona=htmlspecialchars(strip_tags($_POST['zona']));
         $direccion=htmlspecialchars(strip_tags($_POST['direccion']));
         $ndormitorios=htmlspecialchars(strip_tags($_POST['ndormitorios']));
         $precio=htmlspecialchars(strip_tags($_POST['precio']));
         $tamano=htmlspecialchars(strip_tags($_POST['tamano']));
         $extra=htmlspecialchars(strip_tags($_POST['extra']));
         $foto=htmlspecialchars(strip_tags($_POST['foto']));
         $observaciones=htmlspecialchars(strip_tags($_POST['observaciones']));

         
         
         $stmt->bindParam(':id', $id);
         $stmt->bindParam(':tipo', $tipo);
         $stmt->bindParam(':zona', $zona);
         $stmt->bindParam(':direccion', $direccion);
         $stmt->bindParam(':ndormitorios', $ndormitorios);
         $stmt->bindParam(':precio', $precio);
         $stmt->bindParam(':tamano', $tamano);
         $stmt->bindParam(':extra', $extra);
         $stmt->bindParam(':foto', $foto);
         $stmt->bindParam(':observaciones', $observaciones);
  
          
         if($stmt->execute()){
             echo "<div class='alert alert-success'>Registro de modificó con éxito</div>";
         }else{
             echo "<div class='alert alert-danger'>Intente Nuevamente</div>";
         }
          
     }
      
     catch(PDOException $exception){
         die('ERROR: ' . $exception->getMessage());
     }
 }
 ?>





<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Tipo</td>
            <td>
            <select name="tipo" value="<?php echo htmlspecialchars($tipo, ENT_QUOTES);  ?>" class="form-control" id="exampleSelect1">
                <option>Departamento</option>
                <option selected="selected">Casa</option>
                <option>Chalet</option>
                <option>Casa en parcela</option>
                <option>5</option>
            </select></td>
        </tr>
        <tr>
            <td>Zona</td>
            <td>      
            <select name="zona"class="form-control" id="exampleSelect2" value="<?php echo htmlspecialchars($zona, ENT_QUOTES);  ?>">
                <option>El Tabo</option>
                <option>Punta de Tralca</option>
                <option>Algarrobo</option>
                <option elected="selected">isla Negra</option>
                <option>Costa Azul</option>
            </select></textarea></td>
        </tr>
        <tr>
            <td>Dirección</td>
            <td><input type='text' name='direccion' value="<?php echo htmlspecialchars($direccion, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Dormitorios</td>
            <td>
            <select name="ndormitorios"class="form-control" id="SelectND" value="<?php echo htmlspecialchars($ndormitorios, ENT_QUOTES);  ?>">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5+</option>
            </select></td>
        </tr>
        <tr>
            <td>Precio</td>
            <td><input type='number' name='precio' value="<?php echo htmlspecialchars($precio, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Tamaño</td>
            <td><input type='number' name='tamano' value="<?php echo htmlspecialchars($tamano, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Extra</td>
            <td>
            <select name="extra"class="form-control" id="SelectExtra" value="<?php echo htmlspecialchars($extra, ENT_QUOTES);  ?>">
                <option>Vista al Mar</option>
                <option>Piscina</option>
                <option>Jardin</option>
                <option>Quincho</option>
                <option>Estacionamiento</option>
             </select>
             </td>
        <tr>
            <td>Foto</td>
            <td><input type='text' name='foto' value="<?php echo htmlspecialchars($foto, ENT_QUOTES);  ?>" class='form-control' /></td>
        </tr>
        <tr>
            <td>Observaciones</td>
            <td><textarea name='observaciones' class='form-control'><?php echo htmlspecialchars($observaciones, ENT_QUOTES);  ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type='submit' value='Guardar' class='btn btn-primary' />
                <a href='index.php' class='btn btn-danger'>Volver al Index</a>
            </td>
        </tr>
    </table>
</form>
         
    </div> 



<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<?php include 'footer.php';?>
 
</body>
</html>