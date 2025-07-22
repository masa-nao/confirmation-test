<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation Test</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  @yield('css')
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <h1 class="header__logo">FashionablyLate</h1>
      <nav class="header-nav">
        @if (Route::currentRouteName() === 'login.show')
        <a class="header-nav__link" href="{{ route('register.show') }}">
          @yield('register')
        </a>
        @elseif (Route::currentRouteName() === 'register.show')
        <a class="header-nav__link" href="{{ route('login.show') }}">
          @yield('login')
        </a>
        @elseif (Route::currentRouteName() === 'admin.show')
        @yield('loguout')
        @endif
      </nav>
    </div>
  </header>

  <main class="main">
    <div class="page-name__wrapper">
      <h2 class="page-name">
        @yield('page_name')
      </h2>
    </div>
    <div class="content">
      @yield('content')
    </div>
  </main>
</body>

</html>