<?php

require_once '_include_autoload.php';

use Src\VO\AlocarVO;
use Src\Controller\AlocarEquipamentoCTRL;

if (isset($_POST['btn_alocar'])) {
    
    $vo = new AlocarVO;

    $vo->setIdEquipamento($_POST['equipamento']);
    $vo->setIdSetor($_POST['setor_equipamento']);

    $ret = (new AlocarEquipamentoCTRL)->AlocarCTRL($vo);

}