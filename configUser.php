<style>
    .formulario {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .campo {
      display: block;
      margin-bottom: 8px;
    }

    .entrada {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    .boton {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .boton:hover {
      background-color: #45a049;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 16px;
    }

    th, td {
        padding: 5px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    .delete {
        background: red;
        color: white;
    }
  </style>
  <title>Formulario de Registro</title>
</head>
<body>

  <form class="formulario" action="#" method="post" >
    <label class="campo" for="nombre">Nombre:</label>
    <input class="entrada" type="text" id="nombre" name="nombre" required>

    <label class="campo" for="apellido">Apellido:</label>
    <input class="entrada" type="text" id="apellido" name="apellido" required>

    <label class="campo" for="usuario">Usuario:</label>
    <input class="entrada" type="text" id="usuario" name="usuario" required>

    <label class="campo" for="contraseña">Contraseña:</label>
    <input class="entrada" type="password" id="contraseña" name="contraseña" required>

    <label class="campo" for="rol">Rol:</label>
    <select class="entrada" id="rol" name="rol">
      <option value="ADMIN">Administrador</option>
      <option value="RH">Recursos Humanos</option>
    </select>

    <input type="submit" value="Enviar" class="boton" name="enviar">
  </form>

  <?php
  if(isset($_POST['enviar'])){
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $rol = $_POST['rol'];

    $sql = "INSERT INTO usuarios(nombre, apellido, usuario, pass, rol) VALUES ('$nombre','$apellido','$usuario','$contraseña','$rol')";

    if($conn->query($sql)){
      echo "<h1>Usuario $usuario Agregado con Exicto</h1>";
      header("Location: cu_redit.php");
      exit();
    }else{
      echo "<h1>Error al agregar usaurio</h1>";
    }
  }
 
  ?>

  <?php
  $resultado = $conn->query("SELECT id, nombre, apellido, usuario, pass, rol FROM usuarios");
  if(mysqli_fetch_assoc($resultado)){
    echo "<table>";
    echo "<tr> <th>#</th> <th>Nombre</th> <th>Apellido</th> <th>Usuario</th> <th>Contraseña</th> <th>Rol</th> </tr>";
    
    
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td> ". $row['id'] ." </td>";
        echo "<td> ". $row['nombre'] ." </td>";
        echo "<td> ". $row['apellido'] ." </td>";
        echo "<td> ". $row['usuario'] ." </td>";
        echo "<td> ". $row['pass'] ." </td>";
        echo "<td> ". $row['rol'] ." </td>";
        echo "<td><form action='#' method='post'><button class='delete' type='submit' name='delete' value=' ". $row['id'] ." '>X</button></form></td>";
        echo "</tr>";
    }
    
    echo "</table>";
  }

  if(isset($_POST['delete'])){
    $n = $_POST['delete'];
    $sql = "DELETE FROM usuarios WHERE id = $n";

    if($conn->query($sql) === true ){
        
        // Vuelve a ejecutar la consulta para actualizar la tabla después de la eliminación
        header("Location: cu_redit.php");
        exit();

        ;
    }
}

// Cierra la conexión después de realizar todas las operaciones
$conn->close();
  ?>
