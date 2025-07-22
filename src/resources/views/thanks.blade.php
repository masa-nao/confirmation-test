<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation Test</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}">
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
  <div class="thanks__container">
    <div class="thanks__bg-message">
      <span>Thank you</span>
    </div>
    <p class="thanks__message">お問い合わせありがとうございました。</p>
    <a class="thanks__link" href="{{ route('index') }}">HOME</a>
  </div>
</body>

</html>