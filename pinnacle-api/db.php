<?php
$servername = "localhost";
$username = "no18222p_root";
$password = "cashless@2020";

$conn=null;
try {
    $conn = new PDO("mysql:host=$servername;dbname=no18222p_pinnacle", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
catch(PDOException $e)
    {
   		 die("Connection failed: " . $e->getMessage());
    }
?>