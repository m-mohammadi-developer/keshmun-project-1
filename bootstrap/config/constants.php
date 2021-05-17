<?php
define('DS', DIRECTORY_SEPARATOR);

// get site root dynamically
define('SITE_ROOT', __DIR__ . '/../../');

// get site url dynamically
$server_name = 'http://' . $_SERVER['SERVER_NAME'];
$site_url_parts = explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);
$site_uri = $server_name . '/' . $site_url_parts[1] . '/' . $site_url_parts[2];

define('SITE_URL', $site_uri);

$users = [
    'admin' => '$2y$10$oo9.YReMOG7Hjikd1XCz6.rwwaAC/8MXv2tBzMXUPnJPqz7VfLS.u', // 987654321
    'mohammad' => '$2y$10$Ivdq7cg3JdAoSCANxLfG9eoq1PloCdZL535Gx28MHp4QRSuzAE7yS', // 123456
];