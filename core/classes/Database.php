<?php

namespace core\classes;

use Exception;
use PDO;
use PDOException;

class Database
{

    private $ligacao;

    // ==============================================================
    private function ligar()
    {
        // ligação com o banco de dados
        $this->ligacao = new PDO(
            'mysql:' .
                'host=' . MYSQL_SERVER . ';' .
                'dbname=' . MYSQL_DATABASE . ';' .
                'charset=' . MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // debug
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // ==============================================================
    private function desligar()
    {
        // desligamento do banco de dados
        $this->ligacao = null;
    }

    // ==============================================================
    // CRUD
    // ==============================================================
    public function select($sql, $parametros = null)
    {

        // verirfica se é uma instrução SELECT
        if (!preg_match("/^SELECT/i", $sql)) {
            throw new Exception('Banco de dados - Não é uma instrução SELECT.');
        }


        // executa a função de pesquisa de sql
        $this->ligar();

        $resultados = null;

        try {

            // comunicação com o banco de dados
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {

            // caso exista erro
            return false;
        }

        // desliga do banco de dados
        $this->desligar();

        // devolve os resultados obtidos
        return $resultados;
    }

    // ==============================================================
    public function insert($sql, $parametros = null)
    {

        // verirfica se é uma instrução INSERT
        if (!preg_match("/^INSERT/i", $sql)) {
            throw new Exception('Banco de dados - Não é uma instrução INSERT.');
        }


        // liga
        $this->ligar();

        // comunica
        try {

            // comunicação com o banco de dados
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {

            // caso exista erro
            return false;
        }

        // desliga do banco de dados
        $this->desligar();
    }

    // ==============================================================
    public function update($sql, $parametros = null)
    {

        // verirfica se é uma instrução UPDATE
        if (!preg_match("/^UPDATE/i", $sql)) {
            throw new Exception('Banco de dados - Não é uma instrução UPDATE.');
        }


        // concecta com o banco de dados
        $this->ligar();

        $resultados = null;

        try {

            // comunicação com o banco de dados
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {

            // caso exista erro
            return false;
        }

        // desliga do banco de dados
        $this->desligar();

        // devolve os resultados obtidos
        return $resultados;
    }

    // ==============================================================
    public function delete($sql, $parametros = null)
    {

        // verirfica se é uma instrução DELETE
        if (!preg_match("/^DELETE/i", $sql)) {
            throw new Exception('Banco de dados - Não é uma instrução DELETE.');
        }


        // ligar
        $this->ligar();

        $resultados = null;

        try {

            // comunicação com o banco de dados
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {

            // caso exista erro
            return false;
        }

        // desliga do banco de dados
        $this->desligar();

        // devolve os resultados obtidos
        return $resultados;
    }

    // ==============================================================
    // GENÉRICA PARA OUTRAS INSTRUÇÕES DE SQL
    // ==============================================================
    public function statement($sql, $parametros = null)
    {

        // verirfica se é uma instrução diferente das anteriores
        if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)) {
            throw new Exception('Banco de dados - Instrução inválida.');
        }


        // executa a função de pesquisa de sql
        $this->ligar();

        $resultados = null;

        try {

            // comunicação com o banco de dados
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {

            // caso exista erro
            return false;
        }

        // desliga do banco de dados
        $this->desligar();

        // devolve os resultados obtidos
        return $resultados;
    }
}
