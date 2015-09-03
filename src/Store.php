<?php
    Class Store{

      private $store_name;
      private $id;
      
      //Constructors
      function __construct($store_name, $id = null)
      {
          $this->store_name = $store_name;
          $this->id = $id;
      }

      //Setter
      function setStoreName($new_store_name)
      {
          $this->store_name = (string) $new_store_name;
      }

      //Getters
      function getStoreName()
      {
          return $this->store_name;
      }

      function getId()
      {
          return $this->id;
      }

      //Delete a single store:
      function delete()
      {
          $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getID()};");
      }

      function save()
      {
          $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getStoreName()}');");
          $this->id = $GLOBALS['DB']->lastInsertId();
      }

      //Static Methods:
      static function getAll()
      {
          $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
          $stores = array();
          foreach($returned_stores as $store) {
            $store_name = $store['store_name'];
            $id = $store['id'];
            $new_store = new Store($store_name, $id);
            array_push($stores, $new_store);
          }
          return $stores;
      }

      static function deleteAll()
      {
          $GLOBALS['DB']->exec("DELETE FROM stores;");
      }

    //Find store function:

      static function find($search_id)
      {
          $found_store = NULL;
          $stores = store::getAll();
          foreach ($stores as $store) {
              $store_id = $store->getId();
              if ($store_id == $search_id) {
                  $found_store = $store;
              }
          }
          return $found_store;
      }

      function updateStoreName($new_store_name)
      {
          $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store_name}' WHERE id = {$this->getId()};");
          $this->store_name = $new_store_name;
      }

      //   Add & Get brand functions:
      function addBrand($brand)
      {
          $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$brand->getId()}, {$this->getId()});");
      }

      function getBrands()
      {
          $returned_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores 
                JOIN brands_stores ON (stores.id = brands_stores.store_id)
                JOIN brands ON (brands.id = brands_stores.brand_id)
          WHERE stores.id = {$this->getID()};");

          $brands = array();
          foreach($returned_brands as $brand){
              $brand_name = $brand['brand_name'];
              $id = $brand['id'];
              $new_brand = new Brand($brand_name, $id);
              array_push($brands, $new_brand);
          }
          return $brands;
      }

    }

?>
