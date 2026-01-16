<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ئەرکەکانم</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="app-header">
  <h2>📋 هەموو ئەرکەکان</h2>
</header>

<div class="todo-wrapper">
  <ul id="taskList"></ul>
</div>

<!-- Floating Add Button -->
<button class="fab" onclick="location.href='/add-task'">＋</button>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
