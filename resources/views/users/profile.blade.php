@extends('layouts.login')

@section('content')
                  <div class="card-body">
                    <form method="POST" action="/update" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row align-items-center">
                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                            <div class="col-md-6 d-flex align-items-center">
                                <img src="{{ $user->profile_image }}" class="mr-2 rounded-circle" width="80" height="80" alt="profile_image">
                                <input type="file" name="profile_image" class="@error('profile_image') is-invalid @enderror" autocomplete="profile_image">

                                @error('profile_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('user Name') }}</label>
                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mail" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="mail" type="mail" class="form-control @error('mail') is-invalid @enderror" name="mail" value="{{ $user->mail }}" required autocomplete="mail">

                                @error('mail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード -->
                        <div class="form-group row" lass="col-md-4 col-form-label text-md-right">
                            <label for=" password">{{ __('password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" name="password" required autocomplete="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- パスワード確認用-->
                        <div class="form-group row" lass="col-md-4 col-form-label text-md-right">
                            <label for=" password comfirm">{{ __('password comfirm') }}</label>
                            <div class="col-md-6">
                                <input id="password comfirm" type="password" name="password_confirmation">

                                @error('password comfirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- zikosyoukai-->
                        <div class="form-group row">
                            <label for="bio" class="col-md-4 col-form-label text-md-right">{{ __('bio') }}</label>
                            <div class="col-md-6">
                                <input id="bio" type="text" class="form-control"  name="bio" value="{{ $user->bio }}" required autocomplete="bio">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <input type="submit" class="btn btn-primary">更新する</input>
                            </div>
                        </div>
                     </form>
                   </div>



@endsection
