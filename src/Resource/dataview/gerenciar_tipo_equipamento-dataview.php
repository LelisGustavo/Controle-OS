<?php

require_once '_include_autoload.php';

use Src\Controller\TipoEquipamentoCTRL;
use Src\VO\TipoEquipamentoVO;

$ctrl = new TipoEquipamentoCTRL();

if (isset($_POST['btn_cadastrar'])) {
    //Cria o objeto da tela
    $vo = new TipoEquipamentoVO();
    //Usa os set's das propriedades de acordo aos campos preenchidos
    $vo->setNome($_POST['nome_tipo']);

    $ret = $ctrl->CadastrarTipoEquipamentoCTRL($vo);

    if ($_POST['btn_cadastrar'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['btn_alterar'])) {

    $vo = new TipoEquipamentoVO();
    $vo->setNome($_POST['nome_tipo_alt']);
    $vo->setId($_POST['id_alt']);

    $ret = $ctrl->AlterarTipoEquipamentoCTRL($vo);

    if ($_POST['btn_alterar'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['btn_excluir'])) {

    $vo = new TipoEquipamentoVO();
    $vo->setId($_POST['id_exc']);

    $ret = $ctrl->ExcluirTipoEquipamentoCTRL($vo);

    if ($_POST['btn_excluir'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['consultar_ajx']) && $_POST['consultar_ajx'] == 'ajx') {

    $tipos = $ctrl->ConsultarEquipamentoCTRL($_POST['nome_pesquisar']); ?>

                <table class="table table-hover" id="tableResult">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Equipamento</th>

                        </tr>
                    </thead>
                    <tbody>
            <?php foreach ($tipos as $item) { ?>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal"
                                        data-target="#modal-alterar-tipoequip"
                                        onclick="CarregarModalAlterarTipoEquipamento('<?= $item['id'] ?>', '<?= $item['nome'] ?>')">Alterar
                                    </button>

                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-excluir"
                                        onclick="CarregarModalExcluir('<?= $item['id'] ?>', '<?= $item['nome'] ?>')">Excluir</button>
                                </td>
                                <td>
                        <?= $item['nome'] ?>
                                </td>
                            </tr>
            <?php } ?>
                    </tbody>
                </table>

<?php } ?>