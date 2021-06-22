{{-- チャンネル参加画面 --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charaset="UTF-8">
        <title>Post</title>
        <link rel ="stylesheet" href="{{asset('css/style1_9.css')}}">
    </head>
    <body>
    <div class="header">
        <a href = "add.blade.php">
            <div class="header-logo">
                〈 back</div>
            <div class="header-list">
        </a>
            <ul>
                <li>　　    Channel</li>
            </ul>
            </div>
        </div>

        <div class="title">
            チャンネル一覧
        </div>
        <div class="border"></div>

        @foreach ($channels as $channel)
            <div class="channel">
                <form action="{{ url('joins/') }}" method="POST">
                @csrf
                <input type="hidden" name="channel_id" value="{{ $channel->id }}">
                    <div class="joinButton">
                        {{ '#'. $channel->channel_name }}
                        <input type="submit" value="参加する" >
                    </div>
                </form>
            </div>
        @endforeach
    </body>
</html>
