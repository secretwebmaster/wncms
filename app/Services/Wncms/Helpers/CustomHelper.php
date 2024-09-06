<?php

namespace App\Services\Wncms\Helpers;

class CustomHelper
{
    protected $cacheKeyPrefix = "wncms_custom";

    public function test()
    {
        return 'testing custom helper';
    }
}