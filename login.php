<?php
    if (isset($_POST['email']) && (isset($_POST['senha']))){
        include ('conexao.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql_code = "SELECT * FROM clientes WHERE email = '$email'";
        
        $sql_query = $mysqli->query($sql_code) or 
                     die ($mysqli->error); 
        if ($sql_query->num_rows == 0){
            echo "Email não cadastrado";
        }else{
            $usuario = $sql_query->fetch_assoc();
            if ($usuario['senha']==$senha){
                if(!isset($_SESSION)){
                    session_start();
                    $_SESSION['usuario'] = $usuario['id'];
                    $_SESSION['admin'] = $usuario['admin'];
                    header("Location:clientes.php");
                }
            }
            else{
                echo"Senha incorreta";
            }
        }                           
    }
?>


