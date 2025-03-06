<?php
$contra = getenv('DB_PASSWORD');

$conn = new mysqli('localhost', 'root', $contra, 'inv_poo');

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "SELECT id, nombre FROM inventario";
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . "</option>";
    }
} else {
    echo "<option value=''>No hay productos disponibles</option>";
}

$conn->close();
?>
