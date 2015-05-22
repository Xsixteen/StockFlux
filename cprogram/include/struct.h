#ifndef struct_h
#define struct_h

typedef struct{
	char	*dt;
	float	op, hi,lo, cl, vl;

}DAILY;

typedef struct{
	char	*dt;
	float	gap, losh, body, upsh;

}CANDLES;

typedef struct{
	char	ticker[20];
	char	dt1[10];
	char	dt2[10];
	float	rank;
	float	trend;

}MATCH;
#endif
