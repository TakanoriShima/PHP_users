<?php
    // コントローラ(C)
    // 外部ファイルの読みこみ
    require_once 'models/User.php';
    // 物語開始
    $iwai = new User('岩井', 25, 'male');
    $shima = new User('島', 49, 'male');
    $yamada = new User('山田', 10, 'female');
    
    // ユーザー一覧作成
    $users = array(); // let users = Array();
    // $users = [];
    $users[] = $iwai;
    // array_push($users, $iwai); // users.push(iwai);
    $users[] = $shima;
    $users[] = $yamada;
    // var_dump($users);
    // print_r($users);
    // ユーザー一覧表示
    // users.forEach((users) => {});
    // foreach($users as $user){
    //     print $user->name . PHP_EOL;
    //     print $user->age . '歳' . PHP_EOL;
    //     print $user->gender === 'male' ? '男性' . PHP_EOL : '女性' . PHP_EOL;
    //     print $user->drink();
    // }
    // HTMLファイルの表示
    include_once 'views/index_view.php';