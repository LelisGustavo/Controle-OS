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
                            <h1>Remover Equipamento</h1>
                        </div>

                    </div>

                </div>

            </section>

            <section class="content">

                <div class="card">

                    <div class="card-header">

                        <h3 class="card-title">Aqui você poderá remover seus equipamentos</h3>

                    </div>

                    <div class="card-body">

                        <form id="form_cad" action="remover_equipamento.php" method="post">

                            <div class="form-group">

                                <label>Escolha o Setor</label>

                                <select class="form-control select2 obg" style="width: 100%;" name="setor"
                                    id="setor" onchange="CarregarEquipamentosAlocadosSetor()">

                                    <option value="">Selecione</option>

                                    <!-- Carregamento dos setores cadastrados no banco de dados -->
                                    <?php foreach ($setores as $item) { ?>
                                        <option value="<?= $item['id'] ?>"><?= $item['nome'] ?></option>
                                    <?php } ?>

                                </select>

                            </div>

                        </form>

                    </div>

                </div>

                <hr>

                <div class="row" id="divResultado" style="display: none">

                    <div class="col-12">

                        <div class="card">

                            <div class="card-header">

                                <h3 class="card-title">Lista de equipamentos deste setor</h3>

                            </div>

                            <div class="card-body table-responsive p-0">

                                <!-- Tabela renderizada via AJAX com consulta baseada no Setor -->
                                <table class="table table-hover" id="tableResult">
                                        <!-- Tabela -->
                                </table>

                            </div>

                            <form id="form_alt" action="remover_equipamento.php" method="post">

                                <?php
                                include_once 'modals/_excluir.php';
                                ?>

                            </form>

                            <!-- Só vai ativar quando estiver em load a tela -->
                            <div id="divLoad">
                                <!-- Load -->
                            </div>

                        </div>

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
        CarregarEquipamentosAlocadosSetor();
    </script>

</body>

</html>