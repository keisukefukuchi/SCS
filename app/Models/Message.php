<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assingnable.
     *
     * @var array
     */

    protected $fillable = [
       'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function messages()
    {
        return $this->hasMany(message::class);
    }

    public function getUserTimeLine(Int $user_id)
    {
        return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
    }

    public function getMessageCount(Int $user_id)
    {
        return $this->where('user_id', $user_id)->count();
    }

    //指定ユーザIDとメッセージID(id)に合致する返信件数を取得する
    public function getReplyCount(Int $user_id, Int $message_id)
    {
        return $this->where('user_id', $user_id)->where('reply_id', $message_id)->count();
    }
    
    //指定ユーザIDとメッセージID(id)に合致する返信テーブルを取得する
    public function getReply(Int $user_id, Int $message_id)
    {
        return $this->where('user_id', $user_id)->where('reply_id', $message_id);
    }

     // 一覧画面
    public function getTimeLines(Int $user_id, Array $follow_ids, Int $channel_id)
    {
        // 自身とフォローしているユーザIDを結合する
        $follow_ids[] = $user_id;
        return $this->whereIn('user_id', $follow_ids)->where('channel_id', $channel_id)->orderBy('created_at', 'DESC')->paginate(50);
    }

     // 詳細画面
    public function getMessage(Int $message_id)
    {
        return $this->with('user')->where('id', $message_id)->first();
    }

    public function messageStore(Int $user_id, Array $data)
    {
        $this->user_id = $user_id;
        $this->message = $data['message'];
        //$this->reply_id = $data['reply_id'];
        $this->reply_id = 1;
        $this->channel_id = $data['channel_id'];
        $this->save();

        return;
    }

    public function getEditMessage(Int $user_id, Int $message_id)
    {
        return $this->where('user_id', $user_id)->where('id', $message_id)->first();
    }

    public function messageUpdate(Int $message_id, Array $data)
    {
        $this->id = $message_id;
        $this->message = $data['message'];
        $this->update();

        return;
    }

    public function messageDestroy(Int $user_id, Int $message_id)
    {
        return $this->where('user_id', $user_id)->where('id', $message_id)->delete();
    }

    public function messageSearch(string $keyword)
    {
        return $this->where('message', 'like', '%'.$keyword.'%')->orderBy('created_at', 'DESC')->paginate(50);
    }
}
