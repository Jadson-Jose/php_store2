<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;

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
    public function login()
    {

        // verifica se já existe um utilizador logado
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }

        // apresentação do fomulário de login
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login_frm',
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
        $cliente = new Clientes();

        if ($cliente->verificar_email_existe($_POST['text_email'])) {
            $_SESSION['erro'] = 'Já existe um cliente com o mesmo email.';
            $this->novo_cliente();
            return;
        }

        //  inserir novo cliente no banco de dados e devolve o purl
        $email_cliente = strtolower(trim($_POST['text_email']));
        $purl = $cliente->registrar_cliente();

        // envio do email para o cliente
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmação_novo_cliente($email_cliente, $purl);

        if ($resultado) {
            // apresenta o para informar o envio do email
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'criar_cliente_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);

            return;
        } else {
            echo 'Aconteceu um erro';
        }


        // criar um link para enviar por email
    }

    // ==============================================================
    public function confirmar_email()
    {

        // verifica se já existe sessão
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // verifica se existe na query string um purl
        if (!isset($_GET['purl'])) {
            $this->index();
            return;
        }

        $purl = $_GET['purl'];

        // verifica se o purl é válido
        if (strlen($purl) != 12) {
            $this->index();
            return;
        }

        $cliente = new Clientes();
        $resultado =  $cliente->validar_email($purl);

        if ($resultado) {
            // apresenta o para informar que a conta foi confirmada com sucesso
            Store::Layout([
                'layouts/html_header',
                'layouts/header',
                'conta_confirmada_sucesso',
                'layouts/footer',
                'layouts/html_footer',
            ]);
        } else {
            Store::redirect('login');
        }
    }

    // ==============================================================
    public function login_submit()
    {

        // verifica se já existe um utilizador logado
        if (Store::clienteLogado()) {
            Store::redirect('login');
            return;
        }

        // verifica se foi efetuado o post do formulário de login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Store::redirect('login');
            return;
        }

        // valida se os campos vieram corretamente preenchidos
        if (
            !isset($_POST['text_usuario']) ||
            !isset($_POST['text_senha']) ||
            !filter_var(trim($_POST['text_usuario']), FILTER_VALIDATE_EMAIL)
        ) {
            // erro de preenchimento do formulário
            $_SESSION['erro'] = 'Login inválido';
            Store::redirect('login');
            return;
        }

        echo 'OK';
    }
}