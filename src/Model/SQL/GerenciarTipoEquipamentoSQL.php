<?php

namespace Src\Model\SQL;

class GerenciarTipoEquipamentoSQL
{

    public static function INSERIR_TIPO_EQUIPAMENTO(): string
    {

        $sql = 'INSERT INTO 
                tb_tipo (nome)
                VALUES 
                (?)';

        return $sql;

    }

    public static function ALTERAR_TIPO_EQUIPAMENTO(): string 
    {

        $sql = 'UPDATE tb_tipo
                    SET nome = ?
                WHERE id = ?';

        return $sql;

    }

    public static function CONSULTAR_TIPO_EQUIPAMENTO(string $nome): string
    {

        $sql = 'SELECT id,
                       nome
                FROM tb_tipo';

        if(!empty($nome)) {

            $sql .= ' WHERE nome
                    LIKE ?';

        }

        $sql .= ' ORDER BY nome';

        return $sql;

    }

    public static function EXCLUIR_TIPO_EQUIPAMENTO(): string 
    {

        $sql = 'DELETE 
                FROM tb_tipo
                WHERE id = ?';

        return $sql;

    }

}