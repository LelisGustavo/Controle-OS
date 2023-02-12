function CadastrarModeloEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        let nome_modelo = $("#nome_modelo").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_modelo_equipamento-dataview"),
            data: {
                btn_cadastrar: 'ajx',
                nome_modelo: nome_modelo
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();
                    LimparCampos(id_form);
                    ConsultarModeloEquipamento();
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })
    }
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}

function ConsultarModeloEquipamento() {

    $.ajax({
        type: 'POST',
        url: BASE_URL("gerenciar_modelo_equipamento-dataview"),
        data: {
            consultar_ajx: 'ajx',
            nome_pesquisar: $("#nome_filtro").val()
        },
        success: function (dados_result) {
            $("#tableResult").html(dados_result);
        }
    })

}

function Excluir() {

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_modelo_equipamento-dataview"),
        data: {
            btn_excluir: 'ajx',
            id_exc: $("#id_exc").val()
        },
        success: function (retorno) {
            if (retorno == 1) {
                MensagemSucesso();
                ConsultarModeloEquipamento();
                FecharModal("modal-excluir");
            } else {
                MensagemErro();
            }
        }
    })
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}

function AlterarModeloEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        let nome_modelo = $("#nome_modelo_alt").val();
        let id = $("#id_alt").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_modelo_equipamento-dataview"),
            data: {
                btn_alterar: 'ajx',
                nome_modelo_alt: nome_modelo,
                id_alt: id
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();
                    ConsultarModeloEquipamento();
                    LimparCampos(id_form);
                    FecharModal("modal-alterar-modeloequip");
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })

    }
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}