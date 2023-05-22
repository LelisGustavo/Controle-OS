<?php

require_once '_include_autoload.php';

use Src\Controller\EquipamentoCTRL;
use Src\Controller\ModeloEquipamentoCTRL;
use Src\Controller\TipoEquipamentoCTRL;
use Src\VO\EquipamentoVO;
use Src\_Public\Util;

$ctrl = new EquipamentoCTRL();

$acao = 'Cadastrar';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $acao = 'Alterar';
    $dados = (new EquipamentoCTRL)->DetalharEquipamentoCTRL($_GET['id']);
    
    if (empty($dados)) {
        Util::ChamarPagina('consultar_equipamento');
    }

} 

else if (isset($_POST['btn_gravar'])) {
    //Cria os objetos que serão utilizados
    $vo = new EquipamentoVO;

    //Popula as propriedades do objeto de acordo as informações da tela
    $vo->setId($_POST['id_equipamento']);
    $vo->setTipoId($_POST['tipo_equipamento']);
    $vo->setTModeloId($_POST['modelo_equipamento']);
    $vo->setIdentificacao($_POST['identificacao']);
    $vo->setDescricao($_POST['descricao']);

    //Chama a função  da camada a frente
    $ret = $ctrl->GravarEquipamentoCTRL($vo);

    if ($_POST['btn_gravar'] == 'ajx') {
        echo $ret;
    }

} 

else if (isset($_POST['btn_excluir'])) {

    $vo = new EquipamentoVO();
    $vo->setId($_POST['id_exc']);

    $ret = $ctrl->ExcluirEquipamentoCTRL($vo);

    if ($_POST['btn_excluir'] == 'ajx') {
        echo $ret;
    }

}

else if (isset($_POST['consultar_ajx']) && $_POST['consultar_ajx'] == 'ajx') {

    $tipo = $_POST['tipo_filtro'];
    $modelo = $_POST['modelo_filtro'];
    $identificacao = $_POST['identificacao_filtro'];

    $equipamentos = $ctrl->ConsultarEquipamentoCTRL($tipo, $modelo, $identificacao); ?>

        <table class="table table-hover" id="tableResult">

            <thead>

                <tr>

                    <th>Ação</th>
                    <th>Tipo</th>
                    <th>Modelo</th>
                    <th>Identificação</th>
                    <th>Descrição</th>
                    <th>Setor Alocado</th>

                </tr>

            </thead>

            <tbody>
            <?php foreach ($equipamentos as $item) { ?>
                    <tr>

                        <td>
                            <a href="equipamento.php?id=<?=  $item['id'] ?>" class="btn btn-outline-warning btn-sm">Alterar
                            </a>

                            <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modal-excluir"
                                onclick="CarregarModalExcluir('<?= $item['id'] ?>', '<?= $item['nome_tipo'] . ' / ' . $item['nome_modelo'] . ' - ' . 'Identificação ' .  $item['identificacao'] ?>')">Excluir
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

                        <td>
                            <p class="text-info"> 
                                <?= $item['nome_setor'] == "" ? "----------" :  $item['nome_setor'] ?> 
                            </p>
                        </td>
                        
                    </tr>
                    
            <?php } ?>
            </tbody>

        </table>

<?php }

$tipos = (new TipoEquipamentoCTRL)->ConsultarEquipamentoCTRL();
$modelos = (new ModeloEquipamentoCTRL)->ConsultarModeloEquipamentoCTRL();