<?php

require_once '_include_autoload.php';

use Src\Controller\EquipamentoCTRL;
use Src\Controller\SetorCTRL;
use Src\VO\AlocarVO;

$ctrl = new EquipamentoCTRL();
$setores = (new SetorCTRL)->ConsultarSetorCTRL();

if (isset($_POST['btn_alocar'])) {

    $vo = new AlocarVO;

    $vo->setIdEquipamento($_POST['equipamento']);
    $vo->setIdSetor($_POST['setor']);

    $ret = $ctrl->AlocarEquipamentoCTRL($vo);

    if ($_POST['btn_alocar'] == 'ajx') {
        echo $ret;
    }

} 

else if (isset($_POST['consultar_ajx'])) {

    $equipamentos = (new EquipamentoCTRL)->SelecionarEquipamentosNaoAlocadosCTRL();

    ?>

        <select class="form-control select2 obg" style="width: 100%;" name="equipamento" id="equipamento">

            <option value="">Selecione</option>
        <?php foreach ($equipamentos as $item) { ?>
                <option value="<?= $item['id'] ?>"><?= $item['nome_tipo'] . ' / ' . $item['nome_modelo'] . ' - ' . $item['identificacao'] ?></option>
        <?php } ?>

        </select>

<?php } 

else if (isset($_POST['btn_excluir'])) {

    $vo = new AlocarVO();
    $vo->setId($_POST['id_exc']);

    $ret = $ctrl->RemoverEquipamentoSetorCTRL($vo);

    if ($_POST['btn_excluir'] == 'ajx') {
        echo $ret;
    }

} 

else if (isset($_POST['consultar_alocados_ajx'])) {

    $equipamentos = $ctrl->SelecionarEquipamentosAlocadosCTRL($_POST['id_setor']); 
    
        if (count($equipamentos) == 0) {
            echo "";
        } else {
    
    ?>

                <table class="table table-hover" id="tableResult">

                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Equipamento / Modelo - Identificação</th>

                        </tr>
                    </thead>

        <?php foreach ($equipamentos as $item) { ?>

                        <tbody>
                            <tr>
                                <td>

                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-excluir"
                                        onclick="CarregarModalExcluir('<?= $item['id_alocar'] ?>', '<?= $item['nome_tipo'] . ' / ' . $item['nome_modelo'] . ' - ' . $item['identificacao'] . ' , Alocado no setor ' . $item['nome_setor']?>')">Remover</button>

                                </td>
                                <td>

                                    <?= $item['nome_tipo'] . ' / ' . $item['nome_modelo'] . ' - ' . $item['identificacao'] ?>

                                </td>
                            </tr>
                        </tbody>

        <?php } ?>

                </table>

<?php }

}