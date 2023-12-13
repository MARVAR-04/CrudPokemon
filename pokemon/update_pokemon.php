<?php
include("../connection.php");
$conn = connection();

// Verificar si se ha enviado el formulario de actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $num_pokedex = $_POST["num_pokedex"];
    $dano = $_POST["dano"];
    $vida = $_POST["vida"];
    $tipo = $_POST["tipo"];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE pokemons SET nombre='$nombre', num_pokedex=$num_pokedex, dano=$dano, vida=$vida, idtipo=$tipo WHERE id=$id";
    $query = mysqli_query($conn, $sql);


    
    if ($query) {
        header("Location: pokemones.php"); // Redirigir a la página principal después de la actualización
        exit();
    } else {
        echo "Error al actualizar el Pokémon: " . mysqli_error($conn);
    }
} else {
    // Obtener el ID del Pokémon a actualizar desde la URL
    $id = $_GET["id"];

    // Consultar la información actual del Pokémon
    $sql = "SELECT * FROM pokemons WHERE id=$id";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    // Verificar si se encontró el Pokémon
    if (!$row) {
        echo "Pokémon no encontrado.";
        exit();
    }
}

mysqli_close($conn);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Pokémon</title>
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('../img/charizard.jpg');
        }

        .card {
            background-color: rgba(0,0,0,0.3);
            color: #fff;
        }

        .card-header {
            background-color: #65AC91;
            color: #fff;
            background-color: rgba(0,0,0,0.3);
        }

        .btn-success {
            background-color: #28a745; 
        }

        .btn-danger {
            background-color: #FF0000; 
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h1 class="mb-0">Editar Pokémon</h1>
            </div>
            <div class="card-body">
                <form action="update_pokemon.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $row['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="num_pokedex" placeholder="Pokedex" value="<?= $row['num_pokedex'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="dano" placeholder="Daño" value="<?= $row['dano'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="vida" placeholder="Vida" value="<?= $row['vida'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tipo" placeholder="Tipo" value="<?= $row['idtipo'] ?>">
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="index.php" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

