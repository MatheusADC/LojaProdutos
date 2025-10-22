<?php
include_once 'header.php';

// Lista inicial de produtos
$produto1 = ["codigo" => "1", "modelo" => "Galaxy S23", "marca" => "Samsung", "armazenamento" => "128GB", "valor" => "4500"];
$produto2 = ["codigo" => "2", "modelo" => "iPhone 14", "marca" => "Apple", "armazenamento" => "256GB", "valor" => "5000"];
$produto3 = ["codigo" => "3", "modelo" => "Redmi Note 12", "marca" => "Xiaomi", "armazenamento" => "128GB", "valor" => "1800"];
$produto4 = ["codigo" => "4", "modelo" => "Moto G82", "marca" => "Motorola", "armazenamento" => "64GB", "valor" => "1700"];
$produto5 = ["codigo" => "5", "modelo" => "Nord 3", "marca" => "OnePlus", "armazenamento" => "128GB", "valor" => "2500"];
$lista = array($produto1, $produto2, $produto3, $produto4, $produto5);

$erros = [];

if (isset($_POST['btn-cadastrar'])) {
    $modelo = $_POST['txtmodelo'] ?? "";
    $marca = $_POST['txtmarca'] ?? "";
    $armazenamento = $_POST['txtarmazenamento'] ?? "";
    $valor = $_POST['txtvalor'] ?? "";

    // Validações
    if (!filter_var($modelo, FILTER_SANITIZE_STRING) || empty(trim($modelo))) {
        $erros['modelo'] = "Modelo inválido ou vazio!";
    }
    if (!filter_var($marca, FILTER_SANITIZE_STRING) || empty(trim($marca))) {
        $erros['marca'] = "Marca inválida ou vazia!";
    }
    if (!filter_var($armazenamento, FILTER_SANITIZE_STRING) || empty(trim($armazenamento))) {
        $erros['armazenamento'] = "Armazenamento inválido ou vazio!";
    }
    if (!filter_var($valor, FILTER_VALIDATE_FLOAT) || $valor <= 0) {
        $erros['valor'] = "Valor inválido ou vazio!";
    }

    if (empty($erros)) {
        $novoProduto = [
            "codigo" => count($lista) + 1,
            "modelo" => $modelo,
            "marca" => $marca,
            "armazenamento" => $armazenamento,
            "valor" => $valor
        ];
        array_push($lista, $novoProduto);
    }
}
?>

<link rel="stylesheet" href="css/consultar.css">
<div class="container my-5">
    <div class="row g-4">
        <!-- Formulário de inclusão -->
        <div class="col-12 col-lg-5">
            <div class="card cobalt-card shadow-sm p-3">
                <h4 class="text-center mb-3">Incluir Produto</h4>
                <form action="consultar.php" method="POST" novalidate>

                    <div class="mb-2">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="txtmodelo"
                            value="<?= $_POST['txtmodelo'] ?? '' ?>">
                        <?php if (isset($erros['modelo'])) echo '<small class="text-danger">' . $erros['modelo'] . '</small>'; ?>
                    </div>

                    <div class="mb-2">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="txtmarca"
                            value="<?= $_POST['txtmarca'] ?? '' ?>">
                        <?php if (isset($erros['marca'])) echo '<small class="text-danger">' . $erros['marca'] . '</small>'; ?>
                    </div>

                    <div class="mb-2">
                        <label for="armazenamento" class="form-label">Armazenamento</label>
                        <input type="text" class="form-control" id="armazenamento" name="txtarmazenamento"
                            value="<?= $_POST['txtarmazenamento'] ?? '' ?>">
                        <?php if (isset($erros['armazenamento'])) echo '<small class="text-danger">' . $erros['armazenamento'] . '</small>'; ?>
                    </div>

                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="valor" name="txtvalor"
                            value="<?= $_POST['txtvalor'] ?? '' ?>">
                        <?php if (isset($erros['valor'])) echo '<small class="text-danger">' . $erros['valor'] . '</small>'; ?>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="btn-cadastrar" class="btn btn-warning fw-bold w-50">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabela de consulta -->
        <div class="col-12 col-lg-7">
            <div class="card cobalt-card shadow-sm p-3">
                <h4 class="text-center mb-3">Lista de Produtos</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle table-bordas">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Modelo</th>
                                <th>Marca</th>
                                <th>Armazenamento</th>
                                <th>Valor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($lista) > 0): ?>
                                <?php foreach ($lista as $valorproduto): ?>
                                    <tr>
                                        <td><?= $valorproduto["codigo"] ?></td>
                                        <td><?= $valorproduto["modelo"] ?></td>
                                        <td><?= $valorproduto["marca"] ?></td>
                                        <td><?= $valorproduto["armazenamento"] ?></td>
                                        <td>R$ <?= number_format($valorproduto["valor"], 2, ',', '.') ?></td>
                                        <td>
                                            <a href="editar.php?<?= $valorproduto["codigo"]; ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="excluir.php?<?= $valorproduto["codigo"]; ?>" class="btn btn-sm btn-outline-dark"
                                                data-bs-toggle="modal"
                                                data-bs-target="#exampleModal<?= $valorproduto["codigo"]; ?>">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!--INICIO do Modal-->
                                    <div class='modal fade' id="exampleModal<?php echo  $valorproduto["codigo"]; ?>" tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog modal-dialog-centered'>
                                            <div class='modal-content'>
                                                <div class='modal-header bg-danger text-white'>
                                                    <h1 class='modal-title fs-5 ' id='exampleModalLabel'>ATENÇÃO!</h1>
                                                    <button type='button' class='btn-close btn-close-white' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body mb-3 mt-3'>
                                                    Tem certeza que deseja <b>EXCLUIR</b> o produto <?php echo $valorproduto["modelo"]; ?>?
                                                </div>
                                                <div class='modal-footer'>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Voltar</button>
                                                    <a href="excluir.php?id=<?php echo  $valorproduto["codigo"]; ?>" type='button' class='btn btn-danger'>Sim, quero!</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--FIM do Modal-->

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Nenhum produto cadastrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>