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
            if ( $item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert' ) {
                if ( $item->quality > 0 ) {
                    if ( $item->name != 'Sulfuras, Hand of Ragnaros' ) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ( $item->quality < 50 ) {
                    $item->quality = $item->quality + 1;
                    if ( $item->name == 'Backstage passes to a TAFKAL80ETC concert' ) {
                        if ( $item->sell_in < 11 ) {
                            if ( $item->quality < 50 ) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ( $item->sell_in < 6 ) {
                            if ( $item->quality < 50 ) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ( $item->name != 'Sulfuras, Hand of Ragnaros' ) {
                $item->sell_in = $item->sell_in - 1;
            }

            if ( $item->sell_in < 0 ) {
                if ( $item->name != 'Aged Brie' ) {
                    if ( $item->name != 'Backstage passes to a TAFKAL80ETC concert' ) {
                        if ( $item->quality > 0 ) {
                            if ( $item->name != 'Sulfuras, Hand of Ragnaros' ) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ( $item->quality < 50 ) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }
        }
    }
}
