<style>
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

<?php
// Aquí deberías tener tu conexión a la base de datos ($conn)

echo "<table>";
echo "<tr> <th>#</th> <th>Nombre</th> <th>Apellido</th> <th>Puestos</th> <th>Cedula</th> <th>Telefono</th> <th>Correo</th> <th>Dirección</th> <th>Sueldo</th> <th>Descuentos</th> <th>X</th> </tr>";

$sql = "SELECT * FROM empleados";
$resultado = $conn->query($sql);

while ($row = mysqli_fetch_assoc($resultado)) {
    echo "<tr>";
    echo "<td> ". $row['id'] ." </td>";
    echo "<td> ". $row['nombres'] ." </td>";
    echo "<td> ". $row['apellidos'] ." </td>";
    echo "<td> ". $row['puesto'] ." </td>";
    echo "<td> ". $row['cedula'] ." </td>";
    echo "<td> ". $row['telefono'] ." </td>";
    echo "<td> ". $row['correo'] ." </td>";
    echo "<td> ". $row['direccion'] ." </td>";
    echo "<td> ". $row['sueldo'] ." </td>";

    echo "<td>";
    $sfs = $row['sueldo'] * 0.0304;
    $afp = $row['sueldo'] * 0.0287;
    echo "<b>SFS:</b> " . $sfs . "<br>";
    echo "<b>AFP:</b> " . $afp . "<br>";
    $suma = $sfs - $afp;
    $SumaAlAño = $suma * 12;
    if($SumaAlAño > 416220.00){
        $porsentaje = 0;
    }elseif($SumaAlAño > 416220.01 || $SumaAlAño < 624329.00){
        $porsentaje = 0.15;
    }elseif($SumaAlAño > 624329.01 || $SumaAlAño < 867123.00){
        $porsentaje = 0.20;
    }elseif($SumaAlAño < 867123.01){
        $porsentaje = 0.25;
    }


    $isr = $row['sueldo'] * $porsentaje;

    echo "<b>ISR: </b> $isr <br>";
    echo "</td>";
    

    echo "<td><form action='#' method='post'><button class='delete' type='submit' name='delete' value=' ". $row['id'] ." '>X</button></form></td>";
    echo "</tr>";
}

echo "</table>";

if(isset($_POST['delete'])){
    $n = $_POST['delete'];
    $sql = "DELETE FROM empleados WHERE id = $n";

    if($conn->query($sql) === true ){
        
        // Vuelve a ejecutar la consulta para actualizar la tabla después de la eliminación
        $resultado = $conn->query("SELECT * FROM empleados");
        header("Location: n_redit.php");
        exit();
       ;
    }
}

// Cierra la conexión después de realizar todas las operaciones
$conn->close();
?>
