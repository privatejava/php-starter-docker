<?php
// app/index.php

// Attempt to connect to MySQL
$host = 'db'; // The service name for MySQL in docker-compose
// IMPORTANT: In a real application, fetch these from environment variables or a configuration file,
// not directly hardcoded in index.php like this.
$db   = getenv('MYSQL_DATABASE') ?: 'my_app_database';
$user = getenv('MYSQL_USER') ?: 'app_user';
$pass = getenv('MYSQL_PASSWORD') ?: 'app_password_change_me';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $mysql_message = "Successfully connected to MySQL database!";
} catch (\PDOException $e) {
    $mysql_message = "Could not connect to MySQL: " . $e->getMessage();
}

// Get ports from environment variables, with defaults
$app_port = getenv('APP_PORT') ?: '12000';
$mysql_port = getenv('MYSQL_PORT') ?: '3307';
$phpmyadmin_port = getenv('PHPMYADMIN_PORT') ?: '12001';
$mysql_root_password = getenv('MYSQL_ROOT_PASSWORD') ?: 'root_password_change_me';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Docker Dev Environment</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f4; color: #333; }
        .container { background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto; }
        h1, h2 { color: #0056b3; }
        .success { color: green; font-weight: bold; }
        .error { color: red; font-weight: bold; }
        pre { background-color: #eee; padding: 10px; border-radius: 4px; overflow-x: auto; }
        ul { list-style-type: none; padding: 0; }
        li { margin-bottom: 5px; }
        li::before { content: "• "; color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to your PHP Docker Dev Environment!</h1>

        <h2>PHP Information:</h2>
        <ul>
            <li>PHP Version: <?php echo phpversion(); ?></li>
            <li><?php echo $mysql_message; ?></li>
        </ul>

        <h2>Environment Details:</h2>
        <p>This page is being served by Nginx and processed by PHP-FPM.</p>
        <p>Your local <code>app/</code> directory is mounted to <code>/var/www/html</code> inside the containers.</p>

        <h2>To manage your database:</h2>
        <p>Access phpMyAdmin at: <a href="http://localhost:<?php echo $phpmyadmin_port; ?>" target="_blank">http://localhost:<?php echo $phpmyadmin_port; ?></a></p>
        <p>You can also connect to MySQL directly on your host at port: <code><?php echo $mysql_port; ?></code></p>
        <p>Use the following credentials (from your `.env` file):</p>
        <ul>
            <li><strong>Server:</strong> <code>db</code> (from phpMyAdmin) or <code>127.0.0.1</code> (from host)</li>
            <li><strong>Username:</strong> <code><?php echo $user; ?></code></li>
            <li><strong>Password:</strong> <code><?php echo $pass; ?></code></li>
            <li><strong>Root Username:</strong> <code>root</code></li>
            <li><strong>Root Password:</strong> <code><?php echo $mysql_root_password; ?></code></li>
        </ul>

        <h2>PHP Info:</h2>
        <details>
            <summary>Click to view phpinfo()</summary>
            <?php phpinfo(); ?>
        </details>
    </div>
</body>
</html>
