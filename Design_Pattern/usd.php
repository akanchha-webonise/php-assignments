<?php
require_once "currency.php";
class USD implements Currencies{
		private $price;  
		const USDPrice=64.50;   
	    public function __construct($price){
	        $this->price = $price;
	    }     
	    public function findPrice(){
	       return round($this->price/(self::USDPrice),2) . "</b>";

		}
	}
?>