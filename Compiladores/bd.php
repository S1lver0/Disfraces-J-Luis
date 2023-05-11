<?php

    include("conex.php");
    
    if (isset($_POST['registrar'])) {
        $id_c=uniqid();
        $id_f=uniqid();
        

        if (strlen($_POST['nombre_c']) >= 1 && strlen($_POST['apellido_c'])) {

            


            $nombre_c = trim($_POST['nombre_c']);
            $apellido_c = trim($_POST['apellido_c']);
            $dni_c = trim($_POST['dni_c']);
            $domicilio_c = trim($_POST['domicilio_c']);
            $celular_c = trim($_POST['celular_c']);
            

            $consulta = "INSERT INTO cliente(Id, Nombre, Apellido, DNI, Domicilio, Celular) VALUES ('$id_c','$nombre_c','$apellido_c','$dni_c','$domicilio_c','$celular_c')";
            $resultado = mysqli_query($conex,$consulta);
            if ($resultado) {
                ?> 
                <h3 class="ok">¡Te has inscrito correctamente!</h3>
            <?php
            } else {
                ?> 
                <h3 class="bad">¡Ups ha cliente ocurrido un error!</h3>

            <?php
                    die(mysqli_error($conex));
            }
        }   else {
                ?> 
                <h3 class="bad">¡Por favor complete los campos!</h3>
            <?php
        }

            $fecha_e = trim($_POST['fecha_e']);
            $fecha_d = trim($_POST['fecha_d']);
            $precio_f = trim($_POST['Precio_dis']);

            $consulta2 = "INSERT INTO ficha (Id, F_Entrega, F_Devolucion, Precio, Id_Cliente) VALUES ('$id_f','$fecha_e','$fecha_d','$precio_f','$id_c')";
            $resultado2 = mysqli_query($conex,$consulta2);
            if ($resultado2) {
                ?> 
                <h3 class="ok">¡Te has inscrito correctamente!</h3>
            <?php
            } else {
                ?> 
                <h3 class="bad">¡Ups  ficha ha ocurrido un error!</h3>

            <?php
                    die(mysqli_error($conex));
            }

            
            
            


            //$ids = $_POST['Id'];
            $nombres = $_POST['Nombre'];
            $tematicas = $_POST['Tematica'];
            $cantidades = $_POST['Cantidad'];
            $tallas = $_POST['Talla'];
            $precios = $_POST['Precio'];
            $precios_det = $_POST['Precio_T'];
                    
            $values = array();

            /*for ($i = 0; $i < count($ids); $i++) {


                $id = mysqli_real_escape_string($conex, $ids[$i]);
                $nombre = mysqli_real_escape_string($conex, $nombres[$i]);
                $tematica = mysqli_real_escape_string($conex, $tematicas[$i]);
                $cantidad = mysqli_real_escape_string($conex, $cantidades[$i]);
                $talla = mysqli_real_escape_string($conex, $tallas[$i]);
                $precio = mysqli_real_escape_string($conex, $precios[$i]);


                $values[] = "('$id', '$nombre', '$tematica', '$cantidad', '$precio', '$talla')";
            }*/

            for ($i = 0; $i < count($nombres); $i++) {

                $id_detalle= uniqid();
                $id_disfraz = uniqid();

                $nombre = mysqli_real_escape_string($conex, $nombres[$i]);
                $tematica = mysqli_real_escape_string($conex, $tematicas[$i]);
                $cantidad = mysqli_real_escape_string($conex, $cantidades[$i]);
                $talla = mysqli_real_escape_string($conex, $tallas[$i]);
                $precio = mysqli_real_escape_string($conex, $precios[$i]);

                $precio_dt = mysqli_real_escape_string($conex, $precios_det[$i]);


                $values[] = "('$id_disfraz', '$nombre', '$tematica', '$cantidad', '$precio', '$talla')";

                $values_detalle[] = "('$id_detalle', '$precio_dt', '$id_f', '$id_disfraz')";
            }
            

            

            $query = "INSERT INTO disfraz (Id, Nombre, Tematica, Cantidad, Precio, Talla) VALUES " . implode(", ", $values);
                    
            if (mysqli_query($conex, $query)) {
                echo "Datos insertados correctamente";
            } else {
                echo "Error disfraz al insertar datos: " . mysqli_error($conex);
            }

            /*$id_dis= $_POST['Id'];

            $values_detalle = array();

            for ($j = 0; $j < count($id_dis); $j++) {
                $id_detalle= uniqid();
                $id_di = mysqli_real_escape_string($conex, $id_dis[$j]);

                $values_detalle[] = "('$id_detalle', '$id_di', '$id_f')";
            }*/

                $consulta_detalle = "INSERT INTO detalle_ficha(Id, Precio, id_Ficha, id_Disfraz) VALUES " . implode(", ", $values_detalle);
                
                $resultado_detalle = mysqli_query($conex,$consulta_detalle);

                if (mysqli_query($conex, $consulta_detalle)) {
                    echo "Datos insertados correctamente";
                } else {
                    echo "Error detalle al insertar datos: " . mysqli_error($conex);
            }
        
    }
?>