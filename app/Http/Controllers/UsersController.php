<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Message;

/**
 * Designer : 畑
 * Date     : 2021/06/14
 * Purpose  : C?-1 利用者処理
 */

class UsersController extends Controller
{

    /**
     * Function Name : index
     * Designer      : 畑
     * Date          : 2021/06/14
     * Function      : 利用者一覧画面を表示する
     * Return        : 利用者一覧画面
     */
    public function index()
    {
        $all_users = User::getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users' => $all_users
        ]);
    }

    /**
     * Function Name : show
     * Designer      : 畑
     * Date          : 2021/06/14
     * Function      : プロフィール画面を表示する
     * Return        : プロフィール画面
     */
    public function show(User $user)
    {
        $timelines = Message::getUserTimeLine($user->id);
        $message_count = Message::getMessageCount($user->id);

        return view('users.show', [
            'user' => $user,
            'timelines' => $timelines,
            'tweet_count' => $message_count,
        ]);
    }

    // 以下プロフィール編集用コード（実装予定なし）

    // public function edit(User $user)
    // {
    //     return view('users.edit', ['user' => $user]);
    // }

    // public function update(Request $request, User $user)
    // {
    //     $data = $request->all();
    //     $validator = Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //     ]);
    //     $validator->validate();
    //     $user->updateProfile($data);

    //     return redirect('users/'.$user->id);
    // }

}
