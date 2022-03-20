<?php

namespace douggonsouza\request;

use douggonsouza\request\usagesInterface;
use douggonsouza\regexed\regexed;
use douggonsouza\regexed\dicionaryInterface;

/**
 * HANDILING
 * 
 * Forneçe sequencia e funções de tratamento da string de requisição e levantamento dos parâmetros.
 */
class usages implements usagesInterface
{
    private $request;
    private $protocol;
    private $host;
    private $dir;
    private $queryString;
    private $route;
    private $routes;
    private $regexed;

    public function __construct(dicionaryInterface $dicionary)
    {
        $this->setRegexed($dicionary);
    }

    /**
     * Executa a sequencia básica
     *
     * @param array $routes
     * 
     * @return self
     */
    public function parameters(array $routes)
    {
        $this->setRoutes($routes);
        $this->protocol()->host()->dir()->queryString()->request();
        $this->route();

        return $this;
    }

    /**
     * Colhe a request
     *
     * @return self 
     */
    public function request()
    {
        if(!isset($_SERVER['REQUEST_URI'])){
            throw new \Exception("Não encontrada a requisição.");
        }

        $this->setRequest(str_replace('?'.$this->getQueryString(),'',$_SERVER['REQUEST_URI']));
        return $this;
    }

    /**
     * Colhe o protocolo
     *
     * @return self
     */
    public function protocol()
    {
        if(!isset($_SERVER['SERVER_PROTOCOL'])){
            throw new \Exception("Não encontrado o Protocolo.");
        }

        $this->setProtocol(strtolower(explode('/',$_SERVER['SERVER_PROTOCOL'])[0]));
        return $this;
    }

    /**
     * Colhe o host
     *
     * @return self
     */
    public function host()
    {
        if(!isset($_SERVER['HTTP_HOST'])){
            throw new \Exception("Não encontrado o Host.");
        }

        $this->setHost($_SERVER['HTTP_HOST']);
        return $this;
    }

    /**
     * Colhe o diretório
     *
     * @return self
     * 
     */
    public function dir()
    {
        if(!isset($_SERVER['DOCUMENT_ROOT'])){
            throw new \Exception("Não encontrado o diratório.");
        }
        
        $this->setDir($_SERVER['DOCUMENT_ROOT']);
        return $this;
    }

    /**
     * Colhe a queryString
     * 
     * @return self
     */
    public function queryString()
    {
        $this->setQueryString($_SERVER['QUERY_STRING']);
        return $this;
    }

    /**
     * Colhe a rota
     *      
     * @return self
     */
    public function route()
    {
        if($this->getRoutes() === null){
            throw new \Exception("Não encontrada as rotas.");
        }

        $route = null;

        foreach($this->getRoutes() as $index => $value){
            if($this->getRequest() === '/' && $index === 'default'){
                $this->setRoute($value);
                return $this;
            }

            if (preg_match($this->translate($index), $this->getRequest(), $params)) {
                $this->setRoute($value);
                return $this;
            }
        }

        return $this;
    }

    /**
     * Traduz a string para regex
     *
     * @param string $text
     * @return string
     */
    protected function translate(string $text)
    {
        if($this->getRegexed() === null){
            throw new \Exception("Não encontrada a classe de tradução regexed.");
        }

        if(!isset($text) || empty($text)){
            return '';
        }

        // traduz para regex
        return '/^' . $this->getRegexed()->translate($text) . '/';
    }




    /**
     * Get the value of request
     */ 
    public function getRequest()
    {
        return $this->request;
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
     * Get the value of routes
     */ 
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Set the value of routes
     *
     * @return  self
     */ 
    public function setRoutes(array $routes)
    {
        if(isset($routes) && !empty($routes)){
            $this->routes = $routes;
        }

        return $this;
    }

    /**
     * Get the value of host
     */ 
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set the value of host
     *
     * @return  self
     */ 
    public function setHost($host)
    {
        if(isset($host) && !empty($host)){
            $this->host = $host;
        }

        return $this;
    }

    /**
     * Get the value of dir
     */ 
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * Set the value of dir
     *
     * @return  self
     */ 
    public function setDir($dir)
    {
        if(isset($dir) && !empty($dir)){
            $this->dir = $dir;
        }

        return $this;
    }

    /**
     * Get the value of protocol
     */ 
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * Set the value of protocol
     *
     * @return  self
     */ 
    public function setProtocol($protocol)
    {
        if(isset($protocol) && !empty($protocol)){
            $this->protocol = $protocol;
        }
        return $this;
    }

    /**
     * Get the value of queryString
     */ 
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Set the value of queryString
     *
     * @return  self
     */ 
    public function setQueryString($queryString)
    {
        if(isset($queryString) && !empty($queryString)){
            $this->queryString = $queryString;
        }

        return $this;
    }

    /**
     * Get the value of route
     */ 
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set the value of route
     *
     * @return  self
     */ 
    public function setRoute($route)
    {
        if(isset($route) && !empty($route)){
            $this->route = $route;
        }

        return $this;
    }

    /**
     * Get the value of regexed
     */ 
    public function getRegexed()
    {
        return $this->regexed;
    }

    /**
     * Set the value of regexed
     *
     * @return  self
     */ 
    public function setRegexed($dicionary)
    {
        if(isset($dicionary) && !empty($dicionary)){
            $this->regexed = new regexed($dicionary);
        }

        return $this;
    }
}
