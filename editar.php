<?php
    if (!isset($_SESSION)){
        session_start();
    }
    if (!isset($_SESSION['usuario'])){
        header('Location: login.php');
        die();
    }
    include('conexao.php');
    $id = intval($_GET['id']);
    function limpar_texto($str){
        return preg_replace("/[^0-9]/","",$str);
    }

    if (count($_POST)>0){
       
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
                $sql_code = "UPDATE clientes
                set nome = '$nome',
                   email = '$email',
                   senha = '$senha',
                telefone = '$telefone',
              nascimento = '$nascimento',
                   admin = '$admin'
                   where id = '$id'";
            $deucerto = $mysqli->query($sql_code) or die($mysqli->error);
            if ($deucerto){
                echo"<p><b>Dados atualizados com sucesso!!!
                </b></p>";
                unset($_POST);
            }       
        }
    }
    $sql_cliente="SELECT * FROM clientes WHERE id = '$id'";
  
    $query_cliente = $mysqli->query($sql_cliente)or die($mysqli->error);
    
    $cliente =  $query_cliente->fetch_assoc();
 ?>
 <!DOCTYPE html>
 <html lang="pt-br">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Clientes</title>
 </head>
 <body>
    <h1>Editar Dados</h1>
    <form action="" method="post">
       <p>
            <label for="">Nome</label>
            <input value="<?php echo $cliente['nome'];?>" name="nome" type="text">
       </p>
       <p>
            <label for="">Email</label>
            <input value="<?php echo $cliente['email'];?>" name="email" type="text">
       </p>
       <p>
            <label for="">Senha</label>
            <input value="<?php echo $cliente['senha'];?>" name="senha" type="password">
       </p>
       <p>
            <label for="">Telefone</label>
            <input value="<?php echo $cliente['telefone'];?>" name="telefone" type="text">
       </p>
       <p>
            <label for="">Data de nascimento</label>
            <input value="<?php echo formatar_data($cliente['nascimento']);?>" name="nascimento" type="text">
       </p>
        <p>
            <label for="">Tipo</label>
            <br>
            <input name="admin" value="1"type="radio">Admin
            <input name="admin" value="0"type="radio">Cliente
        </p>
        <p>
            <button type="submit">Editar Cliente</button>
        </p>
    </form>
 </body>
 </html>
