<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produtos
{

    // ================================================================
    public function lista_produtos_disponivel()
    {
        // busca todas as informações dos produtos no banco de dados
        $bd = new Database();
        $produtos = $bd->select("SELECT * FROM produtos WHERE visivel = 1");
        return $produtos;
    }
}
