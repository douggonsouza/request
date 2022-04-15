<?php

namespace douggonsouza\request;

use douggonsouza\regexed\dicionaryInterface;

/**
 * dicionary: Coleção de funções tradutoras regex
 * 
 * @version 1.0.0
 */
class dicionary implements dicionaryInterface
{
    /**
     * Lista traduções regex da classe
     *
     * @return array
     * 
     */
    public function words()
    {
        $list = get_class_methods($this);
        unset($list[array_search('words', $list)]);
        return $list;
    }

    /**
     * Tradução para a palavra _number
     *
     * @param string $text
     * 
     * @return string
     * 
     */
    public function _number(string $text)
    {
        if(!isset($text) || empty($text)){
            return '';
        }

        return str_replace('_number','(\d+)', $text);
    }

    /**
     * Tradução para a palavra _char
     *
     * @param string $text
     * 
     * @return string
     * 
     */
    public function _char(string $text)
    {
        if(!isset($text) || empty($text)){
            return '';
        }

        return str_replace('_char', '([a-zA-Z]+)', $text);
    }

    /**
     * Tradução para a palavra _alfanumeric
     *
     * @param string $text
     * 
     * @return string
     * 
     */
    public function _alfanumeric(string $text)
    {
        if(!isset($text) || empty($text)){
            return '';
        }

        return str_replace('_alfanumeric', '([a-zA-Z0-9]+)', $text);
    }

    /**
     * Tradução para a palavra _string
     *
     * @param string $text
     * 
     * @return string
     * 
     */
    public function _string(string $text)
    {
        if(!isset($text) || empty($text)){
            return '';
        }

        return str_replace( '_string', '([a-zA-Z0-9 .\-\_]+)', $text);
    }
}

?>