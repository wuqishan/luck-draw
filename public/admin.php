<?php

include '../vendor/autoload.php';

use Controller\IndexController;

$index = new IndexController();


echo $index->test();


//phpinfo();


?>