<?php

$ticker = $_GET['ticker'];

$chartLink = "http://chartapi.finance.yahoo.com/instrument/1.1/" . $ticker. "/chartdata;type=quote;range=1d/json?callback=yolotrade";
$chartGET = file_get_contents($chartLink);

if(strpos($chartGET, 'finance_charts_json_callback'))
	die('Error: invalid ticker');

$chartGET = str_replace(array("yolotrade(", ")"), "", $chartGET);
$chartJSON = json_decode($chartGET);

$dataPoints = $chartJSON->{'series'};

$indices = count($dataPoints);

echo '{"response":[';

for($i = 0; $i < $indices; $i++) {
	echo '{';
	echo '"timestamp":' . $dataPoints[$i]->{'Timestamp'} . ',';
	echo '"close":' . $dataPoints[$i]->{'close'} . ',';
	echo '"open":' . $dataPoints[$i]->{'open'} . ',';
	echo '"low":' . $dataPoints[$i]->{'low'} . ',';
	echo '"high":' . $dataPoints[$i]->{'high'} . ',';
	echo '"volume":' . $dataPoints[$i]->{'volume'};
	echo '}';
	if($i != $indices - 1)
		echo ',';
	else
		echo ']}';
}

// CLOSE - OPEN - LOW - HIGH - VOLUME

?>