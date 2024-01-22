<?php
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/vendor/autoload.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/config/helpers.php';
require_once dirname($_SERVER['DOCUMENT_ROOT']) . '/config/constants.php';
use App\kernel\App;

$app = new App();

$app->run();