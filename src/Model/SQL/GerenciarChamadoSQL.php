<?php

namespace Src\Model\SQL;

class GerenciarChamadoSQL
{

    public static function LISTAR_EQUIPAMENTOS_CHAMADO_SETOR(): string
    {

        $sql = 'SELECT al.id as alocar_id,
                       eq.identificacao,
                       mo.nome as modelo,
                       ti.nome as tipo
                  FROM tb_alocar as al
            INNER JOIN tb_equipamento as eq
                    ON eq.id = al.equipamento_id
            INNER JOIN tb_modelo as mo
                    ON mo.id = eq.modelo_id
            INNER JOIN tb_tipo as ti
                    ON ti.id = eq.tipo_id
                 WHERE al.setor_id = ?
                   AND al.situacao = ?';

        return $sql;

    }

}