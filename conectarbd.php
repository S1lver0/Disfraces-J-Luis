<?php
// Declaramos las variables de conexión
$ServerName = "-";
$Username = "utuvolae3umgpvfb";
$Password ="-";
$NameBD = "bclcgxjcjrtj4pjg2pqf";

// Creamos la conexión con MySQL
$conex = new mysqli($ServerName, $Username, $Password, $NameBD);

// Revisamos la Conexión MySQL
if ($conex->connect_error) {
    die("Ha fallado la conexión: " . $conex->connect_error);
}
?>