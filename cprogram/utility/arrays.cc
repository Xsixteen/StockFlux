#include <stdio.h>
#include <stdlib.h>

#include <stddef.h>
#define nr_end 1
#define free_arg char* 


//.......................................................................

float **dmatrix(int nrl, int nrh, int ncl, int nch){
	//allocate a float matrix with subscript range
	//row: nrl...nrh
	//col: ncl...nch
	
	int i, nrow=nrh-nrl+1, ncol=nch-ncl+1;
	float** m;

	//allocate pointers to rows
	m=(float**) malloc( (size_t) ( (nrow+nr_end)*sizeof(float*) ) );
	if (!m) 
	{
		printf("failure in allocating dmatrix\n");
		exit(1);
	}

	m +=nr_end;
	m -=nrl;


	//allocate rows and set pointer to them
        m[nrl]=(float*) malloc( (size_t) ((nrow*ncol+nr_end)*sizeof(float)) );
	if (!m[nrl])
	{
		printf("failure in allocating dmatrix\n");
		exit(1);
	}
	m[nrl] +=nr_end;
	m[nrl] -=ncl;
	for (i=nrl+1; i<=nrh; i++) m[i]=m[i-1]+ncol;

	return m;
}



void free_dmatrix(float **m, int nrl, int nrh, int ncl, int nch){
	//free float matrix allocated by dmatrix(...)
	free( (free_arg)(m[nrl]+ncl-nr_end) );
	free( (free_arg)(m+nrl-nr_end) );
}

//.......................................................................

float *dvector(int nl, int nh){
	//allocate a float vector with subscript range nl...nh
	
	float *v;
	v=(float*) malloc( (size_t)(nh-nl+1+nr_end)*sizeof(float)  );
	if (!v) 
	{
		printf("failure in allocating dvector\n");
		exit(1);
	}
	return v-nl+nr_end;
}

void free_dvector(float *v, int nl, int nh){
	//free a float vector allocated by dvector(...)

	free( (free_arg)(v+nl-nr_end)  );
}

//.......................................................................

int *ivector(int nl, int nh){
	//allocate a float vector with subscript range nl...nh
	
	int *v;
	v=(int*) malloc( (size_t)(nh-nl+1+nr_end)*sizeof(int)  );
	if (!v) 
	{
		printf("failure in allocating ivector\n");
		exit(1);
	}
	return v-nl+nr_end;
}

void free_ivector(int *v, int nl, int nh){
	//free a float vector allocated by dvector(...)

	free( (free_arg)(v+nl-nr_end)  );
}
