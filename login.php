<?php
//Header
include_once 'header.php';
?>

<link rel="stylesheet" href="./css/login.css">
<div class="global-container">
	<div class="card login-form">
		<div class="card-body">
			<h3 class="card-title text-center">Autenticação do usuário</h3>
			<div class="card-text">
				<form action="dadosform.php" method="post" novalidate>

					<div class="form-group">
						<label for="exampleInputEmail1">Email:</label>
						<input type="email" class="form-control form-control-sm" name="txtemail" placeholder="teste@teste.com">
						<?php
						if (isset($_GET['email'])) {
							echo '<small class="fw-bold text-danger">E-mail inválido. Tente novamente.</small>';
						}
						?>
					</div>

					<div class="form-group mt-1">
						<label for="exampleInputPassword1">Senha:</label>
						<input type="password" class="form-control form-control-sm" name="txtsenha">
						<?php
						if (isset($_GET['senha'])) {
							echo '<small class="fw-bold text-danger">A senha deve ter pelos menos 6 caracteres.</small>';
						}
						?>
					</div>

					<div class="text-center mt-2">
						<a href="#" class="link-senha">Esqueci a minha senha</a>
					</div>

					<button type="submit" class="btn btn-warning fw-bold mt-2 d-block mx-auto w-50" name="btlogin">Login</button>

				</form>
			</div>
		</div>
	</div>
</div>

<?php include_once 'footer.php'; ?>