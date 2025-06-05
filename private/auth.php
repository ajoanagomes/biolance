<!-- Ana Gomes 1230701 -->
<!-- Esta página permite capturar os dados submetidos no login/registo, analisa o email submetido, redirecionando-o.
        Tal permite que pessoas dos laboratórios (...@lab...) tenham acesso a um backend personalizado ao laboratório
        Pessoas das clínicas (...@clinica...) acesso ao backend clínica, e qualquer outro tipo de email, acesso ao portal do cliente -->

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];

    // Validações básicas
    if (empty($email) || empty($password)) {
        die("Email e senha são obrigatórios");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido");
    }


    // Login válido - redireciona
    $_SESSION['user_email'] = $email;

    if (strpos($email, '@clinica') !== false) {
        header('Location: indexclinica.php');
    } elseif (strpos($email, '@lab') !== false) {
        header('Location: indexlab.php');
    } elseif (strpos($email, '@medico') !== false) {
        header('Location: indexmedicos.php');
    } else {
        header('Location: indexclientes.php');
    }
    exit;
}

// Se acesso direto, redireciona
header('Location: ../public/index.html');
exit;
