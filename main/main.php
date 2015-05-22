#!/usr/bin/php -q
<?php
$count =0;
if($argv[1] == "")
{
die("Arguments are main.php tickerSymbol");
}
//User Interface
$userTic = $argv[1];
if ($handle = opendir('../data/')) {
while(false !== ($file = readdir($handle))) {
			if($file == "." || $file ==".." ){
	     echo "Skip\n";
	} else {
	$output[$count]=exec("../cprogram/main/run $userTic 20 0 $file $count");
	$count ++;

	}
}
}

echo "Data Prep Analysis Done\n Now Locating Best Matches\n\n";

//Next Find Lowest Value
$lowest = 1000;
$lowindex = 0;
for($i=0;$i<$count;$i++)
{
//check for the lowest number
//0 indicates error?
if ($lowest > $output[$i] && $output[$i] != 0)
{

$lowest = $output[$i];
$lowindex = $i;
echo "New Lowest Found at $i\n";
}

}

echo "\n\n\tBest Match Found at $lowest which is index $lowindex\n";

echo "\n Preparing to make Chart Data\n";

$ticker = exec("../plot/mkdata.php $lowindex");
echo $ticker;
//Take the Ticker and Call Plots
echo "Preparing Plots";

echo "\nSetting Compare\n";
exec("../main/set_output_compare.php $ticker");

echo "\nSetting Master\n";
exec("../main/set_output_master.php $userTic");

//Used to fork here... but why? -- Simply create it sequentially
//$pid = pcntl_fork();

//if($pid){
exec("gnuplot -p ./chartc.pl");
//}
//else {
exec("gnuplot -p ./chartm.pl");
//}



?>
