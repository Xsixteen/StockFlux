

#include<stdio.h>
#include<stdlib.h>
#include<string.h>

#include "../include/struct.h"
#include "../include/function.h"
#include "../include/utility.h"

#include "../include/extern.h"
#define offset 10
float* time_shift(CANDLES *m, int l1, CANDLES *c, int l2);
int best_match(CANDLES *m, int l1, CANDLES *c, int l2);

int main(int argc, char *argv[])
{
	char *ticker=argv[1];
	char *var=argv[2];
	char *date2=argv[3];
	char *ticker2 = argv[4];
	char *phpid = argv[5];
	char file[40], file2[40];
	char outC[50];
	int num, numc;
	float pen;
	int nrows;
	DAILY *master, *comp;
	CANDLES *masterc, *compc;
	
	// defines amount days to compare
	int length = atoi(var);

	strcpy(outC, "../cprogram/output/compare/");
	strcat(outC, phpid);	
	//printf( "%s\n", ticker);
	
	//printf( "%i\n", length);

	char *filelocation = "../data/";
	strcpy( file, filelocation );
	strcat( file, ticker ); 	

	strcpy( file2, filelocation );
	strcat( file2, ticker2 ); 
	FILE *fp = fopen( file, "r" );
		
	//printf( "%s\n", file);	

	if( fp == NULL )
	{
		printf ("Poop, didn't find it!\n");
		return 0;
	}
		
	
	// allocate compare stock
	nrows = linesInFile( file );
	comp=malloc_daily(0,nrows-1);
	numc = populate_daily( file2, comp, 0 );

	compc=malloc_candles(0,numc-1);	
	populate_candles( numc, compc, comp );

	// allocate master stock
	master=malloc_daily(0,length);
	num = populate_daily( file, master, length );


	masterc=malloc_candles(0,num-1);	
	populate_candles( num, masterc, master );	
	
	//printf("There are %i stocks in compare stock and %i stocks in master\n", numc, num);

//	int i = 0;
//	int j = numc-num;
//	for(i = 0; i < num; i++)
//	{
//		
//		pen = penalty( masterc[i], compc[j-1] );
//		printf( "%f\n", pen );	
//		j++;
//			
//	}

	

	//float sum = pen_sum(masterc, num, compc, numc-num );
	//printf("The summed penalty is: %f\n", sum);

// creates an array of penalties for comparisons.
	float *compares;
	compares = time_shift(masterc, num, compc, numc);
	
// makes in an index of the start point for the best match date range.
	int index = best_match(masterc, num, compc, numc);

//printing of index and the start date of comparing stock best match
	//printf("Index of best match is: %i, %f\n", index, compares[index] );
	//printf("Start date of best match is: %s\n", compc[index].dt);
	float passer = compares[index];

	out_file("../output/master.txt", ticker, 0, master, 0, num);
	out_file(outC, ticker2, passer, comp, (index+1), (index+1+num+offset));
	//printf("%s\t%i\n", comp[index+1].dt, num);
	printf("%f", passer);
	free_candles( masterc, 0, linesInFile(file)-1 );
	free_daily( master, 0, linesInFile(file)-1 );




  return 0;
}

float* time_shift(CANDLES *m, int l1, CANDLES *c, int l2)
{
	int numcompares = l2-2*l1;
	float arr[numcompares];

	int i=0;
	for(i=0; i<=numcompares; i++)
	{
		arr[i] = pen_sum(m, l1, c, i);
		//printf("Number%i \t%f\n", i, arr[i]);
	}
	
	return arr;

}

int best_match(CANDLES *m, int l1, CANDLES *c, int l2)
{
	int numcompares = l2-2*l1;
	float arr[numcompares];

	int i=0;
	float check = 1000;
	int lowest_index = 0;
	for(i=0; i<=numcompares; i++)
	{
		arr[i] = pen_sum(m, l1, c, i);
		//printf("Number%i\t%f\n", i, arr[i]);
		if (arr[i] < check )
		{
			check = arr[i];
			lowest_index = i;
			//printf("\t%f\n", check);
		}
	
	}
	
	return lowest_index;

}
