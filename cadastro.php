<?php
    include('conexao.php');
   if (!isset($_SESSION)){
        session_start();
    }
    if (!isset($_SESSION['usuario'])){
        header('Location: login.php');
        die();
    }

    function limpar_texto($str){
        return preg_replace("/[^0-9]/","",$str);
    }

    if (count($_POST)>0){
        include('conexao.php');
        $erro = false;
        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        
    }

?>
