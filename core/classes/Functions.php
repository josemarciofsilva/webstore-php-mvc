<?php
namespace core\classes;

use Exception;

class Functions
{
    //===============================================================
    public static function Layout($estruturas, $dados)
    {
        //verifica se estruturas é um array
        if(!is_array($estruturas)) {
            throw new Exception("Coleção de estruturas inválida");
        }

        //variáveis
        if(!empty($dados) && is_array($dados)) {
            extract($dados);
        }



        //apresentar as views da aplicação
        foreach ($estruturas as $estrutura) {
            include("../core/views/$estrutura.php");
        }
    }
}