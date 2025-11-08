<?php
// Header
include_once 'header.php';

// Conexão com o banco de dados
include_once 'conn.php';

$email = "";
$senha = "";
$erroEmail = false;
$erroSenha = false;
$sucesso = false;

// Verifica se o formulário foi enviado
if (isset($_POST['btlogin'])) {
    $email = trim($_POST['txtemail']);
    $senha = trim($_POST['txtsenha']);

    // Validações
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erroEmail = true;
    }

    if (strlen($senha) < 6) {
        $erroSenha = true;
    }

    // Se não houver erros de formato, verifica duplicidade
    if (!$erroEmail && !$erroSenha) {

        // Verifica se o e-mail já está cadastrado
        $stmtCheck = $conn->prepare("SELECT idUsuario FROM usuario WHERE email = ?");
        $stmtCheck->bind_param("s", $email);
        $stmtCheck->execute();
        $resultado = $stmtCheck->get_result();

        if ($resultado->num_rows > 0) {
            // Já existe um usuário com este e-mail
            header("Location: cadastrarusuario.php?cadastro=duplicado");
            exit;
        } else {
            $senhaCript = md5($senha);

            $stmt = $conn->prepare("INSERT INTO usuario (email, senha) VALUES (?, ?)");
            $stmt->bind_param("ss", $email, $senhaCript);

            if ($stmt->execute()) {
                // Redireciona para o login com sucesso
                header("Location: login.php?cadastro=cadastrado");
                exit;
            } else {
                echo "<p class='text-danger text-center mt-2'>Erro ao cadastrar: " . $stmt->error . "</p>";
            }

            $stmt->close();
        }

        $stmtCheck->close();
    }
}

$conn->close();
?>
<link rel="stylesheet" href="./css/cadastrarusuario.css">

<div class="global-container">
    <div class="card cadastrar-usuario-form">
        <div class="card-body">
            <h3 class="card-title text-center">Cadastro do usuário</h3>

            <?php if ($sucesso) { ?>
                <div class="alert alert-success text-center fw-bold">Usuário cadastrado com sucesso!</div>
            <?php } ?>

            <div class="card-text">
                <form action="" method="post" novalidate>

                    <div class="form-group">
                        <label for="txtemail">Email:</label>
                        <input type="email" class="form-control form-control-sm" id="txtemail" name="txtemail" placeholder="teste@teste.com"
                            value="<?php echo htmlspecialchars($email); ?>">
                        <?php if ($erroEmail) { ?>
                            <small class="fw-bold text-danger">E-mail inválido. Tente novamente.</small>
                        <?php } ?>
                    </div>

                    <div class="form-group mt-1">
                        <label for="txtsenha">Senha:</label>
                        <input type="password" class="form-control form-control-sm" id="txtsenha" name="txtsenha" placeholder="******"
                            value="<?php echo htmlspecialchars($senha); ?>">
                        <?php if ($erroSenha) { ?>
                            <small class="fw-bold text-danger">A senha deve ter pelo menos 6 caracteres.</small>
                        <?php } ?>
                    </div>

                    <?php if (isset($_GET['cadastro']) && ($_GET['cadastro'] == 'duplicado')) {
                        echo '<div class="alert alert-danger text-center fw-bold mt-3 mb-0">
					        Esse usuário já está cadastrado!
				        </div>';
                    } ?>

                    <div class="text-center mt-3">
                        <a href="login.php" class="link-senha">Voltar ao login</a>
                    </div>

                    <button type="submit" class="btn btn-warning fw-bold d-block mx-auto w-50 mt-3" name="btlogin">
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>