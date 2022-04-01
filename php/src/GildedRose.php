<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{
    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }
    public function getItems(): array
    {
        return $this->items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            switch ($item->name) {
                case 'Sulfuras, Hand of Ragnaros':
                    break;
                case 'Aged Brie':
                    $item->sell_in = $item->sell_in - 1;
                    self::increaseQuality($item);
                    if ($item->sell_in < 0) {
                        self::increaseQuality($item);
                    }
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $item->sell_in = $item->sell_in - 1;
                    self::increaseQuality($item);
                    if ($item->sell_in < 10) {
                        self::increaseQuality($item);
                    }
                    if ($item->sell_in < 5) {
                        self::increaseQuality($item);
                    }
                    if ($item->sell_in < 0) {
                        $item->quality = 0;
                    }
                    break;
                default:
                    $item->sell_in = $item->sell_in - 1;

                    self::decreaseQuality($item);

                    if ($item->sell_in < 0) {
                        self::decreaseQuality($item);
                    }
                    break;
            }
        }
    }

    public function increaseQuality(Item $item)
    {
        if ($item->quality < 50) {
            $item->quality = $item->quality + 1;
        }
    }

    public function decreaseQuality(Item $item)
    {
        if ($item->quality > 0) {
            $item->quality = $item->quality - 1;
        }
    }
}
