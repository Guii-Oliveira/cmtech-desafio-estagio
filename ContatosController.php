<?php

class ContatosController extends Controller
{

    /**
     * Lista os contatos
     */
    public function listar()
    {
        $this->proteger();
        $contatos = Contato::all();
        return $this->view('grade', ['contatos' => $contatos]);
    }

    /**
     * Mostrar formulario para criar um novo contato
     */
    public function criar()
    {
        $this->proteger();
        return $this->view('form');
    }

    /**
     * Mostrar formulário para editar um contato
     */
    public function editar($dados)
    {
        $this->proteger();
        $id      = (int) $dados['id'];
        $contato = Contato::find($id);

        return $this->view('form', ['contato' => $contato]);
    }

    /**
     * Salvar o contato submetido pelo formulário
     */
    public function salvar()
    {
        $this->proteger();

        $contato           = new Contato;
        $contato->nome     = $this->request->nome;
        $contato->telefone = $this->request->telefone;
        $contato->email    = $this->request->email;
        if ($contato->save()) {
            return $this->listar();
        }
    }

    /**
     * Atualizar o contato conforme dados submetidos
     */
    public function atualizar($dados)
    {
        $this->proteger();

        $id                = (int) $dados['id'];
        $contato           = Contato::find($id);
        $contato->nome     = $this->request->nome;
        $contato->telefone = $this->request->telefone;
        $contato->email    = $this->request->email;
        $contato->save();

        return $this->listar();
    }

    /**
     * Apagar um contato conforme o id informado
     */
    public function excluir($dados)
    {
        $this->proteger();
        
        $id      = (int) $dados['id'];
        $contato = Contato::destroy($id);
        return $this->listar();
    }
}