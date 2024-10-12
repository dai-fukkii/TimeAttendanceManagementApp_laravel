<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/login_validation.js') }}"></script>
</head>
<body>
    <h1>ログイン</h1>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <input type="text" name="username" id="username" placeholder="ユーザ名" required>
        </div>
        <div>
            <input type="password" name="password" id="password" placeholder="パスワード" autocomplete="new-password" required>
        </div>
        @if ($errors->has('login_error'))
            <div style="color: red;">
                {{ $errors->first('login_error') }}
            </div>
        @endif
        <button type="submit">ログイン</button>
    </form>
    <p>登録が済んでいない方はこちら<a href="signup">サインアップ</a></p>
</body>
</html>