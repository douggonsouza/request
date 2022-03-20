<?php

namespace douggonsouza\regexed;

use douggonsouza\regexed\dicionaryInterface;
use douggonsouza\regexed\dicionary;

abstract class regexed implements dicionaryInterface
{
    protected $dicionary;

    /**
     * Evento construtor da classe
     *
     * @param dicionaryInterface $words
     * 
     */
    public function __construct(dicionaryInterface $words = null)
    {
        $this->setDicionary($words);
    }

    /**
     * Lista array com a etiquetas da classe
     *
     * @return array
     * 
     */
    public function words()
    {
        if(isset($this->dicionary)){
            return $this->dicionary->words();
        }

        return array();
    }

    /**
     * Get the value of dicionary
     */ 
    public function getDicionary()
    {
        return $this->dicionary;
    }

    /**
     * Set the value of dicionary
     *
     * @return  self
     */ 
    public function setDicionary($words)
    {
        if(isset($words) && !empty($words)){
            $this->dicionary = $words;
            return $this;
        }

        $this->dicionary = new dicionary();
        return $this;
    }
}