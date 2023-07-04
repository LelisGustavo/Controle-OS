<?php

namespace Src\VO;

use Src\_Public\Util;

class ChamadoVO extends LogErroVO
{
    private $id;
    private $problema;
    private $laudo;
    private $id_alocar;
    private $id_setor;
    private $id_funcionario;
    private $tecnico_atendimento;
    private $tecnico_encerramento;
    private $situacao;

    // GET e SET ID
    public function setId($p_id): void
    {
        $this->id = $p_id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    // GET e SET ID SETOR
    public function setIdSetor($p_id_setor): void
    {
        $this->id_setor = $p_id_setor;
    }
    public function getIdSetor(): int
    {
        return $this->id_setor;
    }

    // GET e SET PROBLEMA
    public function setProblema($p_problema): void
    {
        $this->problema = Util::RemoverTags($p_problema);
    }
    public function getProblema(): string
    {
        return $this->problema;
    }

    //GET e SET DATA ABERTURA
    public function getDataAbertura(): string
    {
        return Util::DataAtual();
    }

    //GET e SET HORA ABERTURA
    public function getHoraAbertura(): string
    {
        return Util::HoraAtual();
    }

    //GET e SET DATA ATENDIMENTO
    public function getDataAtendimento(): string
    {
        return Util::DataAtual();
    }

    //GET e SET HORA ATENDIMENTO
    public function getHoraAtendimento(): string
    {
        return Util::HoraAtual();
    }

    //GET e SET DATA ENCERRAMENTO
    public function getDataEncerramento(): string
    {
        return Util::DataAtual();
    }

    //GET e SET HORA ENCERRAMENTO
    public function getHoraEncerramento(): string
    {
        return Util::HoraAtual();
    }

    // GET e SET LAUDO
    public function setLaudo($p_laudo): void 
    {
        $this->laudo = Util::RemoverTags($p_laudo);
    }
    public function getLaudo(): string 
    {
        return $this->laudo;
    }

    //GET e SET ID ALOCAR
    public function setIdAlocar($p_id_alocar): void 
    {
        $this->id_alocar = $p_id_alocar;
    }
    public function getIdAlocar(): int 
    {
        return $this->id_alocar;
    }

    //GET e SET ID FUNCIONARIO
    public function setIdFuncionario($p_id_funcionario): void 
    {
        $this->id_funcionario = $p_id_funcionario;
    }
    public function getIdFuncionario(): int 
    {
        return $this->id_funcionario;
    }

    //GET e SET TECNICO ATENDIMENTO
    public function setTecnicoAtendimento($p_tecnico_atendimento): void 
    {
        $this->tecnico_atendimento = $p_tecnico_atendimento;
    }
    public function getTecnicoAtendimento(): int 
    {
        return $this->tecnico_atendimento;
    }

    //GET e SET TECNICO ENCERRAMENTO
    public function setTecnicoEncerramento($p_tecnico_encerramento): void 
    {
        $this->tecnico_encerramento = $p_tecnico_encerramento;
    }
    public function getTecnicoEncerramento(): int 
    {
        return $this->tecnico_encerramento;
    }

    //GET e SET SITUACÃO
    public function setSituacao($p_situacao): void 
    {
        $this->situacao = $p_situacao;
    }
    public function getSituacao(): int 
    {
        return $this->situacao;
    }
}