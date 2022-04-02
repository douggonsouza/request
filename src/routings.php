<?php

namespace douggonsouza\request;

use douggonsouza\request\routingsInterface;

abstract class routings implements routingsInterface
{

    public static $routes = array();

    /**
     * Adiciona ao array de routes
     *
     * @param string $identification
     * @param string $routing
     * 
     * @return void
     */
    public static function add(string $identification, string $routing)
    {
        self::setRoutes($identification, $routing);
    }

    /**
     * Exporta o array de routes
     *
     * @return array
     * 
     */
    public static function get()
    {
        return self::$routes;
    }

    /**
     * Set the value of routes
     *
     * @return  void
     */ 
    protected static function setRoutes(string $identification, string $routing)
    {
        if(!isset($identification) || empty($identification)){
            throw new \Exception("Não existe identificador.");
        }

        if(!isset($routing) || empty($routing)){
            throw new \Exception("Não existe caminho do roteamento.");
        }

        self::$routes[$identification] = $routing;
    }
}
?>