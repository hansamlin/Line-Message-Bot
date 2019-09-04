<?php

namespace App\Service;

use LINE\LINEBot\MessageBuilder\ImageMessageBuilder;

class GoldService
{
    public $image;

    public function __construct()
    {
        $imgUrl = "https://goldprice.org/charts/history/gold_30_day_g_twd_x.png";
        $this->image = new ImageMessageBuilder($imgUrl, $imgUrl);
    }

    public function getImage()
    {
        return $this->image;
    }
}
