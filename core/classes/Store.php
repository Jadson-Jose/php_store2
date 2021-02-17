<?php

namespace core\classes;

use Exception;

class Store
{

    // ==============================================================
    public static function Layout($estruturas, $dados = null)
    {

        // verifica se as estruturas é de um array
        if (!is_array($estruturas)) {
            throw new Exception("Coleção de estruturas inválida!");
        }

        // variáveis
        if (!empty($dados) && is_array($dados)) {
            extract($dados);
        }

        // apresentação das views da aplicação
        foreach ($estruturas as $estrutura) {
            include("../core/views/$estrutura.php");
        }
    }

    // ==============================================================
    public static function clienteLogado()
    {

        // verifica se existe um cliente com a sessão ativa
        return isset($_SESSION['cliente']);
    }

    // ==============================================================
    public static function criarHash($num_caractere = 12)
    {

        // criar hashes
        $chars = '01234567890123456789abcdefghijklmnoparstuwyzabcdefghijklmnoparstuwyzABCDEFGHIJKLMNOPARSTUWYZABCDEFGHIJKLMNOPARSTUWYZ';
        return substr(str_shuffle($chars), 0, $num_caractere);
    }

    // ==============================================================
    public static function redirect($rota = '')
    {

        // faz o redirecionamento para a URL desejada (rota)
        header("Location: " . BASE_URL . "?a=$rota");
    }

    // ==============================================================
    public static function printData($data)
    {
        if (is_array($data) || is_object($data)) {
            echo '<pre>';
            print_r($data);
        } else {
            echo '<pre>';
            echo $data;
        }

        // die("<br>TERMINADO!");
    }
}
