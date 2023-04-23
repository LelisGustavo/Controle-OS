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

