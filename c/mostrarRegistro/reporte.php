<!DOCTYPE html>
<html>

<head>
	<title>Tabla de Atributos</title>
	<link rel="stylesheet" href="reporte.css">
</head>

<body>
	<?php
	include '../navegacion/nav.php';
	include_once("../conexion/conectarbd.php");
	$sql = "SELECT *FROM cliente";
	//conectar base de datos
	$conn = ConexionBD();
	//hacer consulta
	$resultado = mysqli_query($conn, $sql);
	//validar si tiene filas
	if (mysqli_num_rows($resultado) > 0) {
		echo "<table>";
		echo "<tr><th>Estado</th><th>Nombre</th><th>DNI</th><th>Disfraz</th><th>Talla</th><th>Precio Total</th><th>Fecha de Entrega</th><th>Fecha de vencimiento</th><th class='actions'>Acciones</th></tr>";
		while ($fila = mysqli_fetch_assoc($resultado)) {
			echo "<tr> <td>Activo</td><td>" . $fila["Nombre"]. "</td><td>" . $fila["DNI"] . "</td> <td>SUPERMAN</td> <td>L</td> <td>$100</td> <td>10</td> <td>10</td> <td class='actions'><button>Eliminar</button></td></tr>";
		}
		echo "</table>";
	}

	?>
</body>

</html>