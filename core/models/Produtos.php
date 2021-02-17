<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class Produtos
{

    // ================================================================
    public function lista_produtos_disponivel($categoria)
    {
        // busca todas as informações dos produtos no banco de dados
        $bd = new Database();

        $sql = "SELECT * FROM produtos WHERE visivel = 1";

        if ($categoria == 'homem' || $categoria == 'mulher') {
            $sql .= "AND categoria = '$categoria'";
        }

        $produtos = $bd->select($sql);
        return $produtos;
    }
}
