<?php
// Database connection settings
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'TwinCities');
// define('DB_USER', 'root');
// define('DB_PASSWORD', '');

// API Keys
define('OPENWEATHER_API_KEY', '50e6ff3f01073976f4dd6631106efb68');
define('FLICKR_API_KEY', 'cf9cc0342390ce4e5f9ab064e7245908');
define('FLICKR_SECRET', '24bd243705a82ff7');
define('XML_FILE_PATH', 'twincities.xml');

// Global settings for application
$GLOBALS['MAP_COORDINATES'] = [
    'Canterbury' => [
        'lat' => '51.2802',
        'lng' => '1.0789',
        'zoom' => '13'
    ],
    'Reims' => [
        'lat' => '49.2620',
        'lng' => '4.0347',
        'zoom' => '13'
    ]
];

$GLOBALS['XML_FILE_PATH'] = 'twincities.xml';

$GLOBALS['CITIES'] = [
    'Canterbury' => ['id' => 1, 'name' => 'Canterbury'],
    'Reims' => ['id' => 2, 'name' => 'Reims']
];

// Error Handling
set_error_handler('customErrorHandler');

function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // error handling code
    $error_message = "Error: [$errno] $errstr\n";
    $error_message .= "Occurred on line $errline in file $errfile";
    logError($error_message);
    // Display user-friendly error message
    if (!ini_get('display_errors')) {
        echo "An error occurred. Please try again later.";
    } else {
        echo $error_message;
    }
    // Don't execute PHP internal error handler
    return true;
}

function logError($message) {
    // Log the error to a file 
    file_put_contents('C:/laragon/www/TwinCitiesUpdated17/Error Checking/error_log.txt', $message . "\n", FILE_APPEND);
}
?>



