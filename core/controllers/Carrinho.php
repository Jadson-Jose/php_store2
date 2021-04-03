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
    public function remover_produto_carrinho()
    {

        // vai buscar o produto na query string
        $id_produto = $_GET['id_produto'];

        // busca a carrinho na sessão
        $carrinho = $_SESSION['carrinho'];

        // remove o produto do carrinho
        unset($carrinho[$id_produto]);

        // atualiza o carrinho na sessão
        $_SESSION['carrinho'] = $carrinho;

        // apresenta novamente a página do carrinho
        $this->carrinho();
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
                        $id_produto = $produto->id_produto;
                        $imagem = $produto->imagem;
                        $titulo = $produto->nome_produto;
                        $quantidade = $quantidade_carrinho;
                        $preco = $produto->preco * $quantidade;

                        // colocar o produto na coleção
                        array_push($dados_temp, [
                            'id_produto' => $id_produto,
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

            // colocar o preço total na sessão
            $_SESSION['total_encomenda'] = $total_da_encomenda;

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

    // ==============================================================
    public function finalizar_encomenda()
    {

        // Verifica se existe cliente logado
        if (!isset($_SESSION['cliente'])) {

            // coloca na sessão um referrer temporário
            $_SESSION['temp_carrinho'] = true;

            // Redirecionar para o página de login
            Store::redirect('login');
        } else {

            Store::redirect('finalizar_encomenda_resumo');
        }
    }

    // ==============================================================
    public function finalizar_encomenda_resumo()
    {

        // verifica se existe cliente logado
        if (!isset($_SESSION['cliente'])) {
            Store::redirect('inicio');
        }


        // informações do carrinho
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
                    $id_produto = $produto->id_produto;
                    $imagem = $produto->imagem;
                    $titulo = $produto->nome_produto;
                    $quantidade = $quantidade_carrinho;
                    $preco = $produto->preco * $quantidade;

                    // colocar o produto na coleção
                    array_push($dados_temp, [
                        'id_produto' => $id_produto,
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

        // preparar os dados da view
        $dados = [];
        $dados['carrinho'] = $dados_temp;

        // busca as informações do cliente
        $cliente = new Clientes();
        $dados_cliente = $cliente->buscar_dados_cliente($_SESSION['cliente']);
        $dados['cliente'] = $dados_cliente;

        // gerar código da encomenda
        if (!isset($_SESSION['codigo_encomenda'])) {
            $codigo_encomenda = Store::gerarCodigoEncomenda();
            $_SESSION['codigo_encomenda'] = $codigo_encomenda;
        }

        // apresenta a página do carrinho
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'encomenda_resumo',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }

    // ==============================================================
    public function endereco_alternativo()
    {

        // receber os dados via AJAX(axios)
        $post = json_decode(file_get_contents('php://input'), true);

        // adiciona ou altera na sessão a variável (coleção / array) dados_alternativos
        $_SESSION['dados_alternativos'] = [
            'endereco' => $post['text_endereco'],
            'cidade' => $post['text_cidade'],
            'email' => $post['text_email'],
            'telefone' => $post['text_telefone'],
        ];
    }

    // ==============================================================
    public function confirmar_encomenda()
    {

        echo 'Escolher pagamento';


        // enviar email para o cliente com os dados da encomenda e pagamento
        $dados_encomenda = [];

        // busca os dados dos produtos
        $ids = [];
        foreach ($_SESSION['carrinho'] as $id_produto => $quantidade) {
            array_push($ids, $id_produto);
        }
        $ids = implode(",", $ids);
        $produtos = new Produtos();
        $resultados = $produtos->buscar_produtos_por_ids($ids);


        // estrutura dos dados dos produtos

        foreach ($resultados as $resultado) {
            $string_produtos = '';

            // quantidade
            $quantidade  = $_SESSION['carrinho'][$resultado->id_produto];
            $string_produtos[] = "$quantidade x $resultado->nome_produto - " . number_format($resultado->preco, 2, ',', '.') . '$ /uni.';
        }

        // lista de produtos para o email
        $dados_encomenda['lista_produtos'] = $string_produtos;

        // preco total de encomenda para o email
        $dados_encomenda['total'] = number_format('R$' . $_SESSION['total_encomenda'], 2, ',', '.');

        // dados de pagamento
        $dados_encomenda['dados_pagamento'] = [
            'numero_da_conta' => '1234567890',
            'codigo_encomenda' => $_SESSION['codigo_encomenda'],
            'total' => number_format('R$' . $_SESSION['total_encomenda'], 2, ',', '.')
        ];
        
        // Store::printData($dados_encomenda);

        // enviar o email para o cliente com os dados da encomenda
        $email = new EnviarEmail();
        $resultado = $email->enviar_email_confirmação_encomenda($_SESSION['usuario'], $dados_encomenda);
        
        
        
        
        
        
        

        // $_SESSION['dados_alternativos'] = [
        //     'endereco'
        //     'cidade'
        //     'email'
        //     'telefone'
        // ];



        $codigo_encomenda = $_SESSION['codigo_encomenda'];
        $total_da_encomenda = $_SESSION['total_encomenda'];

        // apresenta a página de agradecimento da encomenda
        $dados = [
            'codigo_encomenda' => $codigo_encomenda,
            'total_encomenda' => $total_da_encomenda
        ];
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'encomenda_confirmada',
            'layouts/footer',
            'layouts/html_footer',
        ], $dados);
    }
}
