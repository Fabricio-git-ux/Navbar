<?php
// auth_google.php

header("Content-Type: application/json; charset=UTF-8");
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../controller/googleController.php';
require_once __DIR__ . '/../model/usuarioGoogle.php';  // <-- apontando para model
require_once __DIR__ . '/../configs/database.php';


// Lê o JSON enviado pelo fetch
$data = json_decode(file_get_contents("php://input"), true);
$credential = $data['credential'] ?? null;

if (!$credential) {
    http_response_code(400);
    echo json_encode(["sucesso" => false, "mensagem" => "Token não recebido"]);
    exit;
}

// Decodifica JWT (sem validar assinatura — ok para localhost)
$partes = explode('.', $credential);
$payload = json_decode(base64_decode(strtr($partes[1], '-_', '+/')), true);

if (!$payload) {
    http_response_code(400);
    echo json_encode(["sucesso" => false, "mensagem" => "Token inválido"]);
    exit;
}

$google_id = $payload['sub'] ?? null;
$nome = $payload['name'] ?? null;
$email = $payload['email'] ?? null;
$picture = $payload['picture'] ?? null;

if (!$google_id || !$email) {
    http_response_code(400);
    echo json_encode(["sucesso" => false, "mensagem" => "Dados insuficientes"]);
    exit;
}

// Inicializa o controller
$controller = new googleController();

// Verifica se já existe usuário
$usuarioGoogle = new usuarioGoogle((new DataBase())->conectar());
$existe = $usuarioGoogle->buscarPorEmail($email);

$dados = [
    'google_id' => $google_id,
    'nome'      => $nome,
    'email'     => $email,
    'picture'   => $picture
];

// Cadastra se não existir
if (!$existe) {
    $controller->cadastrarGoogle($dados);
}

// Faz login (cria sessão)
$login = $controller->loginGoogle($dados);

if ($login) {
    echo json_encode(["sucesso" => true]);
} else {
    http_response_code(401);
    echo json_encode(["sucesso" => false, "mensagem" => "Falha no login"]);
}
