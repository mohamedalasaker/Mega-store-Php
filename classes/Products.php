<?php 

class Product extends Service {
    public function __construct($taxRate = null)
    {
        $this->taxRate = $taxRate;
    }
    
}