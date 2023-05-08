
<!DOCTYPE html>
<html>
<head>
	<title>Tabla de Atributos</title>
    <link rel="stylesheet" href="reporte.css">
</head>
<body>
    <?php
        include_once("../conexion/conectarbd.php");
     ?>
	<table>
		<thead>
			<tr>
				<th>Estado</th>
				<th>Nombre</th>
				<th>DNI</th>
				<th>Disfraz</th>
				<th>Talla</th>
				<th>Precio Total</th>
				<th>Fecha de entrega</th>
				<th>Fecha de vencimiento</th>
				<th class="actions">Acciones</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Pendiente</td>
				<td>Juan Pérez</td>
				<td>12345678</td>
				<td>Superman</td>
				<td>M</td>
				<td>$50.00</td>
				<td>12/05/2023</td>
				<td>15/05/2023</td>
				<td class="actions"><button>Eliminar</button></td>
			</tr>
			<tr>
				<td>En proceso</td>
				<td>María Rodríguez</td>
				<td>98765432</td>
				<td>Catwoman</td>
				<td>S</td>
				<td>$80.00</td>
				<td>14/05/2023</td>
				<td>17/05/2023</td>
				<td class="actions"><button>Eliminar</button></td>
			</tr>
			<tr>
				<td>Entregado</td>
				<td>Pedro García</td>
				<td>24681357</td>
				<td>Batman</td>
				<td>L</td>
				<td>$100.00</td>
				<td>10/05/2023</td>
				<td>13/05/2023</td>
				<td class="actions"><button>Eliminar</button></td>
			</tr>
		</tbody>
	</table>
</body>
</html>


