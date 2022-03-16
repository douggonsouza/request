<?php

namespace douggonsouza\request;

/**
 * HANDILING
 * 
 * Forneçe sequencia e funções de tratamento da string de requisição e levantamento dos parâmetros.
 */
interface variablesInterface
{
    /**
     * Executa a sequencia básica
     *
     * @param array $folders
     * 
     * @return self
     */
    public function basicSequence(array $folders);

    /**
     * Colhe o host
     *
     * @return self
     */
    public function host();

    /**
     * Colhe a request
     *
     * @return self 
     */
    public function request()

    /**
     * Colhe o diretório
     *
     * @return self
     */
    public function dir();

    /**
     * Colhe a queryString
     *
     * @param string $request
     * 
     * @return self
     */
    public function querystring();

    /**
     * Colhe o folder
     *
     * @param string $request
     * 
     * @return self
     */
    public function folder();
}
?>