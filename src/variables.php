<?php

namespace douggonsouza\request;

use douggonsouza\request\variablesInterface;

/**
 * HANDILING
 * 
 * Forneçe sequencia e funções de tratamento da string de requisição e levantamento dos parâmetros.
 */
class variables implements variablesInterface
{
    private $request;
    private $host;
    private $dir;
    private $queryString;
    private $folder;
    private $folders;

    /**
     * Executa a sequencia básica
     *
     * @param array $folders
     * 
     * @return self
     */
    public function basicSequence(array $folders)
    {
        $this->setFolders($folders);
        $this->host()->dir()->querystring();
        $this->request();

        return $this;
    }

    /**
     * Colhe a request
     *
     * @return self 
     */
    public function request()
    {
        return $this;
    }

    /**
     * Colhe o host
     *
     * @return [type]
     */
    public function host()
    {

        return $this;
    }

    /**
     * Colhe o diretório
     *
     * @return [type]
     * 
     */
    public function dir()
    {

        return $this;
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

        return $this;
    }

    /**
     * Colhe o folder
     *
     * @param string $request
     * 
     * @return [type]
     */
    public function folder()
    {

        return $this;
    }

    /**
     * Get the value of request
     */ 
    public function getRequest()
    {
        return $this;
    }

    /**
     * Set the value of request
     *
     * @return  self
     */ 
    public function setRequest(string $request)
    {
        if(isset($request) && !empty($request)){
            $this->request = $request;
        }

        return $this;
    }

    /**
     * Get the value of folders
     */ 
    public function getFolders()
    {
        return $this->folders;
    }

    /**
     * Set the value of folders
     *
     * @return  self
     */ 
    public function setFolders(array $folders)
    {
        if(isset($folders) && !empty($folders)){
            $this->folders = $folders;
        }

        return $this;
    }
}
