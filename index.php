<?php
include("app/app.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <style>
        body{
            display: flex;
        }
    </style>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="#" class="login-form">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" minlength="4" maxlength="64" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" minlength="8" maxlength="128" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input class="enviar" name="enviar" type="submit" value="Iniciar sesión">
            </div>
                <?php

                

                ?>
        </form>
    </div>
    <?php
    $erores = array();
        if(isset($_POST['enviar'])){
            $usuario = $_POST['username'];
            $contraseña = $_POST['password'];

            $sql = "SELECT nombre, apellido, usuario, pass, rol FROM usuarios WHERE usuario = '$usuario'";
            $resultado = $conn->query($sql);


            if($resultado->num_rows > 0){
                $fila = mysqli_fetch_assoc($resultado);
                if($contraseña == $fila["pass"]){
                    session_start();
                    $_SESSION['user'] = $usuario;
                    $_SESSION['pass'] = $contraseña;
                    $_SESSION['name'] = $fila['nombre'];
                    $_SESSION['lastName'] = $fila['apellido'];
                    $_SESSION['rol'] = $fila['rol'];
                    header("Location: panel.php");
                    exit();
                }else{
                    array_push($erores, "La contraseña es <b>incorrecta</b>");
                }
                
            }else{
                array_push($erores, "El usuario <b>no Existe</b>");

            }
            foreach($erores as $e){
                echo "<p class='errorList'>$e</p>";
            }
        }

        $conn->close();
    ?>
</body>
</html>
