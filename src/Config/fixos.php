<?php 

// define('PATH_URL', $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/src/');

// Definição do caminho padrão (local) do projeto
define('PATH_URL', $_SERVER['DOCUMENT_ROOT'] . '/ControleOs/src/');

// Tipos de Úsuario
const PERFIL_ADM = 1;
const PERFIL_FUNCIONARIO = 2;
const PERFIL_TECNICO = 3;

// Funções do projeto

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

// Situação alocar
const SITUACAO_ALOCADO = 1;
const SITUACAO_REMOVIDO = 2;
const SITUACAO_MANUTENCAO = 3;