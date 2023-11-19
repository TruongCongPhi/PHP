<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem trước</title>
    <!-- Begin bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <!-- End bootstrap cdn -->

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
    <main style="min-height: 100vh; max-width: 100%; padding:5%">
        <!-- <hr> -->


        <?php
        include '../connectdb.php';
        $id_khoa_hoc = $_GET['id_khoa_hoc'];
        $id_cau_hoi = $_GET['id_cau_hoi'];
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
        $query = "SELECT * FROM cau_hoi WHERE id_khoa_hoc = $id_khoa_hoc AND id_cau_hoi = $id_cau_hoi";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row1 = mysqli_fetch_assoc($result);
            $ten_cau_hoi = $row1['ten_cau_hoi'];
            $imgPath = $row1['anh'];
            $loai_cau_hoi = $row1['loai_cau_hoi'];
        }
        ?>
        <div class="d-flex justify-content-center" style="margin: 20px 30%;">
            <!-- tên câu hỏi -->
            <div class="form-group">
                <label for="name_quiz">
                    <h4><?php if(isset($row1)){echo $ten_cau_hoi;}?></h4>
                </label>
            </div>
            <!-- ảnh câu hỏi -->
            <div class="form-group">
                <img src='<?php if(isset($row1)){echo $imgPath;}?>' height='200px'>
            </div>
            <!-- đáp án -->
            <div class="">
                <?php
                $query = "SELECT * FROM dap_an WHERE id_cau_hoi = $id_cau_hoi";
                $result = mysqli_query($conn, $query);
                 if($loai_cau_hoi == "single_choice"){
                    if (mysqli_num_rows($result) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result)) {
                    ?>
               
                    <div class="form-check form-check-column">
                        <input class="form-check-input" type="radio" value="" id="flexCheckDefault" name="flag">
                        <label class="form-check-label" for="flexRadioDefault1"><?php echo $row2['ten_dap_an']; ?></label>
                    </div><br>
                <?php }}}?>
            </div>


        </div>
        </form>

    </main>

    <div class="alert-primary text-center p-2" style="margin-top: 15px;" role="alert">ProjectPHP - 2023</div>
</body>


</html>