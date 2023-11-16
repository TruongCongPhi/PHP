<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khóa học</title>
    <!-- Begin bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="	sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- End bootstrap cdn -->

</head>

<body>
    <?php include 'navbar.php';?>
    <main style="min-height: 100vh; width: 100%;">
        <div class="" style="text-align: center;">
            <h2>Khóa học</h2>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4" style="margin: 0 auto; width: 80%;">
            <!-- begin khóa học -->

            <?php
			include '../connectdb.php';
			
			
			$username = $_SESSION['username'];

			$query = "SELECT * FROM khoa_hoc";
			$result = mysqli_query($conn, $query);

			if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
			    	
			    	if($username == 'admin'){
			    		//admin: hiển thị tất cả khóa học
			    		echo '<div class="col">
			    		        <div class="card">
			    		            <img src="../images/khoahoc.jpg" class="card-img-top" alt="Course Image">
			    		            <div class="card-body">
			    		                <h5 class="card-title">' . $row["ten_khoa_hoc"] . '</h5>
			    		                <a class="btn btn-primary" href="bai_giang.php?id_khoa_hoc=' . $row["id_khoa_hoc"] . '" >Truy cập</a>
			    		            </div>
			    		        </div>
			    		    </div>';

			    	}else{
			    		$id_khoa_hoc = $row["id_khoa_hoc"];
			    		// kiểm tra xem người dùng đã đăng ký khóa học hay chưa
			    		$query_check = "SELECT * FROM quan_ly_khoa_hoc WHERE id_khoa_hoc = $id_khoa_hoc AND id_username = '$username'";
			    		$result_check = mysqli_query($conn, $query_check);

			    		// nếu đã đăng ký thì hiển thị khóa học
			    		if (mysqli_num_rows($result_check) > 0) {
			    			echo '<div class="col">
			    			        <div class="card">
			    			            <img src="../images/khoahoc.jpg" class="card-img-top" alt="Course Image">
			    			            <div class="card-body">
			    			                <h5 class="card-title">' . $row["ten_khoa_hoc"] . '</h5>
			    			                <a class="btn btn-primary" href="bai_giang.php?id_khoa_hoc=' . $row["id_khoa_hoc"] . '">Truy cập</a>
			    			            </div>
			    			        </div>
			    			    </div>';
			    		}
			    	}
			    }
			}
			?>



            <!-- end khóa học -->


        </div>
    </main>
    <?php include 'footer.php'; ?>
</body>


</html>