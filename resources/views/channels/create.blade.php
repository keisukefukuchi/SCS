{{-- チャンネル作成画面 --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charaset="UTF-8">
        <title>ChannelCreate</title>
        <link rel ="stylesheet" href="{{asset('css/style1_7.css')}}">
    </head>
    <body>
        <div class="header">
            <a href = "{{ route('messages.index')}}">
                <div class="header-logo">
                    〈 back</div>
                <div class="header-list">
            </a>
                <ul>
                    <li>   </li>
                </ul>
            </div>
        </div>
        <div class="title">
            チャンネルを作成する
        </div>
        <div class="border"></div>
        <form action="{{ route('channels.store') }}"   method="POST">
            @csrf
            <div class="channelName">チャンネル名(20文字以内)</div>
                <input class="input @error('text') is-invalid @enderror"  name="text">

                @error('text')
                    <span class="invalid-feedback" >
                        <br><strong>{{ $message }}</strong>
                    </span>
                @enderror

            <div class="button">
                <input type="submit" value="＋ Create">
            </div>
        </form>

        <a href = "{{ route('channels.index') }}">
            <div class="button2">
                <input type="submit" value="チャンネル一覧　＞">
            </div>
        </a>
    </body>
</html>
