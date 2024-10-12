<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/signup_validation.js') }}"></script>
</head>
<body>
    <h1>サインアップ</h1>
    <form action="{{ route('signup') }}" method="post">
        @csrf
        <div>
            <input type="text" name="username" id="username" placeholder="ユーザ名" required>
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="パスワード" autocomplete="new-password" required>
        </div>
        <div>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="確認パスワード" required>
        </div>
        <button type="submit">サインアップ</button>
    </form>
    <p>登録済みの方はこちら<a href="{{ route('login') }}">ログイン</a></p>
</body>
</html>