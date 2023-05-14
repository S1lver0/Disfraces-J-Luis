<!DOCTYPE html>
<html>

<head>
    <title>Tabla de Atributos</title>
    <link rel="stylesheet" href="report.css">
</head>

<body>
    <?php
    include '../navegacion/nav.php';
    ?>
    <h1 id="titulo">REGISTROS DE ALQUILER</h1>
    <?php
    include '../conectarbd.php';

    // Procesar la acción de eliminación, si se recibió un ID de registro para eliminar
    if (isset($_GET['eliminar'])) {
        $id_ficha = $_GET['eliminar'];
        $sql = "DELETE FROM detalle_ficha WHERE id_Ficha = '$id_ficha'";
        mysqli_query($conex, $sql);
        $sql = "DELETE FROM ficha WHERE Id= '$id_ficha'";
        mysqli_query($conex, $sql);
    }

    if (isset($_GET['buscar'])) {
        $busqueda = $_GET['buscar'];
        $sql = "SELECT cliente.Nombre AS nombre_cliente,cliente.DNI,ficha.Precio,ficha.F_Entrega,ficha.F_Devolucion,ficha.Id FROM cliente INNER JOIN ficha ON cliente.Id = ficha.Id_Cliente WHERE cliente.DNI='$busqueda'";

    }else{
        $sql = "SELECT cliente.Nombre AS nombre_cliente,cliente.DNI,ficha.Precio,ficha.F_Entrega,ficha.F_Devolucion,ficha.Id
        FROM ficha
        INNER JOIN cliente ON cliente.Id = ficha.Id_Cliente";
    }


    //hacer consulta
    $resultado = mysqli_query($conex, $sql);
    ?>
    <!-- Formulario de búsqueda -->
    <form method="get" action="">
        <input type="text" name="buscar" placeholder="Buscar...">
        <button type="submit">Buscar</button>
    </form>
    <!-- Mostrar la tabla de registros -->

    <table>
        <tr>
            <th>Estado</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Precio Total</th>
            <th>Fecha de Entrega</th>
            <th>Fecha de Vencimiento</th>
            <th>Acciones</th>
        </tr>
        <?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td>
                    Activo
                </td>
                <td>
                    <?php echo $fila['nombre_cliente']; ?>
                </td>
                <td>
                    <?php echo $fila['DNI']; ?>
                </td>
                <td>
                    <?php echo $fila['Precio']; ?>
                </td>
                <td>
                    <?php echo $fila['F_Entrega']; ?>
                </td>
                <td>
                    <?php echo $fila['F_Devolucion']; ?>
                </td>
                <td>
                    <button><a href="?eliminar=<?php echo $fila['Id']; ?>">Eliminar</a></button>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>

</html>