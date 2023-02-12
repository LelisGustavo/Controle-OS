<?php

require_once '_include_autoload.php';

use Src\Controller\ModeloEquipamentoCTRL;
use Src\VO\ModeloEquipamentoVO;

$ctrl = new ModeloEquipamentoCTRL;

if (isset($_POST['btn_cadastrar'])) {

    $vo = new ModeloEquipamentoVO();

    $vo->setNome($_POST['nome_modelo']);

    $ret = $ctrl->CadastrarModeloEquipamentoCTRL($vo);

    if ($_POST['btn_cadastrar'] == 'ajx') {
        echo $ret;
    }

} 

else if (isset($_POST['btn_alterar'])) {

    $vo = new ModeloEquipamentoVO();
    $vo->setNome($_POST['nome_modelo_alt']);
    $vo->setId($_POST['id_alt']);

    $ret = $ctrl->AlterarModeloEquipamentoCTRL($vo);

    if ($_POST['btn_alterar'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['btn_excluir'])) {

    $vo = new ModeloEquipamentoVO();
    $vo->setId($_POST['id_exc']);

    $ret = $ctrl->ExcluirModeloEquipamentoCTRL($vo);

    if ($_POST['btn_excluir'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['consultar_ajx']) && $_POST['consultar_ajx'] == 'ajx') {

    $modelos = $ctrl->ConsultarModeloEquipamentoCTRL($_POST['nome_pesquisar']); ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Nome</th>

                        </tr>
                    </thead>
                    <tbody>
            <?php foreach ($modelos as $item) { ?>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal"
                                        data-target="#modal-alterar-modeloequip"
                                        onclick="CarregarModalAlterarModeloEquipamento('<?= $item['id'] ?>', '<?= $item['nome'] ?>')">Alterar
                                    </button>

                                    <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-excluir"
                                        onclick="CarregarModalExcluir('<?= $item['id'] ?>', '<?= $item['nome'] ?>')">Excluir</button>
                                </td>
                                <td>
                        <?= $item['nome'] ?>
                                </td>
                <?php } ?>
                    </tbody>
                </table>
<?php } ?>