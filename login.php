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
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Entrar</h1>
    <div class="login">
    <form action="" method="post">
        <label for="">Email</label>
        <input type="email" name="email" id="">
        <br>
        <label for="">Senha</label>
        <input type="password" name="senha" id="">
        <br>
        <button type="submit">Entrar</button>
    </form>
    </div>
</body>
</html>


