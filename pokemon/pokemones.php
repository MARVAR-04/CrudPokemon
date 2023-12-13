<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../login_register/login.php");
    exit();
}
?>
<?php
include("../connection.php");
$conn = connection();

$sql = "SELECT pokemons.id, pokemons.nombre, pokemons.num_pokedex, pokemons.dano, pokemons.vida, tipos.tipo 
        FROM pokemons 
        LEFT JOIN tipos ON pokemons.idtipo = tipos.id";
$query = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Pokemones</title>
    <style>
        body {
            background-image: url('../img/Rayquaza.png');
        }

        .card {
            background-color: #65AC91;
            color: #fff;
            background-color: rgba(0,0,0,0.3);
        }

        .btn-primary {
            background-color: #4CAF50; 
        }

        .btn-warning {
            background-color: #FFA500; 
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
                <h1 class="mb-0">Añadir Pokémon</h1>
            </div>
            <div class="card-body">
                <form action="insert_pokemon.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="num_pokedex" placeholder="Pokedex">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="dano" placeholder="Daño">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="vida" placeholder="Vida">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="tipo" placeholder="Tipo">
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h2 class="mb-0">Lista de Pokémon</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Pokedex</th>
                            <th>Daño</th>
                            <th>Vida</th>
                            <th>Tipo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($query)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['num_pokedex'] ?></td>
                                <td><?= $row['dano'] ?></td>
                                <td><?= $row['vida'] ?></td>
                                <td><?= $row['tipo'] ?></td>
                                <td><a href="update_pokemon.php?id=<?= $row['id'] ?>" class="btn btn-warning">Editar</a></td>
                                <td><a href="delete_pokemon.php?id=<?= $row['id'] ?>" class="btn btn-danger">Eliminar</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Agregamos el enlace para ir a la página de entrenadores -->
        <a href="../entrenador/entrenadores.php" class="btn btn-info mt-3">Ver Entrenadores</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
