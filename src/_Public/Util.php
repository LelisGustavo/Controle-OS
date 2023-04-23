<?php

namespace Src\_Public;

class Util
{

    public static function CodigoLogado(): int
    {
        return 1;
    }

    //Função privada para verificar o fuso hórario do usuário
    private static function SetarFusoHorario()
    {

        date_default_timezone_set('America/Sao_Paulo');
    }

    //Função pública da data atual
    public static function DataAtual()
    {

        self::SetarFusoHorario();
        return date('Y-m-d');
    }

    //Função pública para data atual formatação BR
    public static function DataAtualBr()
    {

        self::SetarFusoHorario();
        return date('d/m/Y');
    }

    // Função que verifica os Arrays de cadastro nas páginas
    public static function MostrarArray($arr)
    {

        echo '<pre>';
        print_r($arr);
        echo '</pre>';

    }

    //Função pública da hora atual
    public static function HoraAtual()
    {
        self::SetarFusoHorario();
        return date('H:i');
    }

    // Função pública da data e hora atual
    public static function DataHoraAtual()
    {

        self::SetarFusoHorario();
        return date('Y-m-d H:i');
    }

    //Função pública para usar nos campos para limpar mascaras
    public static function TirarCaracteresEspeciais($palavra)
    {

        $especiais = array(".", ",", ";", "!", "@", "#", "%", "¨", "*", "(", ")", "+", "-", "=", "§", "$", "|", "\\", ":", "/", "<", ">", "?", "{", "}", "[", "]", "&", "'", '"', "´", "`", "?", '“', '”', '$', "'", "'", ' ');
        $palavra = str_replace($especiais, "", trim($palavra));
        return $palavra;
    }

    //Função pública para usar em campos de e-mails e senhas
    public static function RemoverTags($palavra)
    {

        $palavra = strip_tags($palavra);
        return $palavra;
    }

    //Função pública para tratar uso de caracteres não permitidos e execesso de espaço nos input's
    public static function TratarDadosGeral($palavra)
    {

        $especiais = array(".", ",", ";", "!", "@", "#", "%", "¨", "*", "(", ")", "+", "-", "=", "§", "$", "|", "\\", ":", "/", "<", ">", "?", "{", "}", "[", "]", "&", "'", '"', "´", "`", "?", '“', '”', '$', "'", "'", ' ');
        $palavra = strip_tags($palavra);
        $palavra = str_replace($especiais, "", trim($palavra));
        return $palavra;
    }

    //Função pública para tratar uso de caracteres permitidos com execesso de espaço nos input's
    public static function TratarDadosGeralComEspacos($palavra)
    {

        $especiais = array(".", ",", ";", "!", "@", "#", "%", "¨", "*", "(", ")", "+", "-", "=", "§", "$", "|", "\\", ":", "/", "<", ">", "?", "{", "}", "[", "]", "&", "'", '"', "´", "`", "?", '“', '”', '$', "'", "'");
        $palavra = strip_tags($palavra);
        $palavra = str_replace($especiais, "", trim($palavra));
        return $palavra;
    }

    //Função que chama ma página expecifica no projeto
    public static function ChamarPagina(string $pagina) 
    {

        header("location: $pagina.php");
        exit;

    }

    //Função para criptografar a senha do usuario
    public static function CriptografarSenha($palavra)
    {
        
        return password_hash($palavra, PASSWORD_DEFAULT);

    }

    //Função para verificar a senha do usuario
    public static function VerificarSenha($senha, $hash)
    {
        
        return password_verify($senha, $hash);

    }

}