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

        // busca a lista de categorias da loja
        $categorias = $this->lista_categoria();

        $sql = "SELECT * FROM produtos ";
        $sql .= "WHERE visivel = 1 ";

        if (in_array($categoria, $categorias)) {
            $sql .= "AND categoria = '$categoria'";
        }

        $produtos = $bd->select($sql);
        return $produtos;
    }

    // ================================================================
    public function lista_categoria()
    {
        // devolve a lista de categorias existentes no banco de dados
        $bd = new Database();
        $resultados = $bd->select("SELECT DISTINCT categoria FROM produtos");
        $categorias = [];
        foreach ($resultados as $resultado) {
            array_push($categorias, $resultado->categoria);
        }
        return $categorias;
    }

    // ================================================================
    public function verificar_stock_produto($id_produto)
    {

        $bd = new Database();
        $parametros = [
            ':id_produto' => $id_produto
        ];
        $resultados = $bd->select("
            SELECT * FROM produtos 
            WHERE id_produto = :id_produto
            AND visivel = 1
            AND stock > 0 
        ", $parametros);

        return count($resultados) != 0 ? true : false;
    }
}
