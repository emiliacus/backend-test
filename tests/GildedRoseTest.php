<?php

namespace Runroom\GildedRose\Tests;

use PHPUnit\Framework\TestCase;
use Runroom\GildedRose\GildedRose;
use Runroom\GildedRose\Item;

class GildedRoseTest extends TestCase {
   /**
   * @test
   * Function to test degrade quality in Item object with no name.
   *
   * @return void
   * 
   */
   public function itemsDegradeQuality() {
      $items = [new Item( '', 1, 5 )];

      $gilded_rose = new GildedRose( $items );
      $gilded_rose->update_quality();

      $this->assertEquals( 4, $items[0]->quality );
   }

   /**
   * @test 
   * Function to test degrade double quality when sellin date has pass in Item object with no name.
   *
   * @return void
   */
   public function itemsDegradeDoubleQualityOnceTheSellInDateHasPass() {
      $items = [new Item( '', -1, 5 )];

      $gilded_rose = new GildedRose( $items );
      $gilded_rose->update_quality();

      $this->assertEquals( 3, $items[0]->quality );
   }

   /**
   * @test
   * Function to test negative quality in Item object with no name.
   *
   * @return void
   */
   public function itemsCannotHaveNegativeQuality() {
      $items = [new Item( '', 0, 0 )];

      $gilded_rose = new GildedRose( $items );
      $gilded_rose->update_quality();

      $this->assertEquals( 0, $items[0]->quality );
   }

   /**
   * @test
   * Function to test increase quality over time in Item object called Aged Brie.
   *
   * @return void
   */
   public function agedBrieIncreasesQualityOverTime() {
      $items = [new Item( 'Aged Brie', 0, 5 )];

      $gilded_rose = new GildedRose( $items );
      $gilded_rose->update_quality();

      $this->assertEquals( 7, $items[0]->quality );
   }

   /**
   * @test
   * Function to test quality > 50 in Item object called Aged Brie.
   *
   * @return void
   */
   public function qualityCannotBeGreaterThan50() {
      $items = [new Item( 'Aged Brie', 0, 50 )];

      $gilded_rose = new GildedRose( $items );
      $gilded_rose->update_quality();

      $this->assertEquals( 50, $items[0]->quality );
   }

   /**
   * @test
   * Function to test changes in Item object called Sulfuras, Hand of Ragnaros.
   *
   * @return void
   */
   public function sulfurasDoesNotChange() {
      $items = [new Item( 'Sulfuras, Hand of Ragnaros', 10, 10 )];

      $gilded_rose = new GildedRose( $items );
      $gilded_rose->update_quality();

      $this->assertEquals( 10, $items[0]->sell_in );
      $this->assertEquals( 10, $items[0]->quality );
   }

   /**
   * @test
   * @doesNotPerformAssertions
   * Function to test backstage rules based on sellIn values
   *
   * @return array<string, array<int, int>>
   */
   public static function backstageRules() {
      return [
         'incr. 1 if sellIn > 10' => [11, 10, 11],
         'incr. 2 if 5 < sellIn <= 10 (max)' => [10, 10, 12],
         'incr. 2 if 5 < sellIn <= 10 (min)' => [6, 10, 12],
         'incr. 3 if 0 < sellIn <= 5 (max)' => [5, 10, 13],
         'incr. 3 if 0 < sellIn <= 5 (min)' => [1, 10, 13],
         'puts to 0 if sellIn <= 0 (max)' => [0, 10, 0],
         'puts to 0 if sellIn <= 0 (...)' => [-1, 10, 0],
      ];
   }

   /**
   * @test
   * Function to test backstage quality increase over time in Item object called Backstage passes to a TAFKAL80ETC concert.
   *
   * @param int $sellIn
   * @param int $quality
   * @param int $expected
   *
   * @return void
   */
   public function backstageQualityIncreaseOverTimeWithCertainRules( $sellIn = 0, $quality = 0, $expected = 0 ) {

      $items = [new Item( 'Backstage passes to a TAFKAL80ETC concert', $sellIn, $quality )];

      $gilded_rose = new GildedRose( $items );
      $gilded_rose->update_quality();

      $this->assertEquals( $expected, $items[0]->quality );
   }
}
