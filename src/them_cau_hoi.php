<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Kết nối đến cơ sở dữ liệu
        $DB_HOST = 'localhost';
        $DB_USER = 'root';
        $DB_PASS = '';
        $DB_NAME = 'truongcongphi'; 

        $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) or die("Không thể kết nối tới cơ sở dữ liệu");
        
        if ($conn) {
            mysqli_query($conn, "SET NAMES utf8");
        } else {
             "Bạn đã kết nối thất bại";
        }

        // Lấy dữ liệu từ form
        $course_id = $_POST['course_id'];
        $question = $_POST['question'];
        $answer1 = $_POST['answer1'];
        $answer2 = $_POST['answer2'];
        $answer3 = $_POST['answer3'];
        $answer4 = $_POST['answer4'];
        $correct_answer = $_POST['correct_answer'];

        // Thêm câu hỏi vào cơ sở dữ liệu
        $sql_add_question = "INSERT INTO questions (id_khoa_hoc, question_text, answer1, answer2, answer3, answer4, correct_answer)
            VALUES ($course_id, $question, $answer1, $answer2, $answer3, $answer4, $correct_answer)";

        if ($conn->query($sql_add_question) === TRUE) {
             "Câu hỏi đã được thêm thành công.";
        } else {
             "Error: " . $sql_add_question . "<br>" . $conn->error;
        }

        // Đóng kết nối
        $conn->close();
    } else {
         "Invalid request.";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thêm câu hỏi</title>
</head>
<body>
    // Thêm form để thêm câu hỏi
             <h2>Thêm Câu Hỏi</h2>
             <input type="hidden" name="course_id" value=" . $course_id . ">
             <label for="question">Câu Hỏi:</label>
             <textarea name="question" required></textarea><br>
             <label for="answer1">Đáp Án 1:</label>
             <input type="text" name="answer1" required><br>
             <label for="answer2">Đáp Án 2:</label>
             <input type="text" name="answer2" required><br>
             <label for="answer3">Đáp Án 3:</label>
             <input type="text" name="answer3" required><br>
             <label for="answer4">Đáp Án 4:</label>
             <input type="text" name="answer4" required><br>
             <label for="correct_answer">Đáp Án Đúng:</label>
             <select name="correct_answer" required>
             <option value="1">Đáp Án 1</option>
             <option value="2">Đáp Án 2</option>
             <option value="3">Đáp Án 3</option>
             <option value="4">Đáp Án 4</option>
             </select><br>
             <input type="submit" value="Thêm Câu Hỏi">
             </form>

</body>
</html>