<?php

use Src\_Public\Util;

require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_usuario-dataview.php';
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

              <h1>Consultar Usuário</h1>

            </div>

          </div>

        </div>

      </section>

      <section class="content">

        <div class="card">

          <div class="card-header">

            <h3 class="card-title">Aqui você consulta todos os seus usuários</h3>

          </div>

          <div class="card-body">

            <form action="consultar_usuario.php" method="post">

              <!-- Input hidden para saber se é a primeira vez na página ou não -->
              <input type="hidden" id="primeira_vez" value="1">

              <!-- Input hidden para Ativar/Inativar o usuário -->
              <input type="hidden" id="status">

              <div class="form-group">

                <label>Pesquisar pelo nome</label>
                <input class="form-control" placeholder="Digite aqui..." name="nome_filtro" id="nome_filtro" onkeyup="FiltrarUsuario()" value="<?= isset($_GET['nome_filtro']) ? $_GET['nome_filtro'] : '' ?>">

              </div>

            </form>

          </div>

        </div>

        <hr>

        <div class="row" id="divResultado">

          <div class="col-12">

            <!-- Renderiza a tabela e o h3 (resultado da busca de usuários cadastrados) via AJAX/JS -->
            <div class="card" id="tableResult">
              <!-- Tabela e h3 -->
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

  <script src="../../Resource/ajax/usuario-ajx.js"></script>
  <script>
    FiltrarUsuario()
  </script>

</body>

</html>