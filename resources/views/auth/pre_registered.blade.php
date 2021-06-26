{{-- 仮登録完了画面 --}}
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
    <p class="login_logo">Shibaura Chat System</p>
    <div class="registered_box">
        <p class="lead-text">仮会員登録完了！</p>
        <div class="registered_box_text">
            <p>この度は、ご登録いただき、誠にありがとうございます。</p>
            <p>ご本人様確認のため、ご登録いただいたメールアドレスに、<br>
            本登録のご案内のメールが届きます。</p>
            <p>そちらに記載されているURLにアクセスし、<br>
            アカウントの本登録を完了させてください。</p>
        </div>
    </div>

</body>