<?php

require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return json([
        'status' => 'fail',
        'message' => 'Invalid Method'
    ], 405);
}

$username = postValue('username');
$password = hash('sha3-512', postValue('password'));

if (!$sql = mysqli_query($mysql, 'select name, status, id from tbl_users where username = "'. $username.'" and password = "'.  $password . '"')) {
    return json([
        'status' => 'fail',
        'message' => 'MySql Error: ' . mysqli_error($mysql)
    ]);
}

if(mysqli_num_rows($sql) == 0) {
    return json([
        'status' => 'fail',
        'message' => 'Invalid username or password',
    ]);
}

$result = mysqli_fetch_assoc($sql);

$_SESSION['user'] = $result;
$_SESSION['login_status'] = 1;

return json([
    'status' => 'success',
    'message' => 'Login successful! Welcome, ' . $_SESSION['user']['name']
]);
