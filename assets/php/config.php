<?php

/**
 * @author John Rhey Bocalan <jrboc18@gmail.com>
 */

/**
 * Check session if is already starting
 */

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'db_sample_crud';

$host_link = 'crud';

$mysql = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()) {
    return die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

/**
 * json function display json response of array or string
 *
 * @param string,array $json_response
 * @param integer $http_status
 * @return json
 */
function json($json_response, $http_status = 200)
{
    header('Content-Type: application/json');
    http_response_code($http_status);
    echo json_encode($json_response);
}

/**
 * postValue returns value of $_POST[$index]
 *
 * @param string $index
 * @return string
 */
function postValue($index)
{
    global $mysql;
    if (isset($_POST[$index]) && $_POST[$index] != '') {
        return mysqli_escape_string($mysql, $_POST[$index]);
    }

    return null;
}

function phpLink($like_to_file = null)
{
    global $host_link;
    echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}/{$host_link}" . '/assets/php/' . $like_to_file;
}
