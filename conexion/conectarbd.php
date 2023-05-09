<?php

function ConexionBD()
{
    $host = "localhost";
    $database = "disfraz";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    } else {
        return $conn;
    }

}
?>