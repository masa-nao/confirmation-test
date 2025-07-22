@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('page_name', 'Confirm')

@section('content')
<div class="confirm__container">
  <form class="confirm-form" action="{{ route('store') }}" method="POST">
    @csrf
    <div class="confirm-table">
      <table class="confirm-table__inner">
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="last_name" value="{{ $form['last_name'] }}">
            <input class="confirm-table__item-input" type="hidden" name="first_name" value="{{ $form['first_name'] }}">
            <span class="span--last-name">{{ $form['last_name'] }}</span>
            <span class="span--first-name">{{ $form['first_name'] }}</span>
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">性別</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="gender" value="{{ $form['gender'] }}">
            {{ $form['gender_label'] }}
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="email" value="{{ $form['email'] }}">
            {{ $form['email'] }}
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="tel" value="{{ $form['tel'] }}">
            {{ $form['tel'] }}
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">住所</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="address" value="{{ $form['address'] }}">
            {{ $form['address'] }}
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">建物名</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="building" value="{{ $form['building'] }}">
            {{ $form['building'] }}
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="category_id" value="{{ $form['category_id'] }}">
            {{ $form['content_label'] }}
          </td>
        </tr>
        <tr class="confirm-table__row">
          <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__item">
            <input class="confirm-table__item-input" type="hidden" name="detail" value="{{ $form['detail'] }}">
            {{ $form['detail'] }}
          </td>
        </tr>
      </table>
      <div class="confirm__button">
        <button class="confirm__button-submit" type="submit">送信</button>
        <button class="confirm__button-fix" type="button" onclick="history.back()">修正</button>
      </div>
    </div>
  </form>
</div>
@endsection