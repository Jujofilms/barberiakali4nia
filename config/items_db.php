<?php

//conexion a la base de datos

class Database{
    // private $hostname = "localhost";
    // private $database = "jujo_barberc";
    // private $username = "jujo";
    // private $password = "@Molina2009";
    // private $charset = "utf8";

    private $hostname = "localhost";
    private $database = "barberc";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    function conectar(){
        try{
        $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset=" . $this->charset;

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo = new PDO($conexion, $this->username, $this->password, $options);

        return $pdo;
    } catch(PDOException $e){
        echo 'Error conexion: ' . $e->getMessage();
        exit;
    }
    }
}

?>