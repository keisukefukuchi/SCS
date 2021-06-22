<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    </head>
    <body>
        <p class="login_logo">Shibaura Chat System</p>
        <form method="POST" action="#" class="form">
            @csrf
            <p class="lead-text">本登録　必要事項を記入してください</p>
            <div class="register_form_wrap">
                <label for="name" class="form_label">名前</label>
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} form_input" name="student_number" value="{{ old('name') }}" required placeholder="your name">
                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="register_form_wrap">
                <label for="password" class="form_label">パスワード(8文字以上16文字以下)</label>
                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }} form_input" name="password" required placeholder="password">
            </div>
            <div class="register_form_wrap">
                <label for="password-confirm" class="form_label">パスワード(確認用)</label>
                <input id="password-confirm" type="password" class="form-control form_input" name="password_confirmation" required placeholder="password(again)">
            </div>
            <input type="hidden" name="email_token" value="#">
            <button type="submit" class="button">Sign up</button>
        </form>
    </body>
</html>
