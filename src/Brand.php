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


    }
?>
