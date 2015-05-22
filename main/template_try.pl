# for candle chart plotting, data format is given by
#   x open low high close
# column-wise, separated by space or tab.

# define variables for column numbers
x=1
op=3
lo=4
hi=5
cl=6

#chart settings
#~set xtics ("a" 1, "b" 2, "d" 8)
#unset border
#!set ytics ("0" 0, "2" 2, "4" 4, "8" 8)
set grid
set nokey

set bmargin 3
set tmargin 3
set lmargin 10
set rmargin 3
#

#
#$set xrange [0:11]
#%set yrange [0:100]
#
#
#
set title "Candlesticks showing both states of open/close"
set style fill empty
set boxwidth 0.2
plot '../output/master/aaplfull' using x:op:lo:hi:cl with candlesticks, \
NaN with boxes lt 1 fs solid 1
#
#
