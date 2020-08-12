<?php

namespace BrandStudio\Instagram\Facades;

use Illuminate\Support\Facades\Facade;

class Instagram extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'brandstudio_instagram';
    }

}
