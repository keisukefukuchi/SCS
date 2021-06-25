{{-- チャット詳細画面 --}}
@extends('layouts.app')
<style>
    .name {
        text-decoration: none;
        color: #000;
        font-size: 20px;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-haeder p-3 w-100 d-flex">
                    <div class="ml-2 d-flex flex-column">
                        <p class="mb-0 name">{{ $message->user->name }}</p>
                    </div>
                    <div class="d-flex justify-content-end flex-grow-1">
                        <p class="mb-0 text-secondary">{{ $message->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    {!! nl2br(e($message->message)) !!}
                </div>
                <div class="card-footer py-1 d-flex justify-content-end bg-white">
                    <div class="mr-3 d-flex align-items-center">
                        <form method="POST" action="{{ url('reply/show') }}" class="mb-0">
                            @csrf
                            <input type="hidden" name="channel_id" value="{{ $message->channel_id }}">
                            <input type="hidden" name="reply_id" value="{{ $message->id }}">
                            <button type="submit" class="btn p-0 border-0">返信する</button>
                        </form>
                    </div>
                    @if ($message->user->id === Auth::user()->id)
                        <div class="dropdown mr-3 d-flex align-items-center">
                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-fw"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form method="POST" action="{{ url('tweets/' .$message->id) }}" class="mb-0">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ url('tweets/' .$message->id .'/edit') }}" class="dropdown-item">編集</a>
                                    <button type="submit" class="dropdown-item del-btn">削除</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <div class="mr-3 d-flex align-items-center">
                        <a href="{{ url('messages/' .$message->id) }}"><i class="far fa-comment fa-fw"></i></a>
                        <p class="mb-0 text-secondary">{{ $message->getReplyCount($message->user->id, $message->id) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">

        <div class="col-md-8 mb-3">

            <ul class="list-group">

                @forelse ($replies as $reply)
                        <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0 name">{{ $reply->user->name }}</p>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $reply->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! nl2br(($reply->message)) !!}
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if ($reply->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <form method="POST" action="{{ url('tweets/' .$reply->id) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('tweets/' .$reply->id .'/edit') }}" class="dropdown-item">編集</a>
                                            <button type="submit" class="dropdown-item del-btn">削除</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('messages/' .$reply->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ $reply->getReplyCount($reply->user->id, $reply->id) }}</p>
                            </div>
                        </div>
                        </div>
                @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">返信はまだありません。</p>
                    </li>
                @endforelse

            </ul>
        </div>
    </div>
</div>
@endsection
