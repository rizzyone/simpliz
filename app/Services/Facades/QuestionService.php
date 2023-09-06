<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

class QuestionService extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'App\Services\QuestionService';
    }

}
