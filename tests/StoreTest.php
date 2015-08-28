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

    class StoreTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
      {
          Store::deleteAll();
        //  Brand::deleteAll();
      }

        function test_getStoreName()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $test_store = new Store($store_name);

            //Act
            $result = $test_store ->getStoreName();

            //Assert
            $this->assertEquals($store_name, $result);
        }

        function test_getID()
        {
            //Arrange
            $store_name = "ShoreStore One";
            $id = 1;
            $test_store = new Store($store_name, $id);

            //Act
            $result = $test_store->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $test_store = new Store($store_name);
            $test_store->save();

            //Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_delete()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $test_store = new Store($store_name);
            $test_store->save();
            $store_name2 = "ShoeStore Two";
            $test_store2 = new Store($store_name2);
            $test_store2->save();

            //Act
            $test_store2->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store], $result);
        }


    }
?>
