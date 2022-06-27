<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Models\Tweet;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index(User $user)
    {
        $user = new User;
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users'  => $all_users
        ]);
    }

    public function profile(){
        $user = Auth::user();
         return view ('users.profile',[
            'user' => $user
        ]);
    }


//     public function getIndex()
//  　　{
//  　　 return view('validation.index');
// 　　  });
//      }
    public function confirm(Request $request){
        $validateRules = [
            'username' => 'required',//必須
            'mail' => 'required',//必須
            'password' => 'required|string',//必須且つ文字列
            'password comfirm' => 'required|string|confirmed',//必須且つ文字列でパスワードと一致要
            'bio' => 'max30'//自己紹介は３０文字まで
            ];

        $validateMessages = [
        "required" => "必須項目です。",//空の時にこのメッセージ
         ];

       $this->validate($request, $validateRules, $validateMessages);

        $data = $request->all();

        return view('validation.confirm')->with($data);

    }

    public function search(){
        $users = User::get();
        return view ('users.search',[
            'users' => $users
        ]);
    }
    public function search_result(Request $request){
        $username = $request->username;
        if(!empty($username) ){
      $query = User::query();
      $users = $query->where('username','like', '%' .$username. '%')->get();

      $message = "「". $username."」を含む名前の検索が完了しました。";
        return view('users.search',[
         'users' => $users,
        'message' => $message,
      ]);
      } elseif(empty($username)){
          $users = User::get();
          return view('users.search',[
              'users' => $users,
          ]);
        }
    }
    public function sugasouri(){
      Auth::logout();
        return redirect('login');
    }

     // フォロー
    public function follow(User $user)
    {
        $follower = auth()->user();
        // フォローしているかどうか
        $is_following = $follower->isFollowing($user->id);
        if(!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // リムる
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているかどうか
        $is_following = $follower->isFollowing($user->id);
        if($is_following) {
            // フォローしていればリムる
            $follower->unfollow($user->id);
            return back();
        }
    }

      public function show(User $user, Post $post, Follower $follow)
    {
        $login_user = auth()->user();
        $is_following = $login_user->isFollowing($user->id);
        $is_followed = $login_user->isFollowed($user->id);
        $timelines = $post->getUserTimeLine($user->id);
        $tweet_count = $post->getTweetCount($user->id);
        $follow_count = $follower->getFollowCount($user->id);
        $follower_count = $follower->getFollowerCount($user->id);

        return view('users.show', [
            'user'           => $user,
            'is_following'   => $is_following,
            'is_followed'    => $is_followed,
            'timelines'      => $timelines,
            'tweet_count'    => $tweet_count,
            'follow_count'   => $follow_count,
            'follower_count' => $follower_count
        ]);
    }

    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }


}
