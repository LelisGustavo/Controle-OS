function CarregarModalExcluir(id, nome_registro)
{

    $("#id_exc").val(id);
    $("#nome_reg_exc").html(nome_registro);

}

function CarregarModalAlterarTipoEquipamento(id, nome)
{

    $("#id_alt").val(id);
    $("#nome_tipo_alt").val(nome);

}

function CarregarModalAlterarModeloEquipamento(id, nome)
{

    $("#id_alt").val(id);
    $("#nome_modelo_alt").val(nome);

}

function CarregarModalAlterarSetor(id, nome)
{

    $("#id_alt").val(id);
    $("#nome_setor_alt").val(nome);

}


function CarregarModalAlterarStatus(id, status, nome) 
{

    $("#id_alt").val(id);
    $("#status_alt").val(status);
    $("#nome_usuario").val(nome);

}