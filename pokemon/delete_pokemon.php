<?php
include("../connection.php");

$conn = connection();

// Captura el ID del Pokémon a eliminar
$id = $_GET['id'];

// Construye la consulta SQL de eliminación
$sql = "DELETE FROM pokemons WHERE id = $id";

// Ejecuta la consulta SQL
mysqli_query($conn, $sql);

// Redirige a la página principal
header("Location: pokemones.php");
exit();
?>
