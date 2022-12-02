<?php

namespace App\Data;

use DateTime;

class SearchNews {

    public $searchText ;

    public $categories;

    public $tags;

    public ?DateTime $minDate;
}