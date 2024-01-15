<?php

    /* colocamos los datos de nuestra base de datos */

    //$conexion = mysqli_connect("localhost", "jujo", "@Molina2009", "jujo_barberc");
    $conexion = mysqli_connect("localhost", "root", "", "barberc_db");
    
    if($conexion){
    }else{
        echo '<script> alert("No se ha podido establecer conexión con la pagina web, por favor verifique la conexión❌"); </script>';
    }
?>