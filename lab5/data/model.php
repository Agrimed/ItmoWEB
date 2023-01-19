<?php
    class Flower {
        public $id;
        public $name;
        public $price;
        public $desc;

        function __construct($id = 0, $name = "", $price = "", $desc = "") {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->desc = $desc;
        }
    }
?>