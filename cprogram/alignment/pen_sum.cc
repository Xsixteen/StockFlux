#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stddef.h>
#include <math.h>
#include <iostream>
#include "../include/struct.h"
#include "../include/function.h"
#include "../include/utility.h"



float pen_sum(CANDLES *m, int l1, CANDLES *c,int l2)     
{
float sum =0;
int i,mi;
mi =0;

for(i=l2; i < l1+l2; i++)
{
sum+= penalty(m[mi],c[i]);
mi++;
}
return sum;
}


