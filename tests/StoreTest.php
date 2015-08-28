<?php


    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    //require_once "src/Book.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ShoeTest extends PHPUnit_Framework_TestCase
    {
    //   protected function tearDown()
    //   {
    //       Store::deleteAll();
    //       Brand::deleteAll();
    //   }

        function test_getStoreName()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $test_store = new Shoe($store_name);

            //Act
            $result = $test_store ->getStoreName();

            //Assert
            $this->assertEquals($store_name, $result);
        }
    



    }
?>
