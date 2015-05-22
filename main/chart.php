#!/usr/bin/php -q

<?php
$STOCKS_TO_DISPLAY = 10;

$FileName = "../data/aapl";
$fileout = "../data/stocks.dat";
  $lines = count(file($FileName));

$fh = fopen($FileName, 'r') or die("Can't open file");
$fw = fopen($fileout, 'w');
for($i=0; $i < $lines ; $i++){
$data = fgets($fh);
$data_array = split(',', $data);

$stockName =  $data_array[0];
$date = $data_array[1];
$open = $data_array[2];
$high = $data_array[3];
$low = $data_array[4];
$close = $data_array[5];

//Now output to candlesticks.dat
//Output in form Data - Open- Low- High - Close
$output[$i] = $date."\t".$open."\t".$low."\t".$high."\t".$close."\n";
}

for($i =$STOCKS_TO_DISPLAY; $i >= 1 ; $i--)
{
$iloc = $STOCKS_TO_DISPLAY+1-$i;
$writeout = $iloc."\t".$output[$lines - $i];
fwrite($fw,$writeout);

}
//fwrite($fw, $output);

fclose($fw);
fclose($fh);

?>
