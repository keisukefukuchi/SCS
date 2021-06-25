<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <script src="{{ asset('js/logo.js') }}" defer></script>
</head>
<body>
    <a class="login_logo fade-in" href="{{ route('login') }}">Shibaura Chat System</a>
    <form method="POST" action="{{ route('login') }}" class="form">
        @csrf
        <div class="form_wrap">
            <label for="student_number" class="form_label">学籍番号</label>
            <input id="student_number" type="student_number" class="form-control @error('student_number') is-invalid @enderror form_input" name="student_number" value="{{ old('student_number') }}" placeholder="zz00000" autocomplete="student_number" autofocus>
        </div>
            @error('student_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        <div class="form_wrap">
            <label for="password" class="form_label">パスワード</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form_input" name="password" placeholder="password" autocomplete="current-password">
        </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror


        <button type="submit" class="button">Login</button>


        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="login_form_link">
                まだアカウントをお持ちでない方はこちら
            </a>
        @endif
    </form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</body>
</html>
