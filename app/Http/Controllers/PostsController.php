<?php

namespace App\Http\Controllers;//このページはappの中にあるhttpの中にあるコントローラーズの中にある

use Illuminate\Http\Request;//リクエストを使用する

use Illuminate\Support\Facades\Auth;//オースを使用する

use App\Post;//ポストを使用する

use Carbon\Carbon;//カーボンを使用する

class PostsController extends Controller//コントローラーの機能を引き継ぐ
{
    //
    public function index(){
        $posts = Post::get();
        return view('posts.index', [
            'posts' => $posts
        ]);
    }
    public function create(Request $request)
    {
        $post = $request->input('post_create');
        $user_id = Auth::id();

        \DB::table('posts')->insert([
            'posts' => $post,
            'user_id' => $user_id,
            'created_at' => Carbon::now(),
        ]);

        return redirect('top');
    }

    public function delete($id)
    {
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('top');
    }


}
