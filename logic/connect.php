<?php
$dbServer="localhost";
$username="root";
$password="";
$dbName="dbsajt";
try {
    $connection = new PDO("mysql:host=$dbServer;dbname=$dbName",
        $username, $password);
// set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

}
catch(PDOException $e)
{
    echo "Greska sa konekcijom: " . $e->getMessage();
}