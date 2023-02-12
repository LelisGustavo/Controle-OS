function CadastrarEquipamento(id_form) {

    if (NotificarCampos(id_form)) {

        let nome_tipo_equipamento = $("#tipo_equipamento").val();
        let nome_modelo = $("#modelo_equipamento").val();
        let identificacao = $("#identificacao").val();
        let descricao = $("#descricao").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_equipamento-dataview"),
            data: {
                btn_cadastrar: 'ajx',
                tipo_equipamento: nome_tipo_equipamento,
                modelo_equipamento: nome_modelo,
                identificacao: identificacao,
                descricao: descricao
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();
                    LimparCampos(id_form);
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
            // nome_pesquisar: $("#nome_pesquisar").val()
        },
        success: function (dados_result) {
            $("#tableResult").html(dados_result);
        }
    })

}