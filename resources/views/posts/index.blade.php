@extends('layouts.login')

@section('content')
<form action="/post/create" method="post">
  @csrf
  <input type="text" name="post_create">
  <button type="submit">投稿</button>
</form>

@foreach($posts as $post)
<ul>
<li>{{$post->posts}}</li>
<li>{{$post->created_at}}</li>
<li>{{$post->user->username}}</li>
@if(Auth::id() == $post->user_id)
  <td><a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除しますか？')">削除</a></td>
  @endif
            </tr>
</ul>
@endforeach
@endsection
