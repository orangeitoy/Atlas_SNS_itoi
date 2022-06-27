<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 一対多？
     public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'follower', 'follow');
    }
    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'follow' , 'follower');
    }

    public function getAllUsers(Int $user_id)
    {
        return $this->Where('id', '<>', $user_id)->paginate(5);
    }

      // フォローする
    public function follow(Int $user_id)
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id)
    {
        return (boolean) $this->follows()->where('follower', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (boolean) $this->followers()->where('follow', $user_id)->first(['id']);
    }

     public function updateProfile(Array $params)
    {
        if (isset($params['profile_image'])) {
            $file_name = $params['profile_image']->store('public/profile_image/');

            $this::where('id', $this->id)
                ->update([
                    'username'          => $params['username'],
                    'images' => basename($file_name),
                    'mail'         => $params['mail'],
                    'password'      => bcrypt($params['password']),
                    'bio'          => $params['bio']
                ]);
        } else {
            $this::where('id', $this->id)
                ->update([
                    'username'          => $params['username'],
                    'mail'         => $params['mail'],
                    'password'      => bcrypt($params['password']),
                    'bio'          => $params['bio']
                ]);
        }

        return;
    }
}
