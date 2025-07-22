@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('loguout')
<form class="logout-form" action="{{ route('logout') }}" method="POST">
  @csrf
  <button class="logout-form__button-submit" type="submit">logout</button>
</form>
@endsection

@section('page_name', 'Admin')

@section('content')
<div class="admin__content">
  <div class="search-form__container">
    <form class="search-form" action="{{ route('admin.search') }}" method="POST">
      @csrf
      <div class="search-form__item">
        <input class="search-form__item-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

        <div class="select__wrapper">
          <select class="search-form__item-select gender" name="gender">
            <option value="">性別</option>
            @foreach($genders as $value => $label)
            <option value="{{ $value }}" {{ request('gender') == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
        </div>
        <div class="select__wrapper">
          <select class="search-form__item-select type" name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
              {{ $category->content }}
            </option>
            @endforeach
          </select>
        </div>
        <div class="input__wrapper">
          <input class="search-form__item-input date" type="date" name="created_at" value="{{ request('created_at') }}">
        </div>

        <div class="search-form__button">
          <button class="search-form__button-submit" type="submit">検索</button>
        </div>
        <div class="search-form__button">
          <a class="search-form__button-submit reset" href="{{ route('admin.show') }}">リセット</a>
        </div>
      </div>
    </form>
  </div>
  <div class="admin-utilities">
    <div class="export__button">
      <form class="export-form" action="{{ route('admin.export') }}" method="GET">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="gender" value="{{ request('gender') }}">
        <input type="hidden" name="category_id" value="{{ request('category_id') }}">
        <input type="hidden" name="created_at" value="{{ request('created_at') }}">
        <button class="export__button-submit" type="submit">エクスポート</button>
      </form>
    </div>
    <div class="pagination">
      @if ($contacts->lastPage() > 1)
      <div class="pagination-custom">
        @if ($contacts->onFirstPage())
        <span class="pagination-disabled">&lt;</span>
        @else
        <a href="{{ $contacts->previousPageUrl() }}" class="pagination-link">&lt;</a>
        @endif

        @for ($i = 1; $i <= $contacts->lastPage(); $i++)
          @if ($i == $contacts->currentPage())
          <span class="pagination-current">{{ $i }}</span>
          @else
          <a href="{{ $contacts->url($i) }}" class="pagination-link">{{ $i }}</a>
          @endif
          @endfor

          @if ($contacts->hasMorePages())
          <a href="{{ $contacts->nextPageUrl() }}" class="pagination-link">&gt;</a>
          @else
          <span class="pagination-disabled">&gt;</span>
          @endif
      </div>
      @endif
    </div>
  </div>
  <div class="admin-table">
    <table class="admin-table__inner">
      <tr class="admin-table__row">
        <th class="admin-table__header">お名前</th>
        <th class="admin-table__header">性別</th>
        <th class="admin-table__header">メールアドレス</th>
        <th class="admin-table__header">お問い合わせの種類</th>
        <th class="admin-table__header"></th>
      </tr>
      @foreach($contacts as $contact)
      <tr class="admin-table__row">
        <td class="admin-table__item">
          <span class="label--last-name">{{ $contact->last_name }}</span>
          <span class="label--first-name">{{ $contact->first_name }}</span>
        </td>
        <td class="admin-table__item">{{ $contact->gender_label }}</td>
        <td class="admin-table__item">{{ $contact->email }}</td>
        <td class="admin-table__item">{{ $contact->category->content }}</td>
        <td class="admin-table__button">
          <button class="admin-table__button-detail--open" type="button" onclick="document.getElementById('modal{{ $contact->id }}').showModal()">詳細</button>
        </td>
      </tr>

      <dialog id="modal{{ $contact->id }}">
        <form class="detail-form" action="{{ route('admin.delete', ['id' => $contact->id]) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="admin-table__button-detail--close" type="button" onclick="document.getElementById('modal{{ $contact->id }}').close()"></button>
          <div class="detail-form__group">
            <div class="detail-form__item ">
              <p class="detail-form__item-label">お名前</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span">
                <span class="span--last-name">{{ $contact->last_name }}</span>
                <span class="span--first-name">{{ $contact->first_name }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__group">
            <div class="detail-form__item">
              <p class="detail-form__item-label">性別</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span">
                <span>{{ $contact->gender_label }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__group">
            <div class="detail-form__item">
              <p class="detail-form__item-label">メールアドレス</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span">
                <span>{{ $contact->email }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__group">
            <div class="detail-form__item">
              <p class="detail-form__item-label">電話番号</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span">
                <span>{{ $contact->tel }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__group">
            <div class="detail-form__item">
              <p class="detail-form__item-label">住所</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span">
                <span>{{ $contact->address }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__group">
            <div class="detail-form__item">
              <p class="detail-form__item-label">建物名</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span">
                <span>{{ $contact->building }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__group">
            <div class="detail-form__item">
              <p class="detail-form__item-label">お問い合わせの種類</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span">
                <span>{{ $contact->category->content }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__group">
            <div class="detail-form__item">
              <p class="detail-form__item-label">お問い合わせ内容</p>
            </div>
            <div class="detail-form__item">
              <div class="detail-form__item-span optional">
                <span>{{ $contact->detail }}</span>
              </div>
            </div>
          </div>
          <div class="detail-form__button">
            <button class="detail-form__button-submit" type="submit">削除</button>
          </div>
        </form>
      </dialog>
      @endforeach
    </table>
  </div>
</div>
@endsection