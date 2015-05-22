#include <stdio.h>
#include <stdlib.h>
#include <stddef.h>
#include "../include/struct.h"

#define nr_end 0
#define free_arg char* 

DAILY *malloc_daily(int nl, int nh){
	//allocate an array of structures of typedef STOCKDATA with subscript range nl...nh
	
	DAILY *v;
	v=(DAILY*) malloc( (size_t) (nh-nl+1)*sizeof(DAILY)  );
	if (!v) 
	{
		printf("failure in allocating typedef DAILY\n");
		exit(1);
	}
        //allocate memory for the string component in the structure (must be done)
        int j;
        for (j=nl;j<=nh;j++) v[j].dt= (char*) malloc( (size_t) 8*sizeof(char)  );

	return v-nl;
}

void free_daily(DAILY* v, int nl, int nh){
	//free an array of typedef DAILY 

	free( (free_arg)(v+nl-nr_end) );
}

CANDLES *malloc_candles(int nl, int nh){
	//allocate an array of structures of typedef STOCKDATA with subscript range nl...nh
	
	CANDLES *v;
	v=(CANDLES*) malloc( (size_t) (nh-nl+1)*sizeof(DAILY)  );
	if (!v) 
	{
		printf("failure in allocating typedef DAILY\n");
		exit(1);
	}
        //allocate memory for the string component in the structure (must be done)
        int j;
        for (j=nl;j<=nh;j++) v[j].dt= (char*) malloc( (size_t) 8*sizeof(char)  );

	return v-nl;
}

void free_candles(CANDLES* v, int nl, int nh){
	//free an array of typedef DAILY 

	free( (free_arg)(v+nl-nr_end) );
}
