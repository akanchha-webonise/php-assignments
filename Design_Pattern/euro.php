<?php
	require_once "currency.php";
	class Euro implements Currencies{
		private $price;
		const euroPrice=78.89;
		public function __construct($price){
	        	$this->price = $price;
	    	}     
	    public function findPrice(){
	       		//echo "<br><b>Price In Euro : " . round($this->price/(self::euroPrice),2) . "</b>";
	       		return round($this->price/(self::euroPrice),2);
		}
	}

?>