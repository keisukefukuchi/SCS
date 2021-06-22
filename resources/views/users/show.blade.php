{{-- ユーザ詳細画面 --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charaset="UTF-8">
        <title>Profile</title>
        <link rel ="stylesheet" href="{{asset('/css/style1_11.css')}}">
    </head>
    <body>
        <div class="header">
            <a href = "/tweets">
                <div class="header-logo">
                    〈 back
                </div>
                <div class="header-list">
                    </a>
                        <ul>
                            <li>　　    Profile</li>
                        </ul>
                </div>
        </div>
        <div class="profile">
            <div class="username">
                <div class="name"><b>{{ $user->name }}</b></div>
                <div class="ID">{{ $user->screen_name }}</div>
            </div>
            @if ($user->id === Auth::user()->id)
                <br><br><br>
                @else
                @if ($is_following)
                    <form action="{{ route('unfollow', ['user' => $user->id]) }}" method="POST" class="mb-2">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="Release">フォロー解除</button>
                    </form>
                @else
                    <form action="{{ route('follow', ['user' => $user->id]) }}" method="POST" class="mb-2">
                        {{ csrf_field() }}

                        <button type="submit" class="follow">フォローする</button>
                    </form>
                @endif

                @if ($is_followed)
                    <span class="followed">フォローされています</span>
                @endif
            @endif
            <div class="follow-list">

                <div class="center">
                    <p class="bold">ツイート数</p>
                    <span>{{ $tweet_count }}</span>
                </div>
                <div class="center">
                    <p class="bold">フォロー数</p>
                    <span>{{ $follow_count }}</span>
                </div>
                <div class="center">
                    <p class="bold">フォロワー数</p>
                    <span>{{ $follower_count }}</span>
                </div>
            </div>
        </div>


        <!--test-->
        <link rel ="stylesheet" href="{{asset('/css/app.css')}}">
        <br>
        <br>
        <!---->


        @if (isset($timelines))
        @foreach ($timelines as $timeline)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-haeder p-3 w-100 d-flex">
                        <img src="{{ asset('storage/profile_image/' .$user->profile_image) }}" class="rounded-circle" width="50" height="50">
                        <div class="ml-2 d-flex flex-column flex-grow-1">
                            <p class="mb-0">{{ $timeline->user->name }}</p>
                            <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->screen_name }}</a>
                        </div>
                        <div class="d-flex justify-content-end flex-grow-1">
                            <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        {{ $timeline->text }}
                    </div>

                    <div class="card-footer py-1 d-flex justify-content-end bg-white">
                        @if ($timeline->user->id === Auth::user()->id)
                            <div class="dropdown mr-3 d-flex align-items-center">
                                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-fw"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <form method="POST" action="{{ url('tweets/' .$timeline->id) }}" class="mb-0">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ url('tweets/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                        <button type="submit" class="dropdown-item del-btn">削除</button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        <!-- ここから -->
                        <div class="mr-3 d-flex align-items-center">
                            <a href="{{ url('tweets/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                            <p class="mb-0 text-secondary">{{ count($timeline->comments) }}</p>
                        </div>
                        <div class="d-flex align-items-center">
                            @if (!in_array(Auth::user()->id, array_column($timeline->favorites->toArray(), 'user_id'), TRUE))
                                <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
                                    @csrf

                                    <input type="hidden" name="tweet_id" value="{{ $timeline->id }}">
                                    <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
                                </form>
                            @else
                                <form method="POST"action="{{ url('favorites/' .array_column($timeline->favorites->toArray(), 'id', 'user_id')[Auth::user()->id]) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
                                </form>
                            @endif
                            <p class="mb-0 text-secondary">{{ count($timeline->favorites) }}</p>
                        </div>
                        <!-- ここまで -->

                    </div>
                </div>
            </div>
        @endforeach
    @endif

    </body>
</html>
