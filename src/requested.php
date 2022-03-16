<?php

namespace douggonsouza\request;

use douggonsouza\request\variablesInterface;

/**
 * REQUESTED
 * 
 * Trata a requisição para a identificação de parâmetros necessários ao roteamento
 */
class requested implements variablesInterface
{
    protected static $variables;

    /**
     * Defini o objeto variable a ser utilizado
     *
     * @param variablesInterface $variable
     * 
     * @return object
     */
    public static function variable(variablesInterface $variable)
    {
        self::setVariables($variable);
        return self::getVariables();
    }

    /**
     * Executa a sequencia básica
     *
     * @param array $folders
     * 
     * @return self
     */
    public function basicSequence(array $folders)
    {
        if(self::getVariables() !== null){
            return self::getVariables()->basicSequence($folders);
        }
        
        return false;
    }

    /**
     * Colhe o host
     *
     * @return self
     */
    public function host()
    {
        if(self::getVariables() !== null){
            return self::getVariables()->host();
        }

        return false;
    }

    /**
     * Colhe a request
     *
     * @return self 
     */
    public function request()
    {
        if(self::getVariables() !== null){
            return self::getVariables()->request();
        }

        return false;
    }

    /**
     * Colhe o diretório
     *
     * @return self
     */
    public function dir()
    {
        if(self::getVariables() !== null){
            return self::getVariables()->dir();
        }

        return false;
    }

    /**
     * Colhe a queryString
     *
     * @param string $request
     * 
     * @return self
     */
    public function querystring()
    {
        if(self::getVariables() !== null){
            return self::getVariables()->queryString();
        }

        return false;
    }

    /**
     * Colhe o folder
     *
     * @param string $request
     * 
     * @return self
     */
    public function folder()
    {
        if(self::getVariables() !== null){
            return self::getVariables()->folder();
        }

        return false;
    }

    /**
     * Get the value of variables
     */ 
    public static function getVariables()
    {
        return self::$variables;
    }

    /**
     * Set the value of variables
     *
     * @return  self
     */ 
    public static function setVariables($variables)
    {
        if(isset($variables) && !empty($variables)){
            self::$variables = $variables;
        }
    }
}
?>