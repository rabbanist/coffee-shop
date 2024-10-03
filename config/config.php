<?php 

try{
//Host 
define("HOST", "localhost");

//dbname
define("DBNAME","coffe-shop");

//user 
define("USER", "root");

//password
define("PASS", "");

$conn = new PDO("mysql:host=".HOST.";dename=".DBNAME."",USER,PASS);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $Excepton){
    echo $Excepton->getMessage();
}
