<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retiro de Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="fondo">
    <div class="contenido">
    <header>
        <h1>Retiro de Productos</h1>
    </header>
    <main>
        <form class="formulario" action="retirar_productos.php" method="post">
            <label for="producto">Producto:</label>
            <select name="producto_id" id="producto_id">
                <?php include 'obtener_productos.php'; ?>
            </select>
            <br>
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" required>
            <br>
            <button class="boton" type="submit">Retirar</button>
        </form>
    </main>
    </div>
    
</body>
</html>