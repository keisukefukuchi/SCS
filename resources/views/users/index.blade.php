{{-- ユーザ一覧画面 --}}
@extends('layouts.app')

@section('content')
<section class="user-list">
    <p class="section-title">ユーザ一覧</p>
    @foreach ($all_users as $user)
        <div class="user-list_card">
            <a href="{{ url('users/' .$user->id) }}" class="user-list_card-wrapper">
                <div class="user-list_profile">
                    <img src="{{ asset('/img/test.png') }}" alt="no-image" class="user-list_profile-img">
                    <div class="user-list_profile-text">
                        <p class="user-name">{{ $user->name }}</p>
                        <p class="screen-name">{{ $user->screen_name }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
    <div class="my-4 d-flex justify-content-center">
        {{ $all_users->links() }}
    </div>
</section>
@endsection
