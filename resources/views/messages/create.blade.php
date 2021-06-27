{{-- 投稿画面 --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charaset="UTF-8">
        <title>Post</title>
        <link rel ="stylesheet" href="{{asset('/css/style1_5.css')}}">
    </head>
    <body>
        <div class="header">
            <a href = {{ route('messages.index') }}>
                <div class="header-logo">
                    〈 back
                </div>
            </a>
            <div class="header-list">
                <ul>
                    <li>　　    {{ "#".$channel_name }}</li>
                </ul>
            </div>
        </div>

        @if($param == 0)
            <div class="post">
                投稿
            </div>
            <div class="border"></div>
            <form method="POST" action="{{ route('messages.store') }}">
                @csrf
                <input type="hidden" name="reply_id" value="{{ 0 }}">
                <input type="hidden" name="channel_id" value="{{ $channel_id }}">
                <textarea class="textarea @error('message') is-invalid @enderror"  name="message"  rows="8"></textarea>
                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong class = "position">{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                <div class="button">
                    <input type="submit" value="Post">
                </div>
            </form>

        @elseif ($param == 1)
            <div class="post">
                編集
            </div>
            <div class="border"></div>

            <form method="POST" action="{{ route('messages.update', ['message' => $messages->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="channel_id" value="{{ $channel_id }}">
                <textarea class="textarea @error('message') is-invalid @enderror"  name="message"  rows="8">{{ old('message') ? : "$messages->message" }}</textarea>

                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong class = "position">{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                <div class="button">
                    <input type="submit" value="Post">
                </div>
            </form>

        @elseif ($param == 2)
            <div class="post">
                返信
            </div>
            <div class="border"></div>
            <form method="POST" action="{{ url('reply/store') }}">
                @csrf

                <input type="hidden" name="channel_id" value="{{ $channel_id }}">
                <input type="hidden" name="reply_id" value="{{ $reply_id }}">
                <textarea class="textarea @error('message') is-invalid @enderror" name="message"  rows="8">{{ old('message') }}</textarea>

                @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong class = "position">{{ $message }}</strong>
                    </span>
                @enderror
                <br>
                <div class="button">
                    <input type="submit" value="Post">
                </div>

            </form>

        @else

        <div class="post">
            不正な遷移です
        </div>

        @endif
    </body>
</html>
