<div class="modal fade" id="modal-alterar-modeloequip">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title">Alterar Modelo de Equipamento</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <input type="hidden" name="id_alt" id="id_alt">
                <div class="form-group">

                    <label>Modelo do equipamento</label>
                    <input class="form-control obg" placeholder="Digite aqui..." name="nome_modelo_alt" id="nome_modelo_alt">
                </div>

            </div>

            <div class="modal-footer justify-content-between">

                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                <button name="btn_alterar" class="btn btn-outline-success" onclick="return AlterarModeloEquipamento('form_alt')">Alterar</button>
                
            </div>

        </div>
        
    </div>
    
</div>