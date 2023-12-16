<style>
    .ae_form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    .input,
    select {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    .add_ae {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>

<?php
    $nombre = "";
    $apellido = "";
    $puesto = "";
    $cedula = "";
    $telefono = "";
    $correo = "";
    $direccion = "";
    $sueldo = "";

    $ae_no_error_list = 0;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $puesto = $_POST['puesto'];
    $cedula = $_POST['cedula'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['email'];
    $direccion = $_POST['direccion'];
    $sueldo = $_POST['sueldo'];
}

?>

<form class="ae_form" action="#" method="post" id="ae_form">
    <label for="nombre">Nombre:</label>
    <input value="<?php echo $nombre; ?>" class="input" type="text" id="nombre" name="nombre">

    <label for="apellidos">Apellidos:</label>
    <input value="<?php echo $apellido; ?>" class="input" type="text" id="apellidos" name="apellidos">

    <label for="puesto">Puesto:</label>
    <select id="puesto" name="puesto" required>
      <option value="gerente" <?php if($puesto == "gerente"){echo "selected";} ?> >Gerente</option>
      <option value="asistente" <?php if($puesto == "asistente"){echo "selected";} ?>>Asistente</option>
      <option value="tecnico" <?php if($puesto == "tecnico"){echo "selected";} ?>>Técnico</option>
    </select>

    <label for="cedula">Cedula</label>
    <input value="<?php echo($cedula); ?>" class="input" type="text" id="cedula" name="cedula">

    <label for="telefono">Número de Teléfono:</label>
    <input value="<?php echo($telefono); ?>" class="input" type="tel" id="telefono" name="telefono">

    <label for="email">Correo Electrónico:</label>
    <input value="<?php echo ($correo); ?>" class="input" type="email" id="email" name="email">

    <label for="direccion">Dirección:</label>
    <input value="<?php echo $direccion; ?>" class="input" type="text" id="direccion" name="direccion">

    <label for="sueldo">Sueldo:</label>
    <input value="<?php echo $sueldo; ?>" class="input" type="number" id="sueldo" name="sueldo">

    <input class="add_ae" name="add_ae" value="Enviar" type="submit">
  </form>

  <?php
    if(isset($_POST['add_ae'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellidos'];
        $puesto = $_POST['puesto'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['email'];
        $direccion = $_POST['direccion'];
        $sueldo = $_POST['sueldo'];

        $ae_errores = array();
        

        if(strlen($telefono) != 10 ){

            array_push($ae_errores,"El numero de Telefono es obligatorio y debe tener un tamaño de 10");
        }
            else{
            if(substr($telefono,0,3) != 809 && substr($telefono,0,3) != 829 && substr($telefono,0,3) != 849 ){
                array_push($ae_errores, "El numero de Telefono no Es Correcto <b>(El formato correto es 0000000000)</b> Ejemplo: 8291111111");
            }else{
                $ae_no_error_list++;
            }
        }

        if(strlen($cedula) != 13){
            array_push($ae_errores, "La Cedula Deve tener un tamaño de 13 y sele deven incluir los -");
        }else{
            if(substr($cedula,3,1) == "-" && substr($cedula,11,1) == "-")
            {
                $ae_no_error_list++;
            }
            else{
                array_push($ae_errores, "La cedula deve Incluir los 2 - (Giones)");
            }
        }

        if($correo != ""){
            if(filter_var($correo,FILTER_VALIDATE_EMAIL)){
                $ae_no_error_list++;
            }else{
                array_push($ae_errores, "El Correo Electronico no es Valido");
            }
            
        }{
            $ae_no_error_list++;
        }

        foreach($ae_errores as $e){
            echo "<p class='errorList'>$e</p>";
        }



        if($ae_no_error_list == 4){
            $sql = "INSERT INTO empleados(nombres, apellidos, puesto, cedula, telefono, correo, direccion, sueldo) VALUES ('$nombre','$apellido','$puesto','$cedula','$telefono','$correo','$direccion','$sueldo')";
            if($conn->query($sql) === true){
                echo "<h2 style='color:green;'>El Empleado <b>$nombre</b> a sido agregado</h2>";
                header("Location: ae_redit.php");
                $conn->close();
                exit();
            }
        }

    }

  ?>

  <script src="js/script.js" ></script>