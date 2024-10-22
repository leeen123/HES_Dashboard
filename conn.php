<?php 

$servername = "sql202.infinityfree.com";
$username = "if0_37531074";
$password = "rLvKedWuC5epY";
$db = "if0_37531074_HES_Dashboard";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed " . $e->getMessage();
}

?>