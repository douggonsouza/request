<?php

namespace douggonsouza\request;

use douggonsouza\request\usagesInterface;
use douggonsouza\regexed\regexed;
use douggonsouza\regexed\dicionaryInterface;

/**
 * usages
 * 
 * Forneçe sequencia e funções de tratamento da string de requisição e levantamento dos parâmetros.
 * @version 1.0.0
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
    private $header;
    
    /**
     * __construct: Evento construtor da classe
     *
     * @param dicionaryInterface $dicionary
     * @param array              $routes
     * @return void
     */
    public function __construct(dicionaryInterface $dicionary, array $routes = null)
    {
        $this->setRoutes($routes);
        $this->setRegexed($dicionary);
    }

    /**
     * parameters: Executa a sequencia básica
     *
     * 
     * @return self
     */
    public function parameters()
    {
        $this->protocol()->host()->dir()->queryString()->request()->header();
        $this->route();

        return $this;
    }

    /**
     * request: Colhe a request
     *
     * @return self 
     */
    protected function request()
    {
        if(isset($_SERVER['REQUEST_URI'])){
            $this->setRequest(str_replace('?'.$this->getQueryString(),'',$_SERVER['REQUEST_URI']));
        }
        
        return $this;
    }

    /**
     * protocol: Colhe o protocolo
     *
     * @return self
     */
    protected function protocol()
    {
        if(isset($_SERVER['SERVER_PROTOCOL'])){
            $this->setProtocol($_SERVER['SERVER_PROTOCOL']);
        }

        return $this;
    }

    /**
     * host: Colhe o host
     *
     * @return self
     */
    protected function host()
    {
        if(!isset($_SERVER['HTTP_HOST'])){
            throw new \Exception("Não encontrado o Host.");
        }

        $this->setHost($_SERVER['HTTP_HOST']);
        return $this;
    }

    /**
     * dir: Colhe o diretório
     *
     * @return self
     * 
     */
    protected function dir()
    {
        if(!isset($_SERVER['DOCUMENT_ROOT'])){
            throw new \Exception("Não encontrado o diratório.");
        }
        
        $this->setDir($_SERVER['DOCUMENT_ROOT']);
        return $this;
    }

    /**
     * queryString: Colhe a queryString
     * 
     * @return self
     */
    protected function queryString()
    {
        if(isset($_SERVER['QUERY_STRING'])){
            $this->setQueryString($_SERVER['QUERY_STRING']);
        }

        return $this;
    }

    /**
     * route: Colhe a rota
     *      
     * @return self
     */
    protected function route()
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
     * header
     *
     * @return self
     */
    protected function header()
    {
        $this->setHeader(getallheaders());

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
     * getRequest: Get the value of request
     * 
     * @return string
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
    protected function setRequest(string $request)
    {
        if(isset($request) && !empty($request)){
            $this->request = $request;
        }

        return $this;
    }

    /**
     * getRoutes: Get the value of routes
     * 
     * @return array
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
    protected function setRoutes(array $routes)
    {
        if(isset($routes) && !empty($routes)){
            $this->routes = $routes;
        }

        return $this;
    }

    /**
     * getHost: Get the value of host
     * 
     * @return string
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
    protected function setHost($host)
    {
        if(isset($host) && !empty($host)){
            $this->host = $host;
        }

        return $this;
    }

    /**
     * getDir: Get the value of dir
     * 
     * @return string
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
    protected function setDir($dir)
    {
        if(isset($dir) && !empty($dir)){
            $this->dir = $dir;
        }

        return $this;
    }

    /**
     * getProtocol: Get the value of protocol
     * 
     * @return string
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
    protected function setProtocol($protocol)
    {
        if(isset($protocol) && !empty($protocol)){
            $this->protocol = $protocol;
        }
        return $this;
    }

    /**
     * getQueryString: Get the value of queryString
     * 
     * @return string
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
    protected function setQueryString($queryString)
    {
        if(isset($queryString) && !empty($queryString)){
            $this->queryString = $queryString;
        }

        return $this;
    }

    /**
     * getRoute: Get the value of route
     * 
     * @return string
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
    protected function setRoute($route)
    {
        if(isset($route) && !empty($route)){
            $this->route = $route;
        }

        return $this;
    }

    /**
     * getRegexed: Get the value of regexed
     * 
     * @return mixed
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
    protected function setRegexed($dicionary)
    {
        if(isset($dicionary) && !empty($dicionary)){
            $this->regexed = new regexed($dicionary);
        }

        return $this;
    }

    /**
     * getHeader: Get the value of header
     * 
     * @return array
     */ 
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set the value of header
     *
     * @return  self
     */ 
    protected function setHeader($header)
    {
        if(isset($header) && !empty($header)){
            $this->header = $header;
        }

        return $this;
    }
}
