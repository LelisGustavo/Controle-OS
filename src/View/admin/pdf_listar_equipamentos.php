<?php

require_once dirname(__DIR__, 3) . '\vendor\autoload.php';

use Dompdf\Dompdf;
use Src\Controller\EquipamentoCTRL;

if (isset($_GET['pdf-equipamentos'])) {

    $equipamentos = (new EquipamentoCTRL)->ListarTodosEquipamentosCTRL();

    $conteudo = '<table style="width: 100%; font-family: Arial, Helvetica, sans-serif"">

    <caption style="background-color: lightblue; border: 1px solid black; padding: 10px;">EQUIPAMENTOS CADASTRADOS</caption>

                    <thead style="background-color: #42c6fa; color: white;">

                        <tr>

                            <th style="border: 1px solid black; padding: 10px;">Tipo</th>
                            <th style="border: 1px solid black; padding: 10px;">Modelo</th>
                            <th style="border: 1px solid black; padding: 10px;">Identificação</th>
                            <th style="border: 1px solid black; padding: 10px;">Descrição</th>
                            <th style="border: 1px solid black; padding: 10px;">Setor Alocado</th>

                        </tr>

                    </thead>

                    <tbody>';

    foreach ($equipamentos as $item) :

        $setor = $item['nome_setor'] == '' ? '----------' :  $item['nome_setor'];
        $conteudo .= "<tr>

                        <td style='border: 1px solid black;
                        padding: 10px;'>
                        {$item['nome_tipo']}
                        </td>

                        <td style='border: 1px solid black;
                        padding: 10px;'>
                        {$item['nome_modelo']}
                        </td>

                        <td style='border: 1px solid black;
                        padding: 10px;'>
                        {$item['identificacao']}
                        </td>

                        <td style='border: 1px solid black;
                        padding: 10px;'>
                        {$item['descricao']}
                        </td>

                        <td style='border: 1px solid black;
                        padding: 10px;'>
                            {$setor}
                        </td>
                        
                    </tr>";

    endforeach;

    $conteudo .= "</tbody>

                    </table>";

    $dompdf = new Dompdf();
    $dompdf->loadHtml($conteudo);

    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $dompdf->stream();
}
