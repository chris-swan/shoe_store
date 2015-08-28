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


      }


//code review goals for Store: Create,
//Read(all & singular), Update, DeleteAll, DeleteSingular
//


?>
