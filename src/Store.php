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

      function delete()
      {
          $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getID()};");
      }

    }


//code review goals for Store: Create,
//Read(all & singular), Update, DeleteAll, DeleteSingular
//


?>
