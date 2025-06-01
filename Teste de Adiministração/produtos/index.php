<?php
require_once '../config/db.php';
include_once '../includes/header.php';

$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../css/produtos.css">
<h2>Produtos</h2>
<a class="button" href="create.php">+ Novo Produto</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Preço (R$)</th>
        <th>Quantidade</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><?= $produto['id'] ?></td>
            <td><?= htmlspecialchars($produto['nome']) ?></td>
            <td><?= number_format($produto['preco'], 2, ',', '.') ?></td>
            <td><?= $produto['quantidade'] ?></td>
            <td>
                <a class="button" href="edit.php?id=<?= $produto['id'] ?>">Editar</a>
                <a class="button" href="delete.php?id=<?= $produto['id'] ?>" onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once '../includes/footer.php'; ?>
