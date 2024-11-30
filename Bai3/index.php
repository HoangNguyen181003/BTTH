<?php
// Đọc dữ liệu từ tệp CSV
$file = 'diemdanh.csv'; // Đường dẫn đến tệp CSV

// Kiểm tra nếu tệp tồn tại
if (file_exists($file)) {
    // Mở tệp và đọc nội dung
    if (($handle = fopen($file, 'r')) !== false) {
        $data = []; // Mảng để lưu trữ dữ liệu từ CSV
        
        // Đọc tiêu đề (header)
        $header = fgetcsv($handle);
        
        // Kiểm tra nếu tiêu đề hợp lệ
        if ($header !== false) {
            // Đọc các dòng dữ liệu
            while (($row = fgetcsv($handle)) !== false) {
                // Kết hợp tiêu đề với dữ liệu nếu có đủ số lượng cột
                if (count($row) == count($header)) {
                    $data[] = array_combine($header, $row);
                }
            }
        }
        fclose($handle); // Đóng tệp sau khi đọc xong
    }
} else {
    echo "Tệp không tồn tại.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài khoản</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Danh sách tài khoản</h1>
    
    <!-- Kiểm tra nếu có dữ liệu -->
    <?php if (isset($data) && !empty($data)): ?>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Lastname</th>
                    <th>Firstname</th>
                    <th>City</th>
                    <th>Email</th>
                    <th>Course</th>
                </tr>
            </thead>
            <tbody>
                <!-- Lặp qua từng dòng dữ liệu và hiển thị -->
                <?php foreach ($data as $account): ?>
                    <tr>
                        <td><?php echo isset($account['username']) ? htmlspecialchars($account['username']) : 'N/A'; ?></td>
                        <td><?php echo isset($account['password']) ? htmlspecialchars($account['password']) : 'N/A'; ?></td>
                        <td><?php echo isset($account['lastname']) ? htmlspecialchars($account['lastname']) : 'N/A'; ?></td>
                        <td><?php echo isset($account['firstname']) ? htmlspecialchars($account['firstname']) : 'N/A'; ?></td>
                        <td><?php echo isset($account['city']) ? htmlspecialchars($account['city']) : 'N/A'; ?></td>
                        <td><?php echo isset($account['email']) ? htmlspecialchars($account['email']) : 'N/A'; ?></td>
                        <td><?php echo isset($account['course1']) ? htmlspecialchars($account['course1']) : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Không có dữ liệu để hiển thị.</p>
    <?php endif; ?>
</body>
</html>

