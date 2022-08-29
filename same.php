<?php
    setcookie('cookie1', '1',[
        'expires' => time() + 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => false,
        'samesite' => 'None'
    ]);
    setcookie('cookie2','2',[
        'expires' => time() + 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => false,
        'samesite' => 'strict'
    ]);
    setcookie('cookie3','3',[
        'expires' => time() + 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => false,
        'samesite' => 'lax'
    ]);
?>
