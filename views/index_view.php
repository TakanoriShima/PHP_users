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
        <div class="container">
            <div class="row mt-2">
                <h1 class="col-sm-12 text-center text-primary">ユーザー一覧</h1>
            </div>
            <?php if(count($users) !== 0): ?>
            <div class="row mt-2">
                <p class="col-sm-12 text-center">現在のユーザーは<?= count($users) ?>人</p>
            </div>
            <div class="row mt-2">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th class="text-center">名前</th>
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
            </div>
            <?php else: ?>
            <div class="row mt-2">
                <p class="col-sm-12 text-center text-danger">ユーザーがまだいません</p>
            </div>
            <?php endif; ?>
            <div class="row">
                <a href="create.php" class="btn btn-primary">新規ユーザー登録</a>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>