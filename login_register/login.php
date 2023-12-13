<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['username'])) {
    // Si ya ha iniciado sesión, redirige a la página principal
    header("Location: ../index.php");
    exit();
}

include("../connection.php");

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si las claves 'username' y 'password' están configuradas en $_POST
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $conn = connection();

        // Obtén el nombre de usuario y la contraseña del formulario
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Consulta para obtener el usuario de la base de datos y verificar la contraseña
        $sql = "SELECT * FROM users WHERE username = '$username' AND password IS NOT NULL";
        $result = mysqli_query($conn, $sql);

        // Verifica si la consulta fue exitosa
        if ($result) {
            // Obtén la fila de resultados
            $row = mysqli_fetch_assoc($result);

            // Verifica si se encontró un usuario y la contraseña es válida
            if ($row && password_verify($password, $row['password'])) {
                // Inicia sesión
                $_SESSION['username'] = $row['username'];
                // Redirige a la página principal o a la de bienvenida
                header("Location: ../index.php");
                exit();
            } else {
                // Nombre de usuario o contraseña incorrectos
                $error_message = "Nombre de usuario o contraseña incorrectos.";
            }
        } else {
            // Error en la consulta
            $error_message = "Error en la consulta: " . mysqli_error($conn);
        }

        // Cierra la conexión
        mysqli_close($conn);
    } else {
        // Si 'username' o 'password' no están configurados en $_POST
        $error_message = "Por favor, ingresa nombre de usuario y contraseña.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <div class="text-center">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($_SESSION['login_success']) && $_SESSION['login_success']): ?>
            <p class="text-success">Nombre de usuario y contraseña correctos.</p>
        <?php elseif (isset($error_message)): ?>
            <p class="text-danger">Error: <?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>

    <form action="" method="post" class="needs-validation" novalidate>
        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>



