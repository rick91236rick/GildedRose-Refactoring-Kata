<?php

declare(strict_types=1);

namespace GildedRose;

class NormalItem extends Item
{
    public function update(){
        $this->sell_in = $this->sell_in - 1;
        self::decreaseQuality();
        if ($this->sell_in < 0) {
            self::decreaseQuality();
        }
    }
}
