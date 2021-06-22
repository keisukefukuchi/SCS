{{-- ユーザ一覧画面 --}}
@extends('layouts.app')

@section('content')
<section class="user-list">
    <p class="section-title">ユーザ一覧</p>
    @foreach ($all_users as $user)
        <div class="user-list_card">
            <a href="{{ url('users/' .$user->id) }}" class="user-list_card-wrapper">
                <div class="user-list_profile">
                    <div class="user-list_profile-text">
                        <p class="user-name">{{ $user->name }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</section>
@endsection
