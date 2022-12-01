<?php

namespace BrandonDetty\DynamicPropPitfall;

require_once $_composer_autoload_path ?? __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ERROR);
DynamicPropMemTest::run();
