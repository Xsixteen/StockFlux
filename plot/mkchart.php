#!/usr/bin/php -q
<?

$tbname = "aapl";

//define log base

$base =2.0;
$todo = "../cprogram/output/compare.txt";
//open file to write/ read data

$fpwhite = fopen("../data/$tbname"."_white","r");
$fpblack = fopen("../data/$tbname"."_black", "r");

//open chart.pl to be updated

$fp = fopen("./chart.pl", "w");

//read and parse data
	$lines = file($todo);
	$data = split("\t", $lines);

$ticker= $data[1];
$datest = $data[2];
$dateend = $data[3];

while( !(feof($fp)))
{
	$line = fgets($fp,512); if(strlen($line)==0) break;

	$counter++;
	$skip=strtok($line, $delimiters);
	$dt[$counter]=strtok($delimiters);
	$op[$counter]=strtok($delimiters);
	$hi[$counter]=strtok($delimiters);
	$lo[$counter]=strtok($delimiters);
	$cl[$counter]=strtok($delimiters);
	$vl[$counter]=strtok($delimiters);
}
	$nrows = $counter;
/*
//calculate misc bounds
	$maxpri =0.0;
	$minpri=$hi[1];

for($i=0;$i<nrows;$i++)
{
	$maxpri=max($hi[$i], $maxpri);
	$minpri=min($lo[$i], $minpri);
}

//Scaling so the values are aboe 1
$pfactor = $base/$minpri;
$maxpri *=$pfactor;
$minpri *=$pfactor;

$logchartmax=log($maxpri);
$logchartmin=log($minpri);

//convert to log values
/*
for($i=0;$i<$nrows;$i++)
{


	$log_op[$i]= log($op[$i]*$pfactor,$base);
	$log_hi[$i]= log($hi[$i]*$pfactor,$base);
	$log_lo[$i]= log($lo[$i]*$pfactor,$base);
	$log_cl[$i]= log($cl[$i]*$pfactor,$base);
}

//define tick values on the vertical axis
$N=10;
$delta=1.0/$N;

$minpri /=$pfactor; //scale back
$maxpri /=$pfactor;
$v[0]=$minpri;

for($i=1;$i<=$N;$i++)
{

	$v[$i]= $minpri*pow($maxpri/$minpri, $i/$N);

	$v[$i]=ceil($v[$i]*100)/100;
}

*/
$fpwhite1 = fopen("./temp/$tbname"."_white", "w");
$fpblack1 = fopen("./temp/$tbname"."_black", "w");

$format="%d	%15s	%15.2f	%15.2f	%15.2f	%15.2f	%15f\n";
$counter=1;
for($i=0; $i<5;$i++){
if($log_op[$nrows-$i]<$log_cl[$nrows-$i]){ // white candle

				fprintf($fpwhite1, $format, $counter,$dt[$nrows-$i],$log_op[$nrows-$i],$log_hi[$nrows-$i],$log_lo[$nrows-$i],$log_cl[$nrows-$i],$vl[$nrows-$i]);
	}else{
				fprintf($fpblack1, $format, $counter,$dt[$nrows-$i],$log_op[$nrows-$i],$log_hi[$nrows-$i],$log_lo[$nrows-$i],$log_cl[$nrows-$i],$vl[$nrows-$i]);
	}
$counter++;
}

fclose($fpwhite1);
fclose($fpblack1);

fclose($fpwhite);
fclose($fpblack);
