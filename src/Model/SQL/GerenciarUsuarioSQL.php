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

    // Consulta na tebela usuário os 5 últimos cadastrados
    public static function FILTRAR_USUARIOS(bool $ultimos_cad): string
    {

        $sql = 'SELECT id,
                       nome,
                       tipo,
                       status
                  FROM tb_usuario 
                 WHERE nome LIKE ?';

        if ($ultimos_cad) {
            $sql .= '  ORDER BY id DESC LIMIT ?';
        }

        return $sql;
    }

    // Update no Status do usuário (ativo/inativo)
    public static function ALTERAR_STATUS_USUARIO(): string
    {

        $sql = 'UPDATE tb_usuario
                   SET status = ?
                 WHERE id = ?';

        return $sql;
    }

    // Consulta dos dados do usuário
    public static function DETALHAR_USUARIO(): string
    {

        $sql = 'SELECT usu.id as usuario_id,
                       usu.tipo,
                       usu.nome as nome_usuario,
                       usu.email,
                       usu.tel,
                       end.id as endereco_id,
                       end.rua as nome_rua,
                       end.bairro as nome_bairro,
                       end.cep,
                       end.complemento,
                       cid.nome as nome_cidade,
                       est.sigla,
                       tec.nome_empresa_tec,
                       fun.setor_id
                  FROM tb_usuario as usu
            INNER JOIN tb_endereco as end
                    ON usu.id = end.usuario_id
            INNER JOIN tb_cidade as cid
                    ON cid.id = end.cidade_id
            INNER JOIN tb_estado as est
                    ON est.id = cid.estado_id 
             LEFT JOIN tb_tecnico as tec
                    ON usu.id = tec.tecnico_id
             LEFT JOIN tb_funcionario as fun
                    ON usu.id = fun.funcionario_id
                 WHERE usu.id = ?';

        return $sql;

    }

    // Update na tabela usuário no banco de dados
    public static function ALTERAR_USUARIO(): string
    {

        $sql = 'UPDATE tb_usuario
                   SET nome = ?, 
                       email = ?, 
                       tel = ?
                 WHERE id = ?';

        return $sql;
    }

    // Update na tabela técnico no banco de dados
    public static function ALTERAR_TECNICO(): string
    {

        $sql = 'UPDATE tb_tecnico
                   SET nome_empresa_tec = ?
               WHERE tecnico_id = ?';

        return $sql;
    }

    // Update na tabela funcionário no banco de dados
    public static function ALTERAR_FUNCIONARIO(): string
    {

        $sql = 'UPDATE tb_funcionario
                   SET setor_id = ?
                 WHERE funcionario_id = ?';

        return $sql;
    }

    // Update na tabela endereço no banco de dados
    public static function ALTERAR_ENDERECO(): string
    {

        $sql = 'UPDATE tb_endereco
                   SET rua = ?, 
                       bairro = ?, 
                       cep = ?, 
                       complemento = ?, 
                       cidade_id = ? 
                 WHERE id = ?';

        return $sql;
    }

    // Consulta na tebela usuário o login e senha 
    public static function VALIDAR_LOGIN(): string
    {
        
        $sql = 'SELECT id,
                       senha
                  FROM tb_usuario
                 WHERE email = ?
                   AND status = ?';

        return $sql;

    }
    
}
