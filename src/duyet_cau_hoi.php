<?php
include '../connectdb.php';
$id_cau_hoi_duyet = $_GET['id_cau_hoi'];
$query_update_trang_thai = "UPDATE cau_hoi SET trang_thai = 1 WHERE id_cau_hoi = $id_cau_hoi_duyet";
mysqli_query($conn, $query_update_trang_thai);
header("location: bien_tap.php?id_khoa_hoc={$_GET['id_khoa_hoc']}");
