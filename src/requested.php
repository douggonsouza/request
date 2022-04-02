<?php

namespace douggonsouza\request;

use douggonsouza\request\usagesInterface;

/**
 * REQUESTED
 * 
 * Trata a requisição para a identificação de parâmetros necessários ao roteamento
 */
abstract class requested implements usagesInterface
{
    protected static $usages;

    /**
     * Defini o objeto variable a ser utilizado
     *
     * @param usagesInterface $variable
     * 
     * @return object
     */
    public static function usages(usagesInterface $usages = null)
    {
        self::setUsages($usages);
        return self::getUsages();
    }

    public static function routing()
    {
        $routes = self::getUsages()->getRoute();
        include_once $routes;
    }

    /**
     * Executa a sequencia básica
     *
     * @param array $folders
     * 
     * @return self
     */
    public function parameters(array $folders)
    {
        if(self::getUsages() === null){
            throw new \Exception("Não está definido objeto Usages.");
        }

        if(!isset($folders) || empty($folders)){
            throw new \Exception("Lista de 'Routes' não encontrado.");
        }

        self::getUsages()->parameters($folders);
        return $this;
    }

    /**
     * Get the value of variables
     */ 
    public static function getUsages()
    {
        return self::$usages;
    }

    /**
     * Set the value of variables
     *
     * @return  self
     */ 
    public static function setUsages($usages)
    {
        if(isset($usages) && !empty($usages)){
            self::$usages = $usages;
        }
    }
}
?>