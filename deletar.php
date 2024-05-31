<?php
include 'database.php';

// Obter o ID do usuário a ser excluído
$id = $_GET['id'] ?? '';
if (!$id) {
    echo "Usuário não encontrado.";
    return;
}

// Preparar SQL e deletar usuário
$qquery = $database->prepare("DELETE FROM usuarios WHERE id = :id");
$qquery->bindParam(':id', $id);
if ($qquery->execute()) {
    header("Location: index.php");
} else {
    echo "Erro ao excluir usuário.";
}
?>