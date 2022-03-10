<?php
    // (C)
    require_once 'filters/csrf_filter.php';
    require_once 'models/User.php';
    // session_start();
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
    // 入力された値の検証
    $errors = $user->validate();
    // 入力エラーが1つもなければ
    if(count($errors) === 0){
        // 目標
        // セッションからユーザー一覧を取得
        // $users = $_SESSION['users'];
        // $users[] = $user;
        // $_SESSION['users'] = $users;
        // $_SESSION['flush'] = $user->name . 'さんが登録されました';
        // データベースに新しいユーザーを登録
        $flush = $user->save();
        $_SESSION['flush'] = $flush;
        // ユーザー一覧へリダイレクト
        header('Location: index.php');
        exit;
        // var_dump($users);
    }else{
        // 入力のし直し
        $_SESSION['errors'] = $errors;
        $_SESSION['user'] = $user;
        header('Location: create.php');
        exit;
    }
    // var_dump($errors);
    // var_dump($user);
 