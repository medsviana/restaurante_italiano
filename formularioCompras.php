<?php

// ===================== CONEXIÓN BBDD =====================
$conexion = mysqli_connect("localhost","root","","restaurante_italiano") 
    or die("Error al conectar con la base de datos");

// dos arrays vacíos para separar los productos según su 'tipo'
$lista_ingredientes = [];
$lista_otros = [];

// Hacemos la consulta SQL para traer TODOS los productos
$sql = "SELECT id_producto, nombre, precio, tipo FROM producto";
$resultado = mysqli_query($conexion, $sql);

while ($fila = mysqli_fetch_array($resultado)) { 
    
if ($fila['tipo'] == 'ingrediente') {
        $lista_ingredientes[] = $fila; 
    } else {
        $lista_otros[] = $fila; 
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de Compras</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

    <header>
    <div class="header-container">
        <a href="index.php">
        <div class="logo">
            <div class="logo-icon">🍝</div>
            <span>Trattoria Bella Italia</span>
        </div>
        </a>
    </div>
    </header>

    <h1>ERP RESTAURANTE - SOLICITUD DE COMPRA</h1>
    <p>Seleccione los productos cargados desde la Base de Datos.</p>

    <form action="Formulario_Facturacion.php" method="POST">
        
        <table border="1" cellpadding="8" width="70%">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio Coste</th>
                <th>Cantidad a Pedir</th>
            </tr>

            <tr><td colspan="4" bgcolor="#ffebcc"><b>INGREDIENTES Y ALIMENTACIÓN</b></td></tr>
            
            <?php
            // Si no hay ingredientes
            if (empty($lista_ingredientes)) {
                echo "<tr><td colspan='4'>No hay ingredientes registrados en la BD.</td></tr>";
            } else {
                foreach ($lista_ingredientes as $prod) {
                    echo "<tr>";
                    echo "<td>" . $prod['id_producto'] . "</td>"; // ID para referencia
                    echo "<td>" . $prod['nombre'] . "</td>";
                    echo "<td>" . $prod['precio'] . " €</td>";
                    
                    echo "<td>
                            <input type='number' 
                                   name='compras[" . $prod['id_producto'] . "]' 
                                   value='0' min='0'>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>

            <tr><td colspan="4" bgcolor="#ccffcc"><b>OTROS SUMINISTROS</b></td></tr>
            
            <?php
            if (empty($lista_otros)) {
                echo "<tr><td colspan='4'>No hay otros productos registrados.</td></tr>";
            } else {
                foreach ($lista_otros as $prod) {
                    echo "<tr>";
                    echo "<td>" . $prod['id_producto'] . "</td>";
                    echo "<td>" . $prod['nombre'] . "</td>";
                    echo "<td>" . $prod['precio'] . " €</td>";
                    
                    echo "<td>
                            <input type='number' 
                                   name='compras[" . $prod['id_producto'] . "]' 
                                   value='0' min='0'>
                          </td>";
                    echo "</tr>";
                }
            }
            ?>

        </table>
        <br>
        
        <input type="submit" value="ENVIAR SOLICITUD DE COMPRA A PROVEEDOR">
        
    </form>

    <footer>
  <div class="footer-container">
    <div class="footer-bottom">
      © 2026 Trattoria Bella Italia · Auténtica cocina italiana
    </div>
  </div>
</footer>

</body>
</html>