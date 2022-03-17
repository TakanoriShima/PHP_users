<?php
    // (C)
    require_once 'models/User.php';
    session_start();
    // var_dump($_GET);
    $id = $_GET['id'];
    // print $id;
    // データベースから指定されたidのデータを取得
    $user = User::find($id);
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    
    $token = session_id();
    // var_dump($user);
    // Viewの表示
    include_once 'views/edit_view.php';