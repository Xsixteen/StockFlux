#!/usr/bin/php -q
<?php
   $mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $starttime = $mtime; 

$fileCount=0;
$progress=0;
$truecount=0;
$lowI=0;
//User Interface

if ($handle2 = opendir('../data/')) {
while(false !== ($userTic = readdir($handle2))) {
			if($userTic == "." || $userTic ==".." ){
	     echo "Skip\n";
	} else {
//individual stock analysis
$pval = $progress / 1172;
	echo "PROGRESS: $pval%  \t on File $progress \n"; 
	$count=0;
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

$ticker = exec("../plot/mkdata.php $lowindex $endVal");

$bestMatch[$truecount][4] = $endVal;
$bestMatch[$truecount][3] = $lowest;
$bestMatch[$truecount][0] = $userTic;
$bestMatch[$truecount][1] = $ticker;

echo "\tFinished with $userTic"; 
$mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   echo "\tCurrent Execution Time: ".$totaltime." Seconds\n"; 
$truecount++;
$endVal++;
$progress++;
}
}
}
//What is the Best Match Bat Man?
$low =1000;
		for($i=0;$i<$truecount;$i++)
		{
		//check for the lowest number
		//0 indicates error?
		if ($low > $bestMatch[$i][3] && $bestMatch[$i][3] != 0)
		{

		$low = $bestMatch[$i][3];
		$lowI = $i;
		echo "Best Stock Match Found at: $i\n";
		}

		}
$match1 =$bestMatch[$lowI][0];
$match2= $bestMatch[$lowI][1];
$value = $bestMatch[$lowI][3];
$append = $bestMatch[$lowI][4];
echo "Best Stock Matches: $match1 and $match2.\n";
echo "The Value of the Best Stock Match is: $value\n\n";
echo "Preparing Plots";

echo "\nSetting Compare\n";
exec("../main/set_output_compare.php $match2 $append");

echo "\nSetting Master\n";
exec("../main/set_output_master.php $match1");

 $mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   echo "This Script took ".$totaltime." Seconds"; 

$pid = pcntl_fork();

if($pid){
exec("gnuplot -p ./chartc.pl");
}
else {
exec("gnuplot -p ./chartm.pl");
}



?>
