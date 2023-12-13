<?php
include("../connection.php");

$conn = connection();

// Captura los datos del formulario
$nombre = $_POST['nombre'];
$num_pokedex = $_POST['num_pokedex'];
$dano = $_POST['dano'];
$vida = $_POST['vida'];
$tipo = $_POST['tipo'];

// Construye la consulta SQL de inserción
$sql = "INSERT INTO pokemons (nombre, num_pokedex, dano, vida, idtipo) 
        VALUES ('$nombre', '$num_pokedex', '$dano', '$vida', '$tipo')";

// Ejecuta la consulta SQL
mysqli_query($conn, $sql);

// Redirige a la página principal
header("Location: pokemones.php");
exit();
?>
