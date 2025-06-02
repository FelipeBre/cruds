<?php
require_once '../Conf/conexão.php';

$stmt = $pdo->query("SELECT * FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../css/usuarios.css">
<h2>Usuários</h2>
<a class="button" href="create.php">+ Novo Usuário</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td><?= $usuario['id'] ?></td>
            <td><?= htmlspecialchars($usuario['nome']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td>
                <a class="button" href="edit.php?id=<?= $usuario['id'] ?>">Editar</a>
                <a class="button" href="delete.php?id=<?= $usuario['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once '../includes/footer.php'; ?>
