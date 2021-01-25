<?php

namespace core\classes;

use Exception;

class Functions
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
}
