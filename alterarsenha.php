<?php
// Conexão com o banco
include_once 'conn.php';

if (isset($_POST['btnatualizar'])) {
    $email = trim($_POST['txtemail']);
    $novaSenha = trim($_POST['txtnovasenha']);
    $confirmaSenha = trim($_POST['txtConfirmaSenha']);

    // Verifica campos obrigatórios
    if (empty($email) || empty($novaSenha) || empty($confirmaSenha)) {
        $mensagem = '<div class="alert alert-danger text-center fw-bold mt-3 mb-0">Preencha todos os campos!</div>';
    } elseif (strlen($novaSenha) < 6) {
        $mensagem = '<div class="alert alert-danger text-center fw-bold mt-3 mb-0">A senha deve ter pelo menos 6 caracteres!</div>';
    } else if ($novaSenha != $confirmaSenha) {
        $mensagem = '<div class="alert alert-danger text-center fw-bold mt-3 mb-0">A senha está diferente da confirmação!</div>';
    } else {

        // Verifica se o e-mail existe no banco
        $sql = "SELECT * FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $senhaCriptografada = md5($novaSenha);
            $sqlUpdate = "UPDATE usuario SET senha = ? WHERE email = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ss", $senhaCriptografada, $email);

            if ($stmtUpdate->execute()) {
                header("Location: login.php?cadastro=alterado");
                exit;
            } else {
                $mensagem = '<div class="alert alert-danger text-center fw-bold mt-3 mb-0">
                                Erro ao atualizar a senha. Tente novamente.
                             </div>';
            }
        } else {
            $mensagem = '<div class="alert alert-warning text-center fw-bold mt-3 mb-0">
                            E-mail não encontrado!
                         </div>';
        }
    }
}
?>

<?php include_once 'header.php'; ?>

<link rel="stylesheet" href="./css/alterarsenha.css">
<div class="global-container">
    <div class="card alterar-senha-form">
        <div class="card-body">
            <h3 class="card-title text-center">Alterar Senha</h3>

            <div class="card-text">
                <form action="" method="post" novalidate>
                    <div class="form-group">
                        <label for="txtemail">E-mail cadastrado:</label>
                        <input type="email" class="form-control form-control-sm" id="txtemail" name="txtemail" placeholder="teste@teste.com">
                    </div>

                    <div class="form-group mt-2">
                        <label for="txtnovasenha">Nova senha:</label>
                        <input type="password" class="form-control form-control-sm" id="txtnovasenha" name="txtnovasenha" placeholder="Digite a nova senha">
                    </div>

                    <div class="form-group mt-2">
                        <label for="txtConfirmaSenha">Confirmar senha:</label>
                        <input type="password" class="form-control form-control-sm" id="txtConfirmaSenha" name="txtConfirmaSenha" placeholder="Digite a nova senha">
                    </div>

                    <?php if (isset($mensagem)) echo $mensagem; ?>

                    <div class="text-center mt-3">
                        <a href="login.php" class="link-senha">Voltar ao login</a>
                    </div>

                    <button type="submit" class="btn btn-warning fw-bold mt-3 d-block mx-auto w-50" name="btnatualizar">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>