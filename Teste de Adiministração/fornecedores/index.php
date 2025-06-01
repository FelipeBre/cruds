<?php
require_once '../config/db.php';
include_once '../includes/header.php';

$stmt = $pdo->query("SELECT * FROM fornecedores");
$fornecedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="../css/fornecedores.css">
<h2>Fornecedores</h2>
<a class="button" href="create.php">+ Novo Fornecedor</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($fornecedores as $f): ?>
        <tr>
            <td><?= $f['id'] ?></td>
            <td><?= htmlspecialchars($f['nome']) ?></td>
            <td><?= htmlspecialchars($f['cnpj']) ?></td>
            <td><?= htmlspecialchars($f['telefone']) ?></td>
            <td>
                <a class="button" href="edit.php?id=<?= $f['id'] ?>">Editar</a>
                <a class="button" href="delete.php?id=<?= $f['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once '../includes/footer.php'; ?>
