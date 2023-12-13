<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Agrega el enlace a Bootstrap -->
</head>
<body class="container mt-5">

    <div class="text-center">
        <h1 class="display-4">Bienvenido</h1>
    </div>

    <!-- Formulario de Registro -->
    <div class="mt-5">
        <h2 class="text-center">Registro</h2>
        <form action="login_register/register.php" method="post" class="needs-validation" novalidate>
            <!-- Agrega aquí los campos necesarios para el registro -->
            <button type="submit" class="btn btn-primary btn-block mt-3">Registrarse</button>
        </form>
    </div>

    <!-- Formulario de Inicio de Sesión -->
    <div class="mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>
        <form action="login_register/login.php" method="post" class="needs-validation" novalidate>
            <!-- Agrega aquí los campos necesarios para el inicio de sesión -->
            <button type="submit" class="btn btn-success btn-block mt-3">Iniciar Sesión</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
