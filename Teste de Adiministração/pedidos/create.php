<?php
require_once '../config/db.php';
include_once '../includes/header.php';

// Produtos e Fornecedores para o select
$produtos = $pdo->query("SELECT id, nome FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
$fornecedores = $pdo->query("SELECT id, nome FROM fornecedores")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produto_id = $_POST['produto_id'];
    $fornecedor_id = $_POST['fornecedor_id'];
    $quantidade = $_POST['quantidade'];
    $data_pedido = $_POST['data_pedido'];

    $sql = "INSERT INTO pedidos (produto_id, fornecedor_id, quantidade, data_pedido) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto_id, $fornecedor_id, $quantidade, $data_pedido]);

    header("Location: index.php");
    exit;
}
?>

<h2>Novo Pedido</h2>
<form method="post">
    <label>Produto:</label><br>
    <select name="produto_id" required>
        <option value="">Selecione...</option>
        <?php foreach ($produtos as $prod): ?>
            <option value="<?= $prod['id'] ?>"><?= htmlspecialchars($prod['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Fornecedor:</label><br>
    <select name="fornecedor_id" required>
        <option value="">Selecione...</option>
        <?php foreach ($fornecedores as $forn): ?>
            <option value="<?= $forn['id'] ?>"><?= htmlspecialchars($forn['nome']) ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" required><br><br>

    <label>Data do Pedido:</label><br>
    <input type="date" name="data_pedido" required><br><br>

    <button type="submit">Salvar</button>
</form>
<br>
<a class="button" href="index.php">Voltar</a>

<?php include_once '../includes/footer.php'; ?>
