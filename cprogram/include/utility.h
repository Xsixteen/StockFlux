#ifndef utility_h
#define utility_h

/*header file of utility functions*/

void   mkstring(const char *, const char *, char *&);


/* allocate matrices and vectors */

//float **dmatrix(           int, int, int, int);
//void free_dmatrix(float**, int, int, int, int);

//float *dvector(int, int);
//void free_dvector(float*, int, int);

//int  *ivector(int, int);
//void free_ivector(int*, int, int);


/* allocate array of structures */
DAILY* malloc_daily(int, int);
void free_daily(DAILY*, int, int);

/* allocate array of structures */
CANDLES* malloc_candles(int, int);
void free_candles(CANDLES*, int, int);

#endif
