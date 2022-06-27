@extends('layouts.login')

@section('content')
<div style="margin-top:50px;">
<form action="{{route('search_result')}}" method="post">
  @csrf
  <input type="text" name="username">
  <button type="submit">検索</button>
</form>
<h1>検索結果</h1>
@if(!empty($message))
  @foreach($users as $user)
    <p>{{$user->username}}</p>
  @endforeach
<div class="alert alert-primary" role="alert">{{ $message}}</div>
@else
  @foreach($users as $user)
  @if($user->id != Auth::user()->id)
    <p>{{$user->username}}</p>
    @if (Auth::user()->isFollowing($user->id))
    <a href="{{ route('unfollow', ['id' => $user->id]) }}" class="btn btn-success btn-sm">フォロー解除</a>
    @else
    <a href="{{ route('follow', ['id' => $user->id]) }}" class="btn btn-secondary btn-sm">フォロー</a>
    @endif
  @endif
  @endforeach
@endif
</div>
@endsection
