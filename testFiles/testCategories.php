<?php
	require "categories.php";
	use PHPUnit\Framework\TestCase;
		/**
		*@backupGlobals disabled
		* @backupStaticAttributes disabled
		* @author Akanchha
     	* @requires PHP 5
     	*/
	class testCategories extends TestCase{
		private $category;
		/**
		* @before
		*/
		public function setUp(){
			$this->category=new categories();
		}
		/**
		* @covers categories::Addcategory
		* @dataProvider categoryDetailsProvider
		*/
		public function testAddCategory($categoryDetails){
	  		$this->assertNotEmpty($categoryDetails);
			$this->assertInternalType('integer',$categoryDetails['postId']);
			$this->assertInternalType('string',$categoryDetails['postName']);
			$this->assertInternalType('string',$categoryDetails['postDescription']);
			$this->assertInternalType('integer',$categoryDetails['tax']);
			$this->assertTrue(method_exists($this->category,'AddCategory'),'Function does not exists');
			$this->assertNull($this->category->AddCategory($categoryDetails['postId'],$categoryDetails['postName'],$categoryDetails['postDescription'],$categoryDetails['tax']));
		}
		/**
		* @covers categories::displayCategory
		*/
		public function testDisplayCategory(){
			$this->assertNull($this->category->displayCategory());
		}
		/**
		* @covers categories::updateCategory
		* @dataProvider categoryUpdateDetailsProvider
		*/
		public function testUpdateCategory($categoryDetails){
			$this->assertNotEmpty($categoryDetails);
			$this->assertInternalType('integer',$categoryDetails['putTax']);
			$this->assertInternalType('integer',$categoryDetails['putId']);
			$this->assertNull($this->category->updateCategory($categoryDetails['putTax'],$categoryDetails['putId']));
		}
		/**
		* @covers categories::deleteCategory
		* @dataProvider categoryDeleteDetailsProvider
		*/
		public function testDeleteCategory($deleteId){
			$this->assertNull($this->category->deleteCategory($deleteId));
		}
		public function categoryDetailsProvider(){
			return array(array(array('postId'=>4,'postName'=>'Watch','postDescription'=>'Sonata','tax'=>10)));
		}
		public function categoryDeleteDetailsProvider(){
			return [
			[2]
			];
		}
		public function categoryUpdateDetailsProvider(){
			return array(array(array('putTax'=>4,'putId'=>1)));
		}
	}

?>