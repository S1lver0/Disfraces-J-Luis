<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
    <link rel="shortcut icon" href="../img/sopas.png">
    <title>Formulario de Alquiler</title>
</head>

<body>
    <?php
    include("../navegacion/nav.php");

    ?>
    <form method="post" id="registro">
        <div class="pantalla">
            <br>
            <div class="titulo">
                <h1>Formulario de Alquiler</h1>
            </div>
            <br>
            <div class="encabezado1">
                <div>
                    <label for="">Fecha de Entrega:</label>
                    <br>
                    <input required type="date" name="fecha_e">
                </div>
                <div>
                    <label for="">Fecha de Devolucion:</label>
                    <br>
                    <input required type="date" name="fecha_d">
                </div>
            </div>
            <div class="encabezado2">
                <div class="cliente">
                    <h2>Datos del Cliente</h2>
                    <br>
                    <label for="">Nombre:</label>
                    <input type="text" required name="nombre_c">
                    <br>
                    <label for="">Apellido:</label>
                    <input type="text" required name="apellido_c">
                    <br>
                    <label for="">DNI:</label>
                    <input type="text" required name="dni_c">
                    <br>
                    <label for="">Domicilio:</label>
                    <input type="text" required name="domicilio_c">
                    <br>
                    <label for="">Celular:</label>
                    <input type="text" required name="celular_c">
                </div>

                <div class="disfraz">
                    <h2>Datos del Disfraz</h2>
                    <br>
                    <label for="">Nombre:</label>
                    <input required class="disimput" type="text" id="in1">
                    <br>
                    <label for="">Tematica:</label>
                    <input required class="disimput" type="text" id="in2">
                    <br>
                    <div>
                        <label for="">Talla:</label>
                        <select id="seleccionar">
                            <option>L</option>
                            <option>M</option>
                            <option>S</option>
                        </select>
                    </div>
                    <input required class="disimput" readonly maxlength="1" type="text" id="in3">
                    <br>
                    <label for="">Cantidad:</label>
                    <input required class="disimput" type="number" min="1" id="in4">
                    <br>
                    <label for="">Precio:</label>
                    <input required class="disimput" type="number" min="0.1" id="in5">
                    <br>
                    <div class="centrar">
                        <input readonly id="add" type="boton" name="agregar" value="Agregar">
                    </div>


                </div>


            </div>
            <div id="tabla">
                <div class="titulo_dis">
                    <h1>Disfrazes</h1>

                </div>
                <br>
                <div class="centrar" id="tablas">

                    <table>
                        <thead>
                            <tr>
                                <td scope="col">
                                    <h4 class="sub">Acciones</h1>
                                </td>
                                <td scope="col">
                                    <h4 class="sub">Nombre</h1>
                                </td>
                                <td scope="col">
                                    <h4 class="sub">Tematica</h1>
                                </td>
                                <td scope="col">
                                    <h4 class="sub">Talla</h1>
                                </td>
                                <td scope="col">
                                    <h4 class="sub">Cantidad</h1>
                                </td>
                                <td scope="col">
                                    <h4 class="sub">Precio c/u</h1>
                                </td>
                                <td scope="col">
                                    <h4 class="sub">Precio Total</h1>
                                </td>
                            </tr>
                        </thead>
                        <tbody id="fields">

                        </tbody>
                        <tbody>
                            </tr>
                            <td style="text-align: right;" colspan="6">Precio Total</td>
                            <td><input id="precio_del_disfraz" readonly name="Precio_dis" value=" "></td>
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
        <div class="centrar">
            <input class="enviar" type="submit" name="registrar">
        </div>

    </form>
    <br>
    <br>

    <script>

        var campo8_value = 0;
        const input_disfraz = document.querySelectorAll('.disimput')
        var contador = 0;
        var bandera = true;
        var bandera_edit = true;
        var one_case = false;
        function vacio_d() {
            bandera = true;
            for (const inputs_d of input_disfraz) {
                if (inputs_d.value.length === 0) {
                    bandera = false;
                }

            }
            console.log(bandera)
        }
        function delete_() {
            var celdas = $(this).closest("tr");
            //var inputs_dis = document.querySelectorAll(".disimput");
            console.log('123')
            if (celdas.length === 0) {
                for (const input_ta of input_disfraz) {
                    input_ta.required = true;

                }
                console.log('456')
                one_case = false;
            }
        }


        $(document).ready(function () {
            $("#add").click(function () {
                vacio_d()
                if (bandera == false) {

                } else {
                    one_case = true

                    var campo2_value = $('#in1').val();
                    var campo3_value = $('#in2').val();
                    var campo4_value = $('#in3').val();
                    var campo5_value = $('#in4').val();
                    var campo6_value = $('#in5').val();
                    var campo7_value = campo5_value * campo6_value;
                    campo8_value += campo7_value;

                    $('#precio_del_disfraz').val(campo8_value);

                    var html = '<tr>';
                    html += '<td class="acciones"><i class="bx bxs-edit-alt editar-fila"></i><i class="bx bxs-message-alt-x eliminar-fila"></i></th>';

                    html += '<td><input required class="editable" name="Nombre[]" value="' + campo2_value + '" readonly></td>';
                    html += '<td><input required class="editable" name="Tematica[]" value="' + campo3_value + '" readonly></td>';
                    html += '<td><input required class="editable" name="Talla[]" value="' + campo4_value + '" readonly></td>';
                    html += '<td><input required class="editable" name="Cantidad[]" value="' + campo5_value + '" readonly></td>';
                    html += '<td><input required class="editable" name="Precio[]" value="' + campo6_value + '" readonly></td>';
                    html += '<td><input required class="editable" name="Precio_T[]" id=Precio_Total value="' + campo7_value + '" readonly></td>';
                    html += '</tr>';
                    $("#fields").append(html);



                    $('#in1').val('');
                    $('#in2').val('');
                    $('#in3').val('');
                    $('#in4').val('');
                    $('#in5').val('');
                    bandera = true;
                }
                contador++
                var inputs_disfraces = document.querySelectorAll(".disimput");

                if (one_case) {
                    for (const input_t of inputs_disfraces) {
                        input_t.required = false;
                    }
                }



            });



            $(document).on("click", ".eliminar-fila", function () {


                contador--
                //$(this).closest("tr").remove();

                var fila = $(this).closest("tr"); // Encuentra la fila más cercana
                var datos = []; // Arreglo para almacenar los datos de la fila

                // Iterar sobre cada celda de la fila y obtener su contenido
                fila.find("td").each(function () {
                    var contenido = $(this).find('input').val(); // Obtener el texto de la celda
                    datos.push(contenido); // Agregar el contenido al arreglo
                });
                /*console.log(datos)
                console.log(datos[4])
                console.log(datos[5])*/
                campo8_value -= datos[4] * datos[5]
                $('#precio_del_disfraz').val(campo8_value);
                $(this).closest("tr").remove();

                if (contador == 0) {
                    delete_();
                }

            });


            $(document).on("click", ".editar-fila", function () {
                const input_filas = document.querySelectorAll('.editable')
                function vacio_fila() {
                    bandera_edit = true;
                    for (const inputs_f of input_filas) {
                        if (inputs_f.value.length === 0) {
                            bandera_edit = false;
                        }

                    }
                }
                vacio_fila()
                console.log(bandera_edit)
                if (bandera_edit == true) {
                    var fila = $(this).closest("tr");
                    var campos = fila.find(".editable");

                    if (campos.prop("readonly")) {
                        campos.prop("readonly", false);
                        $(this).removeClass("bx bxs-edit-alt").addClass("bx bxs-check-square");
                        var celdas = $(this).closest("tr");
                        var datos = [];
                        celdas.find("td").each(function () {
                            var contenido = $(this).find('input').val();
                            datos.push(contenido);
                        });
                        campo8_value -= datos[4] * datos[5]




                        console.log(bandera_edit)

                        $('#precio_del_disfraz').val(campo8_value);
                    } else {
                        campos.prop("readonly", true);
                        $(this).removeClass("bx bxs-check-square").addClass("bx bxs-edit-alt");

                        var n_celdas = $(this).closest("tr");

                        var n_datos = [];
                        n_celdas.find("td").each(function () {
                            var n_contenido = $(this).find('input').val();
                            n_datos.push(n_contenido);
                        });
                        campo8_value += n_datos[4] * n_datos[5];
                        $('#precio_del_disfraz').val(campo8_value);
                        $(this).closest("tr").find("#Precio_Total").val(n_datos[4] * n_datos[5]);
                        bandera_edit = true
                    }
                }
            });


            const select = document.getElementById('seleccionar');
            const input = document.getElementById('in3');

            select.addEventListener('change', function () {
                input.value = select.value;
            });
        });
    </script>
    <?php
    include("bd.php");
    ?>
</body>
<script src='index.js'></script>

</html>