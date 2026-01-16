<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>چوونەژوورەوە</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">
  <h2>چوونەژوورەوە</h2>

  <input type="email" id="loginEmail" placeholder="ئیمەیڵ">
  <input type="password" id="loginPassword" placeholder="وشەی نهێنی">

  <button onclick="login()">چوونەژوورەوە</button>

  <p>
    هەژمارت نیە؟
    <a href="/register">تۆماردکردن</a>
  </p>
</div>

<script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
