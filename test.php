<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP và JavaScript</title>
</head>

<body>

  <h1>Xin chào từ PHP và JavaScript</h1>

  <script>
    // Phần JavaScript
    function redirectToPHP() {
      var get = document.getElementById("nameP");
      var val = get.options[get.selectedIndex].value;
      console.log("F: " + val);

      // Chuyển hướng đến trang PHP với query string
      window.location.href = 'test.php?jsData=' + val;
    }
  </script>

  <?php
  // Phần PHP (trong cùng file hoặc có thể trong một tệp PHP khác)
  if (isset($_GET['jsData'])) {
    $dataFromJavaScript = $_GET['jsData'];
    echo "Hello from PHP. Received data from JavaScript: $dataFromJavaScript";
  }
  ?>

  <!-- Sử dụng sự kiện onchange để gọi hàm JavaScript khi giá trị thay đổi -->
  <select name="nameP" id="nameP" onchange="redirectToPHP()">
    <option value="0">1</option>
    <option value="1">h</option>
    <option value="2">y</option>
  </select>

</body>

</html>