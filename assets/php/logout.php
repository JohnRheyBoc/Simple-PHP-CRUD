<?php

require __DIR__ . '/config.php';

unset($_SESSION['user']);

return json([
    'status' => 'success',
    'message' => 'Logout successful',
]);
