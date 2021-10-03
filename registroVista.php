
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ESTILOS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">

    <title>Gaucho Rocket</title>
</head>
<body class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                <div class="card iniciosesion">

                    <form class="box" action="usuarioimpl.php" method="post" >

                        <h1>Gaucho Rocket</h1>
                        <h3>REGISTRARSE</h3>
                        <br>
                        <p class="text-muted"> Ingrese su Usuario</p>
                        <input type="text" name="usuario" placeholder="nombre">
                        <p class="text-muted"> Ingrese su Contraseña</p>
                        <input type="password" name="password" placeholder="Contraseña">
                        <p class="text-muted"> Ingrese su correo electronico</p>
                        <input type="password" name="mail" placeholder="example@gmail.com">
                        <input type="submit" name="" value="Registrarse" href="#">

                        <div class="col-md-12">

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>