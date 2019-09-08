<!DOCTYPE HTML>
<html>
<head>
    <title>Propiedades</title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <?php include 'header.php';?>
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>

 
</head>
<body>
    <div class="container">
  
        <div class="page-header">
            <h1>Lista de Propiedades</h1>
        </div>
     
<?php
include 'config/database.php';

$action = isset($_GET['action']) ? $_GET['action'] : "";
 
if($action=='deleted'){
    echo "<div class='alert alert-success'>Registro eliminado</div>";
}
 
 
$query = "SELECT id, tipo, zona, direccion,ndormitorios,precio, tamano, extra,foto,observaciones FROM viviendas ORDER BY id DESC";
$stmt = $con->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();
 
echo "<a href='create.php' class='btn btn-primary m-b-1em'>Ingresar Nueva Propiedad</a>";
 
if($num>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Tipo</th>";
        echo "<th>Zona</th>";
        echo "<th>Dirección</th>";
        echo "<th>Dormitorios</th>";
        echo "<th>Precio</th>";
        echo "<th>Tamaño</th>";        
        echo "<th>Extra</th>";
        echo "<th>Foto</th>";
        echo "<th>Observaciones</th>";
        
        
    echo "</tr>";
     
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);
     
    echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$tipo}</td>";
        echo "<td>{$zona}</td>";
        echo "<td>{$direccion}</td>";
        echo "<td>{$ndormitorios}</td>";
        echo "<td>&#36;{$precio}</td>";
        echo "<td>{$tamano}</td>";        
        echo "<td>{$extra}</td>";
        echo "<td>{$foto}</td>";
        echo "<td>{$observaciones}</td>";
        
        
        echo "<td>";
            echo "<a href='leer_uno.php?id={$id}' class='btn btn-info m-r-1em'>Leer</a>";
             
            echo "<a href='editar.php?id={$id}' class='btn btn-primary m-r-1em'>Editar</a>";
 
            echo "<a href='#' onclick='delete_user({$id});'  class='btn btn-danger'>Eliminar</a>";
        echo "</td>";
    echo "</tr>";
}
 
echo "</table>";
     
}
 
else{
    echo "<div class='alert alert-danger'>Sin registros</div>";
}

?>
         
    </div> 
     
<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>

<script type='text/javascript'>
function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        window.location = 'delete.php?id=' + id;
    } 
}
</script>

<?php include 'footer.php';?>
 
</body>
</html>