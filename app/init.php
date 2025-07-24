<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Only set these if a session isn't already active
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.gc_maxlifetime', 28800);
    ini_set('session.gc_probability',   1);
    ini_set('session.gc_divisor',       1);

    $sessionCookieExpireTime = 28800; // 8hrs
    session_set_cookie_params($sessionCookieExpireTime);

    session_start();
}


// require_once 'core/App.php';
// require_once 'core/Controller.php';
require_once 'core/config.php';
require_once 'database.php';
