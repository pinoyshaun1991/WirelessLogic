<?php

use WL\Controller\ItemController;

require_once __DIR__ . '/../../vendor/autoload.php';

$site  = 'https://videx.comesconnected.com/';
$items = new ItemController($site);

$items->getItems();
