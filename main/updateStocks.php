#! /usr/bin/php -q
<?php
$month = $argv[1];
$day = $argv[2];
$year = $argv[3];
//First download
echo $month.$day.$year;
$month --;


if ($handle = opendir('../stock/')) {
while(false !== ($file = readdir($handle))) {
			if($file == "." || $file ==".."){
	     echo "Skip\n";
	} else {
	exec("wget -O ./process/$file 'http://ichart.finance.yahoo.com/table.csv?s=$file&d=4&e=26&f=2011&g=d&a=$month&b=$day&c=$year&ignore=.'");
	
$fp=fopen("./process/".$file, "r");
$Filep = "../data/".$file;
$delimiters = "	,";
 $Handle = fopen($Filep, 'a');
$name = strtoupper($file);
$i =0;

	$line = fgets($fp,512); if(strlen($line)==0) break;
		while( !(feof($fp)))
		{
			$line = fgets($fp,512); if(strlen($line)==0) break;
			//$line = fgets($fp,512); if(strlen($line)==0) break;
		$datea  = strtok($line, $delimiters);
		$open  = strtok($delimiters);
		$high  = strtok($delimiters);
		$low  =  strtok($delimiters);
		$close  = strtok($delimiters);
		$volume =  strtok($delimiters);
		$date = $datea[0].$datea[1].$datea[2].$datea[3].$datea[5].$datea[6].$datea[8].$datea[9];

		 
		 $Data[$i] = $name .",".$date .",". $open  .",". $high .",".$low .",". $close .",". $volume."\n"; 
		$i++;
		}
		//now write backwards
		for($j=$i-1; $j >= 0; $j--)
		{
		 fwrite($Handle, $Data[$j]);

		}
		echo $name ." Updated!\n";
		

	}
}
}
fclose($Handle);

closedir($handle);


?>
