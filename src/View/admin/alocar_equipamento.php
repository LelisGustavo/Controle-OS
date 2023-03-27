<?php
require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_alocamento-dataview.php';
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
                            <h1>Alocar Equipamento</h1>
                        </div>

                    </div>

                </div>

            </section>

            <section class="content">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Aqui você poderá alocar um equipamento ao setor especifico</h3>
                    </div>

                    <div class="card-body">

                        <form id="form_cad" action="alocar_equipamento.php" method="post">

                            <!-- Div/Select renderizando via AJAX -->
                            <div class="form-group">
                                <label>Equipamento</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="equipamento"
                                    id="equipamento">
                                </select>
                            </div>

                            <!-- Carregamento dos setores cadastrados no banco de dados -->
                            <div class="form-group">
                                <label>Setor</label>
                                <select class="form-control select2 obg" style="width: 100%;" name="setor" id="setor">
                                    <option value="">Selecione</option>
                                    <?php foreach ($setores as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['nome'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <button class="btn btn-outline-success" name="btn_alocar"
                                onclick="return AlocarEquipamento('form_cad')">Alocar</button>

                        </form>

                    </div>

                    <div id="divLoad">
                        <!-- Só vai ativar quando estiver em load a tela -->
                    </div>

                </div>

            </section>

        </div>
    
        <?php
        include_once PATH_URL . '/Template/_includes/_footer.php';
        ?>

    </div>

    <?php
    include_once PATH_URL . '/Template/_includes/_scripts.php';
    include_once PATH_URL . 'Template/_includes/_msg.php';
    ?>

    <script src="../../Resource/ajax/alocar-ajx.js"></script>

    <script>
        CarregarEquipamentosNaoAlocados();
    </script>

</body>

</html>