<?php
    // Errors list
    require __DIR__ . '/errors.php';

    // Main
    define('APP_NAME', 'Task for "Премьер Софтвер Солюшенс"');
    define('CONTROLLER_DIR', '\\App\\Controller\\');
    define('VIEW_DIR', $_SERVER['DOCUMENT_ROOT'] . '\\App\\View\\');

    define('THEMES_DIR', 'Themes\\');
    define('THEME', 'Standart');
    define('THEME_PATH', THEMES_DIR . THEME);
    define('FULL_PATH', '\\App\\View\\' . THEMES_DIR . THEME);

    // Database
    define('DB_NAME', 'pss_database');
    define('DB_USERNAME', 'mysql');
    define('DB_PASSWORD', 'mysql');
    define('DB_HOST', '127.0.0.1');
    define('DB_CHARSET', 'utf8');
    define('DB_PREFIX', 'pss_');

    // Debug
    define('DEBUG_ACTIVE', 1);

    ini_set('display_errors', DEBUG_ACTIVE);
    ini_set('display_startup_errors', DEBUG_ACTIVE);
    error_reporting(DEBUG_ACTIVE == 1 ? E_ALL & ~E_NOTICE : 0);

    Flight::set('flight.handle_errors', false);