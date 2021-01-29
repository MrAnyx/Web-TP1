<?php

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require __DIR__ . "/../vendor/autoload.php";

// Initialisation du package pour afficher de belles url
$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

session_start();
?>