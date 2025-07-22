@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('login', 'login')

@section('page_name', 'Register')

@section('content')
<div class="register-form__container">
  <form class="register-form" action="{{ route('register') }}" method="POST">
    @csrf
    <div class="register-form__item">
      <label class="register-form__item-label" for="name">お名前</label>
      <input class="register-form__item-input" type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例: 山田 太郎">
      <div class="register-form__item-error">
        @error('name')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="register-form__item">
      <label class="register-form__item-label" for="email">メールアドレス</label>
      <input class="register-form__item-input" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
      <div class="register-form__item-error">
        @error('email')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="register-form__item">
      <label class="register-form__item-label" for="password">パスワード</label>
      <input class="register-form__item-input" type="password" name="password" id="password" placeholder="例: coachtech123">
      <div class="register-form__item-error">
        @error('password')
        {{ $message }}
        @enderror
      </div>
    </div>
    <div class="register-form__button">
      <button class="register-form__button-submit" type="submit">登録</button>
    </div>
  </form>
</div>
@endsection