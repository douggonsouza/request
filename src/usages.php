<?php

namespace douggonsouza\request;

use douggonsouza\request\usagesInterface;
use douggonsouza\regexed\regexed;
use douggonsouza\regexed\dicionaryInterface;
use douggonsouza\request\routings;

/**
 * usages
 * 
 * Forneçe sequencia e funções de tratamento da string de requisição e levantamento dos parâmetros.
 * @version 1.0.0
 */
class usages implements usagesInterface
{
    const ROUTE_DEFAULT = 'default';

    private $request;
    private $paramsRequest;
    private $protocol;
    private $host;
    private $dir;
    private $queryString;
    private $route;
    private $routes;
    private $regexed;
    private $header;
    private $requestMethod;
    
    /**
     * __construct: Evento construtor da classe
     *
     * @param dicionaryInterface $dicionary
     * @param array              $routes
     * @return void
     */
    public function __construct(dicionaryInterface $dicionary)
    {
        $this->setRegexed($dicionary);
    }

    /**
     * Executa a sequencia básica
     * 
     * @return self
     */
    public function parameters()
    {
        $this->protocol();
        $this->host();
        $this->dir();
        $this->queryString();
        $this->request();
        $this->paramsRequest();
        $this->header();
        $this->requestMethod();
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
     * paramsRequest - Quebra a request em parâmetros
     *
     * @param string $request [explicite description]
     *
     * @return void
     */
    protected function paramsRequest()
    {
        if(isset($_SERVER['REQUEST_URI'])){
            $request = explode('?', $_SERVER['REQUEST_URI']);

            // parâmetros
            $params = array();
            foreach(explode('/', $request[0]) as $item){
                if(isset($item) && !empty($item)){
                    $params[] = $item;
                }
            }
            $request[0] = $params;

            $this->setParamsRequest($request);
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
            throw new \Exception("Não encontrado o Host ou o Scheme.");
        }

        $host = $_SERVER['HTTP_HOST'];
        if(isset($_SERVER['REQUEST_SCHEME'])){
            $host = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        }

        $this->setHost($host);
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
        $this->setRoute(routings::get()[self::ROUTE_DEFAULT]);

        foreach(routings::get() as $index => $value){
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
     * requestMethod
     * 
     * @return self
     */
    protected function requestMethod()
    {
        $this->setRequestMethod($_SERVER['REQUEST_METHOD']);

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
    protected function setRoutes(array $routes = null)
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

    /**
     * Get the value of requestMethod
     */ 
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * Set the value of requestMethod
     *
     * @return  self
     */ 
    public function setRequestMethod($requestMethod)
    {
        if(isset($requestMethod) && !empty($requestMethod)){
            $this->requestMethod = $requestMethod;
        }

        return $this;
    }

    /**
     * Get the value of paramsRequest
     */ 
    public function getParamsRequest()
    {
        return $this->paramsRequest;
    }

    /**
     * Set the value of paramsRequest
     *
     * @return  self
     */ 
    public function setParamsRequest($paramsRequest)
    {
        if(isset($paramsRequest) && !empty($paramsRequest)){
            $this->paramsRequest = $paramsRequest;
        }

        return $this;
    }
}
