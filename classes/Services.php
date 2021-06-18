<?php

class Service {


    public $avaliblity = true;
    public $taxRate = 0;
    
    public function __construct($taxRate = null)
    {
        $this->taxRate = $taxRate;
    }
    
    public function getPrices($price){

        if($this->taxRate > 0 || $this->taxRate < 0){
            return $price + ($price * $this->taxRate);
        }
        return $price;
    }
    
}