<?php
$host = "localhost";
$db_name = "viviendas_db";
$username = "root";
$password = "";
  
try {
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}
  
// show error
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}
?>

<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'viviendas_db');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>