<?php
	require "currency.php";
	interface Observer{
		public function addCurrency(Currencies $currency);
	}
	class convertPrice implements Observer{
		private $currencies;
		public function __construct(){
			$this->currencies=array();
		}
		public function addCurrency(Currencies $currency){
			array_push($this->currencies,$currency);
		}
		public function updatePrice(){
			foreach ($this->currencies as $currency) {
				$arr[]=$currency->findPrice();
			}
			return $arr;
		}
	}
	?>