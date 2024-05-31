<?php
include 'database.php';
$qquery = $database->query("SELECT id, nome_completo, email FROM usuarios");
$usuarios = $qquery->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" type="text/css" href="style.css">
<h2>Lista de Usuários</h2>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nome Completo</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($usuarios as $usuario) { ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><?php echo $usuario['nome_completo']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td>
                <a href="editar.php?id=<?php echo $usuario['id']; ?>" class="button">Editar</a>
                <a href="deletar.php?id=<?php echo $usuario['id']; ?>" class="button" onclick="return confirm('Tem certeza?');">Excluir</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<br><a href="criar.php" class="button">Adicionar Novo Usuário</a>