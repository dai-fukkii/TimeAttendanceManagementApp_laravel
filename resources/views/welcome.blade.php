<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>welcome</title>
    </head>
    <body>
        <h1>勤怠管理アプリケーション</h1>
        <a href="{{ route('login') }}">
            <button type="submit" name="login">ログイン</button>
        </a>
        <br>
        <a href="{{ route('signup') }}">
            <button type="submit" name="signup">サインアップ</button>
        </a>
    </body>
</html>
