<?php
include("../connection.php");
$conn = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];

    $sql = "INSERT INTO entrenadores (nombre, edad) VALUES ('$nombre', '$edad')";
    mysqli_query($conn, $sql);
}

header("Location: entrenadores.php");
exit;
?>
