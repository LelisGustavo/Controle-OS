<?php
require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_equipamento-dataview.php';
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include_once PATH_URL . '/Template/_includes/_head.php';
    ?>
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <?php
        include_once PATH_URL . '/Template/_includes/_topo.php';
        include_once PATH_URL . '/Template/_includes/_menu.php';
        ?>

        <div class="content-wrapper">

            <section class="content-header">

                <div class="container-fluid">

                    <div class="row mb-2">

                        <div class="col-sm-6">
                            <h1>
                                <?= $acao ?> Equipamento
                            </h1>
                        </div>

                    </div>

                </div>

            </section>

            <section class="content">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <?= isset($dados) ? 'Alterar o equipamento cadastrado' : 'Aqui você podera cadastrar seus novos equipamentos' ?>
                        </h3>
                    </div>

                    <div class="card-body">

                        <form id="form_cad" action="equipamento.php" method="post">

                            <input type="hidden" name="id_equipamento" id="id_equipamento" value="<?= isset($dados) ? $dados['id'] : '' ?>">

                            <div class="form-group">

                                <label>Tipo do equipamento</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="tipo_equipamento" id="tipo_equipamento">
                                    <option value="">Selecione</option>
                                    <?php foreach ($tipos as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= isset($dados) ? ($item['id'] == $dados['tipo_id'] ? 'selected' : '') : '' ?>><?= $item['nome'] ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">

                                <label>Modelo</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="modelo_equipamento" id="modelo_equipamento">
                                    <option value="">Selecione</option>
                                    <?php foreach ($modelos as $item) { ?>
                                        <option value="<?= $item['id'] ?>" <?= isset($dados) ? ($item['id'] == $dados['modelo_id'] ? 'selected' : '') : '' ?>><?= $item['nome'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">

                                <label>Identificação</label>
                                <input class="form-control obg" placeholder="Digite aqui..." name="identificacao" id="identificacao" value="<?= isset($dados['identificacao']) ? $dados['identificacao'] : '' ?>">

                            </div>

                            <div class="form-group">

                                <label>Descrição</label>
                                <textarea class="form-control obg" rows="3" placeholder="Digite aqui..." name="descricao" id="descricao"><?= isset($dados['descricao']) ? $dados['descricao'] : '' ?></textarea>
                            </div>

                            <button class="btn btn-outline-success" name="btn_gravar" onclick="return GravarEquipamento('form_cad')"><?= $acao ?></button>
                    </div>

                    <div id="divLoad">
                        <!-- Só vai ativar quando estiver em load a tela -->
                    </div>

                    </form>

                </div>

            </section>

        </div>

        <?php
        include_once PATH_URL . '/Template/_includes/_footer.php';
        ?>

    </div>

    <?php
    include_once PATH_URL . '/Template/_includes/_scripts.php';
    include_once PATH_URL . '/Template/_includes/_msg.php';
    ?>

    <script src="../../Resource/ajax/equipamento-ajx.js"></script>
    
    <script>
        ConsultarEquipamento();
    </script>

</body>

</html>