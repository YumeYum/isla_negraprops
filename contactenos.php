<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="public/css/bootstrap.min.css" />
<?php include 'header.php';?>
  <style>
  .formu{

  padding: 10px;

  }
  </style>
</head>
<body>
<div class="formu">
<h2>Formulario de Contacto</h2>

<form action="index.php" onsubmit="success()" >
  Nombre y Apellido:<br>
  <input type="text" name="nombreyapellido" value="" required>
  <br>
  Correo Electrónico:<br>
  <input type="email" name="email" value="" required>
  <br>
  Consulta:<br>
  <textarea class="TextArea" id="TextArea" rows="3" cols="50" required></textarea>
  <br><br>
  <input type="submit" value="Enviar" >
</form> 
</div>
<script>
function success() {
    alert("Formulario ingresado con éxito");
}
</script>

</body>

<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<?php include 'footer.php';?>
</body>
</html>
