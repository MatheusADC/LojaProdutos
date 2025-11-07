<?php
include_once 'conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idproduto = $_POST['idproduto'] ?? null;
    $descricao = trim($_POST['descricao'] ?? '');
    $preco = $_POST['preco'] ?? 0;
    $data = $_POST['data'] ?? null;

    if ($idproduto && $descricao && $preco !== '') {
        $sql = "UPDATE produto SET descricao = ?, preco = ?, data = ? WHERE idproduto = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdsi", $descricao, $preco, $data, $idproduto);

        if ($stmt->execute()) {
            header("Location: consultar.php?produto=editado");
            exit;
        } else {
            header("Location: consultar.php?produto=erro");
            exit;
        }
    } else {
        header("Location: consultar.php?produto=erro");
        exit;
    }
}
