<?php

require_once '_include_autoload.php';

use Src\Controller\EquipamentoCTRL;
use Src\Controller\ModeloEquipamentoCTRL;
use Src\Controller\TipoEquipamentoCTRL;
use Src\VO\EquipamentoVO;

$acao = 'Cadastrar';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $acao = 'Alterar';
}

$ctrl = new EquipamentoCTRL();

if (isset($_POST['btn_cadastrar'])) {
    //Cria os objetos que serão utilizados
    $vo = new EquipamentoVO;

    //Popula as propriedades do objeto de acordo as informações da tela
    $vo->setTipoId($_POST['tipo_equipamento']);
    $vo->setTModeloId($_POST['modelo_equipamento']);
    $vo->setIdentificacao($_POST['identificacao']);
    $vo->setDescricao($_POST['descricao']);

    //Chama a função  da camada a frente
    $ret = $ctrl->CadastrarEquipamentoCTRL($vo);

    if ($_POST['btn_cadastrar'] == 'ajx') {
        echo $ret;
    }
} else if (isset($_POST['consultar_ajx'])) {

    $equipamentos = $ctrl->ConsultarEquipamentoCTRL(); ?>

        <table class="table table-hover" id="tableResult">
            <thead>
                <tr>
                    <th>Ação</th>
                    <th>Tipo</th>
                    <th>Modelo</th>
                    <th>Identificação</th>
                    <th>Descrição</th>

                </tr>
            </thead>
            <tbody>
            <?php foreach ($equipamentos as $item) { ?>
                    <tr>
                        <td>
                            <a href="equipamento.php?id=<?=  $item['id'] ?>" class="btn btn-outline-warning btn-sm">Alterar
                            </a>

                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-excluir"
                                onclick="CarregarModalExcluir('<?= $item['id'] ?>', '<?= $item['tipo_equipamento'] ?>')">Excluir

                            </button>
                        </td>
                        <td>
                        <?= $item['nome_tipo'] ?>
                        </td>
                        <td>
                        <?= $item['nome_modelo'] ?>
                        </td>
                        <td>
                        <?= $item['identificacao'] ?>
                        </td>
                        <td>
                        <?= $item['descricao'] ?>
                        </td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>

<?php }

$tipos = (new TipoEquipamentoCTRL)->ConsultarEquipamentoCTRL();
$modelos = (new ModeloEquipamentoCTRL)->ConsultarModeloEquipamentoCTRL();