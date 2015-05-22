#!/usr/bin/php -q
<?php

$comparenum = $argv[1]; 
$endVal = $argv[2];

$todo = "../cprogram/output/compare/$comparenum";
	$lines = file($todo);
	$data = split("\t", $lines[0] );

$ticker= $data[1];
$date1 = $data[2];
$date2 = $data[3];

//open file to write /read datea
$fp=fopen("../data/$ticker", "r");
//open chart.phl to be updated
if($endVal != ""){
$fpwhite = fopen("../output/compare/$ticker".$endVal."_white", "w");
$fpblack = fopen("../output/compare/$ticker".$endVal."_black", "w");
$datafull = fopen("../output/compare/$ticker".$endVal."full","w");
} else {

$fpwhite = fopen("../output/compare/$ticker"."_white", "w");
$fpblack = fopen("../output/compare/$ticker"."_black", "w");
$datafull = fopen("../output/compare/$ticker"."full","w");
}
//read and parsing data...

$format="%d	%15s	%15.2f	%15.2f	%15.2f	%15.2f	%15f\n";
$delimiters = "	,";
$counter=0;
echo "$ticker";

while( !(feof($fp)))
{
	$line = fgets($fp,512); if(strlen($line)==0) break;

	$skip=strtok($line, $delimiters);
	$dt=strtok($delimiters);
	$op=strtok($delimiters);
	$hi=strtok($delimiters);
	$lo=strtok($delimiters);
	$cl=strtok($delimiters);
	$vl=strtok($delimiters);

	if(($dt>=$date1)&($dt<=$date2))
	{
		$counter++;
		fprintf($datafull, $format, $counter,$dt,$op,$hi,$lo,$cl,$vl);
		if($op<$cl) // white candle

				fprintf($fpwhite, $format, $counter,$dt,$op,$hi,$lo,$cl,$vl);
		else
				fprintf($fpblack, $format, $counter,$dt,$op,$hi,$lo,$cl,$vl);
	}
}
fclose($fp);
fclose($fpwhite);
fclose($fpblack);

//Do the Same for Master

$todo = "../output/master.txt";
	$lines = file($todo);
	$data = split("\t", $lines[0] );

$ticker= $data[1];
$date1 = $data[2];
$date2 = $data[3];

//open file to write /read datea
$fp=fopen("../data/$ticker", "r");
//open chart.phl to be updated
$fpwhite = fopen("../output/master/$ticker"."_white", "w");
$fpblack = fopen("../output/master/$ticker"."_black", "w");
$datafull = fopen("../output/master/$ticker"."full","w");
//read and parsing data...

$format="%d	%15s	%15.2f	%15.2f	%15.2f	%15.2f	%15f\n";
$delimiters = "	,";
$counter=0;

while( !(feof($fp)))
{
	$line = fgets($fp,512); if(strlen($line)==0) break;

	$skip=strtok($line, $delimiters);
	$dt=strtok($delimiters);
	$op=strtok($delimiters);
	$hi=strtok($delimiters);
	$lo=strtok($delimiters);
	$cl=strtok($delimiters);
	$vl=strtok($delimiters);

	if(($dt>=$date1)&($dt<=$date2))
	{
		$counter++;
		fprintf($datafull, $format, $counter,$dt,$op,$hi,$lo,$cl,$vl);
		if($op<$cl) // white candle

				fprintf($fpwhite, $format, $counter,$dt,$op,$hi,$lo,$cl,$vl);
		else
				fprintf($fpblack, $format, $counter,$dt,$op,$hi,$lo,$cl,$vl);
	}
}
fclose($fp);
fclose($fpwhite);
fclose($fpblack);
?>
