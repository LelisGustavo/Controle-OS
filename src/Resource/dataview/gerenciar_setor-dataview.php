<?php

require_once '_include_autoload.php';

use Src\Controller\SetorCTRL;
use Src\VO\SetorVO;

$ctrl = new SetorCTRL;

if (isset($_POST['btn_cadastrar'])) {

    $vo = new SetorVO();

    $vo->setNome($_POST['nome_setor']);

    $ret = $ctrl->CadastrarSetorCTRL($vo);

    if ($_POST['btn_cadastrar'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['btn_alterar'])) {

    $vo = new SetorVO();
    $vo->setNome($_POST['nome_setor_alt']);
    $vo->setId($_POST['id_alt']);

    $ret = $ctrl->AlterarSetorCTRL($vo);

    if ($_POST['btn_alterar'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['btn_excluir'])) {

    $vo = new SetorVO();
    $vo->setId($_POST['id_exc']);

    $ret = $ctrl->ExcluirSetorCTRL($vo);

    if ($_POST['btn_excluir'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['consultar_ajx']) && $_POST['consultar_ajx'] == 'ajx') {

    $setores = $ctrl->ConsultarSetorCTRL($_POST['nome_pesquisar']); ?>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Ação</th>
                            <th>Nome</th>

                        </tr>
                    </thead>
                    <tbody>
            <?php foreach ($setores as $item) { ?>
                            <tr>
                                <td>
                                    <button class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal-alterar-setor"
                                        onclick="CarregarModalAlterarSetor('<?= $item['id'] ?>', '<?= $item['nome'] ?>')">Alterar
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