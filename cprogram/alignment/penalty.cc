#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stddef.h>
#include <math.h>
#include <iostream>
#include "../include/struct.h"
#include "../include/function.h"
#include "../include/utility.h"



float penalty(CANDLES master, CANDLES comp)     
{
float sum =0;

 sum += pow(pow(master.gap-comp.gap,2),.5);
 sum += pow(pow(master.body-comp.body,2),.5);
 sum += pow(pow(master.losh-comp.losh,2),.5);
 sum += pow(pow(master.upsh-comp.upsh,2),.5);
return sum;
}


