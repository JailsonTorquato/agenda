<?php
   
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
        $nome       = $_POST['nome'];
        $email      = $_POST['email'];
        $telefone   = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];
        $senha      = $_POST['senha'];
        $admin      = $_POST['admin'];
        if (empty($nome)){
            $erro="Preencha o seu nome";
        }
        if (empty($email)){
           $erro="Preencha o seu email";  
        }
        
        if (!empty($nascimento)){
            $pedacos = explode("/",$nascimento);
            if (count($pedacos)==3){
                $nascimento = implode("-",array_reverse($pedacos));
            }else{
                $erro = "A data está errada. Cadastre no seguinte formato   dd/mm/aaaa";
            }
           }
           if (!empty($telefone)){
                if (strlen($telefone)>17){
                $erro="Preencha o telefone de modo correto";  
                } 
            }
            if ($erro){
                echo "<p><b>Erro: $erro</b></p>";
            }else{
                $sql_code="INSERT INTO clientes (nome,email,senha,telefone,nascimento,data,admin)values('$nome','$email','$senha','$telefone','$nascimento',NOW(),'$admin')";
           
                $deucerto=$mysqli->query($sql_code) or ($mysqli->error);
                if ($deucerto){
                    echo"cadastro efetuado com sucesso!!!";
                    unset($_POST);
                }
            }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
</head>
<body>
    <form action="" method="post">
        <p>
            <label for="">Nome</label>
            <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>"name="nome" type="text">
        </p>
        <p>
            <label for="">Email</label>
            <input value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"name="email" type="email">
        </p>
        <p>
            <label for="">Senha</label>
            <input value="<?php if(isset($_POST['senha'])) echo $_POST['senha'];?>"name="senha" type="password">
        </p>
        <p>
            <label for="">Telefone</label>
            <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" placeholder="(xx)xxxxx-xxxx" name="telefone" type="text">
        </p>

        <p>
            <label for="">Data de Nascimento</label>
            <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>" placeholder="dd/mm/aaaa" name="nascimento" type="text">
        </p>
        
        <p>
            <label for="">Tipo</label>
            <br>
            <input name="admin" value="1"type="radio">Admin
            <input name="admin" value="0"type="radio">Cliente
        </p>
        <p>
            <button type="submit">Salvar Cliente</button>
        </p>
    </form>  
</body>
</html>
