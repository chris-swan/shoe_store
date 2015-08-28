<?php
    Class Store{

      private $id;
      private $store_name;

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

      function updatestoreName($new_store_name)
      {
          $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_store_name}' WHERE id = {$this->getId()};");
          $this->store_name = $new_store_name;
      }

      //get and add brands
      // function addBrand($brand)
      // {
      //     $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) Values ({$this->getId()}, {$book->getId()});");
      // }

    }

//code review goals for Store: Create,
//Read(all & singular), Update, DeleteAll, DeleteSingular
//


?>
