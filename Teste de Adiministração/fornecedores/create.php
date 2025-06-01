<?php
require_once '../config/db.php';
include_once '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO fornecedores (nome, cnpj, telefone) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cnpj, $telefone]);

    header("Location: index.php");
    exit;
}
?>

<h2>Novo Fornecedor</h2>
<form method="post">
    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>CNPJ:</label><br>
    <input type="text" name="cnpj" required><br><br>

    <label>Telefone:</label><br>
    <input type="text" name="telefone"><br><br>

    <button type="submit">Salvar</button>
</form>
<br>
<a class="button" href="index.php">Voltar</a>

<?php include_once '../includes/footer.php'; ?>
