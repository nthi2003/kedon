<?php
require_once '../connection/connect.php';

function check($id)
{
  if ($id > 0) {
    return true;
  } else {
    return false;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kê đơn</title>
  <link rel="stylesheet" href="../style_light.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
  <script>
    function getValue() {
      var selectElement = document.getElementById("nameP");
      var selectedValue = selectElement.options[selectElement.selectedIndex].value;
      console.log("f:" + selectedValue);
      // Gửi giá trị đến PHP bằng Ajax
      window.location.href = 'new_prescription_detail.php?prescriptionId=0&patientId=' + selectedValue;
    }
  </script>
  <header>
    <a href="../index.php">QUẢN TRỊ ĐƠN THUỐC</a>
  </header>
  <div class="content">
    <h2>Kê đơn</h2>

    <div style="margin-left: 180px;">
      <form action="../unitTest.php" method="post" class="form">
        <input type="hidden" name="prescription_detail" value="1">
        <div class="f">
          <label for="name">Bệnh nhân:</label>
          <?php
          $sql = 'SELECT pat.TenBenhNhan AS patientName FROM donthuoc AS pre JOIN benhnhan as pat ON pre.BenhNhanId = pat.BenhNhanId WHERE pre.DonThuocId =  ' . $_GET["prescriptionId"] . '';
          $result = $conn->query($sql);

          if ($result) {
            while ($row = $result->fetch_assoc()) {
              echo '<input type="text" class="form-input" name="name" value="' . $row['patientName'] . '" placeholder="Tên">';
            }
          } else {
            die('Error: ' . mysqli_error($conn));
          }
          ?>
        </div>
        <div class="f">
          <label for="prescriptionId">Đơn thuốc số:</label>
          <input type="text" class="form-input" name="prescriptionId" value="<?php echo $_GET['prescriptionId']; ?>">
        </div>
        <div class="f">
          <label>Chọn thuốc</label>
          <?php
          $sql = 'SELECT thuocId, tenThuoc FROM thuoc';
          $result = $conn->query($sql);
          if ($result) {
            echo '<select class="form-input" name="medicine" >';
            echo '<option value="0">Chọn thuốc</option>';
            while ($row = $result->fetch_assoc()) {
              echo '<option value="' . $row['thuocId'] . '">' . $row['tenThuoc'] . '</option>';
            }

            echo '</select>';
          } else {
            die('Error: ' . mysqli_error($conn));
          }
          ?>
        </div>
        <div class="f">
          <label for="dose_only">Liều dùng 1 lần</label>
          <input type="text" class="form-input" name="dose_only" placeholder="ví dụ: 2 viên">
        </div>
        <div class="f">
          <label>Số lần dùng trong ngày</label>
          <select class="form-input" name="dose_day">
            <option value="2">2/buổi (sáng / tối)</option>
            <option value="3">3/buổi (sáng / trưa / tối)</option>
          </select>
        </div>
        <div class="f">
          <label for="frequency">Số ngày uống</label>
          <input type="text" class="form-input" name="frequency" placeholder="ví dụ: 3 ngày">
        </div>
        <button style="margin-right: 800px;" type="submit" class="button-form">Lưu thông tin</button>
      </form>

    </div>
  </div>

</body>

</html>