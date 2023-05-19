<?php
namespace core\classes;

use Exception;
use PDO;
use PDOException;

class Database
{
    private $conexao;

    //========================================================================
    private function conectar()
    {
        //conecta a base de dados
        $this->conexao = new PDO(
            'mysql:' . 
            'host=' . MYSQL_SERVER . ';' .
            'dbname=' . MYSQL_DATABASE . ';' .
            'charset=' . MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //debug
        $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    //==========================================================================
    private function desconectar()
    {
        //desconecta a base de dados
        $this->conexao = null;
    }
    //===========================================================================
    //CRUD
    //===========================================================================
    public function select($sql, $parametros = null)
    {
        //verificar se é uma instrução SELECT
        if(!preg_match("/^SELECT/i", $sql)) {
            throw new Exception('Base de dados -  Não é uma instrução SELECT');
        }



        //executar função de pesquisa SQL
        $this->conectar();

        $resultados = null;

        //comunicar
        try {
            //comunicação com BD
            if(!empty($parametros)) {
                $executar = $this->conexao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->conexao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }

        } catch (PDOException $e) {
            //caso exista erro
            return false;
        }

        //desconectar a base de dados
        $this->desconectar();

        //devolver os resultados obtidos
        return $resultados;

    }
    //===========================================================================
    public function insert($sql, $parametros = null)
    {
        //verificar se é uma instrução INSERT
        if(!preg_match("/^INSERT/i", $sql)) {
            throw new Exception('Base de dados -  Não é uma instrução INSERT');
        }

        //executar função de insert SQL
        $this->conectar();

        //comunicar
        try {
            //comunicação com BD
            if(!empty($parametros)) {
                $executar = $this->conexao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->conexao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {
            //caso exista erro
            return false;
        }

        //desconectar a base de dados
        $this->desconectar();

    }
    //===========================================================================
    public function update($sql, $parametros = null)
    {
        //verificar se é uma instrução UPDATE
        if(!preg_match("/^UPDATE/i", $sql)) {
            throw new Exception('Base de dados -  Não é uma instrução UPDATE');
        }

        //executar função de update SQL
        $this->conectar();

        //comunicar
        try {
            //comunicação com BD
            if(!empty($parametros)) {
                $executar = $this->conexao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->conexao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {
            //caso exista erro
            return false;
        }

        //desconectar a base de dados
        $this->desconectar();

    }
    //===========================================================================
    public function delete($sql, $parametros = null)
    {
        //verificar se é uma instrução DELETE
        if(!preg_match("/^DELETE/i", $sql)) {
            throw new Exception('Base de dados -  Não é uma instrução DELETE');
        }

        //executar função de delete SQL
        $this->conectar();

        //comunicar
        try {
            //comunicação com BD
            if(!empty($parametros)) {
                $executar = $this->conexao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->conexao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {
            //caso exista erro
            return false;
        }

        //desconectar a base de dados
        $this->desconectar();

    }
    //===========================================================================
    //generica
    //===========================================================================
    public function statement($sql, $parametros = null)
    {
        //verificar se é uma instrução diferente das anteriores
        if(preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)) {
            throw new Exception('Base de dados -  Instrução Inválida');
        }

        //executar função de delete SQL
        $this->conectar();

        //comunicar
        try {
            //comunicação com BD
            if(!empty($parametros)) {
                $executar = $this->conexao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->conexao->prepare($sql);
                $executar->execute();
            }

        } catch (PDOException $e) {
            //caso exista erro
            return false;
        }

        //desconectar a base de dados
        $this->desconectar();

    }
}

