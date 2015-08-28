<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
      // protected function tearDown()
      // {
      //      Store::deleteAll();
      //      Brand::deleteAll();
      // }
      //

        function test_getbrandName()
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

    }


?>
