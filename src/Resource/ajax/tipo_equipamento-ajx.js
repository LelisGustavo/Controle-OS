function CadastrarTipoEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        let nome_tipo_equipamento = $("#nome_tipo").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_tipo_equipamento-dataview"),
            data: {
                btn_cadastrar: 'ajx',
                nome_tipo: nome_tipo_equipamento
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();
                    LimparCampos(id_form);
                    ConsultarTipoEquipamento();
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })
    }
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}

function ConsultarTipoEquipamento() {

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_tipo_equipamento-dataview"),
        data: {
            consultar_ajx: 'ajx',
            nome_pesquisar: $("#nome_filtro").val(),
            tipo_equipamento: $("#tipo_equipamento").val(),
            modelo_equipamento: $("#modelo_equipamento").val()
        },
        success: function (dados_result) {
            $("#tableResult").html(dados_result);
        }
    })
}

function Excluir() {

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_tipo_equipamento-dataview"),
        data: {
            btn_excluir: 'ajx',
            id_exc: $("#id_exc").val()
        },
        success: function (retorno) {
            if (retorno == 1) {
                MensagemSucesso();
                ConsultarTipoEquipamento();
                FecharModal("modal-excluir");
            } else {
                MensagemErroExcluir();
            }
        }
    })
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}

function AlterarTipoEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        let nome_tipo_equipamento = $("#nome_tipo_alt").val();
        let id = $("#id_alt").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_tipo_equipamento-dataview"),
            data: {
                btn_alterar: 'ajx',
                nome_tipo_alt: nome_tipo_equipamento,
                id_alt: id
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();
                    ConsultarTipoEquipamento();
                    LimparCampos(id_form);
                    FecharModal("modal-alterar-tipoequip");
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })
    }
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}