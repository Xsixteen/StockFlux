set label " Author" at graph 0.01, 0.07
set label " Demo " at graph 0.01, 0.03
#set logscale y
#set yrange [75:105]
set xrange [0:16]
set xtics("       20110328"  0,"       20110401"  4,"       20110407"  8,"       20110413"  12,"       20110419"  16)
set ytics("14.828" 14.828,"15.166" 15.166,"15.504" 15.504,"15.842" 15.842,"16.18" 16.18)

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
set title 'Master Stock: F'
plot '../output/master/F_white' using 1:op:lo:hi:cl notitle with candlesticks lt 2, '../output/master/F_black' using 1:op:lo:hi:cl notitle with candlesticks lt 1
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

plot '../output/master/f_white' using 1:vl notitle with impulses lt 2,\
     '../ouput/master/f_black' using 1:vl notitle with impulses lt 1
unset multiplot

#set terminal type and ouput file name
set terminal png large
set output "../charts/aapl.png"

