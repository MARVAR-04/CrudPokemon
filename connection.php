<?php

function connection(){
    $host = "localhost";
    $user = "root";
    $pass = "";
    $bd = "Pokemon";

    $conn = mysqli_connect($host, $user, $pass, $bd);

    if (!$conn) {
        throw new Exception("Conexión fallida: " . mysqli_connect_error());
    }

    return $conn;
}
//ALTER TABLE tu_tabla AUTO_INCREMENT = 1;
?>

