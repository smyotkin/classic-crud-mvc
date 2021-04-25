<?php 
    require __DIR__ . '/vendor/autoload.php';
    $config = require __DIR__ . '/Core/Config.php';

    (new Core\Controller\App($config))->init();