#!/usr/bin/php -q
<?

	$white = file("./temp/aapl_white");
	$black = file("./temp/aapl_black");


	$whiteMax = $white[0];
	$whiteMin = $white[0];
	for( $i=0; $i < count($white); $i++)
	{
		if( $white[$i] > $whiteMax )
			$whiteMax = $white[$i];
		if( $white[$i] < $whiteMin )
			$whiteMin = $white[$i];
	}

	$blackMax = $black[0];
	$blackMin = $black[0];
	for( $i=0; $i < count($black); $i++)
	{
		if( $black[$i] > $blackMax )
			$blackMax = $black[$i];
		if( $black[$i] < $blackMin )
			$blackMin = $black[$i];
	}
	
	$white1[count($white)];
	$black1[count($black)];

	$whiteNorm = $whiteMax - $whiteMin;
	$blackNorm = $blackMax - $blackMin;

	


?>
