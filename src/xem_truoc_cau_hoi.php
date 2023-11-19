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
        <div style="margin: 20px 30%;">
            <!-- tên câu hỏi -->
            <div class="form-group">
                <label for="name_quiz">
                    <h4>Câu hỏi: eyurk</h4>
                </label>
            </div>
            <!-- ảnh câu hỏi -->
            <div class="form-group">
                <img src='../images/560606.jpg' height='200px'>
            </div>
            <!-- đáp án -->
            <div style='margin: 20px 0 0 0;' class='input-group mb-3'>
                <div class='input-group-text'>
                    <input name='' value='' checked type='checkbox' readonly>
                </div>
                <input name='' type='text' class='form-control' value='gs' readonly>
            </div>


        </div>
        </form>

    </main>

    <div class="alert-primary text-center p-2" style="margin-top: 15px;" role="alert">ProjectPHP - 2023</div>
</body>


</html>