<?php

namespace Src\Model\SQL;

class GerenciarUsuarioSQL
{

    // Inserção na tabela usuário no banco de dados
    public static function INSERIR_USUARIO(): string
    {

        $sql = 'INSERT INTO tb_usuario
                (tipo, nome, email, tel, senha, status)
                VALUES
                (?, ?, ?, ?, ?, ?)';

        return $sql;
    }

    // Inserção na tabela técnico no banco de dados
    public static function INSERIR_TECNICO(): string 
    {

        $sql = 'INSERT INTO tb_tecnico
                (tecnico_id, nome_empresa_tec)
                VALUES
                (?, ?)';

        return $sql;

    }

    // Inserção na tabela funcionário no banco de dados
    public static function INSERIR_FUNCIONARIO(): string 
    {

        $sql = 'INSERT INTO tb_funcionario
                (funcionario_id, setor_id)
                VALUES
                (?, ?)';

        return $sql;

    }

    // Inserção na tabela estado no banco de dados
    public static function INSERIR_ESTADO(): string
    {

        $sql = 'INSERT INTO tb_estado
                (nome, sigla)
                VALUES
                (?, ?)';

        return $sql;

    }

    // Inserção na tabela cidade no banco de dados
    public static function INSERIR_CIDADE(): string
    {

        $sql = 'INSERT INTO tb_cidade
                (nome, estado_id)
                VALUES
                (?, ?)';

        return $sql;

    }

    // Inserção na tabela endereço no banco de dados
    public static function INSERIR_ENDERECO(): string
    {

        $sql = 'INSERT INTO tb_endereco
                (rua, bairro, cep, complemento, cidade_id, usuario_id)
                VALUES
                (?, ?, ?, ?, ?, ?)';

        return $sql;

    }

    // Consulta na tabela estado no banco de dados, para verificar se o estado já existe, se SIM, utiliza o estado cadastrado para cadastrar uma nova cidade, se NÃO, cadastra um novo estado
    public static function SELECIONAR_ESTADO(): string 
    {

        $sql = 'SELECT id
                  FROM tb_estado
                 WHERE sigla LIKE ?';

        return $sql;

    }

    // Consulta na tabela cidade no banco de dados, para verificar se a cidade já existe, se SIM, utiliza a cidade cadastrada para cadastrar um novo endereço, se NÃO, cadastra uma nova cidade
    public static function SELECIONAR_CIDADE(): string 
    {

        $sql = 'SELECT ci.id
                  FROM tb_cidade as ci
            INNER JOIN tb_estado as es
                    ON es.id = ci.estado_id
                 WHERE es.sigla LIKE ?
                   AND ci.nome LIKE ?';

        return $sql;

    }

    // Consulta na tabela usuário no banco de dados, para verificar se o e-mail já existe 
    public static function VERIFICAR_EMAIL_DUPLICADO(int $id_email): string
    {

        $sql = 'SELECT count(email) as contar
                  FROM tb_usuario
                 WHERE email = ?';

        // Para quando for uma alteração, não incluir o próprio registro
        if ($id_email > 0) {

            $sql .= ' AND id != ?';
        }

        return $sql;
    }

}
