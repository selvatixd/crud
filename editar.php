<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
    $id = $_POST['id'];
    $nome = $_POST['nome_completo'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Criptografar senha
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $qquery = $database->prepare("UPDATE usuarios SET nome_completo = :nome, email = :email, senha = :senha WHERE id = :id");
    $qquery->bindParam(':id', $id);
    $qquery->bindParam(':nome', $nome);
    $qquery->bindParam(':email', $email);
    $qquery->bindParam(':senha', $senha_hash);
    if ($qquery->execute()) {
        header("Location: index.php");
    } else {
        echo "Erro ao editar usuário.";
    }
}
// ID
$id = $_GET['id'] ?? '';
if (!$id) {
    echo "Usuário não encontrado.";
    return;
}

// CONSULTAR
$qquery = $database->prepare("SELECT * FROM usuarios WHERE id = :id");
$qquery->bindParam(':id', $id);
$qquery->execute();
$usuario = $qquery->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    return;
}
?>
<link rel="stylesheet" type="text/css" href="style.css">
<h2>Editar Usuário</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
    Nome Completo: <input type="text" name="nome_completo" value="<?php echo $usuario['nome_completo']; ?>" required><br>
    Email: <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>
    Senha: <input type="password" name="senha" required><br>
    <input type="submit" value="Atualizar">
</form>