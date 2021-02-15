<?php

namespace core\models;

use core\classes\Store;

use core\classes\Database;

class Clientes
{
    public function verificar_email_existe($email)
    {

        // verifica se já exite outra conta com o mesmo email
        $bd = new Database();
        $parametros = [
            ':e' => strtolower(trim($email))
        ];
        $resultados = $bd->select(" SELECT email FROM clientes WHERE email = :e ", $parametros);

        // se o cliente já existe ...
        if (count($resultados) != 0) {
            return true;
        } else {
            return false;
        }
    }

    // ========================================================================================
    public function registrar_cliente()
    {

        $bd = new Database();

        // cria uma hash para o registro do cliente
        $purl = Store::criarHash();

        //  parametros 
        $parametros = [
            ':email' => strtolower(trim($_POST['text_email'])),
            ':senha' => password_hash(trim($_POST['text_senha_1']), PASSWORD_DEFAULT),
            ':nome_completo' => trim($_POST['text_nome_completo']),
            ':endereco' => trim($_POST['text_endereco']),
            ':cidade' => trim($_POST['text_cidade']),
            ':telefone' => trim($_POST['text_telefone']),
            ':purl' => $purl,
            ':ativo' => 0
        ];

        $bd->insert("
            INSERT INTO clientes VALUES(
                0,
                :email,
                :senha,
                :nome_completo,
                :endereco,
                :cidade,
                :telefone,
                :purl,
                :ativo,
                NOW(),
                NOW(),
                NULL

            )

        ", $parametros);

        // retorna o purl criado
        return $purl;
    }

    // ========================================================================================
    public function validar_email($purl)
    {

        // validar um novo cliente
        $bd = new Database();
        $parametros = [
            ':purl' => $purl
        ];
        $resultados = $bd->select("SELECT * FROM clientes WHERE purl = :purl", $parametros);

        // verifica se foi encontrado o cliente
        if (count($resultados) != 1) {
            return false;
        }

        // foi encontrado o cliente com o purl indicado 
        $id_cliente = $resultados[0]->id_cliente;

        // atulizar os dados do cliente
        $parametros = [
            ':id_cliente' => $id_cliente
        ];
        $bd->update("UPDATE clientes SET purl = NULL, ativo = 1, updated_at = NOW() , WHERE id_cliente = :id_cliente", $parametros);
        return true;
    }

    // ========================================================================================
    public function validar_login($usuario, $senha)
    {

        // verifica se o login é válido
        $parametros = [
            ':usuario' => $usuario
        ];

        $bd = new Database();
        $resultados = $bd->select(
            "SELECT * FROM clientes 
                      WHERE email = :usuario 
                      AND ativo = 1
                      AND deleted_at IS NULL ",
            $parametros
        );

        if (count($resultados) != 1) {

            // não existe usuário
            return false;
        } else {

            // temos usuario, vamos ver a sua senha
            $usuario = $resultados[0];

            // verificar a password
            if (!password_verify($senha, $usuario->$senha)) {

                // password inválida
                return false;
            } else {

                // login válido
                return $usuario;
            }
        }
    }
}
