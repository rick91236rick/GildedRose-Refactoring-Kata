<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\{GildedRose, Item};
use PHPUnit\Framework\TestCase;
use GildedRose\{AgedBrieItem, BackstageItem , SulfurasItem , NormalItem};
class GildedRoseTest extends TestCase
{
    public function testFoo(): void
    {
        $items = [new NormalItem('foo', 0, 0)];
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertSame('foo', $items[0]->name);
    }

    /*
     * @test
     */
    public function quality_never_is_negative(): void
    {
        $items = [new NormalItem("foo", 0, 0)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(0, $app->getItems()[0]->quality);
    }

    /** @test */
    public function sulfuras_could_not_be_sold() {
        $items = [new SulfurasItem("Sulfuras, Hand of Ragnaros", 10, 0)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(10, $app->getItems()[0]->sell_in);
    }

    /** @test */
    public function sulfuras_could_not_decrease_quality() {
        $items = [new SulfurasItem("Sulfuras, Hand of Ragnaros", 10, 10)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(10, $app->getItems()[0]->quality);
    }

    /** @test */
    public function quality_could_not_be_more_than_fifty() {
        $items = [new AgedBrieItem("Aged Brie", 10, 50)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(50, $app->getItems()[0]->quality);
    }

    /** @test */
    public function item_with_date_passed_quality_decrease_by_twice() {
        $items = [new NormalItem("foo", -1, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(38, $app->getItems()[0]->quality);
    }

    /** @test */
    public function aged_brie_increase_quality_when_it_gets_older() {
        $items = [new AgedBrieItem("Aged Brie", 1, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(41, $app->getItems()[0]->quality);
    }

    /** @test */
    public function aged_brie_increase_by_two_quality_when_date_passed() {
        $items = [new AgedBrieItem("Aged Brie", -1, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(42, $app->getItems()[0]->quality);
    }

    /** @test */
    public function aged_brie_increase_by_two_quality_when_date_passed_and_not_more_than_fifty() {
        $items = [new AgedBrieItem("Aged Brie", -1, 50)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(50, $app->getItems()[0]->quality);
    }

    /** @test */
    public function backstage_passes_increase_quality_by_two_when_sellin_less_than_ten() {
        $items = [new BackstageItem("Backstage passes to a TAFKAL80ETC concert", 10, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(42, $app->getItems()[0]->quality);
    }

    /** @test */
    public function backstage_passes_increase_quality_by_two_when_sellin_less_than_six() {
        $items = [new BackstageItem("Backstage passes to a TAFKAL80ETC concert", 6, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(42, $app->getItems()[0]->quality);
    }

    /** @test */
    public function backstage_passes_increase_quality_by_three_when_sellin_less_than_five() {
        $items = [new BackstageItem("Backstage passes to a TAFKAL80ETC concert", 5, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(43, $app->getItems()[0]->quality);
    }

    /** @test */
    public function backstage_passes_increase_quality_by_two_when_sellin_less_than_six_and_not_more_than_fifty() {
        $items = [new BackstageItem("Backstage passes to a TAFKAL80ETC concert", 6, 49)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(50, $app->getItems()[0]->quality);
    }

    /** @test */
    public function backstage_passes_increase_quality_by_three_when_sellin_less_than_five_and_not_more_than_fifty() {
        $items = [new BackstageItem("Backstage passes to a TAFKAL80ETC concert", 5, 48)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(50, $app->getItems()[0]->quality);
    }

    /** @test */
    public function backstage_passes_quality_drops_to_zero_after_concert() {
        $items = [new BackstageItem("Backstage passes to a TAFKAL80ETC concert", 0, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(0, $app->getItems()[0]->quality);
    }

    /** @test */
    public function backstage_passes_quality_increase_quality_by_one_when_date_is_more_than_10() {
        $items = [new BackstageItem("Backstage passes to a TAFKAL80ETC concert", 11, 40)];
        $app = new GildedRose($items);

        $app->updateQuality();

        $this->assertEquals(41, $app->getItems()[0]->quality);
    }
}