<?php
// Kết nối đến cơ sở dữ liệu
include('db_connect.php');

// Kiểm tra nếu người dùng đã nộp bài
if (isset($_POST['submit'])) {
    $score = 0;
    $errors = []; // Mảng lưu trữ các câu chưa được trả lời

    // Lấy danh sách câu hỏi và đáp án đúng
    $sql = "SELECT q.id AS question_id, a.correct_option_id, o.id AS option_id, o.option_text
            FROM question q
            JOIN answers a ON q.id = a.question_id
            JOIN options o ON q.id = o.question_id
            ORDER BY q.id, o.id";
    $result = $conn->query($sql);

    $questions = []; // Lưu danh sách câu hỏi và lựa chọn
    $options_map = []; // Lưu ánh xạ ID lựa chọn -> A, B, C, D

    if ($result->num_rows > 0) {
        $current_question_id = null;
        $option_index = 0;

        while ($row = $result->fetch_assoc()) {
            $question_id = $row['question_id'];

            // Khi gặp câu hỏi mới, reset index cho các lựa chọn
            if ($current_question_id !== $question_id) {
                $current_question_id = $question_id;
                $option_index = 0;
            }

            // Lưu ánh xạ ID của lựa chọn -> A, B, C, D
            $option_letter = chr(65 + $option_index); // A = 65
            $options_map[$row['option_id']] = $option_letter;

            // Lưu câu hỏi và đáp án
            if (!isset($questions[$question_id])) {
                $questions[$question_id] = [
                    'correct_option' => $row['correct_option_id'],
                ];
            }

            $option_index++;
        }
    }

    // Kiểm tra đáp án của người dùng
    foreach ($questions as $question_id => $data) {
        $correct_option = $data['correct_option'];
        $user_answer_id = isset($_POST["question_" . $question_id]) ? $_POST["question_" . $question_id] : null; // Đáp án người dùng chọn

        // Kiểm tra xem người dùng có chọn đáp án cho câu hỏi này không
        if ($user_answer_id === null) {
            $errors[] = "Bạn chưa chọn đáp án cho câu " . $question_id;
        } else {
            // So sánh đáp án
            $user_answer_letter = $options_map[$user_answer_id]; // Chuyển ID -> A, B, C, D
            if (strtoupper($user_answer_letter) === strtoupper($correct_option)) {
                $score++;  // Tăng điểm nếu đáp án đúng
            }
        }
    }

    // Nếu có câu chưa được trả lời, hiển thị thông báo lỗi
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        echo "<button onclick='window.history.back();'>Quay lại</button>"; // Thêm nút quay lại nếu có lỗi
    } else {
        // Nếu không có lỗi, hiển thị điểm số
        echo "Điểm của bạn là: $score / " . count($questions);
    }
} else {
    // Truy vấn câu hỏi và các lựa chọn
    $sql = "SELECT * FROM question";
    $result = $conn->query($sql);

    // Hiển thị form câu hỏi
    if ($result->num_rows > 0) {
        echo "<form method='POST'>";
        $question_number = 1; // Biến để đánh số câu hỏi
        while ($row = $result->fetch_assoc()) {
            echo "<h3><strong>Câu " . $question_number . ":</strong> " . $row["question_text"] . "</h3>"; // Hiển thị câu hỏi và số câu hỏi in đậm
            
            $question_id = $row["id"];
            $option_sql = "SELECT * FROM options WHERE question_id = $question_id";
            $option_result = $conn->query($option_sql);
            
            // Hiển thị các lựa chọn cho câu hỏi
            if ($option_result->num_rows > 0) {
                while ($option = $option_result->fetch_assoc()) {
                    echo "<input type='radio' name='question_" . $question_id . "' value='" . $option['id'] . "'> " . $option['option_text'] . "<br>";
                }
            }
            $question_number++; // Tăng số câu hỏi
        }
        echo "<button type='submit' name='submit'>Nộp bài</button>";
        echo "</form>";
    } else {
        echo "Không có câu hỏi nào.";
    }
}

$conn->close(); // Đóng kết nối sau khi tất cả các thao tác đã hoàn thành
?>



<!-- Thêm các liên kết CSS -->
<head>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styles2.css"> <!-- Thêm styles2.css -->
</head>
