<?php 


/* Connect to a MySQL database using driver invocation 
$dsn = 'mysql:dbname=test;host=localhost';
$dbUsername ="reubenshumba";
$dbPasswoord="cityofdavid";
*/

$dsn = 'mysql:dbname=cs_department;host=localhost';
$dbUsername ="reubenshumba";
$dbPasswoord="cityofdavid";

try {
   
    $DBConnect = new PDO($dsn, $dbUsername, $dbPasswoord);
  
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
 