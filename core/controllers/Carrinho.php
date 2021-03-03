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
        if (!isset($_GET['id_produto'])) {
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }


        // define o id do produto
        $id_produto = $_GET['id_produto'];

        $produtos = new Produtos();
        $resultados = $produtos->verificar_stock_produto($id_produto);

        if (!$resultados) {
            echo isset($_SESSION['carrinho']) ? count($_SESSION['carrinho']) : '';
            return;
        }

        // adiciona/gestão da variável de SESSÃO do carrinho
        // $_SESSION['teste'] = $id_produto;

        $carrinho = [];

        if (isset($_SESSION['carrinho'])) {
            $carrinho = $_SESSION['carrinho'];
        }

        // asiciona o produto ao carrinho
        if (key_exists($id_produto, $carrinho)) {

            // já existe o produto, acrescenta mais uma unidade
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
        unset($_SESSION['carrinho']);

        // recarrega a página do carrinho
        $this->carrinho();
    }

    // ==============================================================
    public function carrinho()
    {

        // verifica se existe carrinho
        if (!isset($_SESSION['carrinho']) || count($_SESSION['carrinho']) == 0) {
            $dados = [
                'carrinho' => null
            ];
        } else {

            $ids = [];
            foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
                array_push($ids, $id_produto);
            }

            $ids = implode(",", $ids);
            $produtos = new Produtos();
            $resultados = $produtos->buscar_produtos_por_ids($ids);


            $dados_temp = [];
            foreach ($_SESSION['carrinho'] as $id_produto => $quantidade_carrinho) {

                // imagem do produto
                foreach ($resultados as $produto) {
                    if ($produto->id_produto == $id_produto) {
                        $imagem = $produto->imagem;
                        $titulo = $produto->nome_produto;
                        $quantidade = $quantidade_carrinho;
                        $preco = $produto->preco * $quantidade;

                        // colocar o produto na coleção
                        array_push($dados_temp, [
                            'imagem' => $imagem,
                            'titulo' => $titulo,
                            'quantidade' => $quantidade,
                            'preco' => $preco
                        ]);

                        break;
                    }
                }
            }

            // calcular o total
            $total_da_encomenda = 0;
            foreach ($dados_temp as $item) {
                $total_da_encomenda += $item['preco'];
            }

            array_push($dados_temp, $total_da_encomenda);

            $dados = [
                'carrinho' => $dados_temp
            ];
        }

        // apresenta a página da carrinho
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }
}
