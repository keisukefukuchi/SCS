<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

/**
 * Designer : 畑
 * Date     : 2021/06/14
 * Purpose  : C?-1 検索処理
 */

class SearchController extends Controller
{
    /**
     * Function Name : index
     * Designer      : 畑
     * Date          : 2021/06/14
     * Function      : 検索画面及び、検索結果を表示する
     * Return        : 検索画面、検索結果
     */
    public function index(Request $request){
        $user = auth()->user();
        $keyword = $request->keyword;

        if(!empty($keyword)){
            $messages_data = Message::messagesSearch($keyword);
            return view('search.index', [
                'user' => $user,
                'messages_data' => $messages_data,
                'keyword' => $keyword
            ]);
        }

        return view('search.index', [
            'user' => $user,
            'messages_data' => [],
            'keyword' => '検索ワード'
        ]);
    }
}
