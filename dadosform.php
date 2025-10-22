<?php
$email = $_POST['txtemail'] ?? '';
$senha = $_POST['txtsenha'] ?? '';

function validaLogin($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validaSenha($senha)
{
    return strlen($senha) >= 6;
}

$erros = [];

if (!validaLogin($email)) {
    $erros['email'] = true;
}

if (!validaSenha($senha)) {
    $erros['senha'] = true;
}

if (!empty($erros)) {
    $parametros = http_build_query($erros);
    header("Location: login.php?$parametros");
    exit;
}

header("Location: consultar.php");
exit;
