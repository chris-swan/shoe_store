<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:3306;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
      {
           Store::deleteAll();
           Brand::deleteAll();
      }


        function test_getBrandName()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $test_brand = new Brand($brand_name);

            //Act
            $result = $test_brand->getbrandName();

            //Assert
            $this->assertEquals($brand_name, $result);
        }

        function test_getId()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $id = 1;
            $test_brand = new brand($brand_name, $id);

            //Act
            $result = $test_brand->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $test_brand = new brand($brand_name);
            $test_brand->save();
            //Act
            $result = brand::getAll();
            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_delete()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $test_brand = new brand($brand_name);
            $test_brand->save();

            $brand_name2 = "ShoeBrand Two";
            $test_brand2 = new brand($brand_name2);
            $test_brand2->save();

            //Act
            $test_brand2->delete();
            $result = Brand::getall();

            //Assert
            $this->assertEquals([$test_brand], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $test_brand = new brand($brand_name);
            $test_brand->save();

            $brand_name2 = "ShoeBrand Two";
            $test_brand2 = new brand($brand_name2);
            $test_brand2->save();

            //Act
            brand::deleteAll();
            $result = brand::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $test_brand = new brand($brand_name);
            $test_brand->save();

            $brand_name2 = "ShoeBrand Two";
            $test_brand2 = new brand($brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals($test_brand, $result[0]);
        }

        function test_find()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $test_brand = new brand($brand_name);
            $test_brand->save();

            $brand_name2 = "ShoeBrand Two";
            $test_brand2 = new brand($brand_name2);
            $test_brand2->save();

            //Act
            $result = Brand::find($test_brand->getId());

            //Assert
            $this->assertEquals($test_brand, $result);
        }

        function test_updateBrandName()
        {
            //Arrange
            $brand_name = "ShoeBrand One";
            $test_brand = new Brand($brand_name);
            $test_brand->save();

            $brand_name2 = "ShoeBrand Two";
            $test_brand->updatebrandName($brand_name2);

            //Act
            $id = $test_brand->getId();
            $result = new Brand($brand_name2, $id);

            //Assert
            $this->assertEquals(Brand::find($id), $result);
        }

         //Test adding one store:
        function test_addStore()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $id = 1;
            $test_store = new Store($store_name);
            $test_store->save();

            $brand_name = "ShoeBrand One";
            $test_brand = new brand($brand_name);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store);

            //Assert
            $this->assertEquals($test_brand->getStores(), [$test_store]);
        }

        //Test ability to get stores
        function testGetStores()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $id = 1;
            $test_store = new Store($store_name, $id);
            $test_store->save();
        
            $brand_name = "ShoeBrand One";
            $id2 = 2;
            $test_brand = new Brand($brand_name, $id2);
            $test_brand->save();
        
            //Act
            $test_brand->addStore($test_store);
            $result = $test_brand->getStores();
        
            //Assert
            $this->assertEquals($result, [$test_store]);
        }
    }

?>
