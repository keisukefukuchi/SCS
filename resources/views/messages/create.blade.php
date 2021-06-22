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
            <a href = "/tweets">
                <div class="header-logo">
                    〈 back</div>
                <div class="header-list">
            </a>
                <ul>
                    <li>　　    {{ "#".$channel_name }}</li>
                </ul>
            </div>
        </div>
        <!--test用-->
        <span class="hidden">{{ $param = 1}}</span>
        <!--test用-->

        @if($param == 0)
            <div class="post">
                投稿
            </div>
            <div class="border"></div>
                <form method="POST" action="{{ route('tweets.store') }}">
                    @csrf
                    <input type="hidden" name="channel_id" value="{{ $channel_id }}">
                    <textarea class="textarea @error('text') is-invalid @enderror"  name="text"  rows="8"></textarea>

                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
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

                <form method="POST" action="{{ route('tweets.update', ['tweet' => 1]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="channel_id" value="{{ $channel_id }}">
                    <textarea class="textarea @error('text') is-invalid @enderror"  name="text"  rows="8">{{ old('text') ? : "oldtext" }}</textarea>

                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <div class="button">
                        <input type="submit" value="Post">
                    </div>
                </form>

            @else
                <div class="post">
                    返信
                </div>
                <div class="border"></div>
                <form method="POST" action="{{ url('reply/store') }}">
                    @csrf

                    <input type="hidden" name="channel_id" value=1>
                    <input type="hidden" name="reply_id" value=1>
                    <textarea class="textarea @error('text') is-invalid @enderror" name="text"  rows="8">{{ old('text') }}</textarea>

                    @error('text')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <div class="button">
                        <input type="submit" value="Post">
                    </div>

                </form>

            @endif
    </body>
</html>