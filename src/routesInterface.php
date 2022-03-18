<?php

namespace douggonsouza\request;

interface routesInterface
{
    /**
     * Adiciona ao array de routes
     *
     * @param string $identification
     * @param string $routing
     * 
     * @return void
     */
    public static function add(string $identification, string $routing);

    /**
     * Exporta o array de routes
     *
     * @return array
     * 
     */
    public static function get();
}
?>