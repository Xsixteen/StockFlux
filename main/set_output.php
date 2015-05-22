#!/usr/bin/php -q
<?php
	
	//file names for data manipulation
	$template = "templateTrial.pl";
	$outFile = "chart.pl";
	$stockFile = "../data/fmasterfull";
	
	//string for chart.pl modification
	$xline = "set xtics(";
	$yline = "set ytics(";
	
	// writing new chart.pl based on x and y changes
	$write = fopen($outFile, 'w');
	
	// grabbing lines in the files for parsing
	$lines = file($template);
	$stocks = file($stockFile);
	

	$hi = 0;
	$low = 1000;
	$xstring = "";
	
	// grabbing lowest and highest values
	for( $i=0; $i<count($stocks); $i++ )
	{
		$data_array = split("\t", $stocks[$i]);
		for( $j=2; $j<=5; $j++)
		{		
			if( $data_array[$j] > $hi )
				$hi = $data_array[$j];
			if( $data_array[$j] < $low )
				$low = $data_array[$j];
			
		}
	}
	print "hi: $hi, low: $low\n";

	// creating string for x
	$stock_count = count($stocks);
	$intervals = 5;
	$deltax = $stock_count/$intervals;
	$deltaxInt = round($deltax);	

	for( $i=0; $i<$intervals; $i++ )
	{
		$j = $i+1;
		$checkpoint = $i*$deltaxInt;
		$data_array = split("\t", $stocks[$checkpoint]);
		$xstring = $xstring."\"$data_array[1]\"  $checkpoint,";
		print "$data_array[0]\n"; 

	}

	// creating string for y
	$ystring = "";
	$deltay = ($hi - $low)/$intervals;
	print "delta: $deltay\n";
	
	for( $i=1; $i<=$intervals; $i++)
	{
		$value = $low + ($deltay*$i);
		$ystring = $ystring."\"$value\" $value,";
		print "Value: $value\n";
	}




	// cutting off the last comma
	$count = count($xstring);
	$xstring = substr($xstring, 0,-1);
	$xline = $xline.$xstring.")\n";  //concatanating the string
	
	$county = count($ystring);
	$ystring = substr($ystring, 0, -1);
	$yline = $yline.$ystring.")\n";

	// formating the template to ouput the data
	for( $i=0; $i<count($lines);$i++ )
	{
		if( $lines[$i][0] == '~')
		{
		  	fwrite($write, $xline);
		}
		elseif( $lines[$i][0] == '!' )
		{
						
			fwrite($write, "$yline\n");
		}
		elseif( $lines[$i][0] == '$' )
		{
			$num = count($stocks)+1;
			fwrite($write, "set xrange[0:$num]\n");
		}		
		elseif( $lines[$i][0] == '%')
		{
			$low = round($low) - $deltay;
			$hi = round($hi) + $deltay;			
			$yline = "set yrange [".$low.":".$hi."]\n";
			fwrite($write, $yline);
		}
		
		else
		{
			fwrite($write, $lines[$i]);
		}
	}
?>
