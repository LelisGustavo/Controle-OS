function BASE_URL(nome_arquivo) {

    return "../../Resource/dataview/" + nome_arquivo + ".php";

}

function BASE_URL_GET(nome_arquivo) {

    return "../../Resource/dataview/" + nome_arquivo;

}

function LimparCampos(id_form) {

    $("#" + id_form + " input, #" + id_form + " select, #" + id_form + " textarea").each(function () {
        //Tira a marcação do CSS do input
        $(this).removeClass("is-valid");
        //Limpa o input da vez
        $(this).val('');
    })

}

function NotificarCampos(id_form) {

    let ret = true;

    $("#" + id_form + " input, #" + id_form + " select, #" + id_form + " textarea").each(function () {

        if ($(this).hasClass("obg")) {

            if ($(this).val().trim() == "") {
                ret = false;
                $(this).addClass("is-invalid");
            } else {
                $(this).removeClass("is-invalid").addClass("is-valid");
            }
        }

    })

    //Se meu ret não for true, dispará a mensagem de preencher campos obrigatórios
    if (!ret)
        MensagemCampoObrigatorio();

    return ret;
}

function FecharModal(id_modal) {
    $("#" + id_modal).modal("hide");
}

function CarregarTela() {
    $("#divLoad").addClass("overlay").html('<i class="fas fa-2x fa-sync-alt fa-spin"></i>');
}

function EncerrarTela() {
    $("#divLoad").removeClass("overlay").html('');
}