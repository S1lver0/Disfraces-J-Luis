<?php

// Conexión a la base de datos
require('fpdf/fpdf.php');
include '../conectarbd.php';
// Conexión a la base de datos
$conexion = $conex;

// Creación del objeto PDF
$pdf = new FPDF();


// Consulta a la base de datos para obtener los clientes
$query_clientes = "SELECT * FROM cliente";
$resultado_clientes = mysqli_query($conexion, $query_clientes);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query_clientes = "SELECT * FROM cliente WHERE Id='$id'";
    $resultado_clientes = mysqli_query($conexion, $query_clientes);

    $cliente = mysqli_fetch_assoc($resultado_clientes);
    // Obtener el ID del cliente actual
    $conexion = mysqli_connect("bclcgxjcjrtj4pjg2pqf-mysql.services.clever-cloud.com", "utuvolae3umgpvfb", "mFzFsIAFNXYMhZX8Qsap", "bclcgxjcjrtj4pjg2pqf");
    $clienteId = $id;

    // Consultar los disfraces del cliente actual
    $query_disfraces = "SELECT disfraz.*, detalle_ficha.Precio, ficha.F_Entrega, ficha.F_Devolucion FROM detalle_ficha
                        INNER JOIN disfraz ON detalle_ficha.id_Disfraz = disfraz.Id
                        INNER JOIN ficha ON detalle_ficha.id_Ficha = ficha.Id
                        WHERE ficha.Id_Cliente = '$clienteId'";
    $resultado_disfraces = mysqli_query($conexion, $query_disfraces);
    // Consultar las fechas de entrega y devolución del cliente actual
    $query_fechas = "SELECT F_Entrega, F_Devolucion FROM ficha WHERE Id_Cliente = '$clienteId'";
    $resultado_fechas = mysqli_query($conexion, $query_fechas);







    // Configurar la fuente y el tamaño del texto
    $pdf->SetFont('Arial', '', 8);

    // Configurar el encabezado y pie de página
    $pdf->AliasNbPages();
    $pdf->AddPage();

    // Agregar título en el centro
    $pdf->SetXY(10, 30);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'SISTEMA DE ALQUILER DE DISFRACES', 0, 1, 'C');

    // Agregar subtítulo
    $pdf->SetFont('Arial', '', 13);
    $pdf->Cell(0, 10, '"TIENDA LUIS S.A.C"', 0, 1, 'C');

    // Dibujar línea negra
    $pdf->SetLineWidth(3);
    $pdf->Line(10, 50, 200, 50);

    // Dibujar un rectángulo para los datos del cliente
    $pdf->SetLineWidth(0.5);
    $pdf->Rect(10, 70, 190, 150);

    // Mostrar los datos del cliente
    $pdf->SetXY(20, 80);
    $pdf->Cell(0, 5, "Nombre: " . $cliente['Nombre'], 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(0, 5, "Apellido: " . $cliente['Apellido'], 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(0, 5, "DNI: " . $cliente['DNI'], 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(0, 5, "Telefono: " . $cliente['Domicilio'], 0, 1);
    $pdf->SetX(20);
    $pdf->Cell(0, 5, "Direccion: " . $cliente['Celular'], 0, 1);
    $pdf->SetX(20);








    // Consultar las fechas de entrega y devolución del cliente actual
    $query_fechas = "SELECT F_Entrega, F_Devolucion FROM ficha WHERE Id_Cliente = '$clienteId'";
    $resultado_fechas = mysqli_query($conexion, $query_fechas);

    // Obtener las fechas de entrega y devolución del cliente actual
    $fechas = mysqli_fetch_assoc($resultado_fechas);
    $fechaEntrega = $fechas['F_Entrega'];
    $fechaDevolucion = $fechas['F_Devolucion'];

    // Mostrar las fechas de entrega y devolución
    $pdf->SetXY(110, 80);
    $pdf->Cell(0, 5, "Fecha de Entrega: " . $fechaEntrega, 0, 1);
    $pdf->SetXY(110, 90);
    $pdf->Cell(0, 5, "Fecha de Devolucion: " . $fechaDevolucion, 0, 1); // Comparar las fechas de devolución


    $fechaActual = date('Y-m-d');

    if ($fechaActual > $fechaDevolucion) {

        $pdf->SetTextColor(255, 0, 0); // Rojo
        $estado = 'Retrasado';
    } else {

        $pdf->SetTextColor(0, 255, 0); // Verde
        $estado = 'En tiempo';
    }

    $pdf->SetXY(110, 100);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 5, "ESTADO: " . $estado, 0, 1);

    $pdf->SetTextColor(0); // negro

    $pdf->SetFont('Arial', '', 10);








    // Agregar una tabla para los datos de los disfraces del cliente
    $pdf->SetXY(90, 120);
    $pdf->Cell(0, 20, "Datos de Disfraces:", 0, 1);
    $pdf->Ln(5);

    // Crear la cabecera de la tabla
    $pdf->SetX(15);
    $pdf->SetFillColor(169, 169, 169);
    $pdf->SetTextColor(0);
    $pdf->Cell(50, 8, "Nombre", 1, 0, 'C', true);
    $pdf->Cell(30, 8, "Cantidad", 1, 0, 'C', true);
    $pdf->Cell(30, 8, "Precio", 1, 0, 'C', true);
    $pdf->Cell(30, 8, "Talla", 1, 0, 'C', true);
    $pdf->Cell(40, 8, "Precio Unitario", 1, 1, 'C', true);

    // Calcular el precio total
    $total = 0;





    // Mostrar los disfraces del cliente actual
    // Mostrar los disfraces del cliente actual
    while ($disfraz = mysqli_fetch_assoc($resultado_disfraces)) {
        $pdf->SetX(15);
        $pdf->Cell(50, 10, $disfraz['Nombre'], 1, 0, 'C');
        $pdf->Cell(30, 10, $disfraz['Cantidad'], 1, 0, 'C');
        $pdf->Cell(30, 10, $disfraz['Precio'], 1, 0, 'C');
        $pdf->Cell(30, 10, $disfraz['Talla'], 1, 0, 'C');
        $pdf->Cell(40, 10, $disfraz['Precio'] * $disfraz['Cantidad'], 1, 1, 'C');
        // Actualizar el precio total
        $total += $disfraz['Precio'] * $disfraz['Cantidad'];
    }




    // Mostrar el precio total del cliente actual
    $pdf->SetX(40);
    $pdf->Cell(0, 10, "Precio Total: $" . $total, 0, 1, "C");

    $pdf->Ln(20);


} else {
    // Recorrer los clientes
    while ($cliente = mysqli_fetch_assoc($resultado_clientes)) {
        // Obtener el ID del cliente actual
        $conexion = mysqli_connect("bclcgxjcjrtj4pjg2pqf-mysql.services.clever-cloud.com", "utuvolae3umgpvfb", "mFzFsIAFNXYMhZX8Qsap", "bclcgxjcjrtj4pjg2pqf");
        $clienteId = $cliente['Id'];

        // Consultar los disfraces del cliente actual
        $query_disfraces = "SELECT disfraz.*, detalle_ficha.Precio, ficha.F_Entrega, ficha.F_Devolucion FROM detalle_ficha
                        INNER JOIN disfraz ON detalle_ficha.id_Disfraz = disfraz.Id
                        INNER JOIN ficha ON detalle_ficha.id_Ficha = ficha.Id
                        WHERE ficha.Id_Cliente = '$clienteId'";
        $resultado_disfraces = mysqli_query($conexion, $query_disfraces);
        // Consultar las fechas de entrega y devolución del cliente actual
        $query_fechas = "SELECT F_Entrega, F_Devolucion FROM ficha WHERE Id_Cliente = '$clienteId'";
        $resultado_fechas = mysqli_query($conexion, $query_fechas);







        // Configurar la fuente y el tamaño del texto
        $pdf->SetFont('Arial', '', 8);

        // Configurar el encabezado y pie de página
        $pdf->AliasNbPages();
        $pdf->AddPage();

        // Agregar título en el centro
        $pdf->SetXY(10, 30);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'SISTEMA DE ALQUILER DE DISFRACES', 0, 1, 'C');

        // Agregar subtítulo
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(0, 10, '"TIENDA LUIS S.A.C"', 0, 1, 'C');

        // Dibujar línea negra
        $pdf->SetLineWidth(3);
        $pdf->Line(10, 50, 200, 50);

        // Dibujar un rectángulo para los datos del cliente
        $pdf->SetLineWidth(0.5);
        $pdf->Rect(10, 70, 190, 150);

        // Mostrar los datos del cliente
        $pdf->SetXY(20, 80);
        $pdf->Cell(0, 5, "Nombre: " . $cliente['Nombre'], 0, 1);
        $pdf->SetX(20);
        $pdf->Cell(0, 5, "Apellido: " . $cliente['Apellido'], 0, 1);
        $pdf->SetX(20);
        $pdf->Cell(0, 5, "DNI: " . $cliente['DNI'], 0, 1);
        $pdf->SetX(20);
        $pdf->Cell(0, 5, "Telefono: " . $cliente['Domicilio'], 0, 1);
        $pdf->SetX(20);
        $pdf->Cell(0, 5, "Direccion: " . $cliente['Celular'], 0, 1);
        $pdf->SetX(20);








        // Consultar las fechas de entrega y devolución del cliente actual
        $query_fechas = "SELECT F_Entrega, F_Devolucion FROM ficha WHERE Id_Cliente = '$clienteId'";
        $resultado_fechas = mysqli_query($conexion, $query_fechas);

        // Obtener las fechas de entrega y devolución del cliente actual
        $fechas = mysqli_fetch_assoc($resultado_fechas);
        $fechaEntrega = $fechas['F_Entrega'];
        $fechaDevolucion = $fechas['F_Devolucion'];

        // Mostrar las fechas de entrega y devolución
        $pdf->SetXY(110, 80);
        $pdf->Cell(0, 5, "Fecha de Entrega: " . $fechaEntrega, 0, 1);
        $pdf->SetXY(110, 90);
        $pdf->Cell(0, 5, "Fecha de Devolucion: " . $fechaDevolucion, 0, 1); // Comparar las fechas de devolución


        $fechaActual = date('Y-m-d');

        if ($fechaActual > $fechaDevolucion) {

            $pdf->SetTextColor(255, 0, 0); // Rojo
            $estado = 'Retrasado';
        } else {

            $pdf->SetTextColor(0, 255, 0); // Verde
            $estado = 'En tiempo';
        }

        $pdf->SetXY(110, 100);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(0, 5, "ESTADO: " . $estado, 0, 1);

        $pdf->SetTextColor(0); // negro

        $pdf->SetFont('Arial', '', 10);






        // Agregar una tabla para los datos de los disfraces del cliente
        $pdf->SetXY(90, 120);
        $pdf->Cell(0, 20, "Datos de Disfraces:", 0, 1);
        $pdf->Ln(5);

        // Crear la cabecera de la tabla
        $pdf->SetX(15);
        $pdf->SetFillColor(169, 169, 169);
        $pdf->SetTextColor(0);
        $pdf->Cell(50, 8, "Nombre", 1, 0, 'C', true);
        $pdf->Cell(30, 8, "Cantidad", 1, 0, 'C', true);
        $pdf->Cell(30, 8, "Precio Unitario", 1, 0, 'C', true);
        $pdf->Cell(30, 8, "Talla", 1, 0, 'C', true);
        $pdf->Cell(40, 8, "Precio Total", 1, 1, 'C', true);

        // Calcular el precio total
        $total = 0;





        // Mostrar los disfraces del cliente actual
        // Mostrar los disfraces del cliente actual
        while ($disfraz = mysqli_fetch_assoc($resultado_disfraces)) {
            $pdf->SetX(15);
            $pdf->Cell(50, 10, $disfraz['Nombre'], 1, 0, 'C');
            $pdf->Cell(30, 10, $disfraz['Cantidad'], 1, 0, 'C');
            $pdf->Cell(30, 10, $disfraz['Precio'], 1, 0, 'C');
            $pdf->Cell(30, 10, $disfraz['Talla'], 1, 0, 'C');
            $pdf->Cell(40, 10, $disfraz['Precio'] / $disfraz['Cantidad'], 1, 1, 'C');
            // Actualizar el precio total
            $total = $disfraz['Precio'];
        }




        // Mostrar el precio total del cliente actual
        $pdf->SetX(40);
        $pdf->Cell(0, 10, "Precio Total: $" . $total, 0, 1, "C");

        $pdf->Ln(20);


    }


}


// Cerrar la conexión a la base de datos
mysqli_close($conexion);

// Salida del PDF
$pdf->Output();
?>