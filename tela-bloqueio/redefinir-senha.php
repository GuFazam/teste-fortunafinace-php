<?php
// Arquivo: redefinir-senha.php

// Verifica se a requisição foi feita através do método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica se os campos do formulário foram preenchidos
    if (empty($_POST['username']) || empty($_POST['old_password']) || empty($_POST['new_password'])) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Inclui o arquivo de conexão com o banco de dados
        require_once 'conexao.php';

        // Obtém os dados do formulário e faz o tratamento para evitar injeção de SQL
        $username = $conexao->real_escape_string($_POST['username']);
        $oldPassword = $conexao->real_escape_string($_POST['old_password']);
        $newPassword = $conexao->real_escape_string($_POST['new_password']);

        // Consulta SQL para verificar se o usuário existe no banco de dados
        $sql = "SELECT * FROM tabela_usuarios WHERE username = '$username' AND password = '$oldPassword'";
        $result = $conexao->query($sql);

        // Verifica se ocorreu algum erro na consulta
        if (!$result) {
            die("Erro na consulta: " . $conexao->error);
        }

        // Verifica se o usuário existe no banco de dados e se a senha antiga está correta
        if ($result->num_rows > 0) {
            // Atualiza a senha do usuário no banco de dados
            $updateSql = "UPDATE tabela_usuarios SET password = '$newPassword' WHERE username = '$username'";
            if ($conexao->query($updateSql)) {
                // Senha atualizada com sucesso
                echo "Senha atualizada com sucesso!";
            } else {
                // Ocorreu um erro ao atualizar a senha
                echo "Erro ao atualizar a senha: " . $conexao->error;
            }
        } else {
            // Nome de usuário e/ou senha antiga incorretos
            echo "Nome de usuário e/ou senha antiga incorretos. Verifique os dados e tente novamente.";
        }

        // Fecha a conexão com o banco de dados
        $conexao->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/redefinir-senha.css">

</head>

<body>
    <div>
        <img src="../img/logo.png" alt="imagem do logo da empresa" class="logo">
    </div>

    <div class="container">
        <h1><strong>REDEFINIR SENHA</strong></h1>
        <br>
        <br>

        <form method="POST" action="redefinir-senha.php">
            <p class="descrição1">Nome de Usuário:</p>
            <input type="text" name="username" placeholder="Fortuna Company" required>
            <br>
            <p class="descrição">Antiga Senha:</p>
            <input type="password" name="old_password" placeholder="Senha" required>
            <br>
            <p class="descrição">Nova Senha:</p>
            <input type="password" name="new_password" placeholder="Senha" required>
            <br>
            <br>
            <button type="submit">Entrar</button>
        </form>

        <p>Já tem conta? <a href="login.php">Efetuar Login</a></p>

    </div>

</body>

</html>