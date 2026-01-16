<!DOCTYPE html>
<html lang="ku" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>گۆڕینی ئەرک</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="add-task-body">

<header class="mobile-header">
  <button class="back-btn" onclick="history.back()">→</button>
  <h2>گۆڕینی ئەرک</h2>
</header>

<div class="add-task-page">

  <label class="field-label">ئەرک چییە؟</label>
  <div class="input-row">
    <input
      type="text"
      id="editTaskInput"
      placeholder="ئەرک بنووسە..."
    >
  </div>
 
  <label class="field-label">بەروار و کات</label>
  <div class="input-row">
    <input type="datetime-local" id="editTaskDateTime"/>
  </div>

</div>

<!-- Bottom Save Button -->
<button class="bottom-save-btn" onclick="updateTask()">
  ✔️ تەواوبوون
</button>

<script>
  const TASK_ID = {{ $taskId }};
</script>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
