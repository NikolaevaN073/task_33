<?php

define('DEBUG_MODE', true);
define('APP_URL', 'http://example.com');
define('URL', '/');
define('timezone', 'UTC');
define('APP_KEY', '');

define('ROOT_DIR', dirname(__DIR__));
define('APP', ROOT_DIR . '/app');
define('CONTROLLERS', APP . '/Controllers');
define('CORE', APP . '/Core');
define('MODELS', APP . '/Models');
define('VIEWS', ROOT_DIR . '/resources/views');
define('CONTROLLERS_NAMESPACE', "App\Controllers\\");

define('HOST', '127.0.0.1');
define('PORT', 3306);
define('DB', 'messenger');
define('USERNAME', 'root');
define('PASSWORD', '');
