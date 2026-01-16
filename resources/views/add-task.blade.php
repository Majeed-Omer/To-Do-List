<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>ئەرکی نوێ</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="add-page">

<header class="add-header">
  <button class="back-btn" onclick="history.back()">→</button>
  <h3>ئەرکی نوێ</h3>
</header>

<div class="add-content">

  <label>ناوی ئەرک</label>
  <input
    type="text"
    id="newTaskInput"
    placeholder="ئەرکەکە بنووسە..."
  >

  <label>ڕێکەوتی ئەرک</label>
  <div class="date-row">
    <input type="datetime-local" id="newTaskDateTime">

  </div>

</div>

<!-- Bottom Save Button -->
<button class="save-task-btn" onclick="saveNewTask()">
  ✓ زیادکردنی ئەرک
</button>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
