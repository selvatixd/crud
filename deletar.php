<?php
include 'database.php';

// VERIFICAÇÃO
$id = $_GET['id'] ?? '';
if (!$id) {
    echo "Usuário não encontrado.";
    return;
}

// CONSULTAR
$qquery = $database->prepare("DELETE FROM usuarios WHERE id = :id");
$qquery->bindParam(':id', $id);
if ($qquery->execute()) {
    header("Location: index.php");
} else {
    echo "Erro ao excluir usuário.";
}
?>