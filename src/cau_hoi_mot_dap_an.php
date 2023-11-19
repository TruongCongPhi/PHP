<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm câu hỏi - Singlechoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <!-- database jquery cdn -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        main {
            padding: 5%;
            overflow-x: auto;
            font-family: 'Nunito', sans-serif;
        }

        section {
            width: 100%;
        }

        .custom-alert {
            color: #B70404;
            background-color: #FF9B9B;
            border-color: #FF8989;
        }
    </style>
</head>

<body>
    <?php include 'navbar.php';
    ?>


    <main>
        <section>
            <?php
            include '../connectdb.php';
            include '../function.php';
            if (!isLogin()) {
                header("location: dang_nhap.php");
                exit();
            }

            $id_khoa_hoc = $_GET['id_khoa_hoc'];
            // truy vấn đến bảng khóa học qua GET
            $query = "SELECT * FROM khoa_hoc WHERE id_khoa_hoc = $id_khoa_hoc";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // hiển thị khóa học
                    echo '<div class="card border-dark mb-3" style="max-width: 100%;">
                    <div class="card-header">' . $row["ten_khoa_hoc"] . '</div>
                    <div class="card-body text-dark">
                        <h5 class="card-title">' . $row["mo_ta_khoa_hoc"] . '</h5>
                    </div>
                    </div>';
                }
            }
            ?>
            <?php
            if (isset($_POST['add_quiz'])) {

                $username = $_SESSION['username'];
                $ten_cau_hoi = $_POST['ten_cau_hoi'];
                $muc_do = $_POST['level'];
                $imgPath = null;
                $addQuizSuccess = 0;
                $uploadCheck = 1;

                // Thêm câu hỏi vào bảng 'cau_hoi'


                if (!empty($_FILES['anh']['name'])) {
                    $targetDirectory = "../uploads/";
                    $imgFileType = strtolower(pathinfo($_FILES['anh']['name'], PATHINFO_EXTENSION));
                    $imgType = array("jpg", "jpeg", "png", "gif");
                    if (!in_array($imgFileType, $imgType)) {
                        $uploadCheck = 0;
                        $addQuizSuccess = 0;
                    }
                    if ($uploadCheck) {
                        $i = 1;
                        $newFileName = $_FILES['anh']['name'];

                        while (file_exists($targetDirectory . $newFileName)) {
                            $newFileName = pathinfo($_FILES['anh']['name'], PATHINFO_FILENAME) . "($i)." . $imgFileType;
                            $i++;
                        }

                        $uploadOk = move_uploaded_file($_FILES['anh']['tmp_name'], $targetDirectory . $newFileName);
                        if ($uploadOk) {
                            $imgPath = $targetDirectory . basename($_FILES["anh"]["name"]);
                        }
                    }
                }
                if (!empty($ten_cau_hoi) && !empty($_POST['flag']) && $uploadCheck == 1) {
                    $query_insert_cau_hoi = "INSERT INTO `cau_hoi` (`id_khoa_hoc`, `ten_cau_hoi`, `anh`, `muc_do`, `loai_cau_hoi`, `nguoi_them`) 
                                        VALUES ('$id_khoa_hoc', '$ten_cau_hoi', '$imgPath', '$muc_do', 'single_choice', '$username')";
                    $result_insert_cau_hoi = mysqli_query($conn, $query_insert_cau_hoi);



                    if ($result_insert_cau_hoi) {
                        $id_cau_hoi = mysqli_insert_id($conn);

                        // Thêm các đáp án vào bảng 'dap_an'
                        for ($i = 1; $i <= $_POST['sl_input']; $i++) {
                            $ten_dap_an = $_POST["dap_an$i"];
                            $dap_an_dung = ($_POST['flag'] == $i) ? 1 : 0;

                            $query_insert_dap_an = "INSERT INTO `dap_an` (`id_cau_hoi`, `ten_dap_an`, `dap_an_dung`)
                                                VALUES ('$id_cau_hoi', '$ten_dap_an', '$dap_an_dung')";

                            $result = mysqli_query($conn, $query_insert_dap_an);
                            if ($result && $i == $_POST['sl_input']) {
                                $addQuizSuccess = 1;
                            }
                        }
                    }
                }
            }

            ?>
            <!-- <script>
                // Kiểm tra xem biểu mẫu đã được gửi hay chưa khi trang tải
                if (window.history.replaceState) {
                    window.history.replaceState(null, null, window.location.href);
                }
            </script> -->


            <form method="POST" action="" enctype="multipart/form-data">
                <?php if (isset($addQuizSuccess) && $addQuizSuccess) : ?>
                    <div class="alert alert-success  " role="alert">
                        Câu hỏi đã được thêm thành công!
                    </div>
                <?php elseif (isset($uploadCheck) && !$uploadCheck) : ?>
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        Chỉ cho phép tải lên các định dạng JPG, JPEG, PNG và GIF!
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="name_quiz">Nhập tên câu hỏi</label>
                    <input type="text" required="required" class="form-control" id="name_quiz" name="ten_cau_hoi">
                </div>
                <div class="mb-3">
                    <label for="formFileSm" class="form-label">Upload ảnh từ máy tính:</label>
                    <input class="form-control form-control-sm" id="formFileSm" type="file" name="anh">
                </div>
                <div class="form-group">
                    <label for="">Dạng câu hỏi</label>
                    <input class="form-control" type="text" value="Chọn một đáp án" readonly><br>
                    <input type="hidden" value="singlechoice" name="loai_quiz">
                    <label for="exampleFormControlSelect1">Chọn độ khó</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="level">
                        <option value="1">Dễ</option>
                        <option value="2">Trung Bình</option>
                        <option value="3">Khó</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Lựa chọn số đáp án</label>
                    <input type="number" class="form-control" name="sl_input" min=2 max=6 value="4" id="sl_input">
                    <button style="margin-top:10px" type='button' class="btn btn-primary" onclick="create_element()">Tạo</button>
                </div>
                <div>Nhập các lựa chọn và tích vào đáp án đúng!</div><br>
                <div class="form-check" id="form-check">
                    <input class="form-check-input" type="radio" value="1" id="flexCheckDefault" name="flag">
                    <input type="text" required="required" class="form-control remove-element" name="dap_an1">
                    <br><br>
                    <input class="form-check-input" type="radio" value="2" id="flexCheckDefault" name="flag">
                    <input type="text" required="required" class="form-control remove-element" name="dap_an2">
                    <br><br>
                    <input class="form-check-input" type="radio" value="3" id="flexCheckDefault" name="flag">
                    <input type="text" required="required" class="form-control remove-element" name="dap_an3">
                    <br><br>
                    <input class="form-check-input" type="radio" value="4" id="flexCheckDefault" name="flag">
                    <input type="text" required="required" class="form-control remove-element" name="dap_an4">
                    <br><br>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary" name="add_quiz">Thêm câu hỏi</button>
            </form>

            <!-- xử lí add csdl -->




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
    </style>
    <footer class="footer-container">
        <?php include 'footer.php' ?>
    </footer>
    <script type="text/javascript">
        function create_element() {
            var value = $("#sl_input").val();
            // remove những phần tử cũ
            $(".form-check-input").remove();
            $(".remove-element").remove(); //class chỉ có trong div#form-check
            $("div br").remove();
            for (var i = 1; i <= value; ++i) {
                var txt_html1 = "<input class=\"form-check-input\" type=\"radio\" value=\"" + i +
                    "\" id=\"flexCheckDefault\" name=\"flag\">";
                var txt_html2 =
                    "<input type=\"text\" required=\"required\" class=\"form-control remove-element\" name=\"dap_an" + i +
                    "\">" +
                    "<br><br>";
                $("#form-check").append(txt_html1, txt_html2);
            }

        }
    </script>


</body>

</html>