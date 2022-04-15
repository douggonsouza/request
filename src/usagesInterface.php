<?php

namespace douggonsouza\request;

/**
 * HANDILING
 * 
 * Forneçe sequencia e funções de tratamento da string de requisição e levantamento dos parâmetros.
 */
interface usagesInterface
{
    /**
     * Executa a sequencia básica
     *
     * @param array $routes
     * 
     * @return self
     */
    public function parameters();
}
?>