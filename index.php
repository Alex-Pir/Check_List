<?php
include_once __DIR__ . '/vendor/autoload.php';

use classes\controllers\Controller;
use \classes\log\Log;

session_start();

try {
    Controller::run();
} catch (Exception $ex) {
    Log::writeLog($ex->getMessage());
}
