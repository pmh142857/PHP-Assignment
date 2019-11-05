<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<div class="container">
	<form action="" method="GET">
		<h1 class="alert-success text-center" >THE WEATHER IN YOUR CITY<br></h1>
		<div>
			<select name="city" class="browser-default custom-select alert-warning" >
				<option class="alert-warning" selected="selected" value="null" >Your city</option>
				<option class="alert-success" value="1905468" ><h3>Tp.Đà Nẵng</h3></option>
				<option class="alert-success" value="1569684" ><h3>Tp.Pleiku</h3></option>
				<option class="alert-success" value="1566083" ><h3>Tp.Hồ Chí Minh</h3></option>
			</section>
		</div>
		<div class="row">
			<input class="btn btn-outline-success" id="form1" type="submit" name="tim" value="Weather">
		</div>     
	</form>
</div>
<?php 
$apikey1 = "319d9a22150ae7ddab38b4b4f8e19015";
$apikey = "1f1e9dadc5ad9cccc96a1e5d6560a9dd";
if (isset($_GET['city'])){
	$googleApiUrl1 = "https://api.openweathermap.org/data/2.5/weather?id=".$_GET['city']."&lang=en&units=metric&APPID=".$apikey1;  
	$googleApiUrl = "https://api.openweathermap.org/data/2.5/forecast?id=".$_GET['city']."&lang=en&units=metric&APPID=".$apikey; 
}

?>

<?php 

// $cityid = "1905468";		//Tp Da Nang
// $cityid1 = "1569684";	//Tp Pleiku
// $cityid2 = "1566083"; 	//Tp HCM

// $googleApiUrl1 = "https://api.openweathermap.org/data/2.5/weather?id=".$cityid."&lang=en&units=metric&APPID=".$apikey1;  
$ch1 = curl_init();

curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_URL, $googleApiUrl1);
curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch1, CURLOPT_VERBOSE, 0);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch1);
curl_close($ch1); 
$data1= json_decode($response);
// echo "<pre>";
// print_r($data1);
$currentTime = time();

?>
<!DOCTYPE html>
<html>
<head>
	<title> weather openweathermap.org </title>

</head>
<body>
	<div class="container" >
		<h1> Current weather in [<?php echo $data1->name;?>]</h1>
		<div class="time">
			<div> <?php echo date("l g:i a", $currentTime); ?></div>
			<div> <?php echo date("jS F, Y", $currentTime); ?></div>
			<div> <?php echo ucwords($data1->weather[0]->description);?></div>
		</div>
		<div class="weather-forecast">
			<img src="http://openweathermap.org/img/w/<?php echo $data1->weather[0]->icon; ?>.png" class="weather-icon"/>
			<?php echo $data1->main->temp_min; ?>&deg;C /
			<span class="min-temperature"><?php echo $data1 ->main->temp_max;?>&deg;C<span/>
			</div>
			<div class="time">
				<div>Humidity: <?php echo $data1->main->humidity;?> %</div>
				<div>Wind: <?php echo $data1 ->wind->speed; ?> m/s</div>
			</div>
			<div  class="text-success">
				<span class=" alert-warning"><h4>Recommendations :</h4></span>
				<?php 
				$nhiet = $data1 ->main->temp_max;
				if ($nhiet <18) {echo "<h3>You should wear warm clothes when going out</h3>";
			}
			if ($nhiet = 25) {echo "<h3>Cool weather you can go out</h3>";
		}
		if ($nhiet > 29) {echo "<h3>You should stay home outdoors which is very hot</h3>";
	}
	?>

	<div>
	</div>

</div>
</div>

</body>
</html>

<?php 

// $googleApiUrl = "https://api.openweathermap.org/data/2.5/forecast?id=".$cityid."&lang=en&units=metric&APPID=".$apikey;  	
$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch); 
$data = json_decode($response);

// echo "<pre>";
// print_r($data);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Dự báo thời tiết trong 5 ngày</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div>
			<h1> 5 day / 3 hour [<?php echo $data->city->name;?>] Weather forecast</h1>
		</div>
		<div class="table-weather">
			<table class="table table-hover alert-success">
				<thead class="thead-light ">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Date</th>
						<th scope="col">Description</th>
						<th scope="col">Temperature (&deg;C)</th>
						<th scope="col">Humidity (%)</th>
						<th scope="col">Wind (m/s)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th scope="row">1</th>
						<td><?php echo $data->list[0]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[0]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[0]->weather[0]->description;?></td>
						<td><?php echo $data->list[0]->main->temp_min; ?>&deg;C /<?php echo $data ->list[0]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[0]->main->humidity;?></td>
						<td><?php echo $data->list[0]->wind->speed;?></td>
					</tr>

					<tr>
						<th scope="row">2</th>
						<td><?php echo $data->list[1]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[1]->weather[0]->description;?></td>
						<td><?php echo $data->list[1]->main->temp_min; ?>&deg;C /<?php echo $data ->list[1]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[1]->main->humidity;?></td>
						<td><?php echo $data->list[1]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">3</th>
						<td><?php echo $data->list[2]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[2]->weather[0]->description;?></td>
						<td><?php echo $data->list[2]->main->temp_min; ?>&deg;C /<?php echo $data ->list[2]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[2]->main->humidity;?></td>
						<td><?php echo $data->list[2]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">4</th>
						<td><?php echo $data->list[3]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[3]->weather[0]->description;?></td>
						<td><?php echo $data->list[3]->main->temp_min; ?>&deg;C /<?php echo $data ->list[3]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[3]->main->humidity;?></td>
						<td><?php echo $data->list[3]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">5</th>
						<td><?php echo $data->list[4]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[4]->weather[0]->description;?></td>
						<td><?php echo $data->list[4]->main->temp_min; ?>&deg;C /<?php echo $data ->list[4]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[4]->main->humidity;?></td>
						<td><?php echo $data->list[4]->wind->speed;?></td>
					</tr>

					<tr>
						<th scope="row">6</th>
						<td><?php echo $data->list[5]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[5]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[5]->weather[0]->description;?></td>
						<td><?php echo $data->list[5]->main->temp_min; ?>&deg;C /<?php echo $data ->list[5]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[5]->main->humidity;?></td>
						<td><?php echo $data->list[5]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">7</th>
						<td><?php echo $data->list[6]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[6]->weather[0]->description;?></td>
						<td><?php echo $data->list[6]->main->temp_min; ?>&deg;C /<?php echo $data ->list[6]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[6]->main->humidity;?></td>
						<td><?php echo $data->list[6]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">8</th>
						<td><?php echo $data->list[7]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[7]->weather[0]->description;?></td>
						<td><?php echo $data->list[7]->main->temp_min; ?>&deg;C /<?php echo $data ->list[7]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[7]->main->humidity;?></td>
						<td><?php echo $data->list[7]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">9</th>
						<td><?php echo $data->list[8]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[8]->weather[0]->description;?></td>
						<td><?php echo $data->list[8]->main->temp_min; ?>&deg;C /<?php echo $data ->list[8]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[8]->main->humidity;?></td>
						<td><?php echo $data->list[8]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">10</th>
						<td><?php echo $data->list[9]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[1]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[9]->weather[0]->description;?></td>
						<td><?php echo $data->list[9]->main->temp_min; ?>&deg;C /<?php echo $data ->list[9]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[9]->main->humidity;?></td>
						<td><?php echo $data->list[9]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">11</th>
						<td><?php echo $data->list[10]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[10]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[10]->weather[0]->description;?></td>
						<td><?php echo $data->list[10]->main->temp_min; ?>&deg;C /<?php echo $data ->list[10]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[10]->main->humidity;?></td>
						<td><?php echo $data->list[10]->wind->speed;?></td>
					</tr>



					<tr>
						<th scope="row">12</th>
						<td><?php echo $data->list[11]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[11]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[11]->weather[0]->description;?></td>
						<td><?php echo $data->list[11]->main->temp_min; ?>&deg;C /<?php echo $data ->list[11]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[11]->main->humidity;?></td>
						<td><?php echo $data->list[11]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">13</th>
						<td><?php echo $data->list[12]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[12]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[12]->weather[0]->description;?></td>
						<td><?php echo $data->list[12]->main->temp_min; ?>&deg;C /<?php echo $data ->list[12]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[12]->main->humidity;?></td>
						<td><?php echo $data->list[12]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">14</th>
						<td><?php echo $data->list[13]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[13]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[13]->weather[0]->description;?></td>
						<td><?php echo $data->list[13]->main->temp_min; ?>&deg;C /<?php echo $data ->list[13]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[13]->main->humidity;?></td>
						<td><?php echo $data->list[13]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">15</th>
						<td><?php echo $data->list[14]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[14]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[14]->weather[0]->description;?></td>
						<td><?php echo $data->list[14]->main->temp_min; ?>&deg;C /<?php echo $data ->list[14]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[14]->main->humidity;?></td>
						<td><?php echo $data->list[14]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">16</th>
						<td><?php echo $data->list[15]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[15]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[15]->weather[0]->description;?></td>
						<td><?php echo $data->list[15]->main->temp_min; ?>&deg;C /<?php echo $data ->list[15]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[15]->main->humidity;?></td>
						<td><?php echo $data->list[15]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">17</th>
						<td><?php echo $data->list[16]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[16]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[16]->weather[0]->description;?></td>
						<td><?php echo $data->list[16]->main->temp_min; ?>&deg;C /<?php echo $data ->list[15]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[16]->main->humidity;?></td>
						<td><?php echo $data->list[16]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">18</th>
						<td><?php echo $data->list[17]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[17]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[17]->weather[0]->description;?></td>
						<td><?php echo $data->list[17]->main->temp_min; ?>&deg;C /<?php echo $data ->list[17]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[17]->main->humidity;?></td>
						<td><?php echo $data->list[17]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">19</th>
						<td><?php echo $data->list[18]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[18]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[18]->weather[0]->description;?></td>
						<td><?php echo $data->list[18]->main->temp_min; ?>&deg;C /<?php echo $data ->list[18]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[18]->main->humidity;?></td>
						<td><?php echo $data->list[18]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">20</th>
						<td><?php echo $data->list[19]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[19]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[19]->weather[0]->description;?></td>
						<td><?php echo $data->list[19]->main->temp_min; ?>&deg;C /<?php echo $data ->list[19]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[19]->main->humidity;?></td>
						<td><?php echo $data->list[19]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">21</th>
						<td><?php echo $data->list[20]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[20]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[20]->weather[0]->description;?></td>
						<td><?php echo $data->list[20]->main->temp_min; ?>&deg;C /<?php echo $data ->list[20]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[20]->main->humidity;?></td>
						<td><?php echo $data->list[20]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">22</th>
						<td><?php echo $data->list[21]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[21]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[21]->weather[0]->description;?></td>
						<td><?php echo $data->list[21]->main->temp_min; ?>&deg;C /<?php echo $data ->list[21]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[21]->main->humidity;?></td>
						<td><?php echo $data->list[21]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">23</th>
						<td><?php echo $data->list[22]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[22]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[22]->weather[0]->description;?></td>
						<td><?php echo $data->list[22]->main->temp_min; ?>&deg;C /<?php echo $data ->list[22]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[22]->main->humidity;?></td>
						<td><?php echo $data->list[22]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">24</th>
						<td><?php echo $data->list[23]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[23]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[23]->weather[0]->description;?></td>
						<td><?php echo $data->list[23]->main->temp_min; ?>&deg;C /<?php echo $data ->list[23]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[23]->main->humidity;?></td>
						<td><?php echo $data->list[23]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">25</th>
						<td><?php echo $data->list[24]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[24]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[24]->weather[0]->description;?></td>
						<td><?php echo $data->list[24]->main->temp_min; ?>&deg;C /<?php echo $data ->list[24]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[24]->main->humidity;?></td>
						<td><?php echo $data->list[24]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">26</th>
						<td><?php echo $data->list[25]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[25]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[25]->weather[0]->description;?></td>
						<td><?php echo $data->list[25]->main->temp_min; ?>&deg;C /<?php echo $data ->list[25]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[25]->main->humidity;?></td>
						<td><?php echo $data->list[25]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">27</th>
						<td><?php echo $data->list[26]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[26]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[26]->weather[0]->description;?></td>
						<td><?php echo $data->list[26]->main->temp_min; ?>&deg;C /<?php echo $data ->list[26]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[26]->main->humidity;?></td>
						<td><?php echo $data->list[26]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">28</th>
						<td><?php echo $data->list[27]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[27]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[27]->weather[0]->description;?></td>
						<td><?php echo $data->list[27]->main->temp_min; ?>&deg;C /<?php echo $data ->list[27]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[27]->main->humidity;?></td>
						<td><?php echo $data->list[27]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">29</th>
						<td><?php echo $data->list[28]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[28]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[28]->weather[0]->description;?></td>
						<td><?php echo $data->list[28]->main->temp_min; ?>&deg;C /<?php echo $data ->list[28]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[28]->main->humidity;?></td>
						<td><?php echo $data->list[28]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">30</th>
						<td><?php echo $data->list[29]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[29]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[29]->weather[0]->description;?></td>
						<td><?php echo $data->list[29]->main->temp_min; ?>&deg;C /<?php echo $data ->list[29]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[29]->main->humidity;?></td>
						<td><?php echo $data->list[29]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">31</th>
						<td><?php echo $data->list[30]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[30]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[30]->weather[0]->description;?></td>
						<td><?php echo $data->list[30]->main->temp_min; ?>&deg;C /<?php echo $data ->list[30]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[30]->main->humidity;?></td>
						<td><?php echo $data->list[30]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">32</th>
						<td><?php echo $data->list[31]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[31]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[31]->weather[0]->description;?></td>
						<td><?php echo $data->list[31]->main->temp_min; ?>&deg;C /<?php echo $data ->list[31]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[31]->main->humidity;?></td>
						<td><?php echo $data->list[31]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">33</th>
						<td><?php echo $data->list[32]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[32]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[32]->weather[0]->description;?></td>
						<td><?php echo $data->list[32]->main->temp_min; ?>&deg;C /<?php echo $data ->list[32]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[32]->main->humidity;?></td>
						<td><?php echo $data->list[32]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">34</th>
						<td><?php echo $data->list[33]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[33]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[33]->weather[0]->description;?></td>
						<td><?php echo $data->list[33]->main->temp_min; ?>&deg;C /<?php echo $data ->list[33]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[33]->main->humidity;?></td>
						<td><?php echo $data->list[33]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">35</th>
						<td><?php echo $data->list[34]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[34]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[34]->weather[0]->description;?></td>
						<td><?php echo $data->list[34]->main->temp_min; ?>&deg;C /<?php echo $data ->list[34]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[34]->main->humidity;?></td>
						<td><?php echo $data->list[34]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">36</th>
						<td><?php echo $data->list[35]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[35]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[35]->weather[0]->description;?></td>
						<td><?php echo $data->list[35]->main->temp_min; ?>&deg;C /<?php echo $data ->list[35]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[35]->main->humidity;?></td>
						<td><?php echo $data->list[35]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">37</th>
						<td><?php echo $data->list[36]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[36]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[36]->weather[0]->description;?></td>
						<td><?php echo $data->list[36]->main->temp_min; ?>&deg;C /<?php echo $data ->list[36]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[36]->main->humidity;?></td>
						<td><?php echo $data->list[36]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">38</th>
						<td><?php echo $data->list[37]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[37]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[37]->weather[0]->description;?></td>
						<td><?php echo $data->list[37]->main->temp_min; ?>&deg;C /<?php echo $data ->list[37]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[37]->main->humidity;?></td>
						<td><?php echo $data->list[37]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">39</th>
						<td><?php echo $data->list[38]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[38]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[38]->weather[0]->description;?></td>
						<td><?php echo $data->list[38]->main->temp_min; ?>&deg;C /<?php echo $data ->list[38]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[38]->main->humidity;?></td>
						<td><?php echo $data->list[38]->wind->speed;?></td>
					</tr>
					<tr>
						<th scope="row">40</th>
						<td><?php echo $data->list[39]->dt_txt;?> <img src="http://openweathermap.org/img/w/<?php echo $data->list[39]->weather[0]->icon; ?>.png" class="weather-icon"/> </td>					
						<td><?php echo $data->list[39]->weather[0]->description;?></td>
						<td><?php echo $data->list[39]->main->temp_min; ?>&deg;C /<?php echo $data ->list[39]->main->temp_max;?>&deg;C</td>
						<td><?php echo $data->list[39]->main->humidity;?></td>
						<td><?php echo $data->list[39]->wind->speed;?></td>
					</tr>
				</tbody>
			</table>

		</div>
	</div>

</body>
</html>