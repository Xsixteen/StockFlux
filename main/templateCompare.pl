set label " Author" at graph 0.01, 0.07
set label " Demo " at graph 0.01, 0.03
#set logscale y
#set yrange [75:105]
$set xrange [0:95]
~set xtics ("20100915" 10, "20101013" 30, "20101110" 50, "20101210" 71)
!set ytics (240,270,300,330,360)
set grid

op =3 
lo =4
hi=5
cl=6
vl=7

set lmargin 9
set rmargin 2
set format x ""

set multiplot
set size 1, 0.7
set origin 0, 0.3
set bmargin 0
^set title "Candle Stick Chart With Volume"
*plot '../ouput/compare/f_white' using 1:op:lo:hi:cl notitle with candlesticks lt 2,\
@     '../output/compare/f_black' using 1:op:lo:hi:cl notitle with candlesticks lt 1
unset label 1
unset label 2
unset title

set bmargin
set format x
set size 1.0, 0.3 
set origin 0.0, 0.0
set tmargin 0 

set autoscale y
set format y "%1.0f"

plot '../output/compare/f_white' using 1:vl notitle with impulses lt 2,\
     '../ouput/compare/f_black' using 1:vl notitle with impulses lt 1
unset multiplot

#set terminal type and ouput file name
set terminal png large
set output "../charts/aapl.png"

