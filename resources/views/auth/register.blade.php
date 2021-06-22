{{-- 仮登録画面 --}}
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <a class="login_logo" href="{{ route('login') }}">Shibaura Chat System</a>
    <form method="POST" action="{{ route('register.pre_check') }}" class="form">
        @csrf
        <p class="lead-text">学籍番号を入力してください</p>
        <div class="form_wrap">
            <label for="student_number" class="form_label">学籍番号</label>
            <input id="student_number" type="text" class="form-control @error('student_number') is-invalid @enderror form_input" name="student_number" value="{{ old('student_number') }}" required placeholder="aa00000" autocomplete="student_number">
        </div>
            @error('student_number')
                <p class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </p>
            @enderror
        <button type="submit" class="button">Register</button>
    </form>
</body>