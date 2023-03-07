function GravarEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        let id_equipamento = $("#id_equipamento").val();
        let nome_tipo_equipamento = $("#tipo_equipamento").val();
        let nome_modelo = $("#modelo_equipamento").val();
        let identificacao = $("#identificacao").val();
        let descricao = $("#descricao").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_equipamento-dataview"),
            data: {
                btn_gravar: 'ajx',
                id_equipamento: id_equipamento,
                tipo_equipamento: nome_tipo_equipamento,
                modelo_equipamento: nome_modelo,
                identificacao: identificacao,
                descricao: descricao
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();

                    if (id_equipamento == "") {
                        LimparCampos(id_form);
                    }

                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })

    }
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}

function ConsultarEquipamento() {

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_equipamento-dataview"),
        data: {
            consultar_ajx: 'ajx',
            identificacao_filtro: $("#identificacao_filtro").val(),
            tipo_filtro: $("#tipo_filtro").val(),
            modelo_filtro: $("#modelo_filtro").val()
        },
        success: function (dados_result) {
            $("#tableResult").html(dados_result);
        }
    })
}

function Excluir() {

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_equipamento-dataview"),
        data: {
            btn_excluir: 'ajx',
            id_exc: $("#id_exc").val()
        },
        success: function (retorno) {
            if (retorno == 1) {
                MensagemSucesso();
                ConsultarEquipamento();
                FecharModal("modal-excluir")
            } else {
                MensagemErro();
            }
        }
    })
    return false;
}

function AlterarEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        let nome_tipo_equipamento = $("#tipo_equipamento").val();
        let nome_modelo = $("#modelo_equipamento").val();
        let identificacao = $("#identificacao").val();
        let descricao = $("#descricao").val();
        let id = $("#id_equipamento").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_equipamento-dataview"),
            data: {
                btn_alterar: 'ajx',
                tipo_equipamento: nome_tipo_equipamento,
                modelo_equipamento: nome_modelo,
                identificacao: identificacao,
                descricao: descricao,
                id_equipamento: id
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();
                    LimparCampos(id_form);
                    //window.location.replace("consultar_equipamento.php")
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })
    }
    return false;
}