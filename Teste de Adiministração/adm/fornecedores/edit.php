<?php
require_once '../config/db.php';
include_once '../includes/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
$stmt->execute([$id]);
$fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fornecedor) {
    die("Fornecedor não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cnpj = $_POST['cnpj'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE fornecedores SET nome = ?, cnpj = ?, telefone = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $cnpj, $telefone, $id]);

    header("Location: index.php");
    exit;
}
?>

<h2>Editar Fornecedor</h2>
<form method="post">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= htmlspecialchars($fornecedor['nome']) ?>" required><br><br>

    <label>CNPJ:</label><br>
    <input type="text" name="cnpj" value="<?= htmlspecialchars($fornecedor['cnpj']) ?>" required><br><br>

    <label>Telefone:</label><br>
    <input type="text" name="telefone" value="<?= htmlspecialchars($fornecedor['telefone']) ?>"><br><br>

    <button type="submit">Atualizar</button>
</form>
<br>
<a class="button" href="index.php">Voltar</a>

<?php include_once '../includes/footer.php'; ?>
