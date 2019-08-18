<?php

require __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return json([
        'status' => 'fail',
        'message' => 'Invalid Method'
    ], 405);
}

$errors = [];

if (is_null(postValue('username'))) {
    $errors[] = 'username field is required.';
}

if (is_null(postValue('password'))) {
    $errors[] = 'password field is required.';
}

if (is_null(postValue('name'))) {
    $errors[] = 'name field is required.';
}

if (!$sql = mysqli_query($mysql, 'select id from tbl_users where username like "' . postValue('username'). '"')) {
    return json([
        'status' => 'fail',
        'message' => 'MySql Error: ' . mysqli_error($mysql)
    ]);
}

if (mysqli_num_rows($sql)) {
    $errors[] = 'the username \'' . postValue('username') . '\' is already taken.';
}

if (count($errors)) {
    $msg = '';

    $i = 0;

    $total_errors = count($errors);

    foreach ($errors as $error) {
        $i++;
        
        if ($i == $total_errors) {
            $msg .= $error;
        } else {
            $msg .= $error . PHP_EOL;
        }
        
    }

    return json([
        'status' => 'fail',
        'message' => 'Validation Error: ' . PHP_EOL . $msg
    ]);
}

$query = 'insert into tbl_users (username, password, name) values("'.postValue('username').'","'.hash('sha3-512', postValue('password')).'","'. postValue('name').'")';


if(!$sql = mysqli_query($mysql, $query)) {
    return json([
        'status' => 'fail',
        'message' => 'MySql Error: ' . mysqli_error($mysql)
    ]);
}

if(!mysqli_affected_rows($mysql)) {
    return json([
        'status' => 'fail',
        'message' => 'Failed to register account'
    ]);
}

return json([
    'status' => 'success',
    'message' => 'Registration successful! Please login'
]);