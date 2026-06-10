<?php

class LoginController extends Controller
{
    public function index()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Se já estiver logado, manda para usuários
    if (isset($_SESSION['usuario_id'])) {
        header('Location: ?controller=UsuariosController&method=listar');
        exit;
    }

    return $this->view('login');
}

    public function autenticar()
    {
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;

        if (empty($email) || empty($senha)) {
            header('Location: ?controller=LoginController&method=index&erro=1');
            exit;
        }

        $usuario = Usuario::findByEmail($email);

        if ($usuario && password_verify($senha, $usuario->senha)) {

            $_SESSION['usuario_id'] = $usuario->id;
            $_SESSION['usuario_nome'] = $usuario->nome;

            header('Location: ?controller=UsuariosController&method=listar');
            exit;
        }

        header('Location: ?controller=LoginController&method=index&erro=1');
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
        session_destroy();

        header('Location: ?controller=LoginController&method=index');
        exit;
    }
}

    
