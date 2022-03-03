<?php
    require_once 'models/User.php';
    // (C)
    // print 'OK';
    // ビューの表示
    session_start();
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    $user = $_SESSION['user'];
    $_SESSION['user'] = null;
    
    if($user === null){
        $user = new User('', '', 'male');
    }
    include_once 'views/create_view.php';