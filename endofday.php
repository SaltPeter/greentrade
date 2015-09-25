<?php

$ticker = $_GET['ticker'];
$days = $_GET['days'];

// $ThirtyDays = mktime (0, 0, 0, date("Y"), date("m")-1, date("d"));
// $OneYear = mktime (0, 0, 0, date("Y")-1, date("m"), date("d"));
// $OneQuarter = (Get last quarterly period to the current date)
// $today = date("Y-m-d");

function fetchChart($startDate, $endDate, $ticker){
	$chartLink="https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance.historicaldata%20where%20symbol%3D%22" . (string)$ticker . "%22%20and%20startDate%3D%22". $startDate ."%22%20and%20endDate%3D%22" . (string)$endDate . "%22&format=json&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=";
$chartGET = file_get_contents($chartLink);
$myChart = json_decode($chartGET);

$chartName = $myChart->{'query'}->{'results'}->{'quote'};
	echo '[';
	if(false){
		for($i = 0; $i < count($chartName); $i++){
			echo 'Date: ' . $chartName[$i]->{'Date'};
			echo '<ul>';
			echo '<li>Daily high: ' . $chartName[$i]->{'High'} . '</li>';
			echo '<li>Daily low: ' . $chartName[$i]->{'Low'} . '</li>';
			echo '<li>Open: ' . $chartName[$i]->{'Open'} . '</li>';
			echo '<li>Close: ' . $chartName[$i]->{'Close'} . '</li>';
			echo '</ul>';
		}
	}
	else {
		for($i = 0; $i < count($chartName); $i++){
				echo '{';
			echo '"Date":"' . $chartName[$i]->{'Date'} . '",';
			echo '"High":"' . $chartName[$i]->{'High'} . '",';
			echo '"Low":"' . $chartName[$i]->{'Low'} . '",';
			echo '"Open":"' . $chartName[$i]->{'Open'} . '",';
			echo '"Close":"' . $chartName[$i]->{'Close'} . '",';
				echo '}';
		}
	}
	echo ']';
}

$first = date("Y-m-d");
$sec = date('Y-m-d', strtotime('-30 days'));

?>
