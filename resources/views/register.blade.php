<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>تۆمارکردن</title>
  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth-container">
  <h2>تۆمارکردن</h2>

  <input type="text" id="name" placeholder="ناو">
  <input type="email" id="email" placeholder="ئیمەیڵ">
  <input type="password" id="password" placeholder="وشەی نهێنی">

  <button onclick="register()">تۆمارکردن</button>

  <p>
    هەژمارت هەیە؟
    <a href="/login">چوونەژوورەوە</a>
  </p>
</div>

<script src="{{ asset('js/auth.js') }}"></script>
</body>
</html>
