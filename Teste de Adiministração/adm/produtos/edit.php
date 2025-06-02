<?php
require_once '../config/db.php';
include_once '../includes/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "UPDATE produtos SET nome = ?, preco = ?, quantidade = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $preco, $quantidade, $id]);

    header("Location: index.php");
    exit;
}
?>

<h2>Editar Produto</h2>
<form method="post">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required><br><br>

    <label>Preço (R$):</label><br>
    <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" value="<?= $produto['quantidade'] ?>" required><br><br>

    <button type="submit">Atualizar</button>
</form>
<br>
<a class="button" href="index.php">Voltar</a>

<?php include_once '../includes/footer.php'; ?>
