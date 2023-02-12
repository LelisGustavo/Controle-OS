<?php

namespace Src\Controller;

use Src\VO\AlocarVO;

class AlocarEquipamentoCTRL
{

    public function AlocarCTRL(AlocarVO $vo)
    {

        if (empty($vo->getIdSetor()) || empty($vo->getIdEquipamento()))
            return 0;
        
            //Continuar o processo
    }

}