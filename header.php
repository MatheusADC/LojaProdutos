<?php
$paginaAtual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Sistema de produtos</title>

  <!-- Bootstrap e ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Fonte Ubuntu -->
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- CSS customizado do header -->
  <link rel="stylesheet" href="css/header.css">

  <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark cobalt-navbar">
    <div class="container-fluid px-3">
      <a class="navbar-brand" href="login.php">
        <img src="img/logo.png" width="90" height="90" alt="Logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link <?= $paginaAtual === 'login.php' ? 'active' : '' ?>" href="login.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $paginaAtual === 'consultar.php' ? 'active' : '' ?>" href="#">Produtos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contato</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>