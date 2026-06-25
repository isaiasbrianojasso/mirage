<?php
// This file exists solely to trick PHP's built-in web server into routing /tienda 
// through Laravel instead of returning a 404 for a physical directory.
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = realpath(__DIR__.'/../index.php');
$_SERVER['PHP_SELF'] = '/index.php';
$_SERVER['DOCUMENT_ROOT'] = realpath(__DIR__.'/../');
require __DIR__.'/../index.php';
