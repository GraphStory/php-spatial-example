<?php

// Always turn error reporting all the way up in dev
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Always set a timezone
date_default_timezone_set('UTC');

require_once './vendor/autoload.php';

use GuzzleHttp\Client;

// Include a secret.php file with your Graph Story credentials. You can grab
// the contents for secret.php from the Graph Kit for PHP documentation at
// https://console.graphstory.com
$config = require_once './secret.php';

$graphStoryUrl = sprintf(
    'https://%s:%s',
    $config['graphStory']['restHost'],
    $config['graphStory']['restPort']
);

$client = new Client([
    'base_url' => [$graphStoryUrl, []],
    'defaults' => [
        'headers' => [
            'Accept' => 'application/json; charset=UTF-8',
        ],
        'auth' => [
            $config['graphStory']['restUsername'],
            $config['graphStory']['restPassword'],
        ],
    ],
]);
