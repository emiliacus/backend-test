<?php

namespace Runroom\GildedRose;

class GildedRose {
    /**
    * Array of Item objects var
    *
    * @var Item[]
    */
    private $items;

    /**
    * String const var
    *
    * @var string
    */
    const AGED = 'Aged Brie';

    /**
    * String const var
    *
    * @var string
    */
    const BACKSTAGE = 'Backstage passes to a TAFKAL80ETC concert';

    /**
    * String const var
    *
    * @var string
    */
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';


    /**
    * GildeRose constructor
    *
    * @param Item[] $items
    */
    function __construct( $items ) {
        $this->items = $items;
    }

    /**
    * Function to update quality parameter of Item objects.
    *
    * @return void
    */
    function update_quality() {
        /* @var $items Item[] */
        foreach ( $this->items as $item ) {

            switch ($item->name){
                case self::AGED:
                    if ( $item->quality < 50 ){
                        $item->quality = $item->quality + 1;
                    }
                    $item->sell_in = $item->sell_in - 1;
                    if ( $item->sell_in < 0 ) {
                        if ( $item->quality < 50 ) {
                            $item->quality = $item->quality + 1;
                        }                        
                    }
                    break;
                case self::BACKSTAGE:
                    if ( $item->quality < 50 ){
                        $item->quality = $item->quality + 1;
                        if ( $item->sell_in < 11 ) {
                            $item->quality = $item->quality + 1;
                        }
                        if ( $item->sell_in < 6 ) {
                            $item->quality = $item->quality + 1;
                        }
                        $item->sell_in = $item->sell_in - 1;
                        if ( $item->sell_in < 0 ) {
                            $item->quality = $item->quality - $item->quality;                            
                        }                    
                    }
                    break;
                case self::SULFURAS:
                    break;

                default:
                    if ( $item->quality > 0 ) {
                        $item->quality = $item->quality - 1;
                    }                
                    $item->sell_in = $item->sell_in - 1;
                    if ( $item->sell_in < 0 ) {
                        if ( $item->quality > 0 ) {
                                $item->quality = $item->quality - 1;
                        }
                    }
            }
        }
    }
}
