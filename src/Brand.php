<?php

    Class Brand
    {
        private $id;
        private $brand_name;

        //Construct function:
        function __construct($brand_name, $id = NULL)
        {
            $this->brand_name = $brand_name;
            $this->id = $id;
        }

        //set functions:
        function setBrandName($new_brand_name)
        {
            $this->brand_name = $new_brand_name;
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

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS ['DB']->lastInsertId();
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

    }
?>
