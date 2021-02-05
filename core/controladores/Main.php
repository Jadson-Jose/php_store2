<?php

namespace core\controladores;

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
        // verifica se ja existe sessão aberta
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }

        // apresenta o layout para cirar um novo utiizador
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'novo_cliente',
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
}
