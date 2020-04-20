<?php

require_once '../vendor/autoload.php';

use \App\Currency;

$currency = new Currency();

echo $currency->index();