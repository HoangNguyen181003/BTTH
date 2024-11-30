<!-- store.php -->
<?php
include 'db.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu form đã được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Kiểm tra nếu có file hình ảnh được tải lên
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name']; // Đường dẫn tạm thời của file
        $fileName = $_FILES['image']['name']; // Tên file gốc
        $fileSize = $_FILES['image']['size']; // Kích thước file
        $fileType = $_FILES['image']['type']; // Loại file

        // Đặt tên file mới và lưu vào thư mục 'Images/'
        $filePath = 'Images/' . $fileName;

        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Chèn thông tin hoa vào cơ sở dữ liệu
            $sql = "INSERT INTO flowers (name, description, image) VALUES ('$name', '$description', '$filePath')";

            if ($conn->query($sql) === TRUE) {
                echo "Thêm hoa thành công!";
                header("Location: index.php"); // Chuyển hướng về trang danh sách hoa
                exit();
            } else {
                echo "Lỗi: " . $conn->error;
            }
        } else {
            echo "Lỗi khi tải hình ảnh lên!";
        }
    } else {
        echo "Vui lòng chọn hình ảnh!";
    }
}
?>
