<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biên tập</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


    <!-- database table script cdn -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js">
    </script>
    <!-- database table script cdn -->
    <!-- database table css link cdn -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap4.min.css">
    <!-- database table css link cdn -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
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

    <?php include 'navbar.php';
    include '../index.php'; ?>


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
                <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Thêm Câu hỏi
                </a>
                <div class="dropdown-menu border-primary" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="cau_hoi_mot_dap_an.php?id_khoa_hoc=<?php echo $id_khoa_hoc; ?>" target="_blank">Câu hỏi 1
                        đáp án</a>
                    <a class="dropdown-item" href=' cau_hoi_nhieu_dap_an.php' target="">Câu hỏi nhiều đáp án
                        đáp án</a>
                    <a class="dropdown-item" href="cau_hoi_dien.php" target="">Câu hỏi điền</a>
                </div>
            </div>
            <br><br>

            <h2>Các câu hỏi đã đóng góp:</h2><br>
            <div id="load_quiz">
                <table style="width: 100%;" class="table table-striped table-bordered dt-responsive" id="myTable1">
                    <thead>
                        <tr>
                            <th title="Số thứ tự">STT</th>
                            <th>Tên Quiz</th>
                            <th>Loại Quiz</th>
                            <th>Mức Độ</th>
                            <th>Trạng thái</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
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