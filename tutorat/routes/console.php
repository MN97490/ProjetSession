<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;


$schedule = new Schedule($this);
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();




