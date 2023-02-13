<?php

namespace douggonsouza\request;

use douggonsouza\request\usagesInterface;

/**
 * requested
 * 
 * Trata a requisição para a identificação de parâmetros necessários ao roteamento
 * @version 1.0.0
 */
abstract class requested
{    
    /** @var mixed $usages */
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
        if(isset($usages) && !empty($usages)){
            self::setUsages($usages);
        }
        
        return self::getUsages()->parameters();
    }
    
    /**
     * routing: Carrega arquivo configurado como responsável pelo roteamento da requisição
     *
     * @return void
     */
    public static function routing(usagesInterface $usages)
    {
        if(isset($usages) && !empty($usages)){
            self::setUsages($usages);
        }

        include_once (self::getUsages())->getRoute();
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
    private static function setUsages($usages)
    {
        if(isset($usages) && !empty($usages)){
            self::$usages = $usages;
        }
    }
}
?>