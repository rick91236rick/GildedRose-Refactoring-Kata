<?php

declare(strict_types=1);

namespace GildedRose;

class BackstageItem extends Item
{
    public function update(){
        $this->sell_in = $this->sell_in - 1;
        self::increaseQuality();
        if ($this->sell_in < 10) {
            self::increaseQuality();
        }
        if ($this->sell_in < 5) {
            self::increaseQuality();
        }
        if ($this->sell_in < 0) {
            $this->quality = 0;
        }
    }
}
