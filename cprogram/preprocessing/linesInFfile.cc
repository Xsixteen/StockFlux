/* The program returns the number of lines in a given text file.
 * The header line is skipped. If there is no header line, then the first line is skipped. 
 *
 * Input       :   filename
 * return value:   number of lines in the file, -1 if the file cannot be opened. 
 */

#include <string.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>

#define linemax 514
int  linesInFile(char *filename )     
{

     FILE *fp;   
     fp = fopen(filename, "r");   

     if(fp==NULL) 
     {
         printf("%s%s\n","Error: can't open file ", filename);
         return -1;
     }
   
     char delimiters[] = " ,";
     char line[linemax];

     int  count=0;
     fgets(line, linemax, fp);  //skip header 

      while( fgets(line, linemax, fp) !=NULL)
      {
          count++;
      }

     fclose(fp);

     return count;
}
