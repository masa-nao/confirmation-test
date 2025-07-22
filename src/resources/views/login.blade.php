@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('register', 'register')

@section('page_name', 'Login')

@section('content')
<div class="login-form__container">
  <form class="login-form" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="login-form__item">
      <label class="login-form__item-label" for="email">メールアドレス</label>
      <input class="login-form__item-input" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
      <div class="login-form__item-error">
        @error('email')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="login-form__item">
      <label class="login-form__item-label" for="password">パスワード</label>
      <input class="login-form__item-input" type="password" name="password" id="password" placeholder="例: coachtech123">
      <div class="login-form__item-error">
        @error('password')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="login-form__button">
      <button class="login-form__button-submit" type="submit">ログイン</button>
    </div>
  </form>
</div>
@endsection