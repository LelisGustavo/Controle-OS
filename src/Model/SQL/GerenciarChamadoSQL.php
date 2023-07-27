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

        public static function ABRIR_CHAMADO(): string
        {

                $sql = 'INSERT INTO tb_chamado
                (problema, data_abertura, hora_abertura, funcionario_id, alocar_id)
                VALUES
                (?, ?, ?, ?, ?)';

                return $sql;
        }

        public static function ATUALIZAR_SITUACAO(): string
        {

                $sql = 'UPDATE tb_alocar 
                   SET situacao = ?
                 WHERE id = ?';

                return $sql;
        }

        public static function FILTRAR_CHAMADO($situacao): string
        {

                $sql = 'SELECT 
                       date_format(ch.data_abertura, "%d/%m/%Y") as data_chamado,
                       date_format(ch.data_atendimento, "%d/%m/%Y") as data_atendimento,
                       date_format(ch.data_encerramento, "%d/%m/%Y") as data_encerramento,
                       ch.hora_abertura,
                       ch.hora_atendimento,
                       ch.hora_encerramento,
                       ch.problema,
                       us_fun.nome as funcionario,
                       eq.identificacao,
                       mo.nome as modelo,
                       ti.nome as tipo,
                       usu_tec_atendimento.nome as tec_atendimento,
                       usu_tec_encerramento.nome as tec_encerramento,
                       ch.laudo,
                       ch.id as chamado_id
                  FROM tb_chamado as ch
            INNER JOIN tb_funcionario as fu
                    ON ch.funcionario_id = fu.funcionario_id
            INNER JOIN tb_usuario as us_fun
                    ON fu.funcionario_id = us_fun.id
            INNER JOIN tb_alocar as al
                    ON al.id = ch.alocar_id
            INNER JOIN tb_equipamento as eq
                    ON al.equipamento_id = eq.id
            INNER JOIN tb_modelo as mo
                    ON mo.id = eq.modelo_id
            INNER JOIN tb_tipo as ti
                    ON ti.id = eq.tipo_id
                -- Vinculo do técnico atendimento (left pois não tem essa informação logo de cara)
             LEFT JOIN tb_tecnico as tec_atendimento
                    ON tec_atendimento.tecnico_id = ch.tecnico_atendimento
             LEFT JOIN tb_usuario as usu_tec_atendimento
                    ON usu_tec_atendimento.id = tec_atendimento.tecnico_id
                -- Vinculo do técnico encerramento (left pois não tem essa informação logo de cara)
             LEFT JOIN tb_tecnico as tec_encerramento
                    ON tec_encerramento.tecnico_id = ch.tecnico_encerramento
             LEFT JOIN tb_usuario as usu_tec_encerramento
                    ON usu_tec_encerramento.id = tec_encerramento.tecnico_id
                 WHERE al.setor_id = ?';

                switch ($situacao) {

                        case 0: // Aguardando atendimento 
                                $sql .= ' AND ch.tecnico_atendimento IS NULL';
                                break;

                        case 1: // Em atendimento
                                $sql .= ' AND ch.tecnico_atendimento IS NOT NULL
                                  AND ch.tecnico_encerramento IS NULL';
                                break;

                        case 2: // Encerrado 
                                $sql .= ' AND ch.tecnico_encerramento IS NOT NULL';
                                break;
                }

                return $sql;
        }

        public static function DETALHAR_CHAMADO_ID(): string
        {

                $sql = 'SELECT 
                       date_format(ch.data_atendimento, "%d/%m/%Y") as data_atendimento,
                       date_format(ch.data_encerramento, "%d/%m/%Y") as data_encerramento,
                       ch.hora_atendimento,
                       ch.hora_encerramento,
                       usu_tec_atendimento.nome as tec_atendimento,
                       usu_tec_encerramento.nome as tec_encerramento,
                       ch.laudo,
                       ch.id as chamado_id
                  FROM tb_chamado as ch
            INNER JOIN tb_funcionario as fu
                    ON ch.funcionario_id = fu.funcionario_id
            INNER JOIN tb_usuario as us_fun
                    ON fu.funcionario_id = us_fun.id
            INNER JOIN tb_alocar as al
                    ON al.id = ch.alocar_id
                -- Vinculo do técnico atendimento (left pois não tem essa informação logo de cara)
             LEFT JOIN tb_tecnico as tec_atendimento
                    ON tec_atendimento.tecnico_id = ch.tecnico_atendimento
             LEFT JOIN tb_usuario as usu_tec_atendimento
                    ON usu_tec_atendimento.id = tec_atendimento.tecnico_id
                -- Vinculo do técnico encerramento (left pois não tem essa informação logo de cara)
             LEFT JOIN tb_tecnico as tec_encerramento
                    ON tec_encerramento.tecnico_id = ch.tecnico_encerramento
             LEFT JOIN tb_usuario as usu_tec_encerramento
                    ON usu_tec_encerramento.id = tec_encerramento.tecnico_id
                 WHERE ch.id = ?';

                return $sql;

        }
}
