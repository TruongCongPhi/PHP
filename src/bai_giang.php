<?php include 'navbar.php'; ?>
<?php
// Kiểm tra xem có tham số course_id được truyền từ trang courses.php không
if (isset($_GET['id_khoa_hoc'])) {
    $course_id = $_GET['id_khoa_hoc'];

    $DB_HOST = 'localhost';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_NAME = 'truongcongphi';

    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME) or die("Không thể kết nối tới cơ sở dữ liệu");

    if ($conn) {
        mysqli_query($conn, "SET NAMES 'utf8'");
    } else {
        echo "Bạn đã kết nối thất bại";
    }

    // Truy vấn cơ sở dữ liệu để lấy thông tin về bài giảng của khóa học
    $sql = "SELECT * FROM bai_giang WHERE id_khoa_hoc = $course_id";
    $result = $conn->query($sql);

    echo "<h1>Bài Giảng</h1>";

    if ($result->num_rows > 0) {
        // Hiển thị danh sách bài giảng
        echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li class="lecture-card">';
            echo '<h2>' . $row["tieu_de_bai_giang"] . '</h2>';
            echo '<p>' . $row["noi_dung"] . '</p>';
            echo '<a href="cau_hoi.php?id_bai_giang=' . $row["id_bai_giang"] . '" >chi tiết</a>';
            echo '</li>';
        }
        echo "</ul>";
    } else {
        echo "Không có bài giảng nào cho khóa học này.";
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Không có thông tin về khóa học.";
}
?>