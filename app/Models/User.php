<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Designer : 畑
 * Date     : 2021/06/14
 * Purpose  : C?-1 利用者情報管理
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'student_number',
        'password',
    ];

    /**
     * Function Name : getAllUsers
     * Designer      : 畑
     * Date          : 2021/06/14
     * Function      : 自分以外の利用者の取得
     * Return        : Collection
     */
    public static function getAllUsers(Int $user_id)
    {
        $all_users = self::where('id', '<>', $user_id)->get();
        return $all_users;
    }

    // 未使用
    /**
     * Function Name : updateProfile
     * Designer      : 畑
     * Date          : 2021/06/14
     * Function      : 利用者データを更新する
     * Return        :
     */
    // public function updateProfile(Array $params)
    // {
    //     $this->where('id', $this->id)
    //             ->update([
    //                 'name' => $params['name'],
    //             ]);
    //     return;
    // }

    /**
     * Function Name : store
     * Designer      : 畑
     * Date          : 2021/06/14
     * Function      : 利用者データを登録する
     * Return        : Userオブジェクト
     */
    public static function store($name, $student_number, $password)
    {
        $user = new self([
            'name'            => $name,
            'student_number'  => $student_number,
            'password'        => $password
        ]);
        $user->save();
        return $user;
    }
}
