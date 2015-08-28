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

    class StoreTest extends PHPUnit_Framework_TestCase
    {
      protected function tearDown()
      {
          Store::deleteAll();
          Brand::deleteAll();
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

        function test_getAll()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $test_store = new store($store_name);
            $test_store->save();
            $store_name2 = "ShoeStore Two";
            $test_store2 = new store($store_name2);
            $test_store2->save();

            //Act
            $result = store::getAll();

            //Assert
            $this->assertEquals($test_store, $result[0]);
        }

        function test_deleteAll()
        {
            //Arrange
            $store_name = "ShoeStore One";
            $test_store = new store($store_name);
            $test_store->save();
            $store_name2 = "ShoeStore Two";
            $test_store2 = new store($store_name2);
            $test_store2->save();

            //Act
            store::deleteAll();
            $result = store::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            $store_name = "ShoeStore One";
            $test_store = new store($store_name);
            $test_store->save();
            $store_name2 = "ShoeStore Two";
            $test_store2 = new store($store_name2);
            $test_store2->save();

            //Act
            $result = store::find($test_store->getId());

            //Assert
            $this->assertEquals($test_store, $result);
        }

        function test_updatestoreName()
        {
            $store_name = "ShoeStore One";
            $test_store = new store($store_name);
            $test_store->save();

            $store_name2 = "ShoeStore Two";
            $test_store->updatestoreName($store_name2);

            //Act
            $id = $test_store->getId();
            $result = new store($store_name2, $id);

            //Assert
            $this->assertEquals(store::find($id), $result);
        }

        // function test_addBrand()
        // {
        //     //Arrange
        //     $store_name = "ShoeStore One";
        //     $test_store = new store($store_name);
        //     $test_store->save();
        //
        //     $brand_name = "ShoeBrand One";
        //     $test_brand = new Brand($brand_name);
        //     $test_brand->save();
        //
        //     //Act
        //     $result = [$test_brand];
        //     $test_store->addBrand($test_brand);
        //
        //     //Assert
        //     $this->assertEquals($test_store->getBrands(), $result);
        // }


    }
?>
