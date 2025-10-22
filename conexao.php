<?php
     $host ="localhost";
     $db   = "agenda";
     $user = "root";
     $pass = "";

     $mysqli = new mysqli($host,$user,
                        $pass, $db);
     if ($mysqli->connect_errno){
        die("Falha ao conectar no Banco de Dados!!!");
     }

     function formatar_data($data){
        return implode('/',array_reverse(explode('-',$data)));
     }
  



?>