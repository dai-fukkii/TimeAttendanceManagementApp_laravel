<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>ログイン</h1>
    <form action="{{ route('login') }}" method="post">
        <div>
            <input type="text" name="username" id="username" placeholder="ユーザ名">
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="パスワード" autocomplete="new-password">
        </div>
        <button type="submit">ログイン</button>
    </form>
    <p>登録が済んでいない方はこちら<a href="signup">サインアップ</a></p>
</body>
</html>