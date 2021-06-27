{{-- ユーザ詳細画面 --}}
<!DOCTYPE html>
<html>
    <head>
        <meta charaset="UTF-8">
        <title>Profile</title>
        <link rel ="stylesheet" href="{{asset('/css/style1_11.css')}}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/my.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

    </head>
    <body>
        <div class="header">
            <a href = "{{ route('messages.index')}}">
                <div class="header-logo">
                    〈 back
                </div>
            </a>
            <div class="header-list">
                <ul>
                    <li>　　    Profile</li>
                </ul>
            </div>
        </div>
        <div class="profile">
            <div class="username">
                <div class="name"><b>{{ $user->name }}</b></div>
            </div>
            <div class="follow-list">

                <div class="center">
                    <p >投稿数</p>
                    <span>{{ $message_count }}</span>
                </div>
            </div>
        </div>

        <br>
        <br>

        <div class="row justify-content-center">
            @if (isset($timelines))
                @foreach ($timelines as $timeline)
                    <div class="col-md-8 mb-3">
                        <div class="card">
                            <div class="card-haeder p-3 w-100 d-flex">
                                <div class="ml-2 d-flex flex-column flex-grow-1">
                                    <p class="mb-0">{{ $timeline->user->name }}</p>
                                    <a href="{{ url('users/' .$timeline->user->id) }}" class="text-secondary">{{ $timeline->user->screen_name }}</a>
                                </div>
                                <div class="d-flex justify-content-end flex-grow-1">
                                    <p class="mb-0 text-secondary">{{ $timeline->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                {{ $timeline->message }}
                            </div>

                            <div class="card-footer py-1 d-flex justify-content-end bg-white">
                                <div class="ml-2 d-flex flex-column flex-grow-1">
                                    <p class="mb-0">{{ "#".$timeline->channel->channel_name }}</p>
                                </div>
                                @if ($timeline->user->id === Auth::user()->id)
                                    <div class="dropdown mr-3 d-flex align-items-center">
                                        <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-fw"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <form method="POST" action="{{ url('messages/' .$timeline->id) }}" class="mb-0">
                                                @csrf
                                                @method('DELETE')

                                                <a href="{{ url('messages/' .$timeline->id .'/edit') }}" class="dropdown-item">編集</a>
                                                <button type="submit" class="dropdown-item del-btn">削除</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif

                                <!-- ここから -->
                                <div class="mr-3 d-flex align-items-center">
                                    <a href="{{ url('messages/' .$timeline->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                    <p class="mb-0 text-secondary">{{ $timeline->getReplyCount($timeline->user->id, $timeline->id) }}</p>
                                </div>
                                <!-- ここまで -->

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </body>
</html>
