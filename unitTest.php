<?php
require_once './connection/connect.php';

function checkDose($conn, $medicine, $dose_only, $dose_day, $day)
{
    $sql_medicine = "SELECT * FROM thuoc where thuocId = $medicine";
    $result = $conn->query($sql_medicine);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $doseMin = $row['lieuToiThieu'];
            $doseMax = $row['LieuToiDa'];
            $frequency = $row['TanXuat'];
            $dose_day_check = $dose_only * $dose_day;
            $dose_all_check = $dose_day_check * $day;
            $dose_one_day = ($dose_day_check <= $frequency);
            $dose_all = ($doseMin < $dose_all_check && $doseMax > $dose_all_check);

            if (!$dose_one_day) {
                echo '<script>alert("Bạn nhập liều dùng trong 1 ngày: ' . $dose_day_check . ' viên là không hợp lý vì liều dùng tối đa trong một ngày là ' . $frequency . ' viên");</script>';
                echo '<script>window.history.back();</script>';
                return false;
            } else if ($dose_all_check < $doseMin) {
                echo '<script>alert("Tổng liều dùng của bạn nhập:' . $dose_all_check . ' nhỏ hơn liều dùng tối thiểu:' . $doseMin . '");</script>';
                echo '<script>window.history.back();</script>';
                return false;
            } else if ($dose_all_check > $doseMax) {
                echo '<script>alert("Tổng liều dùng của bạn nhập:' . $dose_all_check . ' lớn hơn liều dùng tối đa:' . $doseMax . '");</script>';
                echo '<script>window.history.back();</script>';
                return false;
            }
        }
        return true;
    } else {
        echo "Không tìm thấy thuốc với ID = $medicine";
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['prescription_detail'])) {
        $prescription_id = $_POST['prescriptionId'];
        $medicine = $_POST['medicine'];
        $dose_only = $_POST['dose_only'];
        $dose_day = $_POST['dose_day'];
        $day = $_POST['frequency'];

        $dosageIsValid = checkDose($conn, $medicine, $  , $dose_day, $day);

        if ($dosageIsValid) {
            $sql = "INSERT INTO chitietdonthuoc (DonThuocId, thuocId, doseOnly, doseDay, tinhthuongxuyen) VALUES ('$prescription_id', '$medicine', '$dose_only', '$dose_day', '$day')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo '<script>alert("Thông tin kê đơn đã được lưu thành công.");';
                echo 'setTimeout(function() { window.location.href = "./prescription-detail/index.php"; }, 500);</script>';
                mysqli_close($conn);
                exit();
            } else {
                echo '<script>alert("Có lỗi xảy ra khi lưu dữ liệu thuốc.");</script>';
            }
        }
    }
}
?>