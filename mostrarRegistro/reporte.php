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
	$sql = "SELECT cliente.Nombre AS nombre_cliente,cliente.Apellido,cliente.DNI,disfraz.Nombre AS nombre_disfraz,disfraz.Talla,ficha.Precio,ficha.F_Entrega,ficha.F_Devolucion 
	FROM detalle_ficha 
	INNER JOIN ficha ON detalle_ficha.id_Ficha = ficha.Id
	INNER JOIN disfraz ON detalle_ficha.id_Disfraz = disfraz.Id
	INNER JOIN cliente ON cliente.Id = ficha.Id_Cliente";
	//conectar base de datos
	$conn = $conex;
	//hacer consulta
	$resultado = mysqli_query($conn, $sql);
	//validar si tiene filas
	if (mysqli_num_rows($resultado) > 0) {
		echo "<table>";
		echo "<tr><th>Estado</th><th>Nombre</th><th>DNI</th><th>Disfraz</th><th>Talla</th><th>Precio Total</th><th>Fecha de Entrega</th><th>Fecha de vencimiento</th><th class='actions'>Acciones</th></tr>";
		while ($fila = mysqli_fetch_assoc($resultado)) {
			echo "<tr> <td>Activo</td><td>" . $fila["nombre_cliente"] . "</td><td>" . $fila["DNI"] . "</td><td>". $fila["nombre_disfraz"] . "</td><td>".$fila["Talla"]."</td><td>".$fila["Precio"]."</td> <td>".$fila["F_Entrega"]."</td> <td>".$fila["F_Devolucion"]."</td> <td class='actions'><button>Eliminar</button></td></tr>";
		}
		echo "</table>";
	}

	?>
</body>

</html>