<?php

require_once '../vendor/myautoload.php';

use \App\Currency;

$currency = new Currency();

echo $currency->index();