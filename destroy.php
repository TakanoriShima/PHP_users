<?php
    // (C)
    require_once 'filters/csrf_filter.php';
    require_once 'models/User.php';
    $id = $_POST['id'];
    // // モデルを使ってユーザーインスタンスを取得
    $user = User::find($id);
    // // var_dump($user);
    // そのインスタンスをMySQLから削除
    $flush = $user->delete();
    // $flush = User::destroy($id);
    
    $_SESSION['flush'] = $flush;
    
    // リダイレクト
    header('Location: index.php');
    exit;