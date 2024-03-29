<?php 

// define('PATH_URL', $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/src/');

// Definição do caminho padrão (local) do projeto
define('PATH_URL', $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/src/');

// Tipos de Úsuario
const PERFIL_ADM = 1;
const PERFIL_FUNCIONARIO = 2;
const PERFIL_TECNICO = 3;

// Tipo do Equipamento
const CADASTRAR_TIPO = "CadastrarTipoEquipamento";
const ALTERAR_TIPO = "AlterarTipoEquipamento";
const EXCLUIR_TIPO = "ExcluirTipoEquipamento";

// Modelo do Equipamento
const CADASTRAR_MODELO = "CadastrarModeloEquipamento";
const ALTERAR_MODELO = "AlterarModeloEquipamento";
const EXCLUIR_MODELO = "ExcluirModeloEquipamento";

// Setores
const CADASTRAR_SETOR = "CadastrarSetor";
const ALTERAR_SETOR = "AlterarSetor";
const EXCLUIR_SETOR = "ExcluirSetor";

// Equipamentos
const CADASTRAR_EQUIPAMENTO = 'CadastrarEquipamento';
const ALTERAR_EQUIPAMENTO = 'AlterarEquipamento';
const EXCLUIR_EQUIPAMENTO = 'ExcluirEquipamento';
const DETALHAR_EQUIPAMENTO = 'DetalharEquipamento';

// Alocar e Remover
const ALOCAR_EQUIPAMENTO = 'AlocarEquipamento';
const REMOVER_EQUIPAMENTO_SETOR = 'RemoverEquipamentoSetor';

// Usuário
const CADASTRAR_USUARIO = 'CadastrarUsuario';
const ALTERAR_USUARIO = 'AlterarUsuario';
const ALTERAR_STATUS_USUARIO = 'AlterarStatusUsuario';
const ALTERAR_SENHA_USUARIO = "AlterarSenhaUsuario";

// Chamado
const ABRIR_CHAMADO = 'AbrirChamado';

// Situação alocar
const SITUACAO_ALOCADO = 1;
const SITUACAO_REMOVIDO = 2;
const SITUACAO_MANUTENCAO = 3;

// Renderização componente
const COMPONENTE_TABELA = 'TABELA';
const COMPONENTE_COMBO = 'COMBO';

// Status
const ATIVO = 1;
const INATIVO = 2;

// Quantidades de registro para consulta limite
const QTD_ULTIMOS_CADASTRADOS = 5;

// Chave Secret Token
const SECRET_JWT = 'cedricoisthebestdog';
const NAO_AUTORIZADO = -1000;