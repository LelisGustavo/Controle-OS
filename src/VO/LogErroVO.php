<?php

namespace Src\VO;

use Src\_Public\Util;

class LogErroVO
{

    private $msgErro;
    private $funcaoErro;

    //GET e SET CODIGO DO USUARIO LOGADO
    public function getCodigoLogado(): int
    {
        return Util::CodigoLogado();
    }

    //GET e SET MENSAGEM DE ERRO
    public function setMsgErro(string $m): void 
    {
        $this->msgErro = $m;
    }

    public function getMsgErro(): string 
    {
        return $this->msgErro;
    }

    //GET e SET FUNÇÃO ERRO
    public function setFuncaoErro(string $f): void 
    {
        $this->funcaoErro = $f;
    }

    public function getFuncaoErro(): string
    {
        return $this->funcaoErro;
    }

    //GET e SET DATA E HORA ATUAL
    public static function getDataAtual(): string 
    {
        return Util::DataAtualBr();
    }

    public static function getHoraAtual(): string 
    {
        return Util::HoraAtual();
    }
}