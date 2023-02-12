<?php

namespace Src\Model\SQL;

class GerenciarModeloEquipamentoSQL 
{

    public static function INSERIR_MODELO_EQUIPAMENTO(): string
    {

        $sql = 'INSERT INTO 
                tb_modelo (nome)
                VALUES
                (?)';
                
        return $sql;

    }

    public static function ALTERAR_MODELO_EQUIPAMENTO(): string 
    {

        $sql = 'UPDATE tb_modelo
                    SET nome = ?
                WHERE id = ?';

        return $sql;

    }

    public static function CONSULTAR_MODELO_EQUIPAMENTO(string $nome): string 
    {

        $sql = 'SELECT id,
                       nome
                FROM tb_modelo';

        if (!empty($nome)) {

            $sql .= ' WHERE nome
                      LIKE ?';

        }

        $sql .= ' ORDER BY nome';

        return $sql;

    }

    public static function EXCLUIR_MODELO_EQUIPAMENTO(): string 
    {

        $sql = 'DELETE
                FROM tb_modelo
                WHERE id = ?';

        return $sql;

    }

}