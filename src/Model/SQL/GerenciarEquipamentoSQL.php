<?php

namespace Src\Model\SQL;

class GerenciarEquipamentoSQL
{

    public static function INSERIR_EQUIPAMENTO(): string
    {

        $sql = 'INSERT INTO tb_equipamento 
                (identificacao, descricao, modelo_id, tipo_id)
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
                       model.nome as nome_modelo,
                       se.nome as nome_setor
                  FROM tb_equipamento as equi
                -- Relação entre equipamento e o tipo
            INNER JOIN tb_tipo as tipo
                    ON equi.tipo_id = tipo.id
                -- Relaçao entre equipamento e o modelo
            INNER JOIN tb_modelo as model
                    ON equi.modelo_id = model.id
                -- Relação entre equipamento e o alocar
             LEFT JOIN tb_alocar as al
                    ON al.equipamento_id = equi.id
                -- Relação entre equipamento e o setor
             LEFT JOIN tb_setor as se
                    ON al.setor_id = se.id';

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

    public static function SELECIONAR_EQUIPAMENTOS_NAO_ALOCADOS(): string 
    {

        $sql = 'SELECT eq.id,
                       eq.identificacao,
                       ti.nome as nome_tipo,
                       mo.nome as nome_modelo
                  FROM tb_equipamento as eq
            INNER JOIN tb_modelo as mo
                    ON mo.id = eq.modelo_id
            INNER JOIN tb_tipo as ti
                    ON ti.id = eq.tipo_id
                 WHERE eq.id NOT IN (SELECT al.equipamento_id 
                                    FROM tb_alocar as al
                                    WHERE al.situacao != ?)';

        return $sql;

    }

    public static function ALOCAR_EQUIPAMENTO(): string 
    {

        $sql = 'INSERT INTO tb_alocar
                (data_alocar, situacao, equipamento_id, setor_id)
                VALUES
                (?, ?, ?, ?)';

        return $sql;

    }

    public static function SELECIONAR_EQUIPAMENTOS_ALOCADOS(): string 
    {

        $sql = 'SELECT al.id as id_alocar,
                       eq.id,
                       eq.identificacao,
                       ti.nome as nome_tipo,
                       mo.nome as nome_modelo,
                       se.nome as nome_setor
                  FROM tb_equipamento as eq
            INNER JOIN tb_modelo as mo
                    ON mo.id = eq.modelo_id
            INNER JOIN tb_tipo as ti
                    ON ti.id = eq.tipo_id
            INNER JOIN tb_alocar as al
                    ON al.equipamento_id = eq.id
            INNER JOIN tb_setor as se
                    ON se.id = al.setor_id
                 WHERE al.setor_id = ?
                   AND al.situacao != ?';

        return $sql;

    }

    public static function REMOVER_EQUIPAMENTO_SETOR(): string 
    {

        $sql = 'UPDATE tb_alocar
                   SET data_remover = ?,
                       situacao = ?
                 WHERE id = ?';

        return $sql;

    }

    public static function CONSULTAR_EQUIPAMENTO_SETOR($setor): string 
    {

        $sql = 'SELECT al.id,
                       se.nome as nome_setor
                  FROM tb_alocar as al
            INNER JOIN tb_setor as se
                    ON al.id = se.id
                 WHERE al.setor_id = ?';

        return $sql;

    }

}