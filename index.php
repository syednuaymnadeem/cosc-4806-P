<?php
session_start();  

// TEMP SESSION FIX FOR TESTING
$_SESSION['auth'] = 1;
$_SESSION['userid'] = 1;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'app/init.php';

$app = new App;
