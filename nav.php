<?php

?>

<!DOCTYPE html>
<html lang="en">
<header>
        
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>NAVEGACION</title>
</header>

<body>
        <nav class="contenedor">
                <ul class="columnas">
                        <li class="filas"><a class="enlace" href="../Alquiler/registro_alquiler.php">Registrar
                                        Alquiler</a></li>
                        <li id="final" class="filas"><a class="enlace" href="../Alquiler/tabla_alquiler.php">Ver Tabla de
                                        Alquiler</a></li>
                </ul>
        </nav>


        <style>
                @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
                body {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                }

                header {
                        background-color: #F9F8FC;
                }

                .contenedor {
                        padding: 0px;
                        width: 100%;
                        background-color: black;
                }

                .columnas {
                        height: 100px;
                        margin: 0px;
                        width: 100%;
                        display: flex;
                        justify-content: end;
                }

                .filas{
                        display: flex;
                        align-items: center;
                        width: auto;
                }


                nav ul li a {
                        font-family: 'Roboto', sans-serif;
                        text-align: center;
                        color: white;
                        font-weight: bold;
                        text-decoration: none;
                        font-size: 5px;
                        padding: 18px;
                }

                .enlace {
                        color: white;
                        text-decoration: none;
                        font-weight: bold;
                        font-size: 25px;
                        text-decoration: none;
                }

                .filas:hover {
                        background-color: white;
                }
                .enlace:hover{
                        color: black;
                }

                #final{
                        margin-right: 50px;
                }
        </style>

</body>

</html>