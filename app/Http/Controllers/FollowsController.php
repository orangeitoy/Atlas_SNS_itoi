<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;

use App\Http\Controllers\Controller;

use Auth;

class FollowsController extends Controller
{
    public function __construct()
  {
    $this->middleware(['auth', 'verified'])->only(['follow', 'unfollow']);
  }

  public function following($id)
  {
        \DB::table('follows')->insert([
        'follower' => $id,
        'follow' => Auth::id(),
        ]);
    return redirect()->back();
  }

  public function unfollowing($id)
  {
    \DB::table('follows')
    ->where('follower', $id)
    ->where('follow', Auth::id())
    ->delete();

    return redirect()->back();
  }

    public function followList(){
        return view('follows.followList');
    }
    public function followerList(){
        return view('follows.followerList');
    }
}
