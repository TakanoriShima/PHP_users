<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ユーザー一覧</title>
        <link rel="icon" href="images/favicon.ico">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--ビュー(V)-->
        <h1>ユーザー一覧</h1>
        <table>
            <tr>
                <th>名前</th>
                <th>年齢</th>
                <th>性別</th>
                <th>お酒</th>
            </tr>
            <?php foreach($users as $user): ?>
            <tr>
                <td><?= $user->name ?></td>
                <td><?= $user->age ?>歳</td>
                <td><?= $user->gender === 'male' ? '男性' : '女性' ?></td>
                <td><?= $user->drink() ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>