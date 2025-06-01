<?php
require_once '../config/db.php';
include_once '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    $sql = "INSERT INTO produtos (nome, preco, quantidade) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $preco, $quantidade]);

    header("Location: index.php");
    exit;
}
?>

<h2>Novo Produto</h2>
<form method="post">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Preço (R$):</label><br>
    <input type="number" step="0.01" name="preco" required><br><br>

    <label>Quantidade:</label><br>
    <input type="number" name="quantidade" required><br><br>

    <button type="submit">Salvar</button>
</form>
<br>
<a class="button" href="index.php">Voltar</a>

<?php include_once '../includes/footer.php'; ?>
