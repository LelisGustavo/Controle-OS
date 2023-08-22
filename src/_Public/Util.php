<?php

namespace Src\_Public;

class Util
{

    public static function IniciarSessao()
    {

        if (!isset($_SESSION)) {
            session_start();
        }
    }

    public static function CriarSessao($id, $nome)
    {

        self::IniciarSessao();

        $_SESSION['cod'] = $id;
        $_SESSION['nome'] = $nome;
    }

    public static function CodigoLogado(): int
    {

        self::IniciarSessao();

        return $_SESSION['cod'];
    }

    public static function VerLogado()
    {

        self::IniciarSessao();
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == '') {
            self::IrParaLogin();
        }
    }

    public static function IrParaLogin()
    {

        Util::ChamarPagina('http://localhost/controleOS/src/View/admin/acesso');
    }

    public static function Deslogar()
    {
        self::IniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);

        self::IrParaLogin();
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

    //Função que chama uma página expecifica no projeto
    public static function ChamarPagina(string $pagina)
    {

        header("location: $pagina.php");
        exit;
    }

    //Função que chama uma página expecifica no profeto com parametros
    public static function ChamarPaginaParametros(string $pagina, string $parametros)
    {

        header("location: $pagina.php?$parametros");
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

    public static function RetornarTipo(int $tipo): string
    {

        $tipo_desc = '';

        switch ($tipo) {

            case PERFIL_ADM:
                $tipo_desc = 'Administrador';
                break;

            case PERFIL_FUNCIONARIO:
                $tipo_desc = 'Funcionário';
                break;

            case PERFIL_TECNICO:
                $tipo_desc = 'Técnico';
                break;
        }

        return $tipo_desc;
    }

    public static function CreateTokenAuthentication(array $dados_user)
    {

        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256'
        ];

        $payload = $dados_user;

        $header = json_encode($header);
        $payload = json_encode($payload);

        $header = base64_encode($header);
        $payload = base64_encode($payload);

        $sign = hash_hmac(
            "sha256",
            $header . '.' . $payload,
            SECRET_JWT,
            true
        );

        $sign = base64_encode($sign);
        $token = $header . '.' . $payload . '.' . $sign;

        return $token;
    }

    public static function AuthenticationTokenAccess()
    {

        // Recupera todo o cabeçalho da requisição
        $http_header = apache_request_headers();
        // Se não for nulo
        if (
            $http_header['Authorization'] != null &&
            str_contains($http_header['Authorization'], '.')
        ) {
            // Quebra o bearer (autenticação de token)
            $bearer = explode(' ', $http_header['Authorization']);
            $token = explode('.', $bearer[1]);

            // Quebrando os valores e jogango em seus significados
            $header = $token[0];
            $payload = $token[1];
            $sign = $token[2];
            
            // Faz a criptografia novamente para ver se bate com a chave
            $valid = hash_hmac(
                'sha256',
                $header . '.' . $payload,
                SECRET_JWT,
                true
            );
            $valid = base64_encode($valid);
            if ($valid === $sign) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }
}
