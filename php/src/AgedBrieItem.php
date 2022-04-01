<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrieItem extends Item
{
    public function update(){
        $this->sell_in = $this->sell_in - 1;
        self::increaseQuality();
        if ($this->sell_in < 0) {
            self::increaseQuality();
        }
    }
}
