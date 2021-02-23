<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\EnviarEmail;
use core\classes\Store;
use core\models\Clientes;
use core\models\Produtos;


class Carrinho
{

    // ==============================================================
    public function adicionar_carrinho()
    {
        // vai buscar o id_produto à query string
        $id_produto = $_GET['id_produto'];

        // adiciona/gestão da variável de SESSÃO do carrinho
        $_SESSION['teste'] = $id_produto;

        $carrinho = [];

        if (isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        }

        // asiciona o produto ao carrinho
        if (key_exists($id_produto, $carrinho)) {

            // já exsite o produto, acrescenta mais uma unidade
            $carrinho[$id_produto]++;
        } else {

            // adiciona um novo produto ao carrinho
            $carrinho[$id_produto] = 1;
        }

        // atualiza os dados do carrinho da sessão
        $_SESSION['carrinho'] = $carrinho;

        // reposta a resposta (numero de produtos do carrinho)
        $total_produtos = 0;
        foreach ($carrinho as $produto_quantidade) {
            $total_produtos += $produto_quantidade;
        }

        echo $total_produtos;
    }


    // ==============================================================
    public function limpar_carrinho()
    {

        // limpa o carrinho de todos os produtos
        $_SESSION['carrinho'] = [];
        echo "OK!";
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
