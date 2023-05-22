function ValidarEmailDuplicado() {

    let id_user = $("#id_user").val() == '' ? 0 : $("#id_user").val();
    let email_usuario = $("#email_usuario").val();

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_usuario-dataview"),
        data: {
            verificar_email: 'ajx',
            id_user: id_user,
            email_usuario: email_usuario
        },
        success: function (retorno) {
            if (retorno == 1) {
                MensagemCustomizadaWarning("O E-mail: " + email_usuario + " já está cadastrado!");
                $("#email_usuario").val('');
                $("#email_usuario").focus();
            }
        }
    })

}

function FiltrarUsuario() {

    let nome_filtro = $("#nome_filtro").val();
    let primeira_vez = $("#primeira_vez").val();

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_usuario-dataview"),
        data: {
            filtrar_usuario: 'ajx',
            nome_filtro: nome_filtro,
            primeira_vez: primeira_vez
        },
        success: function (dados_result) {
            $("#tableResult").html(dados_result);
            $("#primeira_vez").val('0');
        }
    })
    
}

function AlterarStatus(id, status) {

    $.ajax({
        type: "POST",
        url: BASE_URL("gerenciar_usuario-dataview"),
        data: {
            btn_alterar_status: 'ajx',
            id_user: id,
            status: status
        },
        success: function (retorno) {
            if (retorno == '1') {
                MensagemSucesso();
                FiltrarUsuario();
            } else if (retorno == '2') {
                MensagemErro();
            }
        }
    })
            
}