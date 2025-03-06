<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = getenv('DB_PASSWORD');
$dbname = "inv_poo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];

// Comprobar si el nombre del producto ya existe en la base de datos
$sql_check = "SELECT cantidad FROM inventario WHERE nombre = '$nombre'";
$result = $conn->query($sql_check);

if ($result->num_rows > 0) {
    // El producto ya existe, actualizar la cantidad
    $row = $result->fetch_assoc();
    $nueva_cantidad = $row['cantidad'] + $cantidad;
    $sql_update = "UPDATE inventario SET cantidad = $nueva_cantidad WHERE nombre = '$nombre'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Cantidad actualizada exitosamente";
    } else {
        echo "Error al actualizar la cantidad: " . $conn->error;
    }
} else {
    // El producto no existe, insertar nuevo registro
    $sql_insert = "INSERT INTO inventario (nombre, descripcion, cantidad, precio) VALUES ('$nombre', '$descripcion', $cantidad, $precio)";
    if ($conn->query($sql_insert) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>

