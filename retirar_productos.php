<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = getenv('DB_PASSWORD');
$dbname = "inv_poo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$producto_id = $_POST['producto_id'];
$cantidad_retirar = $_POST['cantidad'];

// Buscar la cantidad restante del producto usando una consulta preparada
$stmt = $conn->prepare("SELECT cantidad FROM inventario WHERE id = ?");
$stmt->bind_param("i", $producto_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cantidad_actual = $row['cantidad'];
    echo "Cantidad actual en inventario: " . $cantidad_actual . "<br>";

    if ($cantidad_retirar <= $cantidad_actual) {
        // Actualizar la cantidad en el inventario
        $nueva_cantidad = $cantidad_actual - $cantidad_retirar;
        $update_stmt = $conn->prepare("UPDATE inventario SET cantidad = ? WHERE id = ?");
        $update_stmt->bind_param("ii", $nueva_cantidad, $producto_id);
        $update_stmt->execute();

        echo "Cantidad retirada: " . $cantidad_retirar . "<br>";
        echo "Nueva cantidad en inventario: " . $nueva_cantidad . "<br>";

        // Verificar si la cantidad restante es menor o igual a 2
        if ($nueva_cantidad <= 2) {
            echo "<script>alert('¡Alerta! La cantidad restante es menor o igual a 2, reponer stock');</script>";
        }

        $update_stmt->close();
    } else {
        echo "Error: No hay suficiente cantidad en el inventario para retirar.<br>";
    }
} else {
    echo "Producto no encontrado.<br>";
}

$stmt->close();
$conn->close();
?>