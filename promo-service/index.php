<?php
//print_r($_SERVER);
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

(new \Choco\Application)
    ->run();
