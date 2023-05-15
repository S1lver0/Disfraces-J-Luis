<!DOCTYPE html>
<html>

<head>
    <title>Registros de Alquiler</title>
    <link rel="stylesheet" href="report.css">
    <link rel="shortcut icon" href="../img/sopas.png">
</head>

<body>
    <?php
    include '../navegacion/nav.php';
    ?>
    <div id="principal">

        <h1 id="titulo">Registros de Alquiler</h1>
        <?php
        error_reporting(0);
        include '../conectarbd.php';

        // Procesar la acción de eliminación, si se recibió un ID de registro para eliminar
        if (isset($_GET['eliminar'])) {
            $idFicha = $_GET['eliminar'];

            // Obtiene los atributos de id_disfraz de detalle_ficha antes de eliminar los otros datos
            $sqlDetalleFicha = "SELECT id_Disfraz FROM detalle_ficha WHERE id_Ficha = '$idFicha'";
            $resultDetalleFicha = mysqli_query($conex, $sqlDetalleFicha);
            $detalleFicha = mysqli_fetch_assoc($resultDetalleFicha);

            // Obtener los Id_Disfraz relacionados con el id_Ficha
            $D = "SELECT id_Disfraz FROM detalle_ficha WHERE id_Ficha = '$idFicha'";
            $R = mysqli_query($conex, $D);

            // Resto del código para eliminar los otros datos...
        

            // Elimina los registros de detalle_ficha que dependen de la ficha
            $sqlDetalleFicha = "DELETE FROM detalle_ficha WHERE id_Ficha = '$idFicha'";

            // Obtiene el Id_Cliente de la ficha que se va a eliminar
            $sqlFicha = "SELECT Id_Cliente FROM ficha WHERE Id = '$idFicha'";
            $resultFicha = mysqli_query($conex, $sqlFicha);
            $rowFicha = mysqli_fetch_assoc($resultFicha);
            $idCliente = $rowFicha['Id_Cliente'];

            // Elimina el registro de ficha
            $sqlFicha = "DELETE FROM ficha WHERE Id = '$idFicha'";

            // Elimina el registro de cliente
            $sqlCliente = "DELETE FROM cliente WHERE Id = '$idCliente'";



            mysqli_query($conex, $sqlDetalleFicha);

            mysqli_query($conex, $sqlFicha);



            mysqli_query($conex, $sqlCliente);



            // Recorrer los resultados y borrar los registros de disfraz por cada Id_Disfraz obtenido
            while ($rowIdDisfraz = mysqli_fetch_assoc($R)) {
                $idDisfraz = $rowIdDisfraz['id_Disfraz'];
                // Borrar el registro de disfraz por Id_Disfraz
                $D = "DELETE FROM disfraz WHERE Id = '$idDisfraz'";
                mysqli_query($conex, $D);
            }

        }
        $boton = true; //boton generar ficha
        
        if (isset($_GET['buscar'])) {
            $busqueda = $_GET['buscar'];
            $sql = "SELECT cliente.Nombre AS nombre_cliente,cliente.DNI,cliente.Id AS cliente_id,ficha.Precio,ficha.F_Entrega,ficha.F_Devolucion,ficha.Id FROM cliente INNER JOIN ficha ON cliente.Id = ficha.Id_Cliente WHERE cliente.DNI='$busqueda'";
            $boton = false; // no mostrar boton generar ficha
        } else {
            $sql = "SELECT cliente.Nombre AS nombre_cliente,cliente.DNI,cliente.Id AS cliente_id,ficha.Precio,ficha.F_Entrega,ficha.F_Devolucion,ficha.Id
        FROM ficha
        INNER JOIN cliente ON cliente.Id = ficha.Id_Cliente";
        }

        //hacer consulta
        $resultado = mysqli_query($conex, $sql);


        ///Filtrado por estado 
        
        $filtro = ""; // Establecer el filtro en vacío por defecto
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $estado = $_POST["estado"];
            if ($estado == "activo") {
                $filtro = "Activo";
            }
            if ($estado == "vencido") {
                $filtro = "Vencido";
            }
            if ($estado == "todo") {
                $filtro = "";
            }
        }


        ?>
        <!-- Formulario de búsqueda -->
        <div id="options">
            <form id="busqueda" method="get" action="">
                <h1 class='subtitulo'>Busqueda por DNI :</h1>
                <input type="text" name="buscar" placeholder="Buscar...">
                <button class="butons" type="submit">Buscar</button>
                <button class="butons"><a href='reporte.php'>CancelarBusqueda</a></button>
            </form>

            <?php
            // seleccion de filtro
            echo "<form method='post' id='filtro'>";
            echo "<label><h1 class='subtitulo'>Filtrar por estado:</h1></label>";
            echo "<select name='estado'>";
            //para ver en que estado se encuentra actualmente la ficha
            echo "<option value='todo'" . ($filtro == "" ? "selected" : "") . ">Mostrar Todo</option>";
            echo "<option value='activo' " . ($filtro == "Activo" ? "selected" : "") . ">Activo</option>";
            echo "<option value='vencido' " . ($filtro == "Vencido" ? "selected" : "") . ">Vencido</option>";
            echo "</select>";
            echo "<input class='butons' type='submit' value='Filtrar'>";
            echo "</form>";
            ?>
        </div>





        <!-- Mostrar la tabla de registros -->
        <div id="tabla">
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
                <?php while ($fila = mysqli_fetch_assoc($resultado)) {
                    //obtener formato
                    $año = substr($fila['F_Devolucion'], 0, 4);
                    $mes = substr($fila['F_Devolucion'], 5, -3);
                    $dia = substr($fila['F_Devolucion'], -2);
                    $f_devoCad = "$dia-$mes-$año 12:12:12";
                    //hora actual
                    $fecha_actual = strtotime(date("d-m-Y H:i:00", time()));

                    //convertir a formato tiempo
                    $f_devo = strtotime($f_devoCad);

                    if ($fecha_actual > $f_devo) {
                        $estado = "Vencido";
                    } else {
                        $estado = "Activo";
                    }
                    ///filtro 
                    if ($filtro && $estado != $filtro) {
                        continue; // Se salta esta fila si no cumple con el filtro
                    }


                    ?>
                    <tr class="<?php if ($estado == "Vencido") {
                        echo 'Vencido';
                    }
                    ?>">
                        <td>
                            <?php echo $estado; ?>
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
                        <td id="actions">
                            <a target="_blank" href="?eliminar=<?php echo $fila['Id']; ?>"><img class="icono"
                                    src="../img/delete.png" alt="borrar"></a>
                            <a target="_blank" href="../PDF/index.php?id=<?php echo $fila['cliente_id']; ?>"><img
                                    class="icono" src="../img/ojo.png" alt="detalles"></a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php
        if($boton==true&&$filtro==""){
            echo "
        <div id='boton_reporte'>
            <button id='reportes' class='butons'><a rel='noopener noreferrer' target='_blank'
                    href='../PDF/index.php'>Generar FichaPDF</a>
            </button>
        </div>";
        }
        ?>
    </div>

</body>

</html>