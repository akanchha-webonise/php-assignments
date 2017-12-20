<?php
	require "carts.php";
	use PHPUnit\Framework\TestCase;

		/**
		*@backupGlobals disabled
		* @backupStaticAttributes disabled
		* @author Akanchha
     	* @requires PHP 5
		*/
	class testCarts extends TestCase
	{
		private $cart;
		/**
		* @before
		*/
		public function setUp(){
				$this->cart=new carts();
		}
		/**
		* @covers carts::AddToCart
		* @dataProvider cartDetailsProvider
		*/
		public function testAddToCart($cartDetails){
			$this->assertNotEmpty($cartDetails);
			$this->assertInternalType('integer',$cartDetails['cartId']);
			$this->assertInternalType('integer',$cartDetails['productId']);
			$this->assertTrue(method_exists($this->cart,'AddToCart'),'Function does not exists');
			$this->assertNull($this->cart->AddToCart($cartDetails['cartId'],$cartDetails['productId']));
		}
		/**
		* @covers carts::displayCart
		*/
		public function testDisplayCart(){
			$this->assertNull($this->cart->displayCart());
		}
		/**
		* @covers carts::deleteCart
		* @dataProvider cartDeleteDetailsProvider
		*/
		public function testDeleteCart($deleteId){
			$this->assertNull($this->cart->deleteCart($deleteId));
		}
		public function cartDetailsProvider(){
			return array(array(array('cartId'=>1,'productId'=>2)));
		}
		public function cartDeleteDetailsProvider(){
			return [
			[2]
			];
		}


	}

?>