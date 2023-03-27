function GravarEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        CarregarTela();

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
                EncerrarTela();
                if (retorno == 1) {
                    MensagemSucesso();
                    // Se vazio é um cadastro, se não vazio, é uma alteração
                    if (id_equipamento == "") {
                        LimparCampos(id_form);
                    } else {
                        // Depois de alterado, manda o usuario para outra pagina depois de 3 segundos
                        setTimeout(function () {
                        location = "consultar_equipamento.php?identificacao=" + identificacao
                        }, 3000);

                    }
                // Retorna a mensagem de erro caso ocorrer algo na operação    
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

    CarregarTela();

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
            EncerrarTela();
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
            FecharModal("modal-excluir");
            if (retorno == 1) {
                MensagemSucesso();
                ConsultarEquipamento();
            } else if (retorno == -1) {
                MensagemErroExcluir();
            }
        }
    })
    return false;
}