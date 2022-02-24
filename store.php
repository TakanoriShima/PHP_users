<?php
    // (C)
    require_once 'models/User.php';
    session_start();
    // $_POST はページ間をまたいで飛んでくる連想配列
    // スーパーグローバル変数
    // var_dump($_POST);
    // フォームで入力された値を取得
    $name = $_POST['name'];
    // print $name;
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    
    // 入力された値をもとに新しいユーザー作成
    $user = new User($name, $age, $gender);
    // var_dump($user);
    // 目標
    // セッションからユーザー一覧を取得
    $users = $_SESSION['users'];
    $users[] = $user;
    var_dump($users);