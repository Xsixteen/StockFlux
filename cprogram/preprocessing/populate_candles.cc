#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stddef.h>
#include <iostream>
#include "../include/struct.h"
#include "../include/function.h"
#include "../include/utility.h"
float max(float one, float two);
float min(float one, float two);

#define linemax 514 
void  populate_candles(int num, CANDLES *candle, DAILY *daily)     
{
     //extern CANDLES *candle;
     //extern DAILY *daily;
     extern int nrows;
     float bodyhi,bodylo, pcl;

       
     //allocate stockdata.........................................

       //candle=malloc_candles(0,num-1);

     pcl = daily[0].cl;

     int  count=0;                           //count number of lines
     while( count < num-1)
     {

	 bodyhi=max(daily[count+1].op,daily[count+1].cl);
	 bodylo=min(daily[count+1].op,daily[count+1].cl);
         strcpy(candle[count].dt, daily[count+1].dt);
         candle[count].gap= daily[count+1].op-pcl;
	 candle[count].body= daily[count+1].cl - daily[count].op;
         candle[count].losh= bodylo - daily[count+1].lo;
          candle[count].upsh= daily[count].hi-bodyhi;
	 pcl = daily[count].cl;

          count++;
     }

}

float min(float one, float two)
{
if (one < two)
return one;
else
return two;
}

float max(float one, float two)
{
if (one > two)
return one;
else
return two;
}
