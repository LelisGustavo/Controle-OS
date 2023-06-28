<?php
require_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_modelo_equipamento-dataview.php';
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
              <h1>Gerenciar modelo de Equipamento</h1>
            </div>

          </div>

        </div>

      </section>

      <section class="content">

        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Aqui você gerencia todos os modelos de equipamentos cadastrados</h3>
          </div>

          <div class="card-body">

            <form id="form_cad" action="gerenciar_modelo_equipamento.php" method="post">

              <div class="form-group">

                <label>Nome do modelo</label>
                <input class="form-control obg" placeholder="Digite aqui..." name="nome_modelo" id="nome_modelo">

              </div>

              <button class="btn btn-outline-success" name="btn_cadastrar"
                onclick="return CadastrarModeloEquipamento('form_cad')">Cadastrar</button>

              </form>

          </div>
          
        </div>

        <hr>

        <div class="row">

          <div class="col-12">

            <div class="card">

              <div class="card-header">

                <h3 class="card-title">Modelos Cadastrados</h3>

                <div class="card-tools">

                  <div class="input-group input-group-sm" style="width: 150px;">

                    <input type="text" onkeyup="ConsultarModeloEquipamento()" name="nome_filtro" id="nome_filtro"
                      class="form-control float-right" placeholder="Filtrar...">

                    <div class="input-group-append">

                      <button type="button" onclick="ConsultarModeloEquipamento()" class="btn btn-default"><i
                          class="fas fa-search"></i></button>

                    </div>

                  </div>

                </div>

                <div id="divLoad">
                  <!-- Só vai ativar quando estiver em load a tela -->
                </div>

              </div>
              
              <div class="card-body table-responsive p-0">

                <table class="table table-hover" id="tableResult">

                </table>

              </div>

              <form id="form_alt" action="gerenciar_modelo_equipamento.php" method="post">
                <?php
                include_once 'modals/_gerenciar_modelo_equipamento_alterar.php';
                include_once 'modals/_excluir.php';
                ?>
              </form>
              
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
  include_once PATH_URL . '/Template/_includes/_msg.php';
  ?>
  
  <script src="../../Resource/ajax/modelo_equipamento-ajx.js"></script>

  <script>
    ConsultarModeloEquipamento()
  </script>

</body>

</html>