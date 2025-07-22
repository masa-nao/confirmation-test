@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('page_name', 'Contact')

@section('content')
<div class="contact-form__container">
  <form class="contact-form" action="{{ route('confirm') }}" method="POST">
    @csrf
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label" for="last_name">お名前</label>
      </div>
      <div class="contact-form__item">
        <div class="contact-form__item-inputs">
          <input class="contact-form__item-input last-name" type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="例: 山田">
          <input class="contact-form__item-input first-name" type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="例: 太郎">
        </div>
        <div class="contact-form__item-error optional">
          <div class="error--first-name">
            @error('last_name')
            {{ $message }}
            @enderror
          </div>
          <div class="error--first-name">
            @error('first_name')
            {{ $message }}
            @enderror
          </div>
        </div>
      </div>
    </div>
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label" for="gender_male">性別</label>
      </div>
      <div class="contact-form__item">
        <div class="contact-form__item-inputs optional">
          <input class="contact-form__item-input male" type="radio" name="gender" id="gender_male" value="1" {{ old('gender', '1') === '1' ? 'checked' : '' }}><span>男性</span>
          <input class="contact-form__item-input female" type="radio" name="gender" id="gender_female" value="2" {{ old('gender') === '2' ? 'checked' : '' }}><span>女性</span>
          <input class="contact-form__item-input other" type="radio" name="gender" id="gender_other" value="3" {{ old('gender') === '3' ? 'checked' : '' }}><span>その他</span>
        </div>
        <div class="contact-form__item-error">
          @error('gender')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label" for="email">メールアドレス</label>
      </div>
      <div class="contact-form__item">
        <input class="contact-form__item-input" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
        <div class="contact-form__item-error">
          @error('email')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label" for="first_tel">電話番号</label>
      </div>
      <div class="contact-form__item">
        <div class="contact-form__item-inputs">
          <input class="contact-form__item-input first-tel" type="number" name="first_tel" id="first_tel" value="{{ old('first_tel') }}" placeholder="080"><span>-</span>
          <input class="contact-form__item-input middle-tel" type="number" name="middle_tel" id="middle_tel" value="{{ old('middle_tel') }}" placeholder="1234"><span>-</span>
          <input class="contact-form__item-input last-tel" type="number" name="last_tel" id="last_tel" value="{{ old('last_tel') }}" placeholder="5678">
        </div>
        <div class="contact-form__item-error">
          @error('first_tel')
          {{ $message }}
          @enderror
          @error('middle_tel')
          {{ $message }}
          @enderror
          @error('last_tel')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label" for="address">住所</label>
      </div>
      <div class="contact-form__item">
        <input class="contact-form__item-input" type="text" name="address" id="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
        <div class="contact-form__item-error">
          @error('address')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label optional" for="building">建物名</label>
      </div>
      <div class="contact-form__item">
        <input class="contact-form__item-input" type="text" name="building" id="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
        <div class="contact-form__item-error">
          @error('building')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label" for="content">お問い合わせの種類</label>
      </div>
      <div class="contact-form__item select">
        <div class="select__wrapper">
          <select class="contact-form__item-select" name="content" id="content">
            <option value="">選択してください</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('content') == $category->id ? 'selected' : '' }}>
              {{ $category->content }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="contact-form__item-error">
          @error('content')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="contact-form__group">
      <div class="contact-form__item">
        <label class="contact-form__item-label" for="detail">お問い合わせ内容</label>
      </div>
      <div class="contact-form__item">
        <textarea class="contact-form__item-textarea" name="detail" id="detail" placeholder="例: お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
        <div class="contact-form__item-error">
          @error('detail')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>

    <div class="contact-form__button">
      <button class="contact-form__button-submit" type="submit">確認画面</button>
    </div>
  </form>
</div>
@endsection