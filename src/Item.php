<?php

namespace Runroom\GildedRose;

class Item {
    /**
    * string name var
    *
    * @var string
    */
    public $name;

    /**
    * int sell_in var
    *
    * @var int
    */
    public $sell_in;

    /**
    * int quality var
    *
    * @var int
    */
    public $quality;

    /**
    * Item constructor
    *
    * @param string $name
    * @param int $sell_in
    * @param int $quality
    */
    function __construct( $name, $sell_in, $quality ) {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    /**
    * Function to convert Item to string
    *
    * @return string
    */
    public function __toString() {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

}
