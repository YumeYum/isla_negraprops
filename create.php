<!DOCTYPE HTML>
<html>
<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <?php include 'header.php';?>
          
</head>
<body>

    <div class="container">
   
        <div class="page-header">
            <h1>Ingresar Propiedad</h1>
        </div>

<?php
if($_POST){
 
    include 'config/database.php';
 
    try{
     
        $query = "INSERT INTO viviendas SET tipo=:tipo, zona=:zona, direccion=:direccion, ndormitorios=:ndormitorios, precio=:precio, tamano=:tamano, extra=:extra, foto=:foto, observaciones=:observaciones";
 
        $stmt = $con->prepare($query);
 
        $tipo=htmlspecialchars(strip_tags($_POST['tipo']));
        $zona=htmlspecialchars(strip_tags($_POST['zona']));
        $direccion=htmlspecialchars(strip_tags($_POST['direccion']));
        $ndormitorios=htmlspecialchars(strip_tags($_POST['ndormitorios']));
        $precio=htmlspecialchars(strip_tags($_POST['precio']));
        $extra=htmlspecialchars(strip_tags($_POST['extra']));
        //$foto=htmlspecialchars(strip_tags($_POST['foto']));
        $observaciones=htmlspecialchars(strip_tags($_POST['observaciones']));
        $tamano=htmlspecialchars(strip_tags($_POST['tamano']));


        $foto=!empty($_FILES["foto"]["name"])
        ? sha1_file($_FILES['foto']['tmp_name']) . "-" . basename($_FILES["foto"]["name"])
        : "";
        $foto=htmlspecialchars(strip_tags($foto));


        
        
        
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':zona', $zona);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':ndormitorios', $ndormitorios);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':extra', $extra);
        $stmt->bindParam(':foto', $foto);
        $stmt->bindParam(':observaciones', $observaciones);
        $stmt->bindParam(':tamano', $tamano);
        
        
         
        //$created=date('Y-m-d H:i:s');
        //$stmt->bindParam(':created', $created);
         
        if($stmt->execute()){
          if($foto){
 
            $target_directory = "uploads/";
            $target_file = $target_directory . $foto;
            $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
         
            $file_upload_error_messages="";
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check!==false){
            }else{
            $file_upload_error_messages.="<div>No es una imagen</div>";
            }
            $allowed_file_types=array("jpg", "jpeg", "png", "gif");
            if(!in_array($file_type, $allowed_file_types)){
                $file_upload_error_messages.="<div>Solo se permiten archivos JPG, JPEG, PNG, y GIF. </div>";
            }
            if(file_exists($target_file)){
              $file_upload_error_messages.="<div>Imagen ya existe, cambie el nombre.</div>";
            }
            if($_FILES['foto']['size'] > (1024000)){
            $file_upload_error_messages.="<div>La imagen debe ser inferior a 1 MB</div>";
            }
            if(!is_dir($target_directory)){
              mkdir($target_directory, 0777, true);
            }
            if(empty($file_upload_error_messages)){
              if(move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)){
              }else{
                  echo "<div class='alert alert-danger'>";
                      echo "<div>No se pudo subir la imagen</div>";
                      echo "<div>Actualize el registro para subir la foto</div>";
                  echo "</div>";
              }
          }
          else{
              echo "<div class='alert alert-danger'>";
                  echo "<div>{$file_upload_error_messages}</div>";
                  echo "<div>Actualize el registro para subir la foto.</div>";
              echo "</div>";
          }

        }
            echo "<div class='alert alert-success'>Se guardó el registro</div>";
        }else{
            echo "<div class='alert alert-danger'>Registro no guardado</div>";
        }
         
    }
     
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
  <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <fieldset>
    <legend>Vivienda</legend>
    <div class="form-group">
      <label for="exampleSelect1">Seleccione tipo</label>
      <select name="tipo"class="form-control" id="exampleSelect1">
        <option>Departamento</option>
        <option selected="selected">Casa</option>
        <option>Chalet</option>
        <option>Casa en parcela</option>
        <option>5</option>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleSelect2">Seleccione zona</label>
      <select name="zona"class="form-control" id="exampleSelect2">
        <option>El Tabo</option>
        <option>Punta de Tralca</option>
        <option>Algarrobo</option>
        <option selected="selected">isla Negra</option>
        <option>Costa Azul</option>
      </select>
    </div>
    <div class="form-group">
      <label for="InputDire">Dirección</label>
      <input name="direccion"class="form-control" id="inputDire" aria-describedby="direHelp" placeholder="Ingrese Dirección" type="text">
    </div>
    <div class="form-group">
      <label for="exampleSelectND">Número de dormitorios</label>
      <select name="ndormitorios"class="form-control" id="SelectND">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5+</option>
      </select>
    </div>
    <div class="form-group">
      <label for="InputPrecio">Precio</label>
      <input name="precio"class="form-control" id="inputPrecio"  placeholder="Ingrese precio" type="number">
    </div>
    <div class="form-group">
      <label for="InputTam">Tamaño</label>
      <input name="tamano" class="form-control" id="inputTam"  placeholder="Ingrese Tamaño" type="number">
    </div>
    <label for="SelectExtra">Extra</label>
      <select name="extra"class="form-control" id="SelectExtra">
        <option>Vista al Mar</option>
        <option>Piscina</option>
        <option>Jardin</option>
        <option>Quincho</option>
        <option>Estacionamiento</option>
      </select>

    <div class="form-group">
      <label for="inputFoto">Foto</label>
      <input name="foto" type="file">
    </div>
    <div class="form-group">
    <div class="form-group">
      <label for="textObs">Observaciones</label>
      <textarea name="observaciones"class="form-control" id="TextObs" rows="3" ></textarea>
    </div>
    </fieldset>
    <button type="submit" value="save"class="btn btn-primary">Publicar</button>
    <a href='index.php' class='btn btn-danger'>Volver al Index</a>
  </fieldset>
</form>


    </div>
      
<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<?php include 'footer.php';?>
</body>
</html>