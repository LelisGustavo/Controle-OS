<?php

namespace Src\Model;

// Configurações do site
define('HOST', 'localhost'); //IP
define('USER', 'root'); //usuario
define('PASS', null); //Senha
define('DB', 'db_controleos'); //Banco
/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 * @copyright (c) year, WMBarros
 */

class Conexao
{

    /** @var PDO */
    private static $Connect;

    private static function Conectar()
    {
        try {

            //Verifica se a conexão não existe
            if (self::$Connect == null):

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new \PDO($dsn, USER, PASS, null);
            endif;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return self::$Connect;
    }

    public static function retornarConexao()
    {
        return self::Conectar();
    }

    public static function GravarErroLog($vo)
    {
        // Cria a váriavel que guarda o caminho e o nome do arquivo
        $arquivo = PATH_URL . 'Model/Log/log_erro.txt';

        //Verifica se existe o arquivo
        if (!file_exists($arquivo)) {
            $arquivo = fopen($arquivo, "w");
        } else {
            $arquivo = fopen($arquivo, "a+");
        }

        $msg = '----------------------------------------' . PHP_EOL;
        $msg .= 'Data do erro: ' . $vo->getDataAtual() . PHP_EOL;
        $msg .= 'Hora do erro: ' . $vo->getHoraAtual() . PHP_EOL;
        $msg .= 'Função do erro: ' . $vo->getFuncaoErro() . PHP_EOL;
        $msg .= 'Código do logado: ' . $vo->getCodigoLogado() . PHP_EOL;
        $msg .= 'Mensagem do erro: ' . $vo->getMsgErro() . PHP_EOL;

        fwrite($arquivo, $msg);
        fclose($arquivo);
    }
}