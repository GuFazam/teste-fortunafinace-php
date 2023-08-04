<?php
include "../inc/conexao.php";

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $conexao->real_escape_string($_POST['email']);
    $senha = $conexao->real_escape_string($_POST['senha']);

    // Consulta na tabela 't_cliente'
    $sql = "SELECT * FROM t_cliente WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $sql) or die("Falha na execução do código SQL: " . $conexao->error);

    if (mysqli_num_rows($resultado) > 0) {
        $t_cliente = $resultado->fetch_assoc();

        // Iniciar a sessão
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION["email"] = $email;
        
        // Redirecionar para a página de destino
        header('Location: ../inicio/home.php');
        exit();
    
    } else {
        echo "Falha ao logar! Email ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../02cadastroProdutos/img/favico.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <a href="../tela-bloqueio/login.php">
        <img src="../img/logo.png" alt="imagem do logo da empresa" class="logo">
    </a>
    <div class="container">
        <h1>LOGIN</h1>
        <br><br>

        <form method="POST" >
            <p class="desc1">Nome de Usuário:</p>
            <input type="text" name="email" placeholder="Nome de usuário" required>
            <br>
            <p class="desc">Senha:</p>
            <input type="password" name="senha" placeholder="Senha" required>
            <br>
            <br>
            <button type="submit">Entrar</button>
        </form>

        <p>Ainda não tem uma conta? <a href="cadastro.php">Cadastrar-se</a></p>

    </div>
</body>
</html>