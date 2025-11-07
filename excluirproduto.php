<?php
include_once 'conn.php';

if (isset($_GET['idproduto'])) {
    $idProduto = intval($_GET['idproduto']);

    $sql = "DELETE FROM produto WHERE idproduto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProduto);

    if ($stmt->execute()) {
        header("Location: consultar.php?produto=excluido");
        exit;
    } else {
        echo "Erro ao excluir o produto.";
    }
} else {
    echo "ID inválido.";
}