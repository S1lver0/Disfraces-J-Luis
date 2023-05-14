<?php
// Declaramos las variables de conexión
$ServerName = "bclcgxjcjrtj4pjg2pqf-mysql.services.clever-cloud.com";
$Username = "utuvolae3umgpvfb";
$Password = "mFzFsIAFNXYMhZX8Qsap";
$NameBD = "bclcgxjcjrtj4pjg2pqf";

// Creamos la conexión con MySQL
$conex = new mysqli($ServerName, $Username, $Password, $NameBD);

// Revisamos la Conexión MySQL
if ($conex->connect_error) {
    die("Ha fallado la conexión: " . $conex->connect_error);
}
// Enviamos un mensaje de conexión correcta
echo "Conectado correctamente";
?>