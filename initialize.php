<?php
if (!defined('base_url')) define('base_url', 'http://localhost/company_website/');
    if (!defined('base_app')) define('base_app', str_replace('\\', '/', __DIR__) . '/');
    
    // Define constants for the database connection
    if (!defined('DB_SERVER')) define('DB_SERVER', "localhost");
    if (!defined('DB_USERNAME')) define('DB_USERNAME', "root");
    if (!defined('DB_PASSWORD')) define('DB_PASSWORD', ""); // For local development, leave blank or use environment variables
    if (!defined('DB_NAME')) define('DB_NAME', "company_website_db");
    
?>