<?php
	require "products.php";
	use PHPUnit\Framework\TestCase;
		/**
		*@backupGlobals disabled
		* @backupStaticAttributes disabled
		* @author Akanchha
     	* @requires PHP 5
		*/
	class testProducts extends TestCase{
		private $product;
		public function setUp(){
			$this->product=new products();
		}
		/**
		* @covers products::AddProduct
		* @dataProvider productDetailsProvider
		*/
		public function testAddProduct($productDetails){
	  		$this->assertNotEmpty($productDetails);
			$this->assertInternalType('integer',$productDetails['postId']);
			$this->assertInternalType('string',$productDetails['postName']);
			$this->assertInternalType('string',$productDetails['postDescription']);
			$this->assertInternalType('integer',$productDetails['postPrice']);
			$this->assertInternalType('integer',$productDetails['postDiscount']);
			$this->assertInternalType('integer',$productDetails['postCategoryId']);
			$this->assertTrue(method_exists($this->product,'AddProduct'),'Function does not exists');
			$this->assertNull($this->product->AddProduct($productDetails['postId'],$productDetails['postName'],$productDetails['postDescription'],$productDetails['postPrice'],$productDetails['postDiscount'],$productDetails['postCategoryId']));
		}
		/**
		* @covers products::displayProduct
		*/
		public function testDisplayProduct(){
			$this->assertNull($this->product->displayProduct());
		}
		/**
		* @covers products::updateProduct
		* @dataProvider productUpdateDetailsProvider
		*/
		public function testUpdateProduct($productDetails){
			$this->assertNotEmpty($productDetails);
			$this->assertInternalType('integer',$productDetails['putDiscount']);
			$this->assertInternalType('integer',$productDetails['putId']);
			$this->assertNull($this->product->updateProduct($productDetails['putDiscount'],$productDetails['putId']));
		}
		/**
		* @covers products::deleteProduct
		* @dataProvider productDeleteDetailsProvider
		*/
		public function testDeleteProduct($deleteId){
			$this->assertNull($this->product->deleteProduct($deleteId));
		}
		public function productDetailsProvider(){
			return array(array(array('postId'=>5,'postName'=>'Watch','postDescription'=>'Sonata','postPrice'=>150,'postDiscount'=>10,'postCategoryId'=>1)));
		}
		public function productDeleteDetailsProvider(){
			return [
			[2]
			];
		}
		public function productUpdateDetailsProvider(){
			return array(array(array('putDiscount'=>4,'putId'=>1)));
		}
	}

?>