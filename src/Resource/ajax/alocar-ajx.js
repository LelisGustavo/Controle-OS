function AlocarEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        CarregarTela();

        let equipamento = $("#equipamento").val();
        let setor = $("#setor").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_alocamento-dataview"),
            data: {
                btn_alocar: 'ajx',
                equipamento: equipamento,
                setor: setor
            },
            success: function (retorno) {
                EncerrarTela();
                if (retorno == 1) {
                    MensagemSucesso();
                    LimparCampos(id_form)
                    CarregarEquipamentosNaoAlocados()
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })
    }
    return false;
}

function CarregarEquipamentosNaoAlocados() {

    CarregarTela();

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_alocamento-dataview"),
        data: {
            consultar_ajx: 'ajx'
        },
        success: function (dados_result) {
            EncerrarTela();
            $("#equipamento").html(dados_result);
        }
    })

}

function CarregarEquipamentosAlocadosSetor() {

    let id_setor = $("#setor").val();

    if (id_setor != "") {

        CarregarTela();

        $.ajax ({
            type: "POST",
            url: BASE_URL("gerenciar_alocamento-dataview"),
            data: {
                consultar_alocados_ajx: 'ajx',
                id_setor: id_setor
            },
            success: function (dados_result) {
                EncerrarTela();
                if (dados_result != "") {
                    $("#divResultado").show();
                    $("#tableResult").html(dados_result);
                } else {
                    MensagemNaoEncontradoRegistro();
                    $("#divResultado").hide();
                }
            }
        })

    } else {
        $("#divResultado").hide();
    }
    return false;
}

function Excluir() {

    CarregarTela();

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_alocamento-dataview"),
        data: {
            btn_excluir: 'ajx',
            id_exc: $("#id_exc").val()
        },
        success: function (retorno) {
            EncerrarTela();
            if (retorno == 1) {
                MensagemSucesso();
                FecharModal("modal-excluir");
                CarregarEquipamentosAlocadosSetor();
            } else if (retorno == -1) {
                MensagemErro();
            }
        }
    })
    return false;
}