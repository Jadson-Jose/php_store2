<?php

namespace core\controladores;

use core\classes\Database;
use core\classes\Store;

class Main
{

    // ==============================================================
    public function index()
    {


        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'inicio',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ==============================================================
    public function loja()
    {
        // apresenta a página da loja


        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ==============================================================
    public function novo_cliente()
    {
        // verifica se ja existe sessão aberta (Clietne logado)
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // apresenta o layout para cirar um novo utilizador
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'criar_cliente',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ==============================================================
    public function carrinho()
    {
        // apresenta a página da carrinho


        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    // ==============================================================
    public function criar_cliente()
    {
        // verifica se já existe sessão
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }
        // verifica se houve sumbmissão de um formulário
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        // verifica se a senha  1 é igual a senha 2
        if ($_POST['text_senha_1'] !== $_POST['text_senha_2']) {

            // as senhas são diferentes
            $_SESSION['erro'] = 'As senhas são diferentes.';
            $this->novo_cliente();
            return;
        }

        // verifica no banco de dados se existe cliente com o mesmo email
        // $bd = new Database();
        // $parametros = [
        //     ':e' => strtolower(trim($_POST['text_email']))
        // ];
        // $resultados = $bd->select(" SELECT email FROM clientes WHERE email = :e ", $parametros);

        // // se o cliente já existe ...
        // if (count($resultados) != 0) {
        //     $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
        //     $this->novo_cliente();
        //     return;
        // }
    }
}
