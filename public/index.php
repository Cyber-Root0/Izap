<?php
require_once('../vendor/autoload.php');
require_once('../app/config/config.php');
require_once('../app/functions/functions.php');

use app\controller\TesteController;
$controller = new TesteController();
dd($controller->seta());