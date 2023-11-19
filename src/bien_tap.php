<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biên tập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>


    <style>
    main {
        /*text-align: center;*/
        padding: 5%;
        overflow-x: auto;
        min-height: 80vh;
        font-family: 'Nunito', sans-serif;
    }

    section {
        width: 100%;
    }

    td img {
        max-width: 650px;
    }
    </style>

</head>

<body>

    <?php
    include 'navbar.php';
    include '../function.php';
    if (!isLogin()) {
        header("location: dang_nhap.php");
        exit();
    }
    ?>


    <main>

        <section>
            <?php
            include '../connectdb.php';
            $id_khoa_hoc = $_GET['id_khoa_hoc'];
            $query = "SELECT * FROM khoa_hoc WHERE id_khoa_hoc = $id_khoa_hoc";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="card border-dark mb-3" style="max-width: 100%;">
                    <div class="card-header">' . $row["ten_khoa_hoc"] . '</div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">' . $row["mo_ta_khoa_hoc"] . '</h5>
                    </div>
                    </div>';
                }
            }
            ?>



            <div class="dropdown show">
                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Thêm Câu hỏi
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="cau_hoi_mot_dap_an.php?id_khoa_hoc=<?php echo $id_khoa_hoc; ?>"
                        target="">Câu hỏi 1
                        đáp án</a>
                    <a class="dropdown-item" href=' cau_hoi_nhieu_dap_an.php' target="">Câu hỏi nhiều đáp án
                        đáp án</a>
                    <a class="dropdown-item" href="cau_hoi_dien.php" target="">Câu hỏi điền</a>
                </div>
            </div>

            <br><br>


            <h2>Các câu hỏi đã đóng góp:</h2><br>
            <div id="load_quiz">
                <table style="width: 100%;" class="table table-striped table-bordered dt-responsive " id="myTable1">
                    <thead>
                        <tr>
                            <th title="Số thứ tự">STT</th>
                            <th>Tên câu hỏi</th>
                            <th>Loại câu hỏi</th>
                            <th>Mức độ</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $username = $_SESSION['username'];
                        if ($_SESSION['quyen'] == 1) {
                            $query = "SELECT * FROM cau_hoi";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $stt = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['muc_do'] == 1) {
                                        $mucdo = "Dễ";
                                    } elseif ($row['muc_do'] == 2) {
                                        $mucdo = "Trung bình";
                                    } elseif ($row['muc_do'] == 3) $mucdo = "Khó";

                                    if ($row['trang_thai'] == 0) {
                                        $trangthai = "Chưa duyệt";
                                    } elseif ($row['trang_thai'] == 1) {
                                        $trangthai = "Đã duyệt";
                                    }
                                    echo "<tr>";
                                    echo "<td>$stt</td>";
                                    echo "<td>{$row['ten_cau_hoi']}<br><img width='80%' alt='' src='{$row['anh']}'></td> ";
                                    echo "<td>{$row['loai_cau_hoi']}</td>";
                                    echo "<td>{$mucdo}</td>";
                                    echo "<td>{$trangthai}</td>"; // Bạn cần thêm trạng thái ở đây
                                    echo '<td>';
                                    echo "<a class='btn btn-info me-1' href='xem_truoc_cau_hoi.php?id_khoa_hoc=$id_khoa_hoc&id_cau_hoi={$row['id_cau_hoi']}' role='button'>Xem trước</a>";
                                    if ($row['trang_thai'] == 0) {
                                        echo "<a class='btn btn-success me-1' href='duyet_cau_hoi.php?id_khoa_hoc=$id_khoa_hoc&id_cau_hoi={$row['id_cau_hoi']}' role='button'>Duyệt</a>";
                                    }
                                    echo "<a class='btn btn-danger me-1' href='xoa_cau_hoi.php?id_khoa_hoc=$id_khoa_hoc&id_cau_hoi={$row['id_cau_hoi']}' role='button'>Xóa</a>";

                                    echo "</td>";
                                    echo "</tr>";

                                    $stt++;
                                }
                            } else echo '<td align="center" colspan="6">Không có câu hỏi nào</td>';
                        } else {
                            $query = "SELECT * FROM cau_hoi WHERE id_khoa_hoc ='$id_khoa_hoc' AND nguoi_them = '$username'";
                            $result = mysqli_query($conn, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $stt = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['muc_do'] == 1) {
                                        $mucdo = "Dễ";
                                    } elseif ($row['muc_do'] == 2) {
                                        $mucdo = "Trung bình";
                                    } elseif ($row['muc_do'] == 3) $mucdo = "Khó";

                                    if ($row['trang_thai'] == 0) {
                                        $trangthai = "Chưa duyệt";
                                    } elseif ($row['trang_thai'] == 1) {
                                        $trangthai = "Đã duyệt";
                                    }
                                    echo "<tr>";
                                    echo "<td>$stt</td>";
                                    echo "<td>{$row['ten_cau_hoi']}</td>";
                                    echo "<td>{$row['loai_cau_hoi']}</td>";
                                    echo "<td>{$mucdo}</td>";
                                    echo "<td>{$trangthai}</td>"; // Bạn cần thêm trạng thái ở đây
                                    echo "<td>";
                                    echo "<a class='btn btn-info' href='xem_truoc_cau_hoi.php?id_khoa_hoc=$id_khoa_hoc&id_cau_hoi={$row['id_cau_hoi']}' role='button'>Xem trước</a>";
                                    echo "</td>";
                                    echo "</tr>";

                                    $stt++;
                                }
                            } else echo '<td align="center" colspan="6">Không có câu hỏi nào</td>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>




        </section>
    </main>
    <br><br><br>
    <style>
    .footer-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        min-height: 100px;
        width: 100%;
        padding: 15px;
        /*background-color: #86b3f0;*/
        /*background-color: #f8f9fa;*/
        background-image: linear-gradient(180deg, hsla(214deg, 100%, 67%, .1), transparent 6rem);
        flex-direction: column;
    }

    .footer-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .footer-container p {
        margin: 0 !important;
        color: #737c83;
        text-align: center;
        /*font-weight: bold;*/
        font-family: 'Nunito', sans-serif;

    }

    @media only screen and (max-width: 980px) {
        .footer-container {}
    }
    </style>
    <footer>
        <?php include 'footer.php' ?>
    </footer>
    <script>
    $(document).ready(function() {

        $('#myTable1').DataTable({
            responsive: true
        });


    });
    </script>

</body>

</html>