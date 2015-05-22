//Header file for functions 

int   linesInFile(char*);
void  populate_data(char *);
void  writeData(char *);
int populate_daily(char *, DAILY *, int);
void populate_candles(int num, CANDLES *, DAILY *);
float penalty(CANDLES master, CANDLES comp);
float pen_sum(CANDLES *m, int l1, CANDLES *c,int l2);
void out_file(char *, char *, float, DAILY *, int, int);     

