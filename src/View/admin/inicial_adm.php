<?php
require_once dirname(__DIR__, 2) . '/Resource/dataview/inicial-dataview.php';
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
                            <h1>Inicial</h1>
                        </div>

                    </div>

                </div>

            </section>

            <section class="content">

                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">Dados dos Chamados</h3>
                    </div>

                    <div class="card-body" style="display: flex; justify-content: center;">

                        <!-- Div usando API do Google para os gráficos do projeto -->
                        <div id="graficos"></div>

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

    <!-- API do Google de Gráficos -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", {
                    role: "style"
                }],
                ["Aguardando", <?= $dados['AGUARDANDO'] ?>, "#ffc107"],
                ["Em Atendimento", <?= $dados['ATENDIMENTO'] ?>, "#17a2b8"],
                ["Finalizado", <?= $dados['ENCERRADO'] ?>, "#28a745"]
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2
            ]);

            var options = {
                title: "CHAMADOS - NÚMEROS EM TEMPO REAL",
                width: 450,
                height: 300,
                bar: {
                    groupWidth: "95%"
                },
                legend: {
                    position: "none"
                },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("graficos"));
            chart.draw(view, options);
        }
    </script>

</body>

</html>