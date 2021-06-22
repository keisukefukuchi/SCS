{{-- 投稿画面 --}}
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $channel_name . 'チャンネル'}}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}">
                        @csrf
                        <input type="hidden" name="channel_id" value="{{ $channel_id }}">
                        <div class="form-group row mb-0">
                            <div class="col-md-12 p-3 w-100 d-flex">
                                <div class="ml-2 d-flex flex-column">
                                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary mb-0 name">{{ $user->screen_name }}</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea class="form-control @error('text') is-invalid @enderror" name="text" required autocomplete="text" rows="4">{{ old('text') }}</textarea>
                                @error('text')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 text-right">
                                <p class="mb-4 text-danger"></p>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-pen" class="fa fa-fw"></i>　投稿する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
