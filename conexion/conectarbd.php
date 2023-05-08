<?php
class Cconexion
{
    function ConexionBD()
    {
        $host = "localhost";
        $dbname = "disfraz";
        $username = "root";
        $pasword = "";
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $pasword);
        } catch (PDOException $exp) {
            echo ("No se logro conectar correctamente con la base de datos : --$dbname, error :$exp");

        }
        return $conn;
    }

}

?>