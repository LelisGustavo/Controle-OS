function CadastrarSetor(id_form) {

    if (NotificarCampos(id_form)) {

        CarregarTela();

        let nome_setor = $("#nome_setor").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_setor-dataview"),
            data: {
                btn_cadastrar: 'ajx',
                nome_setor: nome_setor
            },
            success: function (retorno) {
                EncerrarTela();
                if (retorno == 1) {
                    MensagemSucesso();
                    LimparCampos(id_form);
                    ConsultarSetor();
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })
    }
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}

function ConsultarSetor() {

    CarregarTela();

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_setor-dataview"),
        data: {
            consultar_ajx: 'ajx',
            nome_pesquisar: $("#nome_filtro").val()
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
        url: BASE_URL("gerenciar_setor-dataview"),
        data: {
            btn_excluir: 'ajx',
            id_exc: $("#id_exc").val()
        },
        success: function (retorno) {
            if (retorno == 1) {
                MensagemSucesso();
                ConsultarSetor();
                FecharModal("modal-excluir");
            } else {
                MensagemErro();
            }
        }
    })
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}

function AlterarSetor(id_form) {

    if (NotificarCampos(id_form)) {

        let nome_setor = $("#nome_setor_alt").val();
        let id = $("#id_alt").val();

        $.ajax({
            type: "POST",
            url: BASE_URL("gerenciar_setor-dataview"),
            data: {
                btn_alterar: 'ajx',
                nome_setor_alt: nome_setor,
                id_alt: id
            },
            success: function (retorno) {
                if (retorno == 1) {
                    MensagemSucesso();
                    ConsultarSetor();
                    LimparCampos(id_form);
                    FecharModal("modal-alterar-setor");
                } else if (retorno == -1) {
                    MensagemErro();
                }
            }
        })
    }
    // Return false para não ir para o servidor(php) e piscar a tela
    return false;
}