<?php
require_once '../conf/conexao.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;