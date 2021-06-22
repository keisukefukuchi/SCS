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
                @forelse ($reply as $comment)
                        <div class="card">
                        <div class="card-haeder p-3 w-100 d-flex">
                            <div class="ml-2 d-flex flex-column">
                                <p class="mb-0 name">{{ $comment->user->name }}</p>
                            </div>
                            <div class="d-flex justify-content-end flex-grow-1">
                                <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            {!! nl2br(($comment->message)) !!}
                        </div>
                        <div class="card-footer py-1 d-flex justify-content-end bg-white">
                            @if ($comment->user->id === Auth::user()->id)
                                <div class="dropdown mr-3 d-flex align-items-center">
                                    <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-fw"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <form method="POST" action="{{ url('tweets/' .$comment->id) }}" class="mb-0">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ url('tweets/' .$comment->id .'/edit') }}" class="dropdown-item">編集</a>
                                            <button type="submit" class="dropdown-item del-btn">削除</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="mr-3 d-flex align-items-center">
                                <a href="{{ url('messages/' .$comment->id) }}"><i class="far fa-comment fa-fw"></i></a>
                                <p class="mb-0 text-secondary">{{ $comment->getReplyCount($comment->user->id, $comment->id) }}</p>
                            </div>
                        </div>
                        </div>
                @empty
                    <li class="list-group-item">
                        <p class="mb-0 text-secondary">コメントはまだありません。</p>
                    </li>
                @endforelse
                <li class="list-group-item">
                    <div class="py-3">
                        <form method="POST" action="{{ url('reply/store') }}">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-12 p-3 w-100 d-flex">
                                    <div class="ml-2 d-flex flex-column">
                                        <p class="mb-0 name">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="channel_id" value="{{ $message->channel_id }}">
                                    <input type="hidden" name="reply_id" value="{{ $message->id }}">
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" required autocomplete="message" rows="4">{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-right">
                                    <p class="mb-4 text-danger">140文字以内</p>
                                    <button type="submit" class="btn btn-primary">
                                        投稿する
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
