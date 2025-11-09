<?php
include_once 'header.php';
include_once 'conn.php';

$descricao = "";
$data = "";
$preco = "";
$erros = [];

// Se o formulário for enviado
if (isset($_POST['btn-cadastrar'])) {
    $descricao = trim($_POST['txtdescricao']);
    $data = trim($_POST['txtdata']);
    $preco = trim($_POST['txtpreco']);

    // Validações
    if (empty($descricao)) {
        $erros['descricao'] = "A descrição é obrigatória.";
    }
    if (empty($data)) {
        $erros['data'] = "A data é obrigatória.";
    }
    if (!is_numeric($preco) || $preco <= 0) {
        $erros['preco'] = "Informe um valor válido.";
    }

    // Se não houver erros, insere no banco
    if (empty($erros)) {
        $sql = "INSERT INTO produto (descricao, data, preco) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $descricao, $data, $preco);

        if ($stmt->execute()) {
            // Redireciona para a tela de consulta
            header("Location: consultar.php");
            exit;
        } else {
            echo "<p class='text-danger text-center mt-2'>Erro ao cadastrar: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }
}
$conn->close();
?>

<link rel="stylesheet" href="css/cadastrarproduto.css">

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card cobalt-card shadow-sm p-4">
                <h4 class="text-center mb-4">Novo Produto</h4>

                <form action="" method="POST" class="d-flex flex-column gap-1">

                    <div>
                        <label for="txtdescricao" class="form-label">Descrição:</label>
                        <input type="text" class="form-control" id="txtdescricao" name="txtdescricao"
                            placeholder="Ex: Celular Samsung Galaxy S23"
                            value="<?= htmlspecialchars($descricao); ?>">
                        <?php if (isset($erros['descricao'])): ?>
                            <small class="text-danger fw-bold"><?= $erros['descricao']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="txtdata" class="form-label">Data de Inclusão:</label>
                        <input type="date" class="form-control" id="txtdata" name="txtdata"
                            value="<?= htmlspecialchars($data); ?>">
                        <?php if (isset($erros['data'])): ?>
                            <small class="text-danger fw-bold"><?= $erros['data']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="txtpreco" class="form-label">Preço:</label>
                        <input type="number" step="0.01" class="form-control" id="txtpreco" name="txtpreco"
                            placeholder="Ex: 1999.99"
                            value="<?= htmlspecialchars($preco); ?>">
                        <?php if (isset($erros['preco'])): ?>
                            <small class="text-danger fw-bold"><?= $erros['preco']; ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-3">
                        <button type="submit" name="btn-cadastrar" class="btn btn-warning fw-bold px-4">Cadastrar</button>
                        <a href="consultar.php" class="btn btn-outline-light fw-bold px-4">Lista de produtos </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>