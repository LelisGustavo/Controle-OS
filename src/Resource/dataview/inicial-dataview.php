<?php

use Src\Controller\ChamadoCTRL;

require_once '_include_autoload.php';

$dados = (new ChamadoCTRL)->MostrarDadosTempoRealChamadosCTRL();
