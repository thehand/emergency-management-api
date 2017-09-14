<?php

require __DIR__ . '/../vendor/autoload.php';

$app = new \EmergencyManagement\EmergencyManagementAPI();
$app->get()->run();