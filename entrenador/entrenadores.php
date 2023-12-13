<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../login_register/login.php");
    exit();
}

include("../connection.php");
$conn = connection();

// Verificar si se ha enviado el formulario de agregar entrenador
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $genero = mysqli_real_escape_string($conn, $_POST["genero"]);
    $medallas = mysqli_real_escape_string($conn, $_POST["medallas"]);
    $region = mysqli_real_escape_string($conn, $_POST["region"]);

    // Consulta preparada para evitar SQL Injection
    $sql = "INSERT INTO entrenadores (nombre, genero, medallas, region) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssis", $nombre, $genero, $medallas, $region);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        // Manejo de errores
        die("Error en la consulta: " . mysqli_error($conn));
    }
}

// Consultar todos los entrenadores
$sqlEntrenadores = "SELECT * FROM entrenadores";
$queryEntrenadores = mysqli_query($conn, $sqlEntrenadores);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Entrenadores</title>
    <style>
        body {
            background-image: url('../img/ash.jpg');
        }

        .card {
            background-color: #65AC91;
            color: #fff;
            background-color: rgba(0, 0, 0, 0.3);
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
                <h1 class="mb-0">Añadir Entrenador</h1>
            </div>
            <div class="card-body">
                <form action="entrenadores.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="genero">Género:</label>
                        <select class="form-control" name="genero" required>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="medallas" placeholder="Medallas" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="region" placeholder="Región" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h2 class="mb-0">Lista de Entrenadores</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Género</th>
                            <th>Medallas</th>
                            <th>Región</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($queryEntrenadores)): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['nombre'] ?></td>
                                <td><?= $row['genero'] ?></td>
                                <td><?= $row['medallas'] ?></td>
                                <td><?= $row['region'] ?></td>
                                <td><a href="update_entrenador.php?id=<?= $row['id'] ?>" class="btn btn-warning">Editar</a></td>
                                <td><a href="delete_entrenador.php?id=<?= $row['id'] ?>" class="btn btn-danger">Eliminar</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="../pokemon/pokemones.php" class="btn btn-info mt-3">Ir a Pokémon</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

