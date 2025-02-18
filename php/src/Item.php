<?php

declare(strict_types=1);

namespace GildedRose;

abstract class Item
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $sell_in;

    /**
     * @var int
     */
    public $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }

    protected function increaseQuality()
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;
        }
    }

    protected function decreaseQuality()
    {
        if ($this->quality > 0) {
            $this->quality = $this->quality - 1;
        }
    }
}
