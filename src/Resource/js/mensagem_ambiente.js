function RetornarMsg(ret) {
    let msg = "";

    switch (ret) {

        case -1:
            msg = "Ocorreu um erro na operação";
            break;
        case 0:
            msg = "Preencher o(s) campos(s) obrigatório(s)";
            break;
        case 1:
            msg = "Ação realizada com sucesso";
            break;
        case -2:
            msg = "O registo não pode ser excluído pois está em uso";
            break;
    }

    return msg;
}