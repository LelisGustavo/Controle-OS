<?php

namespace Src\Model\SQL;

class GerenciarEquipamentoSQL
{

    public static function INSERIR_EQUIPAMENTO(): string
    {

        $sql = 'INSERT INTO
                tb_equipamento (identificacao, descricao, modelo_id, tipo_id)
                VALUES 
                (?, ?, ?, ?)';

        return $sql;

    }

    public static function ALTERAR_EQUIPAMENTO(): string
    {

        $sql = 'UPDATE tb_equipamento
                    SET identificacao = ?,
                        descricao = ?,
                        modelo_id = ?,
                        tipo_id = ?
                WHERE id = ?';

        return $sql;

    }

    public static function CONSULTAR_EQUIPAMENTO($tipo, $modelo, $identificacao): string
    {

        $sql = 'SELECT equi.id, 
                       equi.identificacao,
                       equi.descricao,
                       tipo.nome as nome_tipo,
                       model.nome as nome_modelo
                FROM tb_equipamento as equi
                -- Relação entre equipamento e o tipo
                INNER JOIN tb_tipo as tipo
                    ON equi.tipo_id = tipo.id
                -- Relaçao entre equipamento e o modelo
                INNER JOIN tb_modelo as model
                    ON equi.modelo_id = model.id';

        if (!empty($tipo) && empty($modelo)) {

            $sql .= ' WHERE equi.tipo_id = ?';

            if (!empty($identificacao)) {
                $sql .= ' AND equi.identificacao LIKE ?';
            }

        }

        else if (empty($tipo) && !empty($modelo)) {

            $sql .= ' WHERE equi.modelo_id = ?';

            if (!empty($identificacao)) {
                $sql .= ' AND equi.identificacao LIKE ?';
            }

        }

        else if (!empty($tipo)  && !empty($modelo)) {

            $sql .= ' WHERE equi.tipo_id = ?
                        AND equi.modelo_id = ?';

            if (!empty($identificacao)) {
                $sql .= ' AND equi.identificacao LIKE ?';
            }

        }

        else if (empty($tipo) && empty($modelo) && !empty($identificacao)) {

            $sql .= ' WHERE equi.identificacao LIKE ?';

        }

        $sql .= ' ORDER BY equi.identificacao';

        return $sql;

    }

    public static function EXCLUIR_EQUIPAMENTO(): string
    {

        $sql = 'DELETE
                FROM tb_equipamento
                WHERE id = ?';

        return $sql;

    }

    public static function DETALHAR_EQUIPAMENTO(): string
    {

        $sql = 'SELECT id, 
                       identificacao,
                       descricao,
                       modelo_id,
                       tipo_id
                FROM tb_equipamento
                WHERE id = ?';

        return $sql;

    }

}