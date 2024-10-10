<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>welcome</title>
    </head>
    <body>
        <h1>勤怠管理アプリケーション</h1>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <button type="submit" name="login">ログイン</button>
        </form>
        <form action="{{ route('signup') }}" method="post">
            @csrf
            <button type="submit" name="signup">サインアップ</button>
        </form>
    </body>
</html>
