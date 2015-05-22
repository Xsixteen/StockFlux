#!/usr/bin/php -q
<?



//define log base

$base =2.0;

//open file to write/ read data

$fpwhite = fopen("../data/$tbname"."_white", "r");
$fpblack = fopen("../data/$tbname"."_black", "r");

//open chart.pl to be updated

$fq = fopen("./chart.pl", "w");

//read and parse data


while( !(feof($fp)))
{
	$line = fgets($fp,512); if(strlen($line)==0) break;

	$counter++;
	$skip=strtok($line, $delimiters);
	$dt[counter]=strtok($delimiters);
	$op[counter]=strtok($delimiters);
	$hi[counter]=strtok($delimiters);
	$lo[counter]=strtok($delimiters);
	$cl[counter]=strtok($delimiters);
	$vl[counter]=strtok($delimiters);
}
	$nrows = $counter;
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


fclose($fpwhite);
fclose($fpblack);
