<?php
include 'connectdb.php';

// Begin Login function
function isLogin()
{
	// hàm kiểm tra đã đăng nhập chưa
	return isset($_SESSION['username']);
}
// begin checkLogin
function checkLogin($username, $password)
{
	// hàm kiểm tra tài khoản nhập đã đúng chưa
	include 'connectdb.php';
	$query = "SELECT * FROM users WHERE username = '$username'";
	$result = mysqli_query($conn, $query);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		if ($row > 0) {
			if ($username == $row['username'] && md5($password) == $row['password']) {
				session_start();
				if ($username == 'admin') {
					$_SESSION['quyen'] = 1;
				} else {
					$_SESSION['quyen'] = 0;
				}
				return true;
			} else {
				return false;
			}
		}
	}
}
	
    // end checkLogin  <=