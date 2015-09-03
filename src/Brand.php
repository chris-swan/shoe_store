<?php

    Class Brand
    {
        private $brand_name;
        private $id;

        //Construct function:
        function __construct($brand_name, $id = NULL)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        //set functions:
        function setBrandName($new_brand_name)
        {
            $this->brand_name = (string) $new_brand_name;
        }

        //Get functions:
        function getBrandName()
        {
            return $this->brand_name;
        }

        function getId()
        {
            return $this->id;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getID()};");
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS ['DB']->lastInsertId();
        }

        function updateBrandName($new_brand_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_brand_name}' WHERE id = {$this->getId()};");
            $this->brand_name = $new_brand_name;
        }

        //Static functions:
        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach ($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands");
        }

        static function find($search_id)
        {
            $found_brand = NULL;
            $brands = Brand::getAll();
            foreach ($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        //Add and get brand_name(s)
        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
        }

        //Working with join statement
        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN brands_stores ON (brands.id = brands_stores.brand_id)
                JOIN stores ON (stores.id = brands_stores.store_id)
                WHERE brands.id = {$this->getId()};");

            //$returned_stores = $query->fetchAll(PDO::FETCH_ASSOC);

            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
           return $stores;
       }

     }

?>
