<?php

class UsuariosController extends Controller
{

    /**
     * Lista os usuarios
     */
    public function listar()
    {
        $this->proteger();

        $usuarios = Usuario::all();
        return $this->view('usuarios_grade', ['usuarios' => $usuarios]);
    }

    /**
     * Mostrar formulario para criar um novo usuario
     */
    public function criar()
    {
       $this->proteger();

        return $this->view('usuarios_form');
    }

    /**
     * Mostrar formulário para editar um usuario
     */
    public function editar($dados)
    {
        $this->proteger();

        $id      = (int) $dados['id'];
        $usuario = Usuario::find($id);

       return $this->view('usuarios_form', ['usuario' => $usuario]);
    }

    /**
     * Salvar o usuario submetido pelo formulário
     */
    public function salvar()
{
    $this->proteger();

    $usuarioExistente = Usuario::findByEmail($this->request->email);

    if ($usuarioExistente) {
        echo "Este email já está cadastrado!";
        exit;
    }


    $usuario = new Usuario;

    $usuario->nome = $this->request->nome;
    $usuario->email = $this->request->email;

    $usuario->senha = password_hash(
        $this->request->senha,
        PASSWORD_DEFAULT
    );

    $usuario->ativo = $this->request->ativo;


    if ($usuario->save()) {
        return $this->listar();
    }

    echo "Erro ao salvar usuário";
}

    /**
     * Atualizar o usuario conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $this->proteger();

        $id                = (int) $dados['id'];
        $usuario           = Usuario::find($id);
        $usuario->nome     = $this->request->nome;
        $usuario->email    = $this->request->email;
        if (!empty($this->request->senha)) {
    $usuario->senha = password_hash(
        $this->request->senha,
        PASSWORD_DEFAULT);
        }
        $usuario->ativo = $this->request->ativo;
        $usuario->save();

        return $this->listar();
    }

    /**
     * Apagar um usuario conforme o id informado
     */
    public function excluir($dados)
    {
        $this->proteger();

        $id      = (int) $dados['id'];
        $usuario = Usuario::destroy($id);
        return $this->listar();
    }
}