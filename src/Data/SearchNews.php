<?php

namespace App\Data;

use DateTime;

class SearchNews extends SearchPage
{


    public $categories;

    public $tags;

    public ?DateTime $minDate;
}