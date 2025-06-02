<?php
require_once '../config/db.php';
include_once '../includes/header.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $email, $id]);

    header("Location: index.php");
    exit;
}
?>

<h2>Editar Usuário</h2>
<form method="post">
    <label>Nome:</label><br>
    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br><br>

    <button type="submit">Atualizar</button>
</form>
<br>
<a class="button" href="index.php">Voltar</a>

<?php include_once '../includes/footer.php'; ?>
