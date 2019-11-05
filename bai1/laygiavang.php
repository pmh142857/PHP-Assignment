<!DOCTYPE html>
<html>
<head>
  <title>Cập nhật giá vàng SJC</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
  <div class="container">
    <div class="container justify-content-center text-justify">
      <form action="" method="GET">
        <h1 style="text-align: bold;color: green;">Cập nhật giá vàng SJC<br></h1>
        <div>
          <select name="loaitim" class="custom-select-sm" >
            <option class="alert-warning" value="null" >LOẠI VÀNG</option>
            <option class="alert-success" value="SJC 1L, 10L" >SJC 1L, 10L</option>
            <option class="alert-success" value="SJC 5">SJC 5C</option>
            <option class="alert-success" value="1C, 5">SJC 2C, 1C, 5 PHÂN</option>
            <option class="alert-success" value=", 2">VÀNG NHẪN SJC 99,99 1 CHỈ, 2 CHỈ, 5 CHỈ</option>
            <option class="alert-success" value="0.5">VÀNG NHẪN SJC 99,99 0.5 CHỈ</option>
            <option class="alert-success" value="99.99%">NỮ TRANG 99.99%</option>
            <option class="alert-success" value=" 99%">NỮ TRANG 99%</option>
            <option class="alert-success" value="68%">NỮ TRANG 68%</option>
            <option class="alert-success" value="41.7%">NỮ TRANG 41.7%</option>
          </section>
        </div>
        <div>
          <input class="btn btn-outline-success" type="submit" name="tim" value="Cập nhật">
        </div>     
        
      </form>
    </div>
  </div>
  <div class="container justify-content-between">
    <?php
    if (isset($_GET['loaitim'])){
// B1: Tim nguon trang co du bao: giavang
      $url ="http://sjc.com.vn/giavang/textContent.php";
      $htmlContent = file_get_contents($url);
        // var_dump($htmlContent);
        // die();
      $DOM = new DOMDocument();
      $DOM->loadHTML($htmlContent);
      $Header = $DOM->getElementsByTagName('tr');
      $Detail = $DOM->getElementsByTagName('td');

// $aDataTableHeaderHTML ="";
      foreach($Header as $NodeHeader) 
      {

        $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);}
        $loaicantim = $_GET['loaitim'];
        foreach ($aDataTableHeaderHTML as $tr ){
          if(strpos($tr,$loaicantim)!==false){
            $giavang = explode("\n",$tr);
        // var_dump($giavang);
        // die();
            $mua ="<br> Giá mua vào: ";
            $ban ="<br>Gía bán ra: ";
            $ten =$_GET['loaitim'];

            switch ($ten) {
              case "SJC 1L, 10L":
              echo ("<h1 style='color:#BD7B12';> SJC 1L, 10L</h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case "SJC 5":
              echo ("<h1 style='color:#BD7B12';>SJC 5C </h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case "1C, 5":
              echo ("<h1 style='color:#BD7B12';>SJC 2C, 1C, 5 PHÂN</h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case ", 2":
              echo ("<h1 style='color:#BD7B12';>VÀNG NHẪN SJC 99,99 1 CHỈ, 2 CHỈ, 5 CHỈ </h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case "0.5":
              echo ("<h1 style='color:#BD7B12';>VÀNG NHẪN SJC 99,99 0.5 CHỈ </h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case "99.99%":
              echo ("<h1 style='color:#BD7B12';>NỮ TRANG 99.99% </h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case " 99%":
              echo ("<h1 style='color:#BD7B12';>NỮ TRANG 99% </h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case "68%":
              echo ("<h1 style='color:#BD7B12';>NỮ TRANG 68% </h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;
              case "41.7%":
              echo ("<h1 style='color:#BD7B12';>NỮ TRANG 41.7%</h1>".$mua.$giavang[1]." VNĐ".$ban.$giavang[2]." VNĐ");
              break;      
            }        
          }
        }
      }
      ?>
    </div>
  </body>
  </html>