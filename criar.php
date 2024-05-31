<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    // Validar entrada
    $nome = $_POST['nome_completo'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Criptografar senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Preparar SQL e inserir dados
    $qquery = $database->prepare("INSERT INTO usuarios (nome_completo, email, senha) VALUES (:nome, :email, :senha)");
    $qquery->bindParam(':nome', $nome);
    $qquery->bindParam(':email', $email);
    $qquery->bindParam(':senha', $senha_hash);
    if ($qquery->execute()) {
        header("Location: index.php");
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}

?>
<link rel="stylesheet" type="text/css" href="style.css">
<form method="post">
    Nome Completo: <input type="text" name="nome_completo" required><br>
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <input type="submit" value="Cadastrar">
</form>