#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stddef.h>

#include "../include/struct.h"
#include "../include/function.h"
#include "../include/utility.h"

#define linemax 514 
int  populate_daily(char *filename, DAILY *daily, int length)     
{
     //extern DAILY *daily;
     extern int nrows;
     int noreads;
     
     
     //count number of lines in file..............................
       //char *filename;
       nrows=linesInFile(filename);
     
     if (length < 2)
     {
	noreads = 1;
	length = nrows;
     }
     else
     {
	noreads = nrows - length -1;  
     }
	//allocate stockdata.........................................

       //daily=malloc_daily(0,length-1);

     //open file to read into stockdata...........................
     FILE *fp;
     fp = fopen(filename, "r");   
     if(fp==NULL) 
     {
         printf("%s%s\n", "Can't open data file ", filename);
         exit(1);
     }	

     char delimiters[] = ", ";
     char line[linemax];

     char *tmp;

     fgets(line, linemax, fp);               //skip header 

// filtering through to the data requested
     int i = 0;
     for(i=0; i<noreads; i++)
	fgets(line, linemax, fp);

//grab previous days close
     tmp = strtok(line, delimiters);	//ticker
     tmp = strtok(NULL, delimiters);	//date
     tmp = strtok(NULL, delimiters);	//open
     tmp = strtok(NULL, delimiters);	//hi
     tmp = strtok(NULL, delimiters);	//low

     float pcl = atof(strtok(NULL, delimiters));
	tmp = strtok(NULL, delimiters);	//vl

     float temp;
     int  count=0;                           //count number of lines
     while( fgets(line, linemax, fp) !=NULL)
     {
          tmp=strtok(line, delimiters);      //ticker (skipped)
          
          //daily[count].dt= ;         //date
	  strcpy(daily[count].dt, strtok(NULL, delimiters) );
//printf("%s\n", daily[count].dt);
          daily[count].op=(atof(strtok(NULL, delimiters)))/pcl;   //open
          daily[count].hi=(atof(strtok(NULL, delimiters)))/pcl;   //high
          daily[count].lo=(atof(strtok(NULL, delimiters)))/pcl;   //low
	  temp = atof(strtok(NULL, delimiters));
          daily[count].vl=(atof(strtok(NULL, delimiters)))/pcl;   //volume
          
	  daily[count].cl=temp/pcl;   //close
          pcl = temp;
	  
	  count++;
     }

     fclose(fp);
	return count;
}
