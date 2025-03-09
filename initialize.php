<?php
// Define base URL dynamically (for local and live servers)
if (!defined('base_url')) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    $folder = "/company_website/"; // Update with the folder path if different
    define('base_url', $protocol . $host . $folder);
}

// Define application base path
if (!defined('base_app')) {
    define('base_app', str_replace('\\', '/', __DIR__) . '/');
}

// Database Configuration (Use environment variables for security in live setup)
if (!defined('DB_SERVER')) define('DB_SERVER', getenv('DB_SERVER') ?: 'localhost');
if (!defined('DB_USERNAME')) define('DB_USERNAME', getenv('DB_USERNAME') ?: 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', getenv('DB_PASSWORD') ?: ''); // Use environment variables or default to empty
if (!defined('DB_NAME')) define('DB_NAME', getenv('DB_NAME') ?: 'company_website_db');
?>



