<?php
require_once '../Conf/conexão.php';

$sql = "SELECT p.id, p.quantidade, p.data_pedido, 
               pr.nome AS produto, f.nome AS fornecedor
        FROM pedidos p
        JOIN produtos pr ON p.produto_id = pr.id
        JOIN fornecedores f ON p.fornecedor_id = f.id";
$stmt = $pdo->query($sql);
$pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../css/pedidos.css">
<h2>Pedidos</h2>
<a class="button" href="create.php">+ Novo Pedido</a>

<table>
    <tr>
        <th>ID</th>
        <th>Produto</th>
        <th>Fornecedor</th>
        <th>Quantidade</th>
        <th>Data</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($pedidos as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= htmlspecialchars($p['produto']) ?></td>
            <td><?= htmlspecialchars($p['fornecedor']) ?></td>
            <td><?= $p['quantidade'] ?></td>
            <td><?= date('d/m/Y', strtotime($p['data_pedido'])) ?></td>
            <td>
                <a class="button" href="edit.php?id=<?= $p['id'] ?>">Editar</a>
                <a class="button" href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Excluir este pedido?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once '../includes/footer.php'; ?>
