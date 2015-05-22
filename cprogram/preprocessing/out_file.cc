#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stddef.h>

#include "../include/struct.h"
#include "../include/function.h"
#include "../include/utility.h"

void out_file(char *filename, char *ticker, float sum_pen, DAILY *daily, int start, int end)     
{
     
     FILE *fp;
     
     
     printf("%f\n", sum_pen);
     fp = fopen(filename, "w");   
     if(fp==NULL) 
     {
         printf("%s%s\n", "Can't open data file ", filename);
         exit(1);
     }	

     int length = end - start;
     int  count=start+1;                           //count number of lines
     //printf("%i\t%i\t%i\n", start, end, length);
	fprintf(fp, "%f\t%s\t%s\t%s", sum_pen, ticker, daily[start].dt, daily[end-1].dt);
//     while(count<end)
//     {
//	fprintf(fp,"%s	%15f	%15.2f	%15.2f	%15.2f	%15.2f\n", daily[count].dt,  daily[count].op,   daily[count].hi, daily[count].lo, daily[count].cl,  daily[count].vl);
   
//          count++;
//     }

     fclose(fp);

}
