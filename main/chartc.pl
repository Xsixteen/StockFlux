set label " Author" at graph 0.01, 0.07
set label " Demo " at graph 0.01, 0.03
#set logscale y
#set yrange [75:105]
set xrange[0:32]
set xtics("       20110211"  0,"       20110222"  6,"       20110302"  12,"       20110310"  18,"       20110318"  24)
set ytics("60.754" 60.754,"61.808" 61.808,"62.862" 62.862,"63.916" 63.916,"64.97" 64.97)

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
set title 'Compare Stock: pg'
plot '../output/compare/pg_white' using 1:op:lo:hi:cl notitle with candlesticks lt 2, '../output/compare/pg_black' using 1:op:lo:hi:cl notitle with candlesticks lt 1
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

