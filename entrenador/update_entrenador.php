<?php
include("../connection.php");
$conn = connection();

// Verificar si se ha enviado el formulario de actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $genero = $_POST["genero"];
    $medallas = $_POST["medallas"];
    $region = $_POST["region"];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE entrenadores SET nombre='$nombre', genero='$genero', medallas=$medallas, region='$region' WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        header("Location: entrenadores.php"); // Redirigir a la página de entrenadores después de la actualización
        exit();
    } else {
        echo "Error al actualizar el Entrenador: " . mysqli_error($conn);
    }
} else {
    // Obtener el ID del Entrenador a actualizar desde la URL
    $id = $_GET["id"];

    // Consultar la información actual del Entrenador
    $sql = "SELECT * FROM entrenadores WHERE id=$id";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);

    // Verificar si se encontró el Entrenador
    if (!$row) {
        echo "Entrenador no encontrado.";
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
    <title>Editar Entrenador</title>
    <style>
        body {
            background-image: url('../img/ash.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .card {
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
                <h1 class="mb-0">Editar Entrenador</h1>
            </div>
            <div class="card-body">
                <form action="update_entrenador.php" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?= $row['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="genero" placeholder="Género" value="<?= $row['genero'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="medallas" placeholder="Medallas" value="<?= $row['medallas'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="region" placeholder="Región" value="<?= $row['region'] ?>">
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="entrenadores.php" class="btn btn-danger">Cancelar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>

