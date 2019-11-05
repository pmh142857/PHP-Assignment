<form action="" method="GET">
	THỜI TIẾT HIỆN TẠI CỦA TỈNH: 
	<input type="text" name="diaphuong">
	<input type="submit" name="submit" value="xem">
	<p> Đà Nẵng, Hải Phòng, Nha Trang, Nghệ An, Gia Lai, 
Sơn La, TP. Hồ Chí Minh, Hà Nội (Láng)</p>
<p>nguồn: <a href="http://www.nchmf.gov.vn/web/vi-VN/62/21/92/map/Default.aspx">Trung tâm Dự báo khí tượng thuỷ văn quốc gia</a></p>

</form>


<?php
		// Lay nhiet do
		if (isset($_GET['submit'])){
		// B1: Tim nguon trang co du bao:
		$url ="http://www.nchmf.gov.vn/web/vi-VN/62/21/92/map/Default.aspx";
		$noidung = file_get_contents($url);
		      // echo($noidung);
		$data = explode("<!-- Begin Display content -->", $noidung);
		     // echo $data[1];
		$data2 = explode("Cập nhật lúc:", $data[1]);
		     // echo $data2[0];
		$diaphuong = $_GET["diaphuong"]."</td>";
		$data3= explode($diaphuong, $data2[0]);
			// echo $data3[1];
		$data4 = explode("</td>", $data3[1]);
		echo $data4[0];
     }

?> 



<?php 
// Du bao 5 ngay






 ?>