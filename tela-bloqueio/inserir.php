<?php
include "../inc/conexao.php";

$nome_da_empresa = $_POST["nome_da_empresa"];
$email = $_POST["email"];
$contato = $_POST["contato"];
$senha = $_POST["senha"];

$sql = "insert into t_cliente (nome_da_empresa, email, contato, senha) values('$nome_da_empresa', '$email', '$contato', '$senha')";

mysqli_query($conexao, $sql);
mysqli_close($conexao);

header("Location: ../tela-bloqueio/login.php");

?>