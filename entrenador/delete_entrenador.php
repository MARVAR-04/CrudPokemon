<?php
include("../connection.php");

$conn = connection();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM entrenadores WHERE id='$id'";
    mysqli_query($conn, $sql);
}

header("Location: entrenadores.php");
exit;
?>
