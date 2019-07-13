<?php

require __DIR__.'/vendor/autoload.php';

use App\Components\Container\ContainerDi;

(new ContainerDi())->resolve('App\App');

