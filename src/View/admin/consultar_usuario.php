<?php
require_once dirname(__DIR__, 3) . '\vendor\autoload.php';
?>

<!DOCTYPE html>
<html>

<head>
  <?php
  include_once PATH_URL . '/Template/_includes/_head.php';
  ?>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <?php
    include_once PATH_URL . '/Template/_includes/_topo.php';
    include_once PATH_URL . '/Template/_includes/_menu.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Consultar Usuário</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Aqui você consulta todos os seus usuários</h3>
          </div>
          <div class="card-body">
            <form action="consultar_usuario.php" method="post">
              <div class="form-group">
                <label>Pesquisar por tipo</label>
                <input class="form-control" placeholder="Digite aqui..." name="nome_tipo" id="nome_tipo">
              </div>
              <button class="btn btn-outline-info" name="btn_pesquisar">Pesquisar</button>
          </div>
          </form>
          <!-- /.card-body -->
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Usuários Cadastrados</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Ação</th>
                      <th>Nome</th>
                      <th>Setor</th>

                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <a href="#" class="btn btn-outline-warning btn-sm">Alterar</a>
                        <a href="#" class="btn btn-outline-danger btn-sm">Excluir</a>
                      </td>
                      <td>(nome)</td>
                      <td>(setor)</td>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
    include_once PATH_URL . '/Template/_includes/_footer.php';
    ?>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <?php
  include_once PATH_URL . '/Template/_includes/_scripts.php';
  ?>
</body>

</html>