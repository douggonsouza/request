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
    public static function usages(usagesInterface $usages)
    {
        self::setUsages($usages);
        return self::getUsages();
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
        if(self::getUsages() !== null){
            return self::getUsages()->parameters($folders);
        }
        
        return false;
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