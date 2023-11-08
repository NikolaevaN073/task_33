<?php

use App\Core\Route;

session_start();
require_once dirname(__DIR__).'/config/config.php';
require_once dirname(__DIR__).'/vendor/autoload.php'; 
Route::start();
