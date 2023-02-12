<div class="modal fade" id="modal-excluir">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmação de exclusão</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_exc" id="id_exc">
                <div class="form-group">
                    <p>Deseja excluir o registro: <label id="nome_reg_exc"></label> ? </p>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <button name="btn_excluir" class="btn btn-outline-success" onclick="return Excluir()">Sim</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>