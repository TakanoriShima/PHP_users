<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?= $user->name ?>さんの詳細</title>
        <link rel="icon" href="images/favicon.ico">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--ビュー(V)-->
        <div class="container">
            <div class="row mt-2">
                <h1 class="col-sm-12 text-center text-primary"><?= $user->name ?>さんの詳細</h1>
            </div>
            <div class="row mt-2">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>ID</th>
                        <th class="text-center">名前</th>
                        <th>年齢</th>
                        <th>性別</th>
                        <th>お酒</th>
                    </tr>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->name ?></td>
                        <td><?= $user->age ?>歳</td>
                        <td><?= $user->gender === 'male' ? '男性' : '女性' ?></td>
                        <td><?= $user->drink() ?></td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <a href="index.php" class="offset-sm-3 col-sm-6 btn btn-primary">ユーザー一覧に戻る</a>
            </div>
            <div class="row mt-3">
                <a href="edit.php?id=<?= $user->id?>" class="offset-sm-1 col-sm-4 btn btn-success">編集</a>
                <form class="offset-sm-2 col-sm-4 row" action="destroy.php" method="POST">
                    <input type="hidden" name="id" value="<?= $user->id ?>">
                    <input type="hidden" name="_token" value="<?= $token ?>">
                    <button class="col-sm-12 btn btn-danger" type="submit" onclick="return confirm('本当に削除しますか?')">削除</button>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </body>
</html>