function MensagemCampoObrigatorio() {

    toastr.warning(RetornarMsg(0));

}

function MensagemSucesso() {

    toastr.success(RetornarMsg(1));

}

function MensagemErro() {

    toastr.error(RetornarMsg(-1));

}

function MensagemErroExcluir() {

    toastr.error(RetornarMsg(-2));

}

function MensagemCustomizada(texto){
    toastr.info(texto)
}

function MensagemNaoEncontradoRegistro(){
    toastr.info(RetornarMsg(-3));
}