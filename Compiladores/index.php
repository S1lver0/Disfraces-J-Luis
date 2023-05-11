<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
    <link rel="shortcut icon" href="sopas.png">
    <title>Compiladores</title>
</head>
<body>
    <form method="post" id="registro">
        <div class="pantalla">
            <br>
            <div class="titulo">
                <h1>Formulario de Alquiler</h1>
            </div>
            <br>
            <div class="encabezado1">
                <div>
                    <label for="star">Fecha de Entrega:</label>
                    <br>
                    <input id="star" type="date" name="fecha_e">
                </div>
                <div>
                    <label for="">Fecha de Devolucion:</label>
                    <br>
                    <input type="date" name="fecha_d">
                </div>
            </div>
            <div class="encabezado2">
                <div class="cliente">
                    <h1>Datos del Cliente</h1>
                    <br>
                    <label for="">Nombre:</label>
                    <input type="text" required name="nombre_c">
                    <br>
                    <label for="">Apellido:</label>
                    <input type="text" required name="apellido_c">
                    <br>
                    <label for="">DNI:</label>
                    <input type="text" name="dni_c">
                    <br>
                    <label for="">Domicilio:</label>
                    <input type="text" name="domicilio_c">
                    <br>
                    <label for="">Celular:</label>
                    <input type="text" name="celular_c">
                </div>

                <div class="disfraz">
                    <h1>Datos del Disfraz</h1>
                    <br>
                    <br>
                    <label for="">Nombre:</label>
                    <input class="disimput"type="text"id="in1">
                    <br>
                    <label for="">Tematica:</label>
                    <input class="disimput" type="text"id="in2">
                    <br>
                    <label for="">Cantidad:</label>
                    <input class="disimput" type="number" min="1" id="in3">
                    <br>
                    <label for="">Talla:</label>
                    <input class="disimput" type="text" id="in4">
                    <br>
                    <label for="">Precio:</label>
                    <input class="disimput" type="number"  min="0.1"id="in5">
                    <br>
                    <input id="add" type="button" name="agregar" value="Agregar" class="enviar"> 
                </div>

                
            </div>
            <div id="tabla">
                <div class="titulo_dis">
                <h1>Disfrazes</h1>
                
                </div>
                <br>
                <div class="centrar">

                    <table>
                        <thead>
                            <tr>
                                <td scope="col"><h4 class="sub">Acciones</h1></td>
                                <td scope="col"><h4 class="sub">Nombre</h1></td>
                                <td scope="col"><h4 class="sub">Tematica</h1></td>
                                <td scope="col"><h4 class="sub">Cantidad</h1></td>
                                <td scope="col"><h4 class="sub">Talla</h1></td>
                                <td scope="col"><h4 class="sub">Precio c/u</h1></td>
                                <td scope="col"><h4 class="sub">Precio Total</h1></td>
                            </tr>
                        </thead>
                        <tbody id="fields">

                        </tbody>
                        <tbody>
                            </tr>
                                <td colspan="6">Precio Total</td>
                                <td><input  id="precio_del_disfraz" name="Precio_dis" value=" " readonly></td>
                            </tr>
                        </tbody>
                    </table>  
                    <br>
                    <br> 
                </div>
            </div>
            <br>
            <br>
        </div>
        <input class="enviar" type="submit" name="registrar">
    </form>
    <br>
    <br>
    
    <script>

            var campo8_value =0;
            $(document).ready(function() {
                $("#add").click(function() {

                    var campo2_value = $('#in1').val();
                    var campo3_value = $('#in2').val();
                    var campo4_value = $('#in3').val();
                    var campo5_value = $('#in4').val();
                    var campo6_value = $('#in5').val();
                    var campo7_value = campo4_value*campo6_value;
                    campo8_value += campo7_value;
                    
                    $('#precio_del_disfraz').val(campo8_value);

                    var html = '<tr>';
                    html += '<td class="acciones"><i class="bx bxs-edit-alt editar-fila"></i><i class="bx bxs-message-alt-x eliminar-fila"></i></th>';
                    
                    html += '<td><input class="editable" name="Nombre[]" value="' + campo2_value + '" readonly></td>';
                    html += '<td><input class="editable" name="Tematica[]" value="' + campo3_value + '" readonly></td>';
                    html += '<td><input class="editable" name="Cantidad[]" value="' + campo4_value + '" readonly></td>';
                    html += '<td><input class="editable" name="Talla[]" value="' + campo5_value + '" readonly></td>';
                    html += '<td><input class="editable" name="Precio[]" value="' + campo6_value + '" readonly></td>';
                    html += '<td><input class="editable" name="Precio_T[]" value="' + campo7_value + '" readonly></td>';
                    html += '</tr>';
                    $("#fields").append(html);


    
                    $('#in1').val('');
                    $('#in2').val('');
                    $('#in3').val('');
                    $('#in4').val('');
                    $('#in5').val('');

                    
                });
                
                $(document).on("click", ".eliminar-fila", function() {
                    
                    $(this).closest("tr").remove();
                    
                    var fila = $(this).closest("tr"); // Encuentra la fila más cercana
                    var datos = []; // Arreglo para almacenar los datos de la fila

                    // Iterar sobre cada celda de la fila y obtener su contenido
                    fila.find("td").each(function() {
                        var contenido = $(this).find('input').val(); // Obtener el texto de la celda
                        datos.push(contenido); // Agregar el contenido al arreglo
                    });
                    console.log(datos)
                    console.log(datos[3])
                    console.log(datos[5])
                    campo8_value -= datos[3]*datos[5]
                    $('#precio_del_disfraz').val(campo8_value);
                    $(this).closest("tr").remove();

                });
                $(document).on("click", ".editar-fila", function() {
                    var fila = $(this).closest("tr");
                    var campos = fila.find(".editable");
                    
                    if (campos.prop("readonly")) {
                        campos.prop("readonly", false);
                        $(this).removeClass("bx bxs-edit-alt").addClass("bx bxs-check-square");
                    } else {
                        campos.prop("readonly", true);
                        $(this).removeClass("bx bxs-check-square").addClass("bx bxs-edit-alt");
                    }
                });
            });
        </script>
    <?php 
        include("bd.php");
    ?>
</body>
    <script src='index.js'></script>
    
</html>