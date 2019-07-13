<?php

require __DIR__.'/vendor/autoload.php';

use App\Components\Container\ContainerDi;

$container = (new ContainerDi())->resolve('App\App')->init();

