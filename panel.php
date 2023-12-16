<?php
include("app/app.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Contor de Empleados</title>
</head>
<body>

<div class="menu-container">
  <div class="userInfo">
    <img src="img/logo.png">
  <div class="userInfo_date">
  <P class="userInfo_txt"><?php session_start(); echo "Hola <b> " . $_SESSION['name'] . " (". $_SESSION['rol'] .")" . " </b> Bienvenido" ; ?></P>
  <p class="userInfo_hora"><?php echo "<b>Hora:</b> " . date("H:i A")?></p>
  <p class="userInfo_fecha"><?php echo "<b>Fecha:</b> " . date("d/m/Y");?></p>
  </div>
  </div>
    <form method="GET" action="#" class="vertical-menu">
      <?php
        if($_SESSION['rol'] == "ADMIN"){
          echo '<input type="submit" name="btnNomina" value="Nomina">';
          echo '<input type="submit" name="addEmpleados" value="Empleados">';
          echo '<input type="submit" name="configUser" value="Gestionar Usuarios">';
        }

        if($_SESSION['rol'] == "RH"){
          echo '<input type="submit" name="btnNomina" value="Nomina">';
          echo '<input type="submit" name="addEmpleados" value="Empleados">';
        }
      ?>
      
      
      
    </form>
  </div>

  <section>

  <?php
    $title = "";
    $page = "";
    

    if(isset($_GET['btnNomina'])){
        $title = "Nomina de Empleados" ;
        $page = "NE";
    }

    if(isset($_GET['addEmpleados'])){
        $title = "Agregar Empleados";
        $page = "AE";
    }

    if(isset($_GET['configUser'])){
        $title = "Agregar Usuarios";
        $page = "AU";
    }

    
  ?>

    <center><h1><?php echo $title; ?></h1></center>

    <?php
      if($page == "NE"){
        include ("nomina.php");
      }

      if($page == "AE"){
        include ("addEmpleados.php");
      }

      if($page == "AU"){
        include ("configUser.php");
      }
    ?>
  </section>
    
</body>
</html>