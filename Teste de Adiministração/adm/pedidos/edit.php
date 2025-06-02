<?php
require_once '../config/db.php';
include_once '../includes/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM pedidos WHERE id = ?");
$stmt->execute([$id]);
$pedido = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pedido) {
    die("Pedido não encontrado.");
}

$produtos = $pdo->query("SELECT id, nome FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
$fornecedores = $pdo->query("SELECT id, nome FROM fornecedores")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto_id = $_POST['produto_id'];
    $fornecedor_id = $_POST['fornecedor_id'];
    $quantidade = $_POST['quantidade'];
    $data_pedido = $_POST['data_pedido'];

    $sql = "UPDATE pedidos SET produto_id = ?, fornecedor_id = ?, quantidade = ?, data_pedido = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id, $fornecedor_id, $quantidade, $data_pedido, $id]);

    header("Location: index.php");
    exit;
}
?>

<h2>Editar Pedido</h2>
<form method="post">
    <label>Produto:</label><br>
    <select name="produto_id" required>
        <?php foreach ($produtos as $prod): ?>
            <option value="<?= $prod['id'] ?>" <?= $pedido['produto_id'] == $prod['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($prod['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Fornecedor:</label><br>
    <select name="fornecedor_id" required>
        <?php foreach ($fornecedores as $forn): ?>
            <option value="<?= $forn['id'] ?>" <?= $pedido['fornecedor_id'] == $forn['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($forn['nome']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" value="<?= $pedido['quantidade'] ?>" required><br><br>

    <label>Data do Pedido:</label><br>
    <input type="date" name="data_pedido" value="<?= $pedido['data_pedido'] ?>" required><br><br>

    <button type="submit">Atualizar</button>
</form>
<br>
<a class="button" href="index.php">Voltar</a>

<?php include_once '../includes/footer.php'; ?>
