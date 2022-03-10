<?php
    // (C)
    require_once 'models/User.php';
    // var_dump($_GET);
    $id = $_GET['id'];
    // print $id;
    // データベースから指定されたidのデータを取得
    $user = User::find($id);
    // var_dump($user);
    // Viewの表示
    include_once 'views/show_view.php';